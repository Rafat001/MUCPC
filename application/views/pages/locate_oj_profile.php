<?php
error_reporting(0);
ini_set('display_errors', 0);

                if ($this->user->codeforces != '') {
                  $url = 'https://codeforces.com/api/user.info?handles=%20' . $this->user->codeforces . '%20';
                  $html = file_get_html($url);
                  $json                  = str_replace(array(
                                "\t",
                                "\n"
                  ), "", $html);
                  $this->codeforces_info = json_decode($json);
                }
?>
<?php
      $context = stream_context_create(
    array(
        "http" => array(
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
        )
    )
);
$html = file_get_html('https://www.codechef.com/users/' . $user->codechef, false, $context);
$findme   = '<div class="rating-number">';
$pos = strpos($html, $findme);
$pos += strlen($findme);
$str = strval($html);
$CCrating = "";
$CCmaxRating = "";
while ($str[$pos] >= '0' && $str[$pos] <= '9') {
  $CCrating = $CCrating . $str[$pos];
  $pos++;
}
if($CCrating == "") $CCrating = "Unrated";
$findme = '<small>(Highest Rating ';
$pos = strpos($html, $findme);
$pos += strlen($findme);
$str = strval($html);
while ($str[$pos] >= '0' && $str[$pos] <= '9') {
  $CCmaxRating = $CCmaxRating . $str[$pos];
  $pos++;
}
if($CCmaxRating == "") $CCmaxRating = "Unrated";
?>
  <div class="col-lg-10">
    <ul class="nav nav-tabs" style="margin-bottom: 10px; font-size: 18px">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() . "profile/" . $user->username ?>">User Information</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active">Online Judge Profiles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('profile/' . $user->username) ?>/blog">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('profile/' . $user->username) ?>/tagwise_solve" onclick="showToast()">Tagwise Solve</a>
      </li>
    </ul>
  <div class="card-body" style="width: 100%;margin: 0px; padding: 0px">
    <div class="row" style="width: 100%; margin: 0px; padding: 0px">
      <div class="col-lg-12" style="margin: 0px; padding: 0px; margin-bottom: 20px">
        <div class="row" style="margin: 0px; padding: 0px">
          <div class="card text-center col-lg-4" style="margin: 0px; padding: 0px; width: 100%; margin-bottom: 10px">
            <div class="card-header">
              <b>Codeforces</b>
            </div>
            <ul class="list-group list-group-flush">

              <?php if($user->codeforces == '') { ?>
                <li class="list-group-item"><div class="alert alert-warning">Not Provided</div></li>
              <?php } else if($this->codeforces_info->status == "OK") { ?>
              <li class="list-group-item">Username: <a style="text-decoration: none;" href="https://codeforces.com/profile/<?= $user->codeforces ?>"><?= $user->codeforces ?></a></li>
              <li class="list-group-item">Max Rating: <b><?= $this->codeforces_info->result[0]->maxRating?></b></li>
              <li class="list-group-item">Current Rating: <b><?= $this->codeforces_info->result[0]->rating ?></b></li>
              <?php } else { ?>
                <li class="list-group-item"><div class="alert alert-danger">Invalid Handle</div></li>
              <?php } ?>
            </ul>
          </div>

          <div class="card text-center col-lg-4" style="margin: 0px; padding: 0px; width: 100%; margin-bottom: 10px">
            <div class="card-header">
              <b>Codechef</b>
            </div>
            <ul class="list-group list-group-flush">
              <?php if($user->codechef == '') { ?>
                <li class="list-group-item"><div class="alert alert-warning">Not Provided</div></li>
              <?php } else { ?>
              <li class="list-group-item">Username: <a style="text-decoration: none;" href="https://www.codechef.com/users/<?= $user->codechef ?>"><?= $user->codechef ?></a></li>
              <li class="list-group-item">Max Rating: <b><?= $CCmaxRating ?></b></li>
              <li class="list-group-item">Current Rating: <b><?= $CCrating ?></b></li>
              <?php } ?>
            </ul>
          </div>

          <div class="card text-center col-lg-4" style="margin: 0px; padding: 0px; width: 100%; margin-bottom: 10px">
            <div class="card-header">
              <b>UVa</b>
            </div>
            <ul class="list-group list-group-flush">
              <?php if($user->uva == '') { ?>
                <li class="list-group-item"><div class="alert alert-warning">Not Provided</div></li>
              <?php } else { ?>
              <li class="list-group-item">UHunt ID: <a style="text-decoration: none;" href="https://uhunt.onlinejudge.org/id/<?= $user->uva ?>"><?= $user->uva ?></a></li>
              <?php } ?>
            </ul>
          </div>

          <div class="card text-center col-lg-4" style="margin: 0px; padding: 0px; width: 100%; margin-bottom: 10px">
            <div class="card-header">
              <b>SPOJ</b>
            </div>
            <ul class="list-group list-group-flush">
              <?php if($user->spoj == '') { ?>
                <li class="list-group-item"><div class="alert alert-warning">Not Provided</div></li>
              <?php } else { ?>
              <li class="list-group-item">Username: <a style="text-decoration: none;" href="http://www.spoj.com/users/<?= $user->spoj ?>"><?= $user->spoj ?></a></li>
              <?php } ?>
            </ul>
          </div>

          <div class="card text-center col-lg-4" style="margin: 0px; padding: 0px; width: 100%; margin-bottom: 10px">
            <div class="card-header">
              <b>LightOJ</b>
            </div>
            <ul class="list-group list-group-flush">
              <?php if($user->lightoj == '') { ?>
                <li class="list-group-item"><div class="alert alert-warning">Not Provided</div></li>
              <?php } else { ?>
              <li class="list-group-item">LightOJ ID: <?= $user->lightoj ?></li>
              <?php } ?>
            </ul>
          </div>

          <div class="card text-center col-lg-4" style="margin: 0px; padding: 0px; width: 100%; margin-bottom: 10px">
            <div class="card-header">
              <b>Toph</b>
            </div>
            <ul class="list-group list-group-flush">
              <?php if($user->toph == '') { ?>
                <li class="list-group-item"><div class="alert alert-warning">Not Provided</div></li>
              <?php } else { ?>
              <li class="list-group-item">Toph Username: <a href="https://toph.co/u/<?= $user->toph ?>"><?= $user->toph ?></a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
