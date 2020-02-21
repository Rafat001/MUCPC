<h3>Admin Panel</h3>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">User</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="team-tab" href="<?=base_url('admin')?>/team" aria-controls="team" aria-selected="true">Team</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="task-tab" href="<?=base_url('admin')?>/task"  aria-controls="task" aria-selected="false">Task</a>
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
  <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
    <?php $users = $this->Auth_model->get_user_all();
    ?>
    <center><button data-toggle="modal" data-target="#newUser" class="btn btn-primary btn-md">Create New</button></center>
    <table style="font-size: 15px" id="userList" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#
          </th>
          <th style="font-family: Ubuntu-B;">Name
          </th>
          <th style="font-family: Ubuntu-B;">Username
          </th>
          <th style="font-family: Ubuntu-B;">Role
          </th>
          <th style="font-family: Ubuntu-B;">Joined on
          </th>
          <th style="font-family: Ubuntu-B;">*
          </th>
        </tr>
      </thead>
      <?php
$cnt = 1;
foreach ($users as $user) {
?>
      <tr>
        <td style="padding: 10px">
          <?= $cnt++ ?>
        </td>
        <td style="padding: 10px">
          <?= $user->name ?>
        </td>
        <td style="padding: 10px">
          <?= $user->username ?>
        </td>
        <td style="padding: 10px">
          <?= $user->role ?>
        </td>
        <td style="padding: 10px">
          <?= date("M d, Y g:i A",strtotime($user->joined_on)) ?>
        </td>
        <td style="padding: 10px">
          <a role="button" href="<?= base_url("Auth/delete/" . $user->username) ?>" onclick="return confirm('Are you sure you want to delete <?= $user->name ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Delete</a>
          <a type="button" style="margin-left: 10px; float: right;" class="btn btn-primary btn-sm" href="<?= base_url()."profile/" .$user->username ?>">Profile
          </a>
          <div class="btn-group" style="float: right;">
            <?php if($user->verified == "1" && $user->role == "user"):?>
            <button style="margin-left: 10px" type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Change Active Status
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <?php if($user->is_active == "1"): ?>
              <a href="<?= base_url('Auth/changeActive/0/') . $user->username ?>" onclick="return confirm('Are you sure you want change status <?= $user->name ?> to inactive?');" type="button" class="dropdown-item" type="button">Make Inactive</a>
              <?php endif?>
              <?php if($user->is_active == "0"): ?>
              <a href="<?= base_url('Auth/changeActive/1/') . $user->username ?>" onclick="return confirm('Are you sure you want change status <?= $user->name ?> to active?');" type="button" class="dropdown-item" type="button">Make Active</a>
              <?php endif?>
            </div>
            <?php endif?>
          </div>
          <div class="btn-group" style="float: right;">
            <?php if($user->verified == "1"):?>
            <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Change Role
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <?php if($user->role != "admin"): ?>
              <a href="<?= base_url('Auth/changeRole/admin/') . $user->username ?>" onclick="return confirm('Are you sure you want change role <?= $user->name ?> to admin?');" type="button" class="dropdown-item" type="button">Change role to Admin</a>
              <?php endif?>
              <?php if($user->role != "coach"): ?>
              <a href="<?= base_url('Auth/changeRole/coach/') . $user->username ?>" onclick="return confirm('Are you sure you want change role <?= $user->name ?> to coach?');" type="button" class="dropdown-item" type="button">Change role to Coach</a>
              <?php endif?>
              <?php if($user->role != "mentor"): ?>
              <a href="<?= base_url('Auth/changeRole/mentor/') . $user->username ?>" onclick="return confirm('Are you sure you want change role <?= $user->name ?> to mentor?');" type="button" class="dropdown-item" type="button">Change role to Mentor</a>
              <?php endif?>              
              <?php if($user->role != "user"): ?>
              <a href="<?= base_url('Auth/changeRole/user/') . $user->username ?>" onclick="return confirm('Are you sure you want change role <?= $user->name ?> to user?');" type="button" class="dropdown-item" type="button">Change role to User</a>
              <?php endif?>
            </div>
            <?php endif?>
            <?php if($user->verified == "0"):?>
            <button type="button" class="btn btn-warning btn-sm disabled">
              Unverified
            </button>
            <?php endif?>
          </div>
        </td>
      </tr>
      <?php
}
?>
    </table>
  </div>
</div>


<!-- Modal -->
<div class="modal fade"  id="newUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New News</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php
          echo base_url();
          ?>Auth/create">
                
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
            </div>
            <input type="text" name="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"  id="inputGroup-sizing-default">Username</span>
            </div>
            <input type="text" name="username" pattern="[a-zA-Z0-9._]+" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>


          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
            </div>
            <input type="email" name="email" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Role</span>
            </div>
            <select name="role" class="form-control">
              <option value="admin">Admin</option>
              <option value="coach">Coach</option>
              <option value="trainer">Trainer</option>
              <option value="user" selected="">User</option>
            </select>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Student ID</span>
            </div>
            <input type="text" name="student_id" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" pattern="[0-9][0-9][0-9][-][0-9][0-9][0-9][-][0-9][0-9][0-9]">
          </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
$(document).ready(function () {
    $('#userList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>
