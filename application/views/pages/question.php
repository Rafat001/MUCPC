<?php if(!isset($this->question)) {
	redirect(base_url());
} ?>
<?php $question = $this->question ?>
<title><?= $question->title ?> | Metropolitan Unviersity Competitive Programming Community</title>
<?php if($this->username == $question->created_by): ?>
<div class="row" style="margin: 0px; padding: 0px">
	<div class="col-lg-8 col-sm-6 col-md-6" style="margin: 0px; padding: 0px">
		<h3><?= $question->title ?></h3>
		<h6>Published by <a href="<?= base_url() . "profile/" . $question->created_by?>"><?= $question->created_by ?></a>
 on <?= date("M d, Y g:i A",strtotime($question->published_on)) ?></h6>
	</div>
	<div class="col-lg-4 col-sm-6 col-md-6">
		<a role="button" href="<?= base_url("Questions/delete/" . $question->id) ?>" onclick="return confirm('Are you sure you want to delete <?= $question->title ?>?');" style="float: right; margin-left: 10px" class="btn btn-danger btn-sm">Delete</a>
		<button type="button" data-toggle="modal" data-target="#editQuestion" style="float: right;" class="btn btn-primary btn-sm">Edit</button>
	</div>
</div>
<?php endif ?>

<?php if($this->username != $question->created_by): ?>
	<h3><?= $question->title ?></h3>
	<h6>Asked by <a href="<?= base_url() . "profile/" . $question->created_by?>"><?= $question->created_by ?></a>
 on <?= date("M d, Y g:i A",strtotime($question->published_on)) ?></h6>
<?php endif ?>
<hr>
	<p id="show"></p>
<hr>
<h5><?= sizeof($this->Question_model->get_answer(array('question_id' => $question->id))) ?> Answer(s)</h5>
<?php if($this->username): ?>
<form method="post" action="<?= base_url() . "Questions/newAnswer" ?>">
	<input type="hidden" name="question_id" value="<?= $question->id ?>">
	<textarea class="form-control" name="body" required=""></textarea>
	<button style="margin-top: 10px" type="submit" class="btn btn-primary">Answer</button>
</form>
<?php endif ?>
<?php
	$answers = $this->Question_model->get_answer(array('question_id' => $question->id));
	foreach ($answers as $answer) {
		?>
		<div class="card" style="margin-top: 20px">
		  <div class="card-header" style="font-size: 14px">
		    <div style="float: left;"><a href="<?= base_url() . "profile/". $answer->created_by ?>"><?= $answer->created_by ?></a> says</div>
        <?php if($this->username != "" && $this->username != $answer->created_by): ?>
          <?php $check_helpful = $this->Question_model->get_helpful(array("answer_id" => $answer->id, "created_by" => $answer->created_by, "liked_by" => $this->username)) ?>
          <?php if($check_helpful == false): ?>
            <form action="<?= base_url('Questions/addHelpful') ?>" method="post">
              <input type="hidden" name="answer_id" value="<?= $answer->id ?>">
              <input type="hidden" name="question_id" value="<?= $question->id ?>">
              <input type="hidden" name="created_by" value="<?= $answer->created_by ?>">
              <input type="hidden" name="liked_by" value="<?= $this->username ?>">
              <div class="btn-group" style="float: right;" role="group">
                <button type="submit" style="float: right;" class="btn btn-info btn-sm"><span class="fas fa-heart"></span> Helpful</button>
                <button style="float: right;" class="btn btn-secondary btn-sm" type="button"><?= $this->Question_model->sizeOfHelpful($answer->id) ?></button>
              </div>
            </form>
          <?php endif; ?>
          <?php if($check_helpful != false): ?>
            <div class="btn-group" style="float: right;" role="group">
              <button type="button" style="float: right;" class="btn btn-info btn-sm disabled"><span class="fas fa-heart"></span> Helpful</button>
              <button style="float: right;" class="btn btn-secondary btn-sm" type="button"><?= $this->Question_model->sizeOfHelpful($answer->id) ?></button>
            </div>
          <?php endif; ?>
        <?php endif; ?>
		  </div>
		  <div class="card-body" style="margin-bottom: 0px; padding-bottom: 0px">
		    <blockquote class="blockquote" style="margin: 0px; padding: 0px; font-size: 14px">
		      <p><?= $answer->body ?></p>
		    </blockquote>
		  </div>
		  <div class="card-footer" style="font-size: 14px">
		  	On <?= date("M d, Y g:i A",strtotime($answer->published_on)) ?>
		  </div>
		</div>
		<?php
	}
?>
<script>
document.getElementById('show').innerHTML = "<?php echo str_replace(array("\n", "\r"), '', $question->body); ?>"
document.getElementById('show').innerHTML = markUP(document.getElementById('show').innerHTML);
</script>

<?php if($question->created_by == $this->username && $this->username != ""): ?>
<!-- Modal -->
<div class="modal fade"  id="editQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url() ?>Questions/edit">
        	<input type="hidden" name="question_id" value="<?= $question->id ?>">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
            </div>
            <input type="text" name="title" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="" value="<?= $question->title ?>">
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
            <textarea style="height: 300px" name="body" class="form-control" id="body" aria-label="Default" aria-describedby="inputGroup-sizing-default" required=""><?= $question->body ?></textarea>
          </div>
            <div><h5>Preview</h5></div>
            <hr style="padding: 0px; margin: 0px">
            <div><div id="preview"></div></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info btn-md" onclick="showPreview()">Preview</button>
          <button type="submit" class="btn btn-primary btn-md" >Update</button>
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
  wpanswer = document.getElementById('body');
  str = htmlEntities(wpanswer.value);
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