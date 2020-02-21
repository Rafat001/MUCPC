
<?php
if (!isset($this->contest)) {
        redirect(base_url());
}
$contest = $this->contest;
?>

<title><?= $contest->name ?> | Metropolitan Unviersity Competitive Programming Community</title>

<?php
$check = $this->Contest_model->get_contest_participation_by_id(array(
        "contest_id" => $contest->id,
        "username" => $this->session->userdata('username')
));
?>

<h3><?= $contest->name ?></h3>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Details</a>
  </li>
  
  <?php
if ($this->session->userdata('role') == "coach" || $this->session->userdata('role') == "admin" || $this->session->userdata('role') == "mentor"):
?>
  <li class="nav-item">
    <a class="nav-link" id="registered-tab" data-toggle="tab" href="#registered" role="tab" aria-controls="registered" aria-selected="true">Registered Participants</a>
  </li>

  <?php
endif;
?>
  <?php
if ($this->session->userdata('role') == "coach" || $this->session->userdata('role') == "admin"):
?>
  <li class="nav-item">
    <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="true">Settings</a>
  </li>

  <?php
endif;
?>  <?php
if ($contest->standings != ""):
?>
  <li class="nav-item">
    <a class="nav-link" target="_blank" id="standings-tab" href="<?= $contest->standings ?>">Standings</a>
  </li>
  <?php
endif;
?>

  <?php
if ($contest->problems != ""):
?>
  <li class="nav-item">
    <a class="nav-link" target="_blank" id="problems-tab" href="<?= $contest->problems ?>">Problems</a>
  </li>
  <?php
endif;
?>

</ul>


<div class="tab-content" id="myTabContent" style="margin-top: 10px">
  <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
    <h6><div id="show"></div></h6>
    <h5>Schedule</h5>
    The contest will start on <b><?= date("F d, Y", strtotime($contest->start_on)) ?> </b>at<b> <?= date("g:i A", strtotime($contest->start_on)) ?> +0600</b> and will run for <b><?= (intval($contest->duration / 60)) ?> hours <?php if($contest->duration - ((intval($contest->duration / 60)) * 60) > 0):?><?= $contest->duration - ((intval($contest->duration / 60)) * 60) ?> minutes<?php endif?></b>.
    <?php
if (time() > strtotime($contest->registration_deadline)):
?>
      <div style="margin-top: 10px" class="alert alert-warning">The registration deadline is over!</div>
    <?php
endif;
?>


    <?php
if (time() < strtotime($contest->registration_deadline)):
?>
    <div class="alert alert-success">Registration is running!</div>
    <h4 style="margin-top: 20px">Registration Deadline</h4>
    The registration will be closed on <b><?= date("F d, Y", strtotime($contest->registration_deadline)) ?> </b>at<b> <?= date("g:i A", strtotime($contest->registration_deadline)) ?> +0600</b>.
    <br>

    <?php
        if ($this->session->userdata('role') == "user" && $check == false):
?>
      <button style="margin-top: 20px" id="register" class="btn btn-success" data-toggle="modal" data-target="#registerModal" type="button"> Register </button>

      <form method="post" action="<?= base_url() ?>Contests/contestRegister">
        <div class="modal fade"  id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="contest_id" value="<?= $contest->id ?>">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Phone Number</span>
                  </div>
                  <input type="text" name="phone" class="form-control" placeholder="Phone Number" pattern="[0-9]*.{11,14}" required title="Minimum length should be 11 and all the characters should be digit">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Department</span>
                  </div>
                  <select name="department" class="form-control" required="">
                    <option selected="">CSE</option>
                    <option>EEE</option>
                    <option>ECO</option>
                    <option>BBA</option>
                    <option>Law</option>
                    <option>Eng</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Batch</span>
                  </div>
                  <input type="number" name="batch" class="form-control" placeholder="Batch" required="">
                </div>
              </div>
            
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-md" >Register</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    <?php
        endif;
?>
  <?php
endif;
?>

  <?php
if ($this->session->userdata('role') == "user" && $check != false):
?>
    <button style="margin-top: 20px" class="btn btn-primary disabled" type="button">Already Registered</button>
  <?php
endif;
?>
  </div>

<script>
document.getElementById('show').innerHTML = "<?php echo str_replace(array("\n", "\r"), '', $contest->details); ?>"
document.getElementById('show').innerHTML = markUP(document.getElementById('show').innerHTML);
</script>

  <div class="tab-pane fade" id="registered" role="tabpanel" aria-labelledby="registered-tab">
    <?php
if ($this->session->userdata('role') == "coach" || $this->session->userdata('role') == "admin" || $this->session->userdata('role') == "mentor"):
        $participants_list = $this->Contest_model->get_participants_by_contest_id(array(
                "contest_id" => $contest->id
        ));
?>
      <h5>Registered Participants</h5>
      <table class="table table-bordered table-striped table-hover" id="participants"> 
        <thead> 
          <th>#</th>
          <th>Name</th>
          <th>Department</th>
          <th>Batch</th>
          <th>Student ID</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Registration Time</th>
        </thead>
        <tbody>
          <?php
        $cnt = 1;
        foreach ($participants_list as $participant) {
                $user = $this->Auth_model->get_user_by_id(array(
                        "username" => $participant->username
                ));
?>
                    <tr>
                      <td>
                        <?= $cnt++ ?>
                      </td>
                      <td>
                        <a style="text-decoration: none;" href="<?= base_url() . "profile/" . $user->username ?>"> <?= $user->name ?></a>
                      </td>
                      <td>
                        <?= $participant->department ?>
                      </td>
                      <td>
                        <?= $participant->batch ?>
                      </td>
                      <td>
                        <?= $user->student_id ?>
                      </td>
                      <td>
                        <?= $user->email ?>
                      </td>
                      <td>
                        <?= $participant->phone ?>
                      </td>
                      <td>
                        <?= $participant->registered_on ?>
                      </td>
                    </tr>
                    <?php
        }
?>
        </tbody>
      </table>
    <?php
endif;
?>
  </div>

  <?php
if ($this->session->userdata('role') == "coach" || $this->session->userdata('role') == "admin"):
?>
  <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
    <form name="update" method="post" action="<?= base_url("Contests/update/" . $contest->id) ?>" onsubmit="return validateform() " >
      <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Contest Name
              </span>
            </div>
            <input type="text" name="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $contest->name ?>" required="">
          </div>
          <div style="margin-bottom: 10px">
            <button type="button" class="btn btn-light" onclick="textbox('b')">B</button>
            <button type="button" class="btn btn-light" onclick="textbox('i')"><i>I</i></button>
            <button type="button" class="btn btn-light" onclick="textbox('h1')">H1</button>
            <button type="button" class="btn btn-light" onclick="textbox('h2')">H2</button>
            <button type="button" class="btn btn-light" onclick="textbox('h3')">H3</button>
            <button type="button" class="btn btn-light" onclick="textbox('h4')">H4</button>
            <button type="button" class="btn btn-light" onclick="textbox('h5')">H5</button>
            <button type="button" class="btn btn-light" onclick="textbox('ul')">UL</button>
            <button type="button" class="btn btn-light" onclick="textbox('ol')">OL</button>
            <button type="button" class="btn btn-light" onclick="textbox('li')">LI</button>
            <button type="button" class="btn btn-light" onclick="textbox('url')">URL</button>
            <button type="button" class="btn btn-light" onclick="textbox('img')">IMG</button>
            <button type="button" class="btn btn-light" onclick="textbox('br')">BR</button>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Details</span>
            </div>
            <textarea style="height: 300px" name="details" class="form-control" id="detailsBody" aria-label="Default" aria-describedby="inputGroup-sizing-default"><?= $contest->details ?></textarea>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Start Time
              </span>
            </div>
            <input type="datetime-local" name="start_on" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= date("Y-m-d", strtotime($contest->start_on)) . "T" . date("H:i", strtotime($contest->start_on)) ?>" required="">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Registration Deadline
              </span>
            </div>
            <input type="datetime-local" name="registration_deadline" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= date("Y-m-d", strtotime($contest->registration_deadline)) . "T" . date("H:i", strtotime($contest->registration_deadline)) ?>" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Duration (in minutes)
              </span>
            </div>
            <input type="number" min="1" max="3000" name="duration" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="" value="<?= $contest->duration ?>">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Standings
              </span>
            </div>
            <input type="text" name="standings" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $contest->standings ?>">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Problems
              </span>
            </div>
            <input type="text" name="problems" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $contest->problems ?>">
          </div>
          <button style="width: 100%" type="submit" class="btn btn-primary btn-sm">Update</button>
    </form>
  </div>

  <script>
    function validateform() {
      var start_on = document.update.start_on.value;
      var registration_deadline = document.update.registration_deadline.value;
      var duration = document.update.duration.value;
      if(start_on <= registration_deadline) {
        alert("Registration Deadline should be before the Start Time!");
        return false;
      }
      if(duration < 0 || duration > 3000) {
        alert("Invalid Duration");
        return false;
      }
      return true;
    }
  </script>

  <script>
  function htmlEntities(str) {
      return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }
  function showPreview() {
    wpcomment = document.getElementById('details');
    str = htmlEntities(wpcomment.value);
    str = markUP(str);
    document.getElementById('preview').innerHTML = str;
  }
  function textbox(val)
  {
          var ctl = document.getElementById('detailsBody');
          var startPos = ctl.selectionStart;
          var endPos = ctl.selectionEnd;
          if(val == "b") {
            ctl.value = ctl.value.slice(0, endPos) + "[/b]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[b]" + ctl.value.slice(startPos);
          }
          if(val == "i") {
            ctl.value = ctl.value.slice(0, endPos) + "[/i]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[i]" + ctl.value.slice(startPos);
          }
          if(val == "h1") {
            ctl.value = ctl.value.slice(0, endPos) + "[/h1]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[h1]" + ctl.value.slice(startPos);
          }
          if(val == "h2") {
            ctl.value = ctl.value.slice(0, endPos) + "[/h2]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[h2]" + ctl.value.slice(startPos);
          }
          if(val == "h3") {
            ctl.value = ctl.value.slice(0, endPos) + "[/h3]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[h3]" + ctl.value.slice(startPos);
          }
          if(val == "h4") {
            ctl.value = ctl.value.slice(0, endPos) + "[/h4]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[h4]" + ctl.value.slice(startPos);
          }
          if(val == "h5") {
            ctl.value = ctl.value.slice(0, endPos) + "[/h5]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[h5]" + ctl.value.slice(startPos);
          }
          if(val == "ul") {
            ctl.value = ctl.value.slice(0, endPos) + "[/ul]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[ul]" + ctl.value.slice(startPos);
          }
          if(val == "ol") {
            ctl.value = ctl.value.slice(0, endPos) + "[/ol]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[ol]" + ctl.value.slice(startPos);
          }
          if(val == "li") {
            ctl.value = ctl.value.slice(0, endPos) + "[/li]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[li]" + ctl.value.slice(startPos);
          }
          if(val == "br") {
            ctl.value = ctl.value.slice(0, endPos) + "[br]" + ctl.value.slice(endPos);
          }
          if(val == "url") {
            ctl.value = ctl.value.slice(0, endPos) + "][/url]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[url](link)[](text)[" + ctl.value.slice(startPos);
          }
          if(val == "img") {
            ctl.value = ctl.value.slice(0, endPos) + "][/img]" + ctl.value.slice(endPos);
            ctl.value = ctl.value.slice(0, startPos) + "[img](src)[](text)[" + ctl.value.slice(startPos);
          }
          //alert(startPos + ", " + endPos);
  }

  </script>

  <?php
endif;
?>
</div>

<script>
$(document).ready(function () {
    $('#participants').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>