<?php if(!isset($this->news)) {
	redirect(base_url());
} $news = $this->news ?>

<title><?= $news->title ?> | Metropolitan Unviersity Competitive Programming Community</title>

<?php if($this->session->userdata('role') == "admin"): ?>
<center>
	<a role="button" href="<?= base_url("News/delete/" . $news->id) ?>" onclick="return confirm('Are you sure you want to delete <?= $news->title ?>?');" style="float: right; margin-left: 10px" class="btn btn-danger btn-sm">Delete</a>
	<button type="button" data-toggle="modal" data-target="#editBlog" style="float: right;" class="btn btn-primary btn-sm">Edit</button>
</center>
<?php endif ?>
<h1><center><?= $news->title ?></center></h1>
<h3><center><?= $news->summary ?></center></h3>
<?php if($news->photo != ""):?> <center><img src="<?= base_url() . $news->photo?>" style="margin-top: 15px; width: 50%; height: 100%"></center> <?php endif ?>
<br>
<p id="show"></p>

<script>
document.getElementById('show').innerHTML = "<?php echo str_replace(array("\n", "\r"), '', $news->body); ?>"
document.getElementById('show').innerHTML = markUP(document.getElementById('show').innerHTML);
</script>

<?php if($this->session->userdata('role') == "admin"): ?>
<div class="modal fade"  id="editBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update News</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" method="post" action="<?= base_url() ?>News/edit">
        	<input type="hidden" name="news_id" value="<?= $news->id ?>">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
            </div>
            <input type="text" name="title" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="" value="<?= $news->title ?>">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Summary</span>
            </div>
            <input type="text" name="summary" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="" value="<?= $news->summary ?>">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Title Photo</span>
            </div>
            <input class="form-control" style="margin-left: 10px; margin-top: 6px" type="file" name="photo"  />
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
            <textarea style="height: 300px" name="body" class="form-control" id="body" aria-label="Default" aria-describedby="inputGroup-sizing-default" required=""><?= $news->body ?></textarea>
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