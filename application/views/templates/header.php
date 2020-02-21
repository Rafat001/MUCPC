
<?php 
error_reporting(0);
ini_set('display_errors', 0);
?>
<html lang="en"><head>
	<meta charset="UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&amp;display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono&display=swap" rel="stylesheet">

	<style>
		@font-face {
	    		font-family: Ubuntu-B;
	    		src: url('<?= base_url() ?>assets/font/Ubuntu-B.ttf');
		}
		@font-face {
	    		font-family: UbuntuMono-R;
	    		src: url('<?= base_url() ?>assets/font/UbuntuMono-R.ttf');
		}
		@font-face {
	    		font-family: UbuntuMono-B;
	    		src: url('<?= base_url() ?>assets/font/UbuntuMono-B.ttf');
		}
		* {
      		font-family: Ubuntu;
    	}
    	@media screen and (min-width: 768px) {
        .modal-dialog {
          width: 700px; /* New width for default modal */
        }
        .modal-sm {
          width: 350px; /* New width for small modal */
        }
    }
	</style>



<link href="<?= base_url() . "/assets/fa/css/all.css" ?>" rel="stylesheet"> 

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<script src="<?= base_url('assets/js/markup.js') ?>"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


  <!-- jQuery UI library -->
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<style type="text/css">
  .ui-front {
    z-index: 9999;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Hind+Siliguri" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding-left: 5%; padding-right: 5%">
  <a class="navbar-brand" href="<?= base_url() ?>">MUCPC</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto" style="font-size: 15px">
      <li class="nav-item <?php
if ($this->title == "Home") {
				echo ("active");
}
?>">
        <a class="nav-link" href="<?= base_url() ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php
if ($this->title == "Participation") {
				echo ("active");
}
?>">
        <a class="nav-link" href="<?= base_url() . "participation" ?>">Participation</a>
      </li>
      <li class="nav-item <?php
if ($this->title == "Programmers") {
				echo ("active");
}
?>">
        <a class="nav-link" href="<?= base_url() . "programmers" ?>">Programmers</a>
      </li>
      <?php
if ($this->session->userdata('role') == 'coach'):
?>
    	<li class="nav-item <?php
if ($this->title == "Training") {
				echo ("active");
}
?>">
        <a class="nav-link" href="<?= base_url() . "training" ?>">Training</a>
      </li>
<?php
endif;
?>
<?php
if ($this->session->userdata('role') == 'user'):
?>
      <li class="nav-item <?php
if ($this->title == "Dashboard") {
        echo ("active");
}
?>">
        <a class="nav-link" href="<?= base_url() . "dashboard" ?>">Dashboard</a>
      </li>
<?php
endif;
?>
<?php
if ($this->session->userdata('role') == 'mentor'):
?>
      <li class="nav-item <?php
if ($this->title == "Mentoring") {
        echo ("active");
}
?>">
        <a class="nav-link" href="<?= base_url() . "mentoring" ?>">Mentoring</a>
      </li>
<?php
endif;
?>
<?php
if ($this->session->userdata('role') == 'admin'):
?>
      <li class="nav-item <?php
if ($this->title == "Admin") {
        echo ("active");
}
?>">
        <a class="nav-link" href="<?= base_url() . "admin" ?>">Admin Panel</a>
      </li>
<?php
endif;
?>
    <li class="nav-item <?php
if ($this->title == "Contests") {
        echo ("active");
}
?>">
        <a class="nav-link" href="<?= base_url() . "contests" ?>">Contests</a>
      </li>

        <li class="nav-item <?php
if ($this->title == "Discussions") {
        echo ("active");
}
?>">
        <a class="nav-link" href="<?= base_url() . "discussions" ?>">Discussions</a>
      </li>

      <li class="nav-item <?php
if ($this->title == "Leaderboard") {
        echo ("active");
}
?>">
        <a class="nav-link" href="<?= base_url() . "leaderboard" ?>">Leaderboard</a>
      </li>
    </ul>
    

    <ul class="nav navbar-nav ml-auto">
	<?php
if ($this->session->userdata('username') == ''):
?>
    	<li class="nav-item">
		<a class="nav-link" href="<?php
				echo base_url();
?>login">Login</a>
	</li>
<?php
endif;
?>

<?php
if ($this->session->userdata('username') != ''):
?>
			<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="rounded" height="40" width="40" src="<?= base_url() . $this->session->userdata('photo') ?>"/></a>
        </a>
	        <div style="font-size: 14px" class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= base_url() . "profile/" . $this->session->userdata('username') ?>"><b><?= $this->session->userdata('name') ?></b><br><?= $this->session->userdata('username') ?></a>
	          <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url() . "profile/" . $this->session->userdata('username') ?>">Profile</a>
	          <a class="dropdown-item" href="<?= base_url() . "account" ?>">Account</a>
	          <div class="dropdown-divider"></div>
	          <a class="dropdown-item text-danger" href="<?= base_url() ?>Auth/logout"><span class="fa fa-sign-out"></span> Logout</a>
	        </div>
      	</li>
<?php
endif;
?>

	<?php
if ($this->session->userdata('username') == ''):
?>
    	<li class="nav-item">
		<a class="nav-link" href="<?php
				echo base_url();
?>register">Register</a>
	</li>
<?php
endif;
?>
	</ul>
	<span class="navbar-text" style="font-size: 13px">
      <b>Metropolitan Unviersity Competitive Programming Community</b>
  </span>
  </div>
</nav>


<div class="container-fluid" style="padding-left: 5%; padding-right: 5%; padding-top: 15px">
<?php
if ($this->session->userdata('error_msg') != NULL) {
?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php
        echo $this->session->userdata('error_msg');
        $this->session->unset_userdata('error_msg');
?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
      <?php
}
?>

<?php
if ($this->session->userdata('success_msg') != NULL) {
?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        echo $this->session->userdata('success_msg');
        $this->session->unset_userdata('success_msg');
?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
      <?php
}
?>
<?php
if ($this->session->userdata('warning_msg') != NULL) {
?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php
        echo $this->session->userdata('warning_msg');
        $this->session->unset_userdata('warning_msg');
?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
      <?php
}
?>