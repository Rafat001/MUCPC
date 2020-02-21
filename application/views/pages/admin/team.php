<h3>Admin Panel</h3>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link" id="user-tab" href="<?=base_url('admin')?>/user" aria-controls="user" aria-selected="true">User</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" id="team-tab" data-toggle="tab" href="#team" role="tab" aria-controls="team" aria-selected="true">Team</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="user-tab" href="<?=base_url('admin')?>/task" aria-controls="task" aria-selected="true">Task</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="group-tab" href="<?=base_url('admin')?>/group" aria-controls="group" aria-selected="true">Group</a>
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
  <div class="tab-pane fade show active" id="team" role="tabpanel" aria-labelledby="team-tab">
    <?php $teams = $this->Team_model->get_team_all();
    ?>
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
          <th style="font-family: Ubuntu-B;">Coach
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
          <a href="<?= base_url('profile/') . $team->member1 ?>" style="text-decoration: none;"><?= $team->member1 ?></a>
        </td>
        <td style="padding: 10px">
          <a href="<?= base_url('profile/') . $team->member2 ?>" style="text-decoration: none;"><?= $team->member2 ?></a>
        </td>
        <td style="padding: 10px">
          <a href="<?= base_url('profile/') . $team->member3 ?>" style="text-decoration: none;"><?= $team->member3 ?></a>
        </td>
        <td style="padding: 10px">
          <a href="<?= base_url('profile/') . $team->coach ?>" style="text-decoration: none;"><?= $team->coach ?></a>
        </td>
        <td style="padding: 10px">
          <?= date("M d, Y g:i A",strtotime($team->created_on)) ?>
        </td>
        <td style="padding: 10px">
          <a role="button" href="<?= base_url("Teams/delete/" . $team->id) ?>" onclick="return confirm('Are you sure you want to delete <?= $team->name ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Delete</a>
          <a style="float: right;" type="button" class="btn btn-primary btn-sm" href="<?= base_url()."team/" .$team->id ?>">Enter
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
    $('#teamList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>
