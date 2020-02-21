<title>Programmers | Metropolitan Unviersity Competitive Programming Community</title>
<h3>Our Programmers</h3>
<table style="font-size: 15px" id="user" class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th style="font-family: Ubuntu-B;">#</th>
      <th style="font-family: Ubuntu-B;">Name</th>
      <th style="font-family: Ubuntu-B;">Codeforces</th>
      <th style="font-family: Ubuntu-B;">Codechef</th>
      <th style="font-family: Ubuntu-B;">Topcoder</th>
      <th style="font-family: Ubuntu-B;">UVa</th>
      <th style="font-family: Ubuntu-B;">SPOJ</th>
      <th style="font-family: Ubuntu-B;">LightOJ</th>
      <th style="font-family: Ubuntu-B;">Toph</th>
      <th style="font-family: Ubuntu-B;">*</th>
    </tr>
  </thead>
  <?php $users = $this->Auth_model->get_user(array('is_active' => "1", 'verified' => "1", 'role' => "user"));
    $cnt = 1;
    foreach ($users as $user) {
      ?>
      <tr>
        <td style="padding: 10px"><?= $cnt++ ?></td>
        <td style="padding: 10px"><?= $user->name ?> <alert class="alert alert-success" style="padding: 6px;margin: 0px; float: right; margin-left: 10px"><?= $user->student_id ?></alert></td>
        <td style="padding: 10px"><?= $user->codeforces ?></td>
        <td style="padding: 10px"><?= $user->codechef ?></td>
        <td style="padding: 10px"><?= $user->topcoder ?></td>
        <td style="padding: 10px"><?= $user->uva ?></td>
        <td style="padding: 10px"><?= $user->spoj ?></td>
        <td style="padding: 10px"><?= $user->lightoj ?></td>
        <td style="padding: 10px"><?= $user->toph ?></td>
        <td style="padding: 10px"><a type="button" class="btn btn-primary btn-sm" href="<?= base_url() . "profile/" . $user->username ?>">Profile</a></td>
      </tr>
      <?php
    }
  ?>
</table>
<script>
$(document).ready(function () {
    $('#user').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>