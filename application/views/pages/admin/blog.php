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
    <a class="nav-link" id="group-tab" href="<?=base_url('admin')?>/group" aria-controls="group" aria-selected="false">Group</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" id="blog-tab" data-toggle="tab" href="#blog" role="tab" aria-controls="blog" aria-selected="false">Blog</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="question-tab" href="<?=base_url('admin')?>/question" aria-controls="question" aria-selected="true">Question</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="news-tab" href="<?=base_url('admin')?>/news" aria-controls="news" aria-selected="true">News</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent" style="margin-top: 20px">
  <div class="tab-pane fade show active" id="blog" role="tabpanel" aria-labelledby="blog-tab">
    <?php $blogs = $this->Blog_model->get_blog_all();
    ?>
    <table style="font-size: 15px" id="blogList" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#
          </th>
          <th style="font-family: Ubuntu-B;">Blog Title
          </th>
          <th style="font-family: Ubuntu-B;">Creator
          </th>
          <th style="font-family: Ubuntu-B;">Published on
          </th>
          <th style="font-family: Ubuntu-B;">*
          </th>
        </tr>
      </thead>
      <?php
$cnt = 1;
foreach ($blogs as $blog) {
?>
      <tr>
        <td style="padding: 10px">
          <?= $cnt++ ?>
        </td>
        <td style="padding: 10px">
          <?= $blog->title ?>
        </td>

        <td style="padding: 10px">
          <a href="<?= base_url('profile/') . $blog->created_by ?>" style="text-decoration: none;"><?= $blog->created_by ?></a>
        </td>
        <td style="padding: 10px">
          <?= date("M d, Y g:i A",strtotime($blog->published_on)) ?>
        </td>
        <td style="padding: 10px">

          <a role="button" href="<?= base_url("Blogs/delete_by_admin/" . $blog->id) ?>" onclick="return confirm('Are you sure you want to delete <?= $blog->title ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Delete</a>
          <a style="float: right;" type="button" class="btn btn-primary btn-sm" href="<?= base_url()."blog/" .$blog->id ?>">Enter
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
    $('#blogList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>
