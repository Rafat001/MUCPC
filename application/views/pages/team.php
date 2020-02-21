<?php if(!isset($this->team)) {
  redirect(base_url());
} ?>
<?php
set_time_limit(0);
$team = $this->team;
?>


<title><?= $team->name ?> | Metropolitan Unviersity Competitive Programming Community</title>


<?php if($this->input->get('locate') != "chat" && $this->input->get('locate') != "settings"): ?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
  </li>
  <?php if(($this->username == $team->coach && $this->session->userdata('role') == "coach") || $this->username == $team->member1 || $this->username == $team->member2 || $this->username == $team->member3): ?>
  <li class="nav-item">
    <a class="nav-link" href="?locate=chat" id="chat-tab">Chat</a>
  </li>
<?php endif ?>
<?php
        if ($this->username == $team->coach && $this->session->userdata('role')=="coach"):
?>
  <li class="nav-item">
    <a class="nav-link" href="?locate=settings" id="chat-tab">Settings</a>
  </li>
<?php
        endif;
?>
</ul>

<div class="tab-content" id="myTabContent" style="margin-top: 10px">
  <div class="tab-pane fade <?php if($this->input->get('locate') != "chat") {echo("show active");} ?>" id="details" role="tabpanel" aria-labelledby="details-tab">
    <h5>Team Name: <b><?= $team->name ?></b></h5>
    <?php $user = $this->Auth_model->get_user_by_id(array("username" => $team->coach)) ?>
    <h6>Coach: <b><a href="<?= base_url() . "profile/" . $user->username ?>"><?= $user->name ?></a></b></h6>
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Member Name</th>
          <th>Student ID</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php $user = $this->Auth_model->get_user_by_id(array("username" => $team->member1)) ?>
          <td>
            1
          </td>
          <td>
            <a href="<?= base_url() . "profile/" . $user->username ?>"><?= $user->name ?></a>
          </td>
          <td>
            <?= $user->student_id ?>
          </td>
          <td>
            <?= $user->email ?>
          </td>
        </tr>
        <tr>
          <?php $user = $this->Auth_model->get_user_by_id(array("username" => $team->member2)) ?>
          <td>
            2
          </td>
          <td>
            <a href="<?= base_url() . "profile/" . $user->username ?>"><?= $user->name ?></a>
          </td>
          <td>
            <?= $user->student_id ?>
          </td>
          <td>
            <?= $user->email ?>
          </td>
        </tr>
        <tr>
          <?php $user = $this->Auth_model->get_user_by_id(array("username" => $team->member3)) ?>
          <td>
            3
          </td>
          <td>
            <a href="<?= base_url() . "profile/" . $user->username ?>"><?= $user->name ?></a>
          </td>
          <td>
            <?= $user->student_id ?>
          </td>
          <td>
            <?= $user->email ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php endif ?>

<?php if($this->input->get('locate') == "chat"): 
  include('chat.php');
endif; ?>

<?php
if ($this->input->get('locate') == "settings" && $this->session->userdata('role') == "coach" && $this->session->userdata('username') == $team->coach):?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('team/' . $team->id)?>" id="details-tab" >Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="?locate=chat" id="chat-tab">Chat</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="?locate=settings" id="settings-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Settings</a>
  </li>
</ul>


<div class="tab-content" id="myTabContent" style="margin-top: 10px">
  <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="details-tab">
    <h5>Change Team Name</h5>
      <form action="<?= base_url() ?>Teams/update" method="post">
        <input type="hidden" name="team_id" value="<?= $team->id ?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
          </div>
          <input name="name" id="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="" value="<?= $team->name ?>">
          <button class="btn btn-primary" type="submit">Update</button>
        </div>
      </form>
  </div>
</div>
<?php endif?>
