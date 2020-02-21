<title>Dashboard | Metropolitan Unviersity Competitive Programming Community</title>
<h3>Dashboard</h3>
<ul class="nav nav-tabs" id="myTab" role="tablist">

  <li class="nav-item">
    <a class="nav-link active" id="task-tab" data-toggle="tab" href="#task" role="tab" aria-controls="task" aria-selected="false">Task</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="team-tab" data-toggle="tab" href="#team" role="tab" aria-controls="team" aria-selected="true">Team</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="group-tab" data-toggle="tab" href="#group" role="tab" aria-controls="group" aria-selected="false">Group</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade" id="team" role="tabpanel" aria-labelledby="team-tab">
    <?php $get_teams = $this->Team_model->get_team_all(); $teams = array();
      foreach ($get_teams as $team) {
        if($team->member1 == $this->username || $team->member2 == $this->username || $team->member3 == $this->username) {
          array_push($teams, $team);
        }
      }
    ?>
    <h3 style="margin: 20px">
      <center>You have assigned in  
        <?= sizeof($teams)?> team(s)
      </center>
    </h3>
    <table style="font-size: 15px" id="teamList" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#
          </th>
          <th style="font-family: Ubuntu-B;">Team Name
          </th>
          <th style="font-family: Ubuntu-B;">Member #1
          </th>
          <th style="font-family: Ubuntu-B;">Member #2
          </th>
          <th style="font-family: Ubuntu-B;">Member #3
          </th>
          <th style="font-family: Ubuntu-B;">Created on
          </th>
          <th style="font-family: Ubuntu-B;">*
          </th>
        </tr>
      </thead>
      <?php
$cnt = 1;
foreach ($teams as $team) {
?>
      <tr>
        <td style="padding: 10px">
          <?= $cnt++ ?>
        </td>
        <td style="padding: 10px">
          <?= $team->name ?>
        </td>
        <td style="padding: 10px">
          <a style="text-decoration: none;" href="<?= base_url('profile/' . $team->member1) ?>"><?= $team->member1 ?></a>
        </td>
        <td style="padding: 10px">
          <a style="text-decoration: none;" href="<?= base_url('profile/' . $team->member2) ?>"><?= $team->member2 ?></a>
        </td>
        <td style="padding: 10px">
          <a style="text-decoration: none;" href="<?= base_url('profile/' . $team->member3) ?>"><?= $team->member3 ?></a>
        </td>
        <td style="padding: 10px">
          <?= date("M d, Y g:i A",strtotime($team->created_on)) ?>
        </td>
        <td style="padding: 10px">
          <a type="button" class="btn btn-primary btn-sm" href="<?= base_url()."team/" .$team->id ?>">Enter
          </a>
        </td>
      </tr>
      <?php
}
?>
    </table>
  </div>
  <div class="tab-pane fade show active" id="task" role="tabpanel" aria-labelledby="task-tab">
    <?php $get_tasks = $this->Task_model->get_task_all(); $tasks = array();
      foreach ($get_tasks as $task) {
        if($this->Task_model->check_participant(array("username" => $this->username, "task_id" => $task->id)) != false) {
          array_push($tasks, $task);
        }
      }
    ?>
    <h3 style="margin: 20px">
      <center>You have assigned in  
        <?= sizeof($tasks)?> task(s)
      </center>
    </h3>
    <table style="font-size: 15px" id="taskList" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#
          </th>
          <th style="font-family: Ubuntu-B;">Name
          </th>
          <th style="font-family: Ubuntu-B;">Start Time
          </th>
          <th style="font-family: Ubuntu-B;">Duration
          </th>
          <th style="font-family: Ubuntu-B;">Type
          </th>
          <th style="font-family: Ubuntu-B;">*
          </th>
        </tr>
      </thead>
      <?php
$cnt = 1;
foreach ($tasks as $task) {
?>
      <tr>
        <td style="padding: 10px">
          <?= $cnt++ ?>
        </td>
        <td style="padding: 10px">
          <?= $task->name ?>
        </td>
        <td style="padding: 10px">
          <?= date("M d, Y g:i A",strtotime($task->start_on)) ?>
        </td>
        <td style="padding: 10px">
          <?= $task->duration ?>
        </td>
        <td style="padding: 10px">
          <?php
if($task->public == '1'):?><p style="margin: 0px; padding: 5px" class="alert alert-success">Public</p><?php endif; ?>
<?php 
if($task->public == '0'):?><p style="margin: 0px; padding: 5px" class="alert alert-warning">Private</p><?php endif; ?>
        </td>
        <td style="padding: 10px">
          <a onclick="showToast()" type="button" class="btn btn-primary btn-sm" href="<?= base_url()."task/" .$task->id ?>">Enter
          </a>
        </td>
      </tr>
      <?php
}
?>
    </table>
    <?php $get_tasks = $this->Task_model->get_task(array("public" => '1')); $tasks = array();
      foreach ($get_tasks as $task) {
        if($this->Task_model->check_participant(array("username" => $this->username, "task_id" => $task->id)) == false) {
          array_push($tasks, $task);
        }
      }
    ?>
    <hr>
    <h3>Public Tasks</h3>
    <table style="font-size: 15px" id="taskListPublic" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#
          </th>
          <th style="font-family: Ubuntu-B;">Name
          </th>
          <th style="font-family: Ubuntu-B;">Start Time
          </th>
          <th style="font-family: Ubuntu-B;">Duration
          </th>
          <th style="font-family: Ubuntu-B;">Type
          </th>
          <th style="font-family: Ubuntu-B;">*
          </th>
        </tr>
      </thead>
      <?php
$cnt = 1;
foreach ($tasks as $task) {
?>
      <tr>
        <td style="padding: 10px">
          <?= $cnt++ ?>
        </td>
        <td style="padding: 10px">
          <?= $task->name ?>
        </td>
        <td style="padding: 10px">
          <?= date("M d, Y g:i A",strtotime($task->start_on)) ?>
        </td>
        <td style="padding: 10px">
          <?= $task->duration ?>
        </td>
        <td style="padding: 10px">
          <?php
if($task->public == '1'):?><p style="margin: 0px; padding: 5px" class="alert alert-success">Public</p><?php endif; ?>
<?php 
if($task->public == '0'):?><p style="margin: 0px; padding: 5px" class="alert alert-warning">Private</p><?php endif; ?>
        </td>
        <td style="padding: 10px">
          <a type="button" class="btn btn-primary btn-sm" href="<?= base_url()."Tasks/register/" .$task->id ?>">Register
          </a>
        </td>
      </tr>
      <?php
}
?>
    </table>
  </div>
  <div class="tab-pane fade" id="group" role="tabpanel" aria-labelledby="group-tab">
    <?php $get_groups = $this->Group_model->get_group_all(); $groups = array();
      foreach ($get_groups as $group) {
        if($this->Group_model->get_participation_by_id(array("group_id" => $group->id, "username" => $this->username)) != false) {
          array_push($groups, $group);
        }
      }
    ?>
    <h3 style="margin: 20px">
      <center>You have assigned in  
        <?= sizeof($groups)?> group(s)
      </center>
    </h3>
    <table style="font-size: 15px" id="groupList" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#
          </th>
          <th style="font-family: Ubuntu-B;">Group Name
          </th>
          <th style="font-family: Ubuntu-B;">Created on
          </th>
          <th style="font-family: Ubuntu-B;">*
          </th>
        </tr>
      </thead>
      <?php
$cnt = 1;
foreach ($groups as $group) {
?>
      <tr>
        <td style="padding: 10px">
          <?= $cnt++ ?>
        </td>
        <td style="padding: 10px">
          <?= $group->name ?>
        </td>
        <td style="padding: 10px">
          <?= date("M d, Y g:i A",strtotime($group->created_on)) ?>
        </td>
        <td style="padding: 10px">
          <a type="button" class="btn btn-primary btn-sm" href="<?= base_url()."group/" .$group->id ?>">Enter
          </a>
        </td>
      </tr>
      <?php
}
?>
    </table>
  </div>
</div>

<script>
$(document).ready(function () {
    $('#teamList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>

<script>
$(document).ready(function () {
    $('#taskList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>

<script>
$(document).ready(function () {
    $('#taskListPublic').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>

<script>
$(document).ready(function () {
    $('#groupList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>
