<title>Account | Metropolitan Unviersity Competitive Programming Community</title>

    <?php
if ($this->session->userdata('error_msg') != NULL) {
?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php
        echo $this->session->userdata('error_msg');
        $this->session->unset_userdata('error_msg');
?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
      <?php
}
?>

<?php
if ($this->session->userdata('success_msg') != NULL) {
?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        echo $this->session->userdata('success_msg');
        $this->session->unset_userdata('success_msg');
?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
      <?php
}
?>
<?php
$user = $this->db->get_where('users', array(
        'username' => $this->session->userdata('username')
))->row();
?>
<h3>Account</h3><hr>
<form method="post" enctype="multipart/form-data" action="Auth/update">
<div class="row">
    <div class="col-3">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active show" id="v-pills-personal-tab" data-toggle="pill" href="#v-pills-personal" role="tab" aria-controls="v-pills-personal" arcontactia-selected="true">Personal Information</a>
        <a class="nav-link " id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false">Contact Information</a>
        <?php if($user->role == "user"): ?>
        <a class="nav-link " id="v-pills-oj-tab" data-toggle="pill" href="#v-pills-oj" role="tab" aria-controls="v-pills-oj" aria-selected="false">Online Judge Profiles</a>
        <?php endif?>
        <a class="nav-link " id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
      </div>
    </div>
      <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent" style="margin-left: 10px">
          <div class="tab-pane fade active show" id="v-pills-personal" role="tabpanel" aria-labelledby="v-pills-personal-tab">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                </div>
                <input type="text" name="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $user->name ?>" required="">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
                </div>
                <input type="text" name="username" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $user->username ?>" readonly/>
              </div>
              <?php if($user->role == "user"): ?>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Student ID</span>
                </div>
                <input type="text" name="student_id" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $user->student_id ?>" required="" >
              </div>
              <?php endif?>

              <div class="input-group mb-3">
                <div>
                  <img src="<?= base_url() . $user->photo ?>" height="100" width="100">
                </div >
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Change Profile Picture</span>
                </div>
                <input style="margin-left: 10px; margin-top: 6px" type="file" name="photo"  />

              </div>
          </div>
          <div class="tab-pane fade" id="v-pills-contact" role="tabpanel" aria-labelledby="v-pills-contact-tab">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                </div>
                <input type="email" name="email" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $user->email ?>" readonly>
              </div>
          </div>

          
          <?php if($user->role == "user"): ?>
          <div class="tab-pane fade" id="v-pills-oj" role="tabpanel" aria-labelledby="v-pills-oj-tab">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Codeforces Username</span>
              </div>
              <input type="text" name="codeforces" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $user->codeforces ?>">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Codechef Username</span>
              </div>
              <input type="text" name="codechef" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $user->codechef ?>">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">UHunt ID</span>
              </div>
              <input type="text" name="uva" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $user->uva ?>">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">SPOJ Username</span>
              </div>
              <input type="text" name="spoj" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $user->spoj ?>">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Topcoder Username</span>
              </div>
              <input type="text" name="topcoder" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $user->topcoder ?>">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Toph Username</span>
              </div>
              <input type="text" name="toph" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $user->toph ?>">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">LightOJ ID</span>
              </div>
              <input type="text" name="lightoj" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $user->lightoj ?>">
            </div>
          </div>
          <?php endif?>
          <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">New Password </span>
              </div>
              <input type="password" name="password1" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="" placeholder="(Leave blank if yo do not want to change)">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Repeat New Password</span>
              </div>
              <input type="password" name="password2" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
          </div>
        </div>
            <button style="margin-left: 10px; width: 100%" type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#updateModal">Update Profile
    </button>

    </div>
  </div>

  <!-- Modal22 -->
  <div class="modal fade" style="width: 100%"  id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Enter Password
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;
            </span>
          </button>
        </div>
        <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Enter Current Password
                </span>
              </div>
              <input type="password" name="password" id="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close
              </button>
              <button type="submit" class="btn btn-primary btn-md" >Update
              </button>
              </div>
            </div>
          </div>
        </div>
      </form>
      
  