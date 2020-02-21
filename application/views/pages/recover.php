<title>Password Recovery | Metropolitan Unviersity Competitive Programming Community</title>
<div class="row" style="margin-top: 10%; margin-bottom: 10%">
  <div class="col-lg-4">
  </div>
  <div class="col-lg-4">
    
    <h3>Password Recovery</h3>
    <form method="post" action="<?php
echo base_url();
?>Auth/recover">
      
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
  </div>
  <input type="text" name="username" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
</div>
      
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
  </div>
  <input type="email" name="email" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
</div>
      <button type="submit" class="btn btn-primary">Recover</button>
    </form>
  </div>
  <div class="col-lg-4">
  </div>
</div>