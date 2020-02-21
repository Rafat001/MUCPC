<title>Training | Metropolitan Unviersity Competitive Programming Community</title>
<?php
if ($this->session->userdata('success_msg') != NULL) {
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?php
echo $this->session->userdata('success_msg');
$this->session->unset_userdata('success_msg');
?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;
    </span>
  </button>
</div>
<?php
}
?>
<?php if($this->input->get('locate') != "team"): ?>
<ul class="nav nav-tabs" id="pills-tab" role="tablist">
  <li class="nav-item" style="font-size: 20px">
    <a class="nav-link active" id="pills-task-tab" data-toggle="pill" href="#pills-task" role="tab" aria-controls="pills-task" aria-selected="true">Task
    </a>
  </li>
  <li class="nav-item" style="font-size: 20px">
    <a class="nav-link" href="?locate=team" id="pills-team-tab" role="tab" aria-controls="pills-team" aria-selected="false">Team
    </a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-task" role="tabpanel" aria-labelledby="pills-task-tab">
    <?php $tasks = $this->db->get_where('tasks', array("coach" => $this->session->userdata('username')))->result(); ?>
    <h3 style="margin: 20px">
      <center>You have created 
        <?= sizeof($tasks)?> task(s)
      </center>
    </h3>
      <center><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newTask">Create New
        </button></center>
    <table style="font-size: 15px" id="taskList" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#
          </th>
          <th style="font-family: Ubuntu-B;">Name
          </th>
          <th style="font-family: Ubuntu-B;">Start Time
          </th>
          <th style="font-family: Ubuntu-B;">Duration
          </th>
          <th style="font-family: Ubuntu-B;">Type
          </th>
          <th style="font-family: Ubuntu-B;">*
          </th>
        </tr>
      </thead>
      <?php $tasks = $this->Task_model->get_task(array('coach' => $this->username));
$cnt = 1;
foreach ($tasks as $task) {
?>
      <tr>
        <td style="padding: 10px">
          <?= $cnt++ ?>
        </td>
        <td style="padding: 10px">
          <?= $task->name ?>
        </td>
        <td style="padding: 10px">
          <?= date("M d, Y g:i A",strtotime($task->start_on)) ?>
        </td>
        <td style="padding: 10px">
          <?= $task->duration ?>
        </td>
        <td style="padding: 10px">
          <?php
if($task->public == '1'):?><p style="margin: 0px; padding: 5px" class="alert alert-success">Public</p><?php endif; ?>
<?php 
if($task->public == '0'):?><p style="margin: 0px; padding: 5px" class="alert alert-warning">Private</p><?php endif; ?>
        </td>
        <td style="padding: 10px">

          <a role="button" href="<?= base_url("Tasks/delete/" . $task->id) ?>" onclick="return confirm('Are you sure you want to delete <?= $task->name ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Delete</a>
          <a onclick="showToast()" type="button" style="float: right;" class="btn btn-primary btn-sm" href="<?= base_url()."task/" .$task->id ?>">Enter
          </a>
        </td>
      </tr>
      <?php
}
?>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" style="width: 100%"  id="newTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Task
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;
          </span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url() ?>Tasks/create">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Task Name
              </span>
            </div>
            <input type="text" name="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
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
            <input type="number" name="duration" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Type
              </span>
            </div>
            <select name="type" class="custom-select">
              <option>Public
              </option>
              <option selected="">Private
              </option>
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">No. of Tasks (Max 99)
              </span>
            </div>
            <input type="number" min="1" max="25" id="no_of_problems" name="no_of_problems" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <a  style="margin-bottom: 5px; width: 100%" href="#" type="button" class="btn btn-primary btn-md" id="filldetails" onclick="addFields()">Insert Problems
          </a>
          <hr>
          <h4>Problem List
          </h4>
          <div id="container"/>
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


<?php endif; ?>

<?php if($this->input->get('locate') == "team"): ?>
<ul class="nav nav-tabs" id="pills-tab" role="tablist">
  <li class="nav-item" style="font-size: 20px">
    <a class="nav-link" id="pills-task-tab" href="<?= base_url('training') ?>" role="tab" aria-controls="pills-task" aria-selected="true">Task
    </a>
  </li>
  <li class="nav-item" style="font-size: 20px">
    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Team
    </a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" style="margin-top: 10px" id="pills-team" role="tabpanel" aria-labelledby="pills-team-tab">
    <?php $teams = $this->Team_model->get_team(array('coach' => $this->username)); ?>
    <h3 style="margin: 20px">
      <center>You have created 
        <?= sizeof($teams)?> team(s)
      </center>
    </h3>
    <center>
      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newTeam">Create New
      </button>
    </center>
    <table style="font-size: 15px" id="teamList" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#
          </th>
          <th style="font-family: Ubuntu-B;">Team Name
          </th>
          <th style="font-family: Ubuntu-B;">Member #1
          </th>
          <th style="font-family: Ubuntu-B;">Member #2
          </th>
          <th style="font-family: Ubuntu-B;">Member #3
          </th>
          <th style="font-family: Ubuntu-B;">Created on
          </th>
          <th style="font-family: Ubuntu-B;">*
          </th>
        </tr>
      </thead>
      <?php
$cnt = 1;
foreach ($teams as $team) {
?>
      <tr>
        <td style="padding: 10px">
          <?= $cnt++ ?>
        </td>
        <td style="padding: 10px">
          <?= $team->name ?>
        </td>
        <td style="padding: 10px">
          <a style="text-decoration: none;" href="<?= base_url('profile/' . $team->member1) ?>"><?= $team->member1 ?></a>
        </td>
        <td style="padding: 10px">
          <a style="text-decoration: none;" href="<?= base_url('profile/' . $team->member2) ?>"><?= $team->member2 ?></a>
        </td>
        <td style="padding: 10px">
          <a style="text-decoration: none;" href="<?= base_url('profile/' . $team->member3) ?>"><?= $team->member3 ?></a>
        </td>
        <td style="padding: 10px">
          <?= date("M d, Y g:i A",strtotime($team->created_on)) ?>
        </td>
        <td style="padding: 10px">

          <a role="button" href="<?= base_url("Teams/delete/" . $team->id) ?>" onclick="return confirm('Are you sure you want to delete <?= $team->name ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Delete</a>
          <a type="button" class="btn btn-primary btn-sm" style="float: right;" href="<?= base_url()."team/" .$team->id ?>">Enter
          </a>
        </td>
      </tr>
      <?php
}
?>
    </table>
    <div class="container">
    </div>
  </div>
</div>

<!-- Modal22 -->
<div class="modal fade" style="width: 100%"  id="newTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Create New Team
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;
          </span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url() ?>Teams/create">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Team Name
              </span>
            </div>
            <input type="text" name="name" id="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Member #1
              </span>
            </div>
            <input type="text" name="member1" id="member1" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Member #2
              </span>
            </div>
            <input type="text" name="member2" id="member2" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Member #3
              </span>
            </div>
            <input type="text" name="member3" id="member3" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
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

<?php endif; ?>


<script>
$(document).ready(function () {
    $('#taskList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>

<script>
$(document).ready(function () {
    $('#teamList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>

<script>
  function addFields(){
    var number = document.getElementById("no_of_problems").value;
    if(number > 99) {
      number = 99;
    }
    if(number < 1) {
      return;
    }
    document.getElementById("filldetails").className = "btn btn-primary btn-mn disabled";
    document.getElementById("no_of_problems").value = number;
    document.getElementById("no_of_problems").readOnly  = true;
    var container = document.getElementById("container");
    while (container.hasChildNodes()) {
      container.removeChild(container.lastChild);
    }
    for (i=0;i<number;i++){
      //container.appendChild(createTextNode('<div class="input-group mb-3">'));
      //container.appendChild(document.createTextNode("Problem #" + (i+1)));
      var prepend = document.createElement("div");
      prepend.className = "input-group-prepend";
      prepend.innerHTML += '<span class="input-group-text" id="basic-addon1">' + (i + 1) + '</span>';
      prepend.style.width = "10%";
      prepend.style.cssFloat = "left";
      container.appendChild(prepend);
      var select = document.createElement("select");
      select.className = "custom-select";
      select.style.marginBottom = "5px";
      select.style.width = "45%";
      var option = document.createElement("option");
      option.text = "Codeforces";
      select.add(option);
      option = document.createElement("option");
      option.text = "UVa";
      select.add(option);
      select.name = "oj" + (i + 1);
      container.appendChild(select);
      var input = document.createElement("input");
      input.type = "text";
      input.className = "form-control";
      input.style.width = "45%";
      input.style.marginBottom = "5px";
      input.style.cssFloat = "right";
      input.name = "problem" + (i + 1);
      input.required = true;
      container.appendChild(input);
      //container.appendChild(createTextNode('</div>'));
    }
  }
</script>

<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize 
     $( "#member1" ).autocomplete({
        source: function( request, response ) {
          // Fetch data

          $.ajax({
            url:"<?=base_url() ?>Teams/suggest",
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
          $('#member1').val(ui.item.label); // display the selected text
          $('#member1').val(ui.item.value); // save selected id to input
          return false;
        }
      });
   $( "#member2" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?=base_url() ?>Teams/suggest",
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
          $('#member2').val(ui.item.label); // display the selected text
          $('#member2').val(ui.item.value); // save selected id to input
          return false;
        }
      });
    
    $( "#member3" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?=base_url() ?>Teams/suggest",
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
          $('#member3').val(ui.item.label); // display the selected text
          $('#member3').val(ui.item.value); // save selected id to input
          return false;
        }
      });

    });
 
</script>