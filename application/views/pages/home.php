<title>Metropolitan Unviersity Competitive Programming Community</title>
<div class="row" style="margin: 0px">
	<div class="col-lg-9">
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" style="margin-bottom: 20px">
	    <ol class="carousel-indicators">
	      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
	      <li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li>
	      <li data-target="#carouselExampleCaptions" data-slide-to="2" class=""></li>
	    </ol>
	    <div class="carousel-inner">
	      <div class="carousel-item active">
	        <img class="d-block w-100" data-src="holder.js/800x400?auto=yes&amp;bg=777&amp;fg=555&amp;text=First slide" alt="First slide [800x400]" src="<?= base_url('assets/images/home_1.jpg') ?>" data-holder-rendered="true">
	        <div class="carousel-caption d-none d-md-block">
	          <h5>Success in ICPC Dhaka Regional 2019</h5>
	          <p>Metropolitan University ranked 30th ICPC Dhaka Regional 2019</p>
	        </div>
	      </div>
	      <div class="carousel-item">
	        <img class="d-block w-100" data-src="holder.js/800x400?auto=yes&amp;bg=666&amp;fg=444&amp;text=Second slide" alt="Second slide [800x400]" src="<?= base_url('assets/images/home_2.jpg') ?>" data-holder-rendered="true">
	        <div class="carousel-caption d-none d-md-block">
	          <h5>Impressive success in NGPC</h5>
	          <p>Metropolitan University become champione in Ada Lovelace National Girl's Programming Contest.</p>
	        </div>
	      </div>
	      <div class="carousel-item ">
	        <img class="d-block w-100" data-src="holder.js/800x400?auto=yes&amp;bg=555&amp;fg=333&amp;text=Third slide" alt="Third slide [800x400]" src="<?= base_url('assets/images/home_3.jpg') ?>" data-holder-rendered="true">
	        <div class="carousel-caption d-none d-md-block">
	          <h5 style="color: green">14th in Synapse Ranking</h5>
	          <p style="color: green">Metropolitan University ranked 14th in Synapse ranking.</p>
	        </div>
	      </div>
	    </div>
	    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
	      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	      <span class="sr-only">Previous</span>
	    </a>
	    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
	      <span class="carousel-control-next-icon" aria-hidden="true"></span_>
	      <span class="sr-only">Next</span>
	    </a>
	  </div>
	</div>
	<div class="col-lg-3">
		<div class="card">
		  <h5 class="card-header">Recent Blog Posts</h5>
		  <div class="card-body">
		  <?php $vec = $this->Blog_model->get_blog_all();
			$cnt = 1;
			foreach ($vec as $blog) {
				if($cnt > 10) break;
				$cnt++;
				?>
		    <h5 class="card-title"><a style="text-decoration: none;" href="<?= base_url('blog/' . $blog->id) ?>"><?= $blog->title ?></a></h5>
		    <p class="card-text"><?= substr($blog->body, 0, 25) . "..." ?></p>
		  <?php } ?>
		  </div>
		</div>
	</div>
</div>


	<div class="col-lg-9">
		<div class="row">
		<?php
$vec = $this->Auth_model->get_news();
$cnt = 1;
foreach ($vec as $news) {
	if($cnt > 16) break;
	$cnt++;
	?>
			<div class="card col-lg-4" style="padding: 0">
			  <div class="card-body">
			    <h5 class="card-title"><?= $news->title ?></h5>
			    <p class="card-text"><?= $news->summary ?></p>
			    <a href="<?= base_url() . "news/" . $news->id ?>" class="btn btn-primary">Read More</a>
			  </div>
			</div>
	<?php
}
?></div>
</div>