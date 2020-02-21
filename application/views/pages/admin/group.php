<h3>Admin Panel</h3>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link" id="user-tab" href="<?=base_url('admin')?>/user" aria-controls="user" aria-selected="true">User</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="team-tab" href="<?=base_url('admin')?>/team" aria-controls="team" aria-selected="true">Team</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="task-tab" href="<?=base_url('admin')?>/task" aria-controls="task" aria-selected="false">Task</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" id="group-tab" data-toggle="tab" href="#group" role="tab" aria-controls="group" aria-selected="false">Group</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="blog-tab" href="<?=base_url('admin')?>/blog" aria-controls="blog" aria-selected="true">Blog</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="question-tab" href="<?=base_url('admin')?>/question" aria-controls="question" aria-selected="true">Question</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="news-tab" href="<?=base_url('admin')?>/news" aria-controls="news" aria-selected="true">News</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent" style="margin-top: 20px">
  <div class="tab-pane fade show active" id="group" role="tabpanel" aria-labelledby="group-tab">
    <?php $groups = $this->Group_model->get_group_all();
    ?>
    <table style="font-size: 15px" id="groupList" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#
          </th>
          <th style="font-family: Ubuntu-B;">Group Name
          </th>
          <th style="font-family: Ubuntu-B;">Mentor
          </th>
          <th style="font-family: Ubuntu-B;">Created on
          </th>
          <th style="font-family: Ubuntu-B;">*
          </th>
        </tr>
      </thead>
      <?php
$cnt = 1;
foreach ($groups as $group) {
?>
      <tr>
        <td style="padding: 10px">
          <?= $cnt++ ?>
        </td>
        <td style="padding: 10px">
          <?= $group->name ?>
        </td>

        <td style="padding: 10px">
          <a href="<?= base_url('profile/') . $group->mentor ?>" style="text-decoration: none;"><?= $group->mentor ?></a>
        </td>
        <td style="padding: 10px">
          <?= date("M d, Y g:i A",strtotime($group->created_on)) ?>
        </td>
        <td style="padding: 10px">

          <a role="button" href="<?= base_url("Groups/delete/" . $group->id) ?>" onclick="return confirm('Are you sure you want to delete <?= $group->name ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Delete</a>
          <a style="float: right;" type="button" class="btn btn-primary btn-sm" href="<?= base_url()."group/" .$group->id ?>">Enter
          </a>
        </td>
      </tr>
      <?php
}
?>
    </table>
  </div>
</div>


<script>
$(document).ready(function () {
    $('#groupList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>
