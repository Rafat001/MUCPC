<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="mucpcl-tab" data-toggle="tab" href="#mucpcl" role="tab" aria-controls="mucpcl" aria-selected="false">MUCPC Leaderboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contributionl-tab" data-toggle="tab" href="#contributionl" role="tab" aria-controls="contributionl" aria-selected="true">Contribution Leaderboard</a>
  </li>
</ul>


<div class="tab-content" id="myTabContent" style="margin-top: 10px">
  <div class="tab-pane fade show active" id="mucpcl" role="tabpanel" aria-labelledby="mucpcl-tab">
		<?php if($this->session->userdata('role') != "user" && $this->session->userdata('role') != ''): ?>
		<a role="button" style="float: right;" class="btn btn-warning btn-sm" href="?update=true">Update</a>
		<?php endif?>
		<?php if ($this->input->get('update') == "true" && $this->session->userdata("role") != "" && $this->session->userdata("role") != "user"):?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		        Leaderboard Updated Successfully!
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php
		endif?>
		<h5>MUCPC Leaderboard</h5>
		<table style="font-size: 15px" id="mucpc" class="table table-bordered table-striped table-hover">
		  <thead>
		    <tr>
		      <th style="font-family: Ubuntu-B;">#</th>
		      <th style="font-family: Ubuntu-B;">Name</th>
		      <th style="font-family: Ubuntu-B;">Codeforces Rating</th>
		      <th style="font-family: Ubuntu-B;">Codeforces Max Rating</th>
		      <th style="font-family: Ubuntu-B;">Codechef Rating</th>
		      <th style="font-family: Ubuntu-B;">Codechef Max Rating</th>
		      <th style="font-family: Ubuntu-B;">Total Score</th>
		      <th style="font-family: Ubuntu-B;">*</th>
		    </tr>
		  </thead>
		  <?php
		$users = $this->Auth_model->get_user(array(
						'is_active' => "1",
						'verified' => "1",
						'role' => "user"
		));
		foreach ($users as $user) {
		?>
		        <?php
						$CCrating    = $user->CCrating;
						$CCmaxRating = $user->CCmaxRating;
						$CFrating    = $user->CFrating;
						$CFmaxRating = $user->CFmaxRating;
						if ($this->input->get('update') == "true" && $this->session->userdata("role") != "" && $this->session->userdata("role") != "user"):
		?>
		        <?php
										if ($user->codeforces != '') {
														$url             = 'https://codeforces.com/api/user.info?handles=%20' . $user->codeforces . '%20';
														$html            = file_get_html($url);
														$json            = str_replace(array(
																		"\t",
																		"\n"
														), "", $html);
														$codeforces_info = json_decode($json);
														if ($codeforces_info->status == "OK") {
																		$CFrating    = $codeforces_info->result[0]->rating;
																		$CFmaxRating = $codeforces_info->result[0]->maxRating;
														} else {
																		$CFrating    = 0;
																		$CFmaxRating = 0;
														}
										} else {
														$CFrating    = 0;
														$CFmaxRating = 0;
										}
		?>
		<?php
										$context = stream_context_create(array(
														"http" => array(
																		"header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
														)
										));
										if ($user->codechef == "") {
														$CCmaxRating = 0;
														$CCrating    = 0;
										} else {
														$html   = file_get_html('https://www.codechef.com/users/' . $user->codechef, false, $context);
														$findme = '<div class="rating-number">';
														$pos    = strpos($html, $findme);
														$pos += strlen($findme);
														$str         = strval($html);
														$CCrating    = "";
														$CCmaxRating = "";
														while ($str[$pos] >= '0' && $str[$pos] <= '9') {
																		$CCrating = $CCrating . $str[$pos];
																		$pos++;
														}
														if ($CCrating == "")
																		$CCrating = "0";
														$findme = '<small>(Highest Rating ';
														$pos    = strpos($html, $findme);
														$pos += strlen($findme);
														$str = strval($html);
														while ($str[$pos] >= '0' && $str[$pos] <= '9') {
																		$CCmaxRating = $CCmaxRating . $str[$pos];
																		$pos++;
														}
														if ($CCmaxRating == "")
																		$CCmaxRating = "0";
										}
		?>
		<?php
						endif;
		?>
		      <?php
						$data = array(
										"CFrating" => $CFrating,
										"CFmaxRating" => $CFmaxRating,
										"CCrating" => $CCrating,
										"CCmaxRating" => $CCmaxRating
						);
						$this->Auth_model->updateRating($data, $user->username);
		}
		?>

		<?php
		$users = $this->Auth_model->get_user(array(
						'is_active' => "1",
						'verified' => "1",
						'role' => "user"
		));
		$userList = array();
		foreach ($users as $user) {
			$user->score = $user->CFrating * 4 + $user->CFmaxRating * 3 + $user->CCrating * 2 + $user->CCmaxRating * 1;
			array_push($userList, $user);
		}

		function cmp($a, $b)
		    {
		        return strcmp($b->score, $a->score);
		    }
		    usort($userList, "cmp");


		$cnt = 1;
		foreach ($userList as $user) {
		?>
		      <tr>
		        <td style="padding: 10px"><?= $cnt++ ?></td>
		        <td style="padding: 10px"><?= $user->name ?> <alert class="alert alert-success" style="padding: 6px;margin: 0px; float: right; margin-left: 10px"><?= $user->student_id ?></alert></td>
			<td style="padding: 10px"><?= $user->CFrating ?></td>
			<td style="padding: 10px"><?= $user->CFmaxRating ?></td>
			<td style="padding: 10px"><?= $user->CCrating ?></td>
			<td style="padding: 10px"><?= $user->CCmaxRating ?></td>
			<td style="padding: 10px"><?= $user->score ?></td>
		        <td style="float: right; padding: 10px"><a type="button" class="btn btn-primary btn-sm" href="<?= base_url() . "profile/" . $user->username ?>">Profile</a></td>
		      </tr>
		      <?php
		}
		?>
		</table>
	</div>


  <div class="tab-pane fade" id="contributionl" role="tabpanel" aria-labelledby="contributionl-tab">
		<h5>Contribution Leaderboard</h5>
		<table style="font-size: 15px" id="contribution" class="table table-bordered table-striped table-hover">
		  <thead>
		    <tr>
		      <th style="font-family: Ubuntu-B;">#</th>
		      <th style="font-family: Ubuntu-B;">Name</th>
		      <th style="font-family: Ubuntu-B;">Total Score</th>
		      <th style="font-family: Ubuntu-B;">*</th>
		    </tr>
		  </thead>
		<?php
		$users = $this->Auth_model->get_user(array(
						'verified' => "1"
		));
		$userList = array();
		foreach ($users as $user) {
			$user->score = sizeof($this->Question_model->get_helpful(array("created_by" => $user->username)));
			array_push($userList, $user);
		}
		    usort($userList, "cmp");


		$cnt = 1;
		foreach ($userList as $user) {
		?>
		      <tr>
		        <td style="padding: 10px"><?= $cnt++ ?></td>
		        <td style="padding: 10px"><?= $user->name ?> (<?= $user->username ?>)</td>
		        <td style="padding: 10px"><?= $user->score ?></td>
		        <td style="float: right; padding: 10px"><a type="button" class="btn btn-primary btn-sm" href="<?= base_url() . "profile/" . $user->username ?>">Profile</a></td>
		      </tr>
		      <?php
		}
		?>
		</table>
	</div>
</div>

<script>
$(document).ready(function () {
    $('#mucpc').DataTable({
    "order": [[6, "desc"]],
    responsive: true,

    });
  });
</script>

<script>
$(document).ready(function () {
    $('#contribution').DataTable({
    "order": [[2, "desc"]],
    responsive: true,

    });
  });
</script>