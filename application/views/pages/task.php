<?php
if (!isset($this->task)) {
        redirect(base_url());
}
?>
<?php
error_reporting(0);
ini_set('display_errors', 0);
set_time_limit(0);
$task = $this->task;
?>

<title><?= $task->name ?> | Metropolitan Unviersity Competitive Programming Community</title>

<h3><?= $task->name ?>
<?php
if (time() < strtotime($task->start_on)) {
?>
    <alert style="padding: 10px; font-size: 16px;" class="alert alert-info" role="alert">
     Upcoming        </alert>
   <?php
}
?>
<?php
if (time() >= strtotime($task->start_on) && time() <= strtotime($task->start_on) + $task->duration * 60) {
?>
    <alert style="padding: 10px; font-size: 16px;" class="alert alert-success" role="alert">
     Running        </alert>
   <?php
}
?>
<?php
if (time() > strtotime($task->start_on) + $task->duration * 60) {
?>
    <alert style="padding: 10px; font-size: 16px;" class="alert alert-warning" role="alert">
     Finished        </alert>
   <?php
}
?></h3>
<ul class="nav nav-tabs" id="pills-tab" role="tablist">
 <li class="nav-item" style="font-size: 17px">
  <a class="nav-link active" id="pills-problems-tab" data-toggle="pill" href="#pills-problems" role="tab" aria-controls="pills-problems" aria-selected="true">Problems</a>
 </li>
 <li class="nav-item" style="font-size: 17px">
  <a class="nav-link" id="pills-standings-tab" data-toggle="pill" href="#pills-standings" role="tab" aria-controls="pills-standings" aria-selected="false">Standings</a>
 </li>
 <li class="nav-item" style="font-size: 17px">
  <a class="nav-link" id="pills-announcement-tab" data-toggle="pill" href="#pills-announcement" role="tab" aria-controls="pills-announcement" aria-selected="false">Announcements</a>
 </li>
 <?php
if ($task->coach == $this->username && ($this->session->userdata('role') == "mentor" || $this->session->userdata('role') == "coach")) {
?>
  <li class="nav-item" style="font-size: 17px">
   <a class="nav-link" id="pills-settings-tab" data-toggle="pill" href="#pills-settings" role="tab" aria-controls="pills-settings" aria-selected="false">Settings</a>
  </li>
  <?php
}
?>
</ul>


  <?php
$html              = $task->problems;
$json              = $html;
$data              = json_decode($json);
$totalProblems     = 0;
$problems          = $data->result;
$participatedUsers = array();
$totalSubmission   = array();
$totalAC           = array();
array_push($totalSubmission, intval(0));
array_push($totalAC, intval(0));
foreach ($problems as $problem) {
        array_push($totalSubmission, intval(0));
        array_push($totalAC, intval(0));
}
if ($task->public != "-1") {
        $users = $this->Task_model->get_participation_by_id(array(
                "task_id" => $task->id
        ));
        foreach ($users as $participant) {
                $user          = $this->Auth_model->get_user_by_id(array(
                        "username" => $participant->username
                ));
                $uva_id        = $user->uva;
                $codeforces_id = $user->codeforces;
                $status        = array();
                $submitted     = 0;
                array_push($status, 0);
                array_push($status, $user->username);
                array_push($status, $user->name);
                array_push($status, $user->student_id);
                $idx              = 1;
                $codeforces_scrap = array();
                foreach ($problems as $problem) {
                        $ac               = 0;
                        $problem->uva_pid = $problem->url;
                        if ($problem->oj == "UVa" && $user->uva != '') {
                                $html = file_get_html('https://uhunt.onlinejudge.org/api/subs-pids/' . $uva_id . '/' . $problem->uva_pid . '/0');
                                $data = json_decode($html);
                                foreach ($data as $uva_ids_inner) {
                                        foreach ($uva_ids_inner->subs as $sub) {
                                                if ($sub[4] >= strtotime($task->start_on) && $sub[4] <= strtotime($task->start_on) + $task->duration * 60) {
                                                        if ($sub[2] == '90') {
                                                                $ac = 1;
                                                                break;
                                                        } else {
                                                                $ac = -1;
                                                        }
                                                }
                                        }
                                }
                        } else if ($user->codeforces != '') {
                                $totalScrapped = 1;
                                if ($user->codeforces != "") {
                                        for ($i = 1; ; $i += 10) {
                                                if (sizeof($codeforces_scrap) < $totalScrapped) {
                                                        $html = file_get_html('https://codeforces.com/api/user.status?handle=' . $user->codeforces . '&from=' . $i . '&count=10');
                                                        array_push($codeforces_scrap, $html);
                                                } else {
                                                        $html = $codeforces_scrap[$totalScrapped - 1];
                                                }
                                                $totalScrapped++;
                                                $data = json_decode($html);
                                                $f    = 0;
                                                $cnt  = 0;
                                                if ($data->status == "OK") {
                                                        foreach ($data->result as $sub) {
                                                                $cnt = 1;
                                                                if ($sub->creationTimeSeconds >= strtotime($task->start_on) && $sub->creationTimeSeconds <= strtotime($task->start_on) + $task->duration * 60) {
                                                                        if ($sub->contestId == $problem->pid && $sub->problem->index == $problem->idx) {
                                                                                if ($sub->verdict == "OK") {
                                                                                        $ac = 1;
                                                                                        $f  = 1;
                                                                                        break;
                                                                                } else {
                                                                                        $ac = -1;
                                                                                }
                                                                        }
                                                                } else if ($sub->creationTimeSeconds < strtotime($task->start_on)) {
                                                                        $f = 1;
                                                                        break;
                                                                }
                                                        }
                                                        if ($cnt == 0) {
                                                                $f = 1;
                                                        }
                                                        if ($f == 1) {
                                                                break;
                                                        }
                                                } else {
                                                        break;
                                                }
                                        }
                                }
                        }
                        if ($ac != 0) {
                                $totalSubmission[$idx]++;
                                $submitted = 1;
                        }
                        if ($ac == 1) {
                                $totalAC[$idx]++;
                                $status[0] += 1;
                        }
                        array_push($status, $ac);
                        $idx++;
                }
                if ($submitted) {
                        array_push($participatedUsers, $status);
                }
        }
}
rsort($participatedUsers);
?>
   <div class="tab-content" id="pills-tabContent">
 <div class="tab-pane fade show active" id="pills-problems" role="tabpanel" aria-labelledby="pills-problems-tab">
  <table style="margin-top: 10px; font-size: 14px" id="" class="table table-bordered table-striped table-hover">
   <thead>
    <tr>
     <th style="font-family: Ubuntu-B;">#</th>
     <th style="font-family: Ubuntu-B;">Origin</th>
     <th style="font-family: Ubuntu-B;">Name</th>
     <th style="font-family: Ubuntu-B;">Stat</th>
    </tr>
   </thead>
      <tbody>
   <?php
$idx = 1;
$ch  = 65;
$val = 0;
foreach ($problems as $problem) {
        $totalProblems++;
        if ($problem->oj == "UVa")
                $problem->url = "https://onlinejudge.org/index.php?option=com_onlinejudge&Itemid=13&page=show_problem&problem=" . $problem->url;
?>

   <tr>
    <td>
     <?= chr($ch) ?>
     <?php
        if ($val) {
                echo $val;
        }
?>
    </td>
    <td>
     <?= $problem->oj . " " . $problem->pid . $problem->idx ?>
    </td>
    <td>
     <a style="text-decoration: none;" href="<?= $problem->url ?>" target="_blank" ><?= $problem->name ?></a>
    </td>
    <td>
     <?= $totalAC[$idx] . " / " . $totalSubmission[$idx] ?>
    </td>
   </tr>
   <?php
        $idx++;
        $ch = $ch + 1;
        if ($ch > 90) {
                $ch = 65;
                $val++;
        }
}
?>
 </tbody>

  </table>
 </div>
  
 <div style="margin-top: 20px" class="tab-pane fade" id="pills-standings" role="tabpanel" aria-labelledby="pills-standings-tab">
  <table style="width: 100%; font-size: 14px" id="standings" class="table table-bordered table-striped table-hover">
   <thead>
    <tr>
     <th>Rank</th>
     <th>Username</th>
     <th>Score</th>
     <?php
$ch  = 65;
$val = 0;
for ($i = 1; $i <= $totalProblems; $i++) {
        echo ('<th style="text-align: center">' . chr($ch));
        if ($val)
                echo ($val);
        echo ("<br>[" . $totalAC[$i] . " / " . $totalSubmission[$i] . "]</th>");
        $ch = $ch + 1;
        if ($ch > 90) {
                $ch = 65;
                $val++;
        }
}
?>
    </tr>
   </thead>
   <tbody>
    <?php
foreach ($participatedUsers as $user) {
?>
     <tr>
      <td>
       1
      </td>
      <td>
       <a href="<?= base_url() . "profile/" . $user[1] ?>"><?= $user[1] ?></a>
      </td>
      <td align="center"><span style="padding: 4px; font-size: 14px; font-family: Ubuntu-B" class="badge badge-primary">
       <?= $user[0] ?>
       </span>
      </td>
      <?php
        for ($i = 1; $i <= $totalProblems; $i++) {
                $j = $i + 3;
                if ($user[$j] == '-1') {
?> <td align="center"><span style="text-align: center; font-size: 1.3em; color: orange;">
 <i class="fas fa-times"></i>
</span></td> <?php
                } else if ($user[$j] == '1') {
?> <td align="center"><span style="text-align: center; font-size: 1.3em; color: green;">
 <i class="fas fa-check"></i>
</span></td> <?php
                } else {
?> <td align="center"></td> <?php
                }
        }
?>
     </tr>
     <?php
}
?>
   </tbody>
  </table>
 </div>
 <div class="tab-pane fade" id="pills-announcement" role="tabpanel" aria-labelledby="pills-announcement-tab">
  <?php
$announcements = $this->Task_model->get_announcement(array(
        "task_id" => $task->id
))?>

  <?php
if ($this->username != "" && $task->coach == $this->username):
?> 
          <button style="margin-top: 10px; float: right; margin-bottom: 10px" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newAnnouncement">Create New</button>
        <?php
endif;
?>

  <h5 style="margin-top: 10px;"><?= sizeof($announcements) ?> Announcement(s)</h5>
  <?php
foreach ($announcements as $announcement) {
?>

    <div class="card text-center" style="margin-bottom: 20px; margin-top: 20px; width: 100%">
          <div class="card-body">
            <h5 class="card-title" id="body<?= $announcement->id ?>"></h5>
            <script>
              document.getElementById("body<?= $announcement->id ?>").innerHTML = markUP("<?= str_replace(array(
                "\n",
                "\r"
        ), '', $announcement->body) ?>");
            </script>
          </div>
          <div class="card-footer text-muted">
            Published on <?= date("M d, Y g:i A", strtotime($announcement->published_on)) ?>
          </div>
        </div>
      <?php
}
?>

</div>
<?php
if ($task->coach == $this->username && ($this->session->userdata('role') == "mentor" || $this->session->userdata('role') == "coach")) {
?>
  <div class="tab-pane fade" style="margin-top: 10px" id="pills-settings" role="tabpanel" aria-labelledby="pills-settings-tab">
    <h5>General Settings</h5>
    <form method="post" action="<?= base_url("Tasks/update/". $task->id) ?>">
      <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Task Name
              </span>
            </div>
            <input type="text" name="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $task->name ?>" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Start Time
              </span>
            </div>
            <input type="datetime-local" name="start_on" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= date("Y-m-d", strtotime($task->start_on)) . "T" . date("H:i", strtotime($task->start_on)) ?>" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Duration (in minutes)
              </span>
            </div>
            <input type="number" name="duration" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="" value="<?= $task->duration ?>">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Type
              </span>
            </div>
            <select name="type" class="custom-select">
              <option <?php if($task->public == "1") {echo 'selected=""';} ?>>Public
              </option>
              <option <?php if($task->public == "0") {echo 'selected=""';} ?>>Private
              </option>
            </select>
          </div>
          <button style="width: 100%" type="submit" class="btn btn-primary btn-sm">Update</button>
    </form>
    <hr>
    <?php
        if ($this->username == $task->coach):
                $users = $this->Task_model->get_participation_by_id(array(
                        "task_id" => $task->id
                ));
?>
    <h5>Invite Participant</h5>
    <form action="<?= base_url() ?>Tasks/invite" method="post">
      <input type="hidden" name="task_id" value="<?= $task->id ?>">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
        </div>
        <input name="username" id="username" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
        <button class="btn btn-primary" type="submit">Invite</button>
      </div>
    </form><hr>
    <?php
        endif;
?>
    <?php
        if ($this->username == $task->coach && $this->session->userdata('role') == 'coach'):
?>
    <h5>Invite Team</h5>
    <form action="<?= base_url() ?>Tasks/inviteTeam" method="post">
      <input type="hidden" name="task_id" value="<?= $task->id ?>">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">Team Name</span>
        </div>
        <input name="team_id" type="hidden" id="team_id" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
        <input name="team_name" id="team_name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
        <button class="btn btn-primary" type="submit">Invite</button>
      </div>
    </form><hr>
    <?php
        endif;
?>

    <?php
        if ($this->username == $task->coach && $this->session->userdata('role') == 'mentor'):
?>
    <h5>Invite Group</h5>
    <form action="<?= base_url() ?>Tasks/inviteGroup" method="post">
      <input type="hidden" name="task_id" value="<?= $task->id ?>">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">Group Name</span>
        </div>
        <input name="group_id" type="hidden" id="group_id" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
        <input name="group_name" id="group_name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
        <button class="btn btn-primary" type="submit">Invite</button>
      </div>
    </form><hr>
    <?php
        endif;
?>

    <h5>Participants</h5>
    <table style="font-size: 15px" id="partcipant" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th>
            #
          </th>
          <th>
            Username
          </th>
          <th>
            Joined on
          </th>
          <th>
            *
          </th>
        </tr>
      </thead>
      <tbody>
    <?php
        $cnt = 1;
        foreach ($users as $user) {
?>
        <tr>
          <td>
            <?= $cnt++ ?>
          </td>
          <td>
            <a href="<?= base_url('profile/' . $user->username) ?>" style="text-decoration: none;"> <?= $user->username ?></a>
          </td>
          <td>
            <?= date("M d, Y g:i A", strtotime($user->created_on)) ?>
          </td>
          <td>
            <a role="button" href="<?= base_url("Tasks/removeParticipant/" . $task->id . "/" . $user->username) ?>" onclick="return confirm('Are you sure you want to remove <?= $user->username ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Remove</a>
          </td>
        </tr>
        <?php
        }
?>
      </tbody>
    </table>
  </div>
  <?php
}
?>
<?php
if ($this->username == $task->coach):
?>
  <!-- Modal -->
  <div class="modal fade"  id="newAnnouncement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New Announcement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?= base_url() ?>Tasks/createAnnouncement">
            <input type="hidden" name="task_id" value="<?= $task->id ?>">
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
                <span class="input-group-text" id="inputGroup-sizing-default">Body</span>
              </div>
              <textarea style="height: 300px" name="body" class="form-control" id="body" aria-label="Default" aria-describedby="inputGroup-sizing-default" required=""></textarea>
            </div>
              <div><h5>Preview</h5></div>
              <hr style="padding: 0px; margin: 0px">
              <div><div id="preview"></div></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info btn-md" onclick="showPreview()">Preview</button>
            <button type="submit" class="btn btn-primary btn-md" >Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
endif;
?>

<script>
function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
function showPreview() {
  wpcomment = document.getElementById('body');
  str = htmlEntities(wpcomment.value);
  str = markUP(str);
  document.getElementById('preview').innerHTML = str;
}
function textbox(val)
{
        var ctl = document.getElementById('body');
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
  $('#standings').DataTable({
  "ordering": false,
  responsive: true
  });
 });
</script>

<script>
$(document).ready(function () {
  $('#partcipant').DataTable({
  "ordering": false,
  responsive: true
  });
 });
</script>


<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize 
     $( "#username" ).autocomplete({
        source: function( request, response ) {
          // Fetch data

          $.ajax({
            url:"<?= base_url() ?>Tasks/suggest/<?= $task->id ?>",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#username').val(ui.item.label); // display the selected text
          $('#username').val(ui.item.value); // save selected id to input
          return false;
        }
      });

    });
 
</script>

<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize 

     $( "#team_name" ).autocomplete({

        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"<?= base_url() ?>Tasks/suggestTeam/<?= $task->id ?>",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#team_name').val(ui.item.label); // display the selected text
          $('#team_id').val(ui.item.value); // save selected id to input
          return false;
        }
      });

    });
 
</script>


<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize 

     $( "#group_name" ).autocomplete({

        source: function( request, response ) {
          // Fetch data
          //alert("h");
          $.ajax({
            url:"<?= base_url() ?>Tasks/suggestGroup/<?= $task->id ?>",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#group_id').val(ui.item.value); // save selected id to input
          $('#group_name').val(ui.item.label); // save selected id to input
          return false;
        }
      });

    });
 
</script>