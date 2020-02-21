<h3>Admin Panel</h3>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link" id="user-tab" href="<?=base_url('admin')?>/user" aria-controls="user" aria-selected="true">User</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="team-tab" href="<?=base_url('admin')?>/team" aria-controls="team" aria-selected="true">Team</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" id="task-tab" data-toggle="tab" href="#task" role="tab" aria-controls="task" aria-selected="false">Task</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="group-tab" href="<?=base_url('admin')?>/group" aria-controls="group" aria-selected="true">Group</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="blog-tab" href="<?=base_url('admin')?>/blog" aria-controls="blog" aria-selected="true">Blog</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="question-tab" href="<?=base_url('admin')?>/question" aria-controls="question" aria-selected="true">Question</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="news-tab" href="<?=base_url('admin')?>/news" aria-controls="news" aria-selected="true">News</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent" style="margin-top: 20px">
  <div class="tab-pane fade show active" id="task" role="tabpanel" aria-labelledby="task-tab">
    <?php $tasks = $this->Task_model->get_task_all();
    ?>
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
          <th style="font-family: Ubuntu-B;">Creator
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
          <a href="<?= base_url('profile/') . $task->coach ?>" style="text-decoration: none;"><?= $task->coach ?></a>
        </td>
        <td style="padding: 10px">

          <a role="button" href="<?= base_url("Tasks/delete/" . $task->id) ?>" onclick="return confirm('Are you sure you want to delete <?= $task->name ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Delete</a>
          <a type="button" style="float: right;" class="btn btn-primary btn-sm" href="<?= base_url()."task/" .$task->id ?>">Enter
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
    $('#taskList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>
