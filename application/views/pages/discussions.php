<title>Discussions | Metropolitan Unviersity Competitive Programming Community</title>
        <h3 class="card-title" style="float: left">
          Questions
        </h3>
        <?php
if ($this->username != ""):
?> 
          <button style="float: right; margin-bottom: 10px" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#newQuestion">Create New</button>
          <a href="?my_questions=true" style="float: right; margin-bottom: 10px; margin-right: 10px" type="button" class="btn btn-secondary btn-md">My Questions</a>
        <?php
endif;
?>
        <?php
$questions = $this->Question_model->get_question(array());

if($this->input->get('my_questions') == 'true' && $this->username != "") {
  $questions = $this->Question_model->get_question(array("created_by" => $this->username));
}

$tot = ($this->pno - 1) * 10 + 1;
$cnt = 0;
$f = 0;
foreach ($questions as $question) {
        $cnt++;
        if($cnt < $tot) continue;
        if($cnt > $tot + 9) break;
        $f = 1;
?>
        <div class="card text-center" style="margin-bottom: 20px; margin-top: 20px; width: 100%">
          <div class="card-body">
            <h5 class="card-title"><?= $question->title ?></h5>
            <p class="card-text" id="body<?= $question->id ?>"></p>
            <script>
              document.getElementById("body<?= $question->id ?>").innerHTML = markUP("<?= str_replace(array("\n", "\r"), '', substr($question->body, 0, 100) . "...") ?>");
            </script>
            <a href="<?= base_url() . "question/" . $question->id ?>" class="btn btn-primary btn-sm">Read more</a>
          </div>
          <div class="card-footer text-muted">
            Published on <?= date("M d, Y g:i A", strtotime($question->published_on)) ?> by <a href="<?= base_url('profile/' . $question->created_by) ?>"><?= $question->created_by ?></a>
          </div>
        </div>
       <?php
}


if($f == 0):?>
<div class="alert alert-info" style="margin-top: 50px; padding: 20px; font-size: 28px; text-align: center;">No Entry</div>
<?php
endif;
?>


<?php
$cnt = ceil(sizeof($questions) / 10);
?>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item <?php if($this->pno == 1) {echo "disabled";} ?>"><a class="page-link" href="<?= base_url('discussions/' . ($this->pno - 1)) ?>">Previous</a></li>
    <?php 
      for($i = 1; $i <= $cnt; $i++) {
        if($i == 11) {?>
          <li class="page-item"><a class="page-link">...</a></li>
        <?php }
        if($i > 10 && $i < ($cnt - 9)) continue;
      ?>
        <li class="page-item <?php if($i == $this->pno) { echo "active"; } ?>"><a class="page-link" href="<?= base_url('discussions/' . $i) ?>"><?= $i ?></a></li>
      <?php  
      }
    ?>
    <li class="page-item <?php if($this->pno == $cnt) {echo "disabled";} ?>"><a class="page-link" href="<?= base_url('discussions/' . ($this->pno + 1)) ?>">Next</a></li>
  </ul>
</nav>


<?php if($this->username != ""): ?>
<!-- Modal -->
<div class="modal fade"  id="newQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url() ?>Questions/create">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
            </div>
            <input type="text" name="title" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          </div>
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
<?php endif; ?>

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