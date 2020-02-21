<title>Participation | Metropolitan Unviersity Competitive Programming Community</title>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="icpc-tab" data-toggle="tab" href="#icpc" role="tab" aria-controls="icpc" aria-selected="false">ICPC Dhaka Regional</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="ncpc-tab" data-toggle="tab" href="#ncpc" role="tab" aria-controls="ncpc" aria-selected="true">National Collegiate Programming Contest</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="iupc-tab" data-toggle="tab" href="#iupc" role="tab" aria-controls="iupc" aria-selected="false">Inter University Programming Contest</a>
  </li>
</ul>


<div class="tab-content" id="myTabContent" style="margin-top: 10px">
  <div class="tab-pane fade show active" id="icpc" role="tabpanel" aria-labelledby="icpc-tab">
    <?php if($this->session->userdata('role') != "user" && $this->session->userdata('role') != ''): ?>
    <button style="float: right;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newICPC">Add New</button>
    <?php endif?>
    <h5>ICPC Dhaka Regional Participation</h5>
    <table style="font-size: 15px" id="icpcList" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#</th>
          <th style="font-family: Ubuntu-B;">Name</th>
          <th style="font-family: Ubuntu-B;">Total Team</th>
          <th style="font-family: Ubuntu-B;">Total Team from MU</th>
          <th style="font-family: Ubuntu-B;">Best Rank by MU Team</th>
          <th style="font-family: Ubuntu-B;">*</th>
        </tr>
      </thead>
      <?php $icpc = $this->Auth_model->get_participation(array('type' => "icpc"));
        $cnt = 1;
        foreach ($icpc as $contest) {
          ?>
          <tr>
            <td style="padding: 10px"><?= $cnt++ ?></td>
            <td style="padding: 10px"><?= $contest->name ?></td>
            <td style="padding: 10px"><?= $contest->total_team ?></td>
            <td style="padding: 10px"><?= $contest->total_team_from_mu ?></td>
            <td style="padding: 10px"><?= $contest->best_rank ?></td>
            <td style="padding: 10px">
              <?php if($this->session->userdata('role') != "user" && $this->session->userdata('role') != ''): ?>
              <a role="button" href="<?= base_url("Pages/deleteRank/" . $contest->id) ?>" onclick="return confirm('Are you sure you want to delete <?= htmlentities($contest->name) ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Delete</a>
              <?php endif ?>
              <a style="float: right;" type="button" class="btn btn-info btn-sm" href="<?= $contest->standings ?>">Full Standings</a>
            </td>
          </tr>
          <?php
        }
      ?>
    </table>
  </div>

  <div class="tab-pane fade" id="ncpc" role="tabpanel" aria-labelledby="icpc-tab">
    <?php if($this->session->userdata('role') != "user" && $this->session->userdata('role') != ''): ?>
    <button style="float: right;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newNCPC">Add New</button>
    <?php endif?>
    <h5>National Collegiate Programming Contest (NCPC) Participation</h5>
    <table style="font-size: 15px" id="ncpcList" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#</th>
          <th style="font-family: Ubuntu-B;">Name</th>
          <th style="font-family: Ubuntu-B;">Total Team</th>
          <th style="font-family: Ubuntu-B;">Total Team from MU</th>
          <th style="font-family: Ubuntu-B;">Best Rank by MU Team</th>
          <th style="font-family: Ubuntu-B;">*</th>
        </tr>
      </thead>
      <?php $ncpc = $this->Auth_model->get_participation(array('type' => "ncpc"));
        $cnt = 1;
        foreach ($ncpc as $contest) {
          ?>
          <tr>
            <td style="padding: 10px"><?= $cnt++ ?></td>
            <td style="padding: 10px"><?= $contest->name ?></td>
            <td style="padding: 10px"><?= $contest->total_team ?></td>
            <td style="padding: 10px"><?= $contest->total_team_from_mu ?></td>
            <td style="padding: 10px"><?= $contest->best_rank ?></td>
            <td style="padding: 10px">
              <?php if($this->session->userdata('role') != "user" && $this->session->userdata('role') != ''): ?>
              <a role="button" href="<?= base_url("Pages/deleteRank/" . $contest->id) ?>" onclick="return confirm('Are you sure you want to delete <?= htmlentities($contest->name) ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Delete</a>
              <?php endif ?>
              <a style="float: right;" type="button" class="btn btn-info btn-sm" href="<?= $contest->standings ?>">Full Standings</a>
            </td>
          </tr>
          <?php
        }
      ?>
    </table>
  </div>

  <div class="tab-pane fade" id="iupc" role="tabpanel" aria-labelledby="icpc-tab">
    <?php if($this->session->userdata('role') != "user" && $this->session->userdata('role') != ''): ?>
    <button style="float: right;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newIUPC">Add New</button>
    <?php endif?>
    <h5>Inter University Programming Contest (IUPC) Participation</h5>
    <table style="font-size: 15px" id="iupcList" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th style="font-family: Ubuntu-B;">#</th>
          <th style="font-family: Ubuntu-B;">Name</th>
          <th style="font-family: Ubuntu-B;">Total Team</th>
          <th style="font-family: Ubuntu-B;">Total Team from MU</th>
          <th style="font-family: Ubuntu-B;">Best Rank by MU Team</th>
          <th style="font-family: Ubuntu-B;">*</th>
        </tr>
      </thead>
      <?php $iupc = $this->Auth_model->get_participation(array('type' => "iupc"));
        $cnt = 1;
        foreach ($iupc as $contest) {
          ?>
          <tr>
            <td style="padding: 10px"><?= $cnt++ ?></td>
            <td style="padding: 10px"><?= $contest->name ?></td>
            <td style="padding: 10px"><?= $contest->total_team ?></td>
            <td style="padding: 10px"><?= $contest->total_team_from_mu ?></td>
            <td style="padding: 10px"><?= $contest->best_rank ?></td>
            <td style="padding: 10px">
              <?php if($this->session->userdata('role') != "user" && $this->session->userdata('role') != ''): ?>
              <a role="button" href="<?= base_url("Pages/deleteRank/" . $contest->id) ?>" onclick="return confirm('Are you sure you want to delete <?= htmlentities($contest->name) ?>?');" style="margin-left: 10px; float: right;" class="btn btn-danger btn-sm">Delete</a>
                <?php endif ?>
              <a style="float: right;" type="button" class="btn btn-info btn-sm" href="<?= $contest->standings ?>">Full Standings</a>
            </td>
          </tr>
          <?php
        }
      ?>
    </table>
  </div>
</div>


<?php if($this->session->userdata('role') != "user" && $this->session->userdata('role') != ''): ?>
<!-- Modal22 -->
<div class="modal fade" style="width: 100%"  id="newICPC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Add New ICPC
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;
          </span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url() ?>Pages/createRank">
          <input type="hidden" name="type" value="icpc">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Contest Name
              </span>
            </div>
            <input type="text" name="name" id="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Year
              </span>
            </div>
            <input type="number" name="year" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Standings Link
              </span>
            </div>
            <input type="text" name="standings" id="standings" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Total Team
              </span>
            </div>
            <input type="number" name="total_team" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Total Team from Metropolitan University
              </span>
            </div>
            <input type="number" name="total_team_from_mu" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Best Rank
              </span>
            </div>
            <input type="number" name="best_rank" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close
          </button>
          <button type="submit" class="btn btn-success btn-md" >Add
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<?php endif; ?>

<?php if($this->session->userdata('role') != "user" && $this->session->userdata('role') != ''): ?>
<!-- Modal22 -->
<div class="modal fade" style="width: 100%"  id="newNCPC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Add New NCPC
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;
          </span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url() ?>Pages/createRank">
          <input type="hidden" name="type" value="ncpc">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Contest Name
              </span>
            </div>
            <input type="text" name="name" id="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Year
              </span>
            </div>
            <input type="number" name="year" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Standings Link
              </span>
            </div>
            <input type="text" name="standings" id="standings" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Total Team
              </span>
            </div>
            <input type="number" name="total_team" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Total Team from Metropolitan University
              </span>
            </div>
            <input type="number" name="total_team_from_mu" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Best Rank
              </span>
            </div>
            <input type="number" name="best_rank" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close
          </button>
          <button type="submit" class="btn btn-success btn-md" >Add
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<?php endif; ?>


<?php if($this->session->userdata('role') != "user" && $this->session->userdata('role') != ''): ?>
<!-- Modal22 -->
<div class="modal fade" style="width: 100%"  id="newIUPC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Add New IUPC
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;
          </span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url() ?>Pages/createRank">
          <input type="hidden" name="type" value="iupc">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Contest Name
              </span>
            </div>
            <input type="text" name="name" id="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Year
              </span>
            </div>
            <input type="number" name="year" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>

          
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Standings Link
              </span>
            </div>
            <input type="text" name="standings" id="standings" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Total Team
              </span>
            </div>
            <input type="number" name="total_team" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Total Team from Metropolitan University
              </span>
            </div>
            <input type="number" name="total_team_from_mu" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Best Rank
              </span>
            </div>
            <input type="number" name="best_rank" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close
          </button>
          <button type="submit" class="btn btn-success btn-md" >Add
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
    $('#iupcList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>


<script>
$(document).ready(function () {
    $('#icpcList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>

<script>
$(document).ready(function () {
    $('#ncpcList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>