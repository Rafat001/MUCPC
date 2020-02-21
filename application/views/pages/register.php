<title>Register | Metropolitan Unviersity Competitive Programming Community</title>
<div class="row" style="margin-top: 5%; margin-bottom: 5%">
  <div class="col-lg-4">
  </div>
  <div class="col-lg-4">
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
    <h3>Register</h3>
    <form method="post" action="<?php
echo base_url();
?>Auth/register">
      
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
    <span class="input-group-text" id="inputGroup-sizing-default">Student ID</span>
  </div>
  <input type="text" name="student_id" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="" pattern="[0-9][0-9][0-9][-][0-9][0-9][0-9][-][0-9][0-9][0-9]">
</div>
      
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
  </div>
  <input type="password" name="password1" minlength="6" maxlength="15" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Repeat Password</span>
  </div>
  <input type="password" name="password2" minlength="6" maxlength="15" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
</div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>
  <div class="col-lg-4">
  </div>
</div>