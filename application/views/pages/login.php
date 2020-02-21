<title>Login | Metropolitan Unviersity Competitive Programming Community</title>
<div class="row" style="margin-top: 10%; margin-bottom: 10%">
  <div class="col-lg-4">
  </div>
  <div class="col-lg-4">
    
    <h3>Login</h3>
    <form method="post" action="<?php
echo base_url();
?>Auth/login">
      
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
  </div>
  <input type="text" name="username" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
</div>
      
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
  </div>
  <input type="password" minlength="6" maxlength="15" name="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
</div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <a href="<?= base_url("recover") ?>" role="button" class="btn btn-light">Forgot Password?</a>
    </form>
  </div>
  <div class="col-lg-4">
  </div>
</div>