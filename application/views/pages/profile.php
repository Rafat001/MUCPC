
<?php if(!isset($this->user)) {
  redirect(base_url());
} ?>
<?php
ini_set('max_execution_time', 0);
$user = $this->user;
?>
<title><?= $user->name ?> | Metropolitan Unviersity Competitive Programming Community</title>
<div class="row">
  <div class="col-lg-2">
    <h5 style="margin-bottom: 10px; margin-top: 10px">Profile of <?= $user->name ?></h5>
    <h5>
      <?php if($user->role == 'mentor'):?>
        <alert class="alert alert-success" style=" padding: 5px" ><i class="fas fa-star"></i> Mentor</alert>
      <?php endif?>
      <?php if($user->role == 'admin'):?>
        <alert class="alert alert-warning" style=" padding: 5px" ><i class="fas fa-user-shield"></i> Admin</alert>
      <?php endif?>
      <?php if($user->role == 'coach'):?>
        <alert class="alert alert-info" style=" padding: 5px" ><i class="fas fa-chalkboard-teacher"></i> Coach</alert>
      <?php endif?>
    </h5>
    <img src="<?= base_url() . $user->photo ?>" class="rounded-circle" style="text-align: center; margin: 10px" width="100" height="100" > 
  </div>
  <?php
  if ($this->locate == ''):
  ?>
<div class="col-lg-10">
      <ul class="nav nav-tabs" style="font-size: 18px">
        <li class="nav-item">
          <a class="nav-link active">User Information</a>
        </li>
        <?php if($user->role == "user"): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('profile/' . $user->username) ?>/oj_profile">Online Judge Profiles</a>
        </li>
        <?php endif?>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('profile/' . $user->username) ?>/blog">Blog</a>
        </li>
        <?php if($user->role == "user"): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('profile/' . $user->username) ?>/tagwise_solve" onclick="showToast()">Tagwise Solve</a>
        </li>
        <?php endif?>
      </ul>
      <div class="row" style="margin-top: 10px;">
        <div class="col-lg-6" style="margin-bottom: 20px">
          <h5 class="card-title">
            Personal Information
          </h5>
          <div class="card">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Name: <?= $user->name ?></li>
              <li class="list-group-item">Username: <?= $user->username ?></li>
              <?php if($user->role == "user"): ?>
              <li class="list-group-item">Student ID: <div style="font-size: 15px" class="badge badge-primary"><?= $user->student_id ?></div></li>
              <?php endif?>
             </ul>
          </div>
        </div>
        <div class="col-lg-6" style="margin-bottom: 20px">
          <h5 class="card-title">
             Contact Information
          </h5>
            <div class="card">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Email: <?= $user->email ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

<?php
endif;
?>
<?php
if ($this->locate == 'oj_profile' && $user->role == 'user'):
include('locate_oj_profile.php');
endif;
?>
<?php
if ($this->locate == 'blog'):
include('locate_blog.php');
endif;
if ($this->locate == 'tagwise_solve' && $user->role == 'user'):
include('locate_tagwise_solve.php');
endif;
?>

  </div>



<script>
  function showToast() {
    alert("This segment may need some moments to be loaded.");
  }
</script>
