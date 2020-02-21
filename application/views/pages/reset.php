<title>Reset | Metropolitan Unviersity Competitive Programming Community</title>
<div class="row" style="margin-top: 10%; margin-bottom: 10%">
  <div class="col-lg-4">
  </div>
  <div class="col-lg-4">
    
    <h3>Reset Password</h3>
    <form method="post" action="<?php
echo base_url();
?>Auth/resetPassword/<?=$this->code->code ?>" >
      
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">New Password</span>
  </div>
  <input type="password" minlength="6" maxlength="15" name="password1" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
</div>
      
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Repeat Password</span>
  </div>
  <input type="password" minlength="6" maxlength="15" name="password2" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
</div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
  <div class="col-lg-4">
  </div>
</div>