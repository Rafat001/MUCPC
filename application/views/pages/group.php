<?php
if (!isset($this->group)) {
        redirect(base_url());
}
?>
<?php
set_time_limit(0);
$group = $this->group;
?>

<title><?= $group->name ?> | Metropolitan Unviersity Competitive Programming Community</title>

<?php
if ($this->input->get('locate') != "chat" && $this->input->get('locate') != "settings"):
?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
  </li>
  <?php
        if (($this->username == $group->mentor && $this->session->userdata('role') == "mentor") || $this->Group_model->get_participation_by_id(array("group_id" => $group->id, "username" => $this->username)) != false):
?>
  <li class="nav-item">
    <a class="nav-link" href="?locate=chat" id="chat-tab">Chat</a>
  </li>
<?php
        endif;
?>
<?php
        if ($this->username == $group->mentor && $this->session->userdata('role')=="mentor"):
?>
  <li class="nav-item">
    <a class="nav-link" href="?locate=settings" id="chat-tab">Settings</a>
  </li>
<?php
        endif;
?>
</ul>

<div class="tab-content" id="myTabContent" style="margin-top: 10px">
  <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="details-tab">

    

    <h5>Group Name: <b><?= $group->name ?></b></h5>
    <?php
        $user = $this->Auth_model->get_user_by_id(array(
                "username" => $group->mentor
        ))?>
    <h6>Mentor: <b><a href="<?= base_url() . "profile/" . $user->username ?>"><?= $user->name ?></a></b></h6>
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Member Name</th>
          <th>Student ID</th>
          <th>Email</th>
          <?php if ($this->username == $group->mentor && $this->session->userdata('role')=="mentor"): ?>
          <td>
            *
          </td>
          <?php endif?>
        </tr>
      </thead>
      <tbody>
        <?php
        $users = $this->Group_model->get_participation_by_id(array(
                "group_id" => $group->id
        ));
        $cnt = 1;
        foreach ($users as $user) {
                $details = $this->Auth_model->get_user_by_id(array(
                        "username" => $user->username
                ));
?>
        <tr>
          <td>
            <?= $cnt++ ?>
          </td>
          <td>
            <a href="<?= base_url('profile/' . $details->username) ?>" style="text-decoration: none;" ><?= $details->name ?></a>
          </td>
          <td>
            <?= $details->student_id ?>
          </td>
          <td>
            <?= $details->email ?>
          </td>
          <?php if ($this->username == $group->mentor && $this->session->userdata('role')=="mentor"):?>
          <td>
            <a role="button" href="<?= base_url("Groups/removeParticipant/" . $group->id . "/" . $user->username) ?>" onclick="return confirm('Are you sure you want to remove <?= $details->name ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Remove</a>
          </td>
          <?php endif?>
        </tr>
        <?php
        }
?>
      </tbody>
    </table>

    <?php
        if ($group->mentor == $this->username):
?>
      <h5>Add New Member</h5>
      <form action="<?= base_url() ?>Groups/invite" method="post">
        <input type="hidden" name="group_id" value="<?= $group->id ?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
          </div>
          <input name="username" id="username" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          <button class="btn btn-primary" type="submit">Add</button>
        </div>
      </form>
    <?php
        endif;
?>
  </div>
</div>
<?php
endif;
?>

<?php
if ($this->input->get('locate') == "chat" && (($this->username == $group->mentor && $this->session->userdata('role') == "mentor") || $this->Group_model->get_participation_by_id(array("group_id" => $group->id, "username" => $this->username)) != false)):
        include('group_chat.php');
endif;
?>

<?php
if ($this->input->get('locate') == "settings" && $this->session->userdata('role') == "mentor" && $this->session->userdata('username') == $group->mentor):?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('group/' . $group->id)?>" id="details-tab" >Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="?locate=chat" id="chat-tab">Chat</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="?locate=settings" id="settings-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Settings</a>
  </li>
</ul>


<div class="tab-content" id="myTabContent" style="margin-top: 10px">
  <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="details-tab">
    <h5>Change Group Name</h5>
      <form action="<?= base_url() ?>Groups/update" method="post">
        <input type="hidden" name="group_id" value="<?= $group->id ?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
          </div>
          <input name="name" id="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="" value="<?= $group->name ?>">
          <button class="btn btn-primary" type="submit">Update</button>
        </div>
      </form>
  </div>
</div>
<?php endif?>

<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize 
     $( "#username" ).autocomplete({
        source: function( request, response ) {
          // Fetch data

          $.ajax({
            url:"<?= base_url() ?>Groups/suggest/<?= $group->id ?>",
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