<title>Contests | Metropolitan Unviersity Competitive Programming Community</title>
<div style="margin-bottom: 50px">
  <h3 style="float: left;">Intra Contests</h3>
<?php if($this->session->userdata('role') == "coach" || $this->session->userdata('role') == "admin"): ?>
  <button style="float: right;" data-toggle="modal" data-target="#newContest" class="btn btn-primary btn-md">Create New</button>
<?php endif; ?>
  <?php $contests = $this->Contest_model->get_contest_all(); ?>
</div>

<table style="font-size: 15px" id="contests" class="table table-bordered table-striped table-hover">
  <thead>
    <th>#</th>
    <th>Name</th>
    <th>Start Time</th>
    <th>Duration</th>
    <th>*</th>
  </thead>
  <tbody>
    <?php
    $cnt = 1;
    foreach ($contests as $contest) {
      ?>
      <tr>
        <td>
          <?= $cnt++ ?>
        </td>
        <td style="max-width: 350px">
          <?= $contest->name ?>
        </td>
        <td>
          <?= date("M d, Y g:i A",strtotime($contest->start_on)) ?>
        </td>
        <td>
          <?= $contest->duration ?>
        </td>
        <td>
          <?php if($this->session->userdata('role') == "coach" || $this->session->userdata('role') == "admin"):?>
          <a role="button" href="<?= base_url("Contests/delete/" . $contest->id) ?>" onclick="return confirm('Are you sure you want to delete <?= $contest->name ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Delete</a>
          <?php endif?>
          <?php if($contest->problems != ""): ?>
          <a type="button" class="btn btn-secondary btn-sm" style="float: right; margin-left: 10px" href="<?= $contest->problems ?>">Problems
          </a>
          <?php endif?>
          <?php if($contest->problems == ""): ?>
          <a type="button" class="btn btn-secondary btn-sm disabled" style="float: right; margin-left: 10px">Problems
          </a>
          <?php endif?>
          <?php if($contest->standings != ""): ?>
          <a target="_blank" type="button" class="btn btn-info btn-sm" style="float: right; margin-left: 10px" href="<?= $contest->standings ?>">Standings
          </a>
          <?php endif?>
          <?php if($contest->standings == ""): ?>
          <a target="_blank" type="button" class="btn btn-info btn-sm disabled" style="float: right; margin-left: 10px">Standings
          </a>
          <?php endif?>
          <a type="button" class="btn btn-primary btn-sm" style="float: right;" href="<?= base_url()."contest/" .$contest->id ?>">Enter
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>



<?php if($this->session->userdata('role') == "coach" || $this->session->userdata('role') == "admin"): ?>
<!-- Modal -->
<div class="modal fade" style="width: 100%"  id="newContest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Contest
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;
          </span>
        </button>
      </div>
      <div class="modal-body">
        <form name="create" method="post" action="<?= base_url() ?>Contests/create" onsubmit="return validateform()">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Contest Name
              </span>
            </div>
            <input type="text" name="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
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
            <textarea style="height: 300px" name="details" class="form-control" id="details" aria-label="Default" aria-describedby="inputGroup-sizing-default"></textarea>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Start Time
              </span>
            </div>
            <input type="datetime-local" name="start_on" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Duration (in minutes)
              </span>
            </div>
            <input type="number" min="1" max="3000" name="duration" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <input type="hidden" name="created_by" value="<?= $this->username ?>">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Registration Deadline
              </span>
            </div>
            <input type="datetime-local" name="registration_deadline" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close
          </button>
          <button type="submit" class="btn btn-success btn-md" >Create
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<script>
  function validateform() {
    var start_on = document.create.start_on.value;
    var registration_deadline = document.create.registration_deadline.value;
    var duration = document.create.duration.value;
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

<?php endif; ?>
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
        var ctl = document.getElementById('details');
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

<script>
$(document).ready(function () {
    $('#contests').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>