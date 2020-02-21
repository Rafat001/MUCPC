  <div class="col-lg-10">
    <ul class="nav nav-tabs" style="font-size: 18px">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() . "profile/" . $user->username ?>">User Information</a>
      </li>

      <?php if($user->role == "user"): ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('profile/' . $user->username) ?>/oj_profile">Online Judge Profiles</a>
      </li>
      <?php endif?>
      <li class="nav-item">
        <a class="nav-link active">Blog</a>
      </li>
      <?php if($user->role == "user"): ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('profile/' . $user->username) ?>/tagwise_solve" onclick="showToast()">Tagwise Solve</a>
      </li>
      <?php endif?>
    </ul>
  <div class="card-body" style="width: 100%; margin: 0px; padding: 0px; margin-top: 10px">
    <div class="row" style="width: 100%margin: 0px; padding: 0px ">
      <div class="col-lg-12" style="margin: 0px; padding: 0px margin-bottom: 20px">
        <?php
if ($this->username != "" && $user->username == $this->username):
?> 
          <button style="float: right; margin-bottom: 10px" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#newBlog">Create New</button>
        <?php
endif;
?>
        <?php
$blogs = $this->Blog_model->get_blog(array(
        "created_by" => $user->username
));

if(sizeof($blogs) == 0):?>
<div class="alert alert-info" style="margin-top: 50px; padding: 20px; font-size: 28px; text-align: center;">No Entry</div>
<?php
endif;


foreach ($blogs as $blog) {
?>
        <div class="card text-center" style="padding: 0px; margin-bottom: 20px; margin-top: 20px; margin-left: 0px; margin-right: 0px; width: 100%">
          <div class="card-body">
            <h5 class="card-title"><?= $blog->title ?></h5>
            <p class="card-text" id="body<?= $blog->id ?>"></p>
            <script>
              document.getElementById("body<?= $blog->id ?>").innerHTML = markUP("<?= str_replace(array("\n", "\r"), '', substr($blog->body, 0, 100) . "...") ?>");
            </script>
            <a href="<?= base_url() . "blog/" . $blog->id ?>" class="btn btn-primary">Read more</a>
          </div>
          <div class="card-footer text-muted">
            Published on <?= date("M d, Y g:i A", strtotime($blog->published_on)) ?>
          </div>
        </div>
       <?php
}
?>
      </div>
    </div>
  </div>
</div>



<?php if($user->username == $this->username && $this->username != ""): ?>
<!-- Modal -->
<div class="modal fade"  id="newBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Blog</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url() ?>Blogs/create">
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