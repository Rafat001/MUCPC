<title>Admin Panel | Metropolitan Unviersity Competitive Programming Community</title>
<?php
  if($this->locate == 'task') {
    include('admin/task.php');
  }
  else if($this->locate == 'group') {
    include('admin/group.php');
  }
  else if($this->locate == 'team') {
    include('admin/team.php');
  }
  else if($this->locate == 'blog') {
    include('admin/blog.php');
  }
  else if($this->locate == 'question') {
    include('admin/question.php');
  }
  else if($this->locate == 'news') {
    include('admin/news.php');
  }
  else {
    include('admin/user.php');
  }
?>