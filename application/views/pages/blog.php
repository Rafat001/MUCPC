<?php if(!isset($this->blog)) {
	redirect(base_url());
} ?>
<?php $blog = $this->blog ?>
<title><?= $blog->title ?> | Metropolitan Unviersity Competitive Programming Community</title>

<div class="row" style="margin: 0px; padding: 0px; padding-top: 10px">
  <div class="col-lg-9" style="margin: 0px; padding: 0px">

    <?php if($this->username == $blog->created_by): ?>
    <div class="row" style="margin: 0px; padding: 0px">
    	<div class="col-lg-8 col-sm-6 col-md-6" style="margin: 0px; padding: 0px">
    		<h3><?= $blog->title ?></h3>
    		<h6>Published by <a href="<?= base_url() . "profile/" . $blog->created_by?>"><?= $blog->created_by ?></a>
     on <?= date("M d, Y g:i A",strtotime($blog->published_on)) ?></h6>
    	</div>
    	<div style="padding-top: 10px" class="col-lg-4 col-sm-6 col-md-6">
    		<a role="button" href="<?= base_url("Blogs/delete/" . $blog->id) ?>" onclick="return confirm('Are you sure you want to delete <?= $blog->title ?>?');" style="float: right; margin-left: 10px" class="btn btn-danger btn-sm">Delete</a>
    		<button type="button" data-toggle="modal" data-target="#editBlog" style="float: right;" class="btn btn-primary btn-sm">Edit</button>
    	</div>
    </div>
    <?php endif ?>

    <?php if($this->username != $blog->created_by): ?>
    	<h3><?= $blog->title ?></h3>
    	<h6>Published by <a href="<?= base_url() . "profile/" . $blog->created_by?>"><?= $blog->created_by ?></a>
     on <?= date("M d, Y g:i A",strtotime($blog->published_on)) ?></h6>
    <?php endif ?>
    <hr>
    	<p id="show"></p>
    <hr>
    <h5><?= sizeof($this->Blog_model->get_comment(array('blog_id' => $blog->id))) ?> Comment(s)</h5>
    <?php if($this->username): ?>
    <form method="post" action="<?= base_url() . "Blogs/newComment" ?>">
    	<input type="hidden" name="blog_id" value="<?= $blog->id ?>">
    	<textarea class="form-control" name="body" required=""></textarea>
    	<button style="margin-top: 10px" type="submit" class="btn btn-primary">Comment</button>
    </form>
    <?php endif ?>
    <?php
    	$comments = $this->Blog_model->get_comment(array('blog_id' => $blog->id));
    	foreach ($comments as $comment) {
    		?>
    		<div class="card" style="margin-top: 20px">
    		  <div class="card-header" style="font-size: 14px">
    		    <a href="<?= base_url() . "profile/". $comment->created_by ?>"><?= $comment->created_by ?></a> says
    		  </div>
    		  <div class="card-body" style="margin-bottom: 0px; padding-bottom: 0px">
    		    <blockquote class="blockquote" style="margin: 0px; padding: 0px; font-size: 14px">
    		      <p><?= $comment->body ?></p>
    		    </blockquote>
    		  </div>
    		  <div class="card-footer" style="font-size: 14px">
    		  	On <?= date("M d, Y g:i A",strtotime($comment->published_on)) ?>
    		  </div>
    		</div>
    		<?php
    	}
    ?>
    <script>
    document.getElementById('show').innerHTML = "<?php echo str_replace(array("\n", "\r"), '', $blog->body); ?>"
    document.getElementById('show').innerHTML = markUP(document.getElementById('show').innerHTML);
    </script>

    <?php if($blog->created_by == $this->username && $this->username != ""): ?>
    <!-- Modal -->
    <div class="modal fade"  id="editBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Blog</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="<?= base_url() ?>Blogs/edit">
            	<input type="hidden" name="blog_id" value="<?= $blog->id ?>">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
                </div>
                <input type="text" name="title" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="" value="<?= $blog->title ?>">
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
                <textarea style="height: 300px" name="body" class="form-control" id="body" aria-label="Default" aria-describedby="inputGroup-sizing-default" required=""><?= $blog->body ?></textarea>
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
  </div>
  <div style="padding: 10px;"class="col-lg-3 col-sm-12 col-md-12">
    <div class="card">
      <p class="card-header" style="font-size: 20px; padding: 10px; margin: 0px">Recent Blog Posts</p>
        <ul class="list-group list-group-flush">
          <?php $vec = $this->Blog_model->get_blog_all();
          $cnt = 1;
          foreach ($vec as $blog) {
            if($cnt > 10) break;
            $cnt++;
            ?>
            <li class="list-group-item" style="padding: 10px; margin: 0px">
              <p style="margin: 0px; padding: 0px; font-size: 18px" class="card-title"><a style="text-decoration: none;" href="<?= base_url('blog/' . $blog->id) ?>"><?= $blog->title ?></a>
              </p>
              <div style="margin: 0px;padding: 0px; font-family: Ubuntu Mono" class="card-text">by <a style="font-family: Ubuntu Mono; text-decoration: none;" href="<?= base_url('profile/'.$blog->created_by)?>"><?= $blog->created_by ?></a></div>
            </li>
          <?php } ?>
        </ul>
    </div>
  </div>
</div>

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