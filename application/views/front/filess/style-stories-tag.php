<?php  $this->load->view('Page/template/header'); ?>
<?php // print_r($archives); ?>
<style type="text/css">
	.blog-list .stories_img img {
	    height: 200px;
	    object-fit: cover;
	    transition: all 0.2s;
	    overflow: hidden;
	    width: 100%;
	}
	.blog-list .stories_box h4 {
	    height: auto;
	}
	.blog-list .stories_box h4 a {
	    /* font-size: 18px; */
	    text-transform: capitalize;
	    color: var(--black);
	    margin-top: 15px;
	    font-size: 22px;
	}
	.blog-list .stories_box p{
		color: #000;
	}
	.blog-list .stories_box{
		background: #fff;
		box-shadow: 0 2px 20px rgb(0 0 0 / 20%);
		border: 2px solid #ffffff;
	    transition: ease-out 0.5s;
	    -webkit-transition: ease-out 0.5s;
	    -moz-transition: ease-out 0.5s;
	}
	.blog-list .stories_box::after,
	.blog-list .stories_box::before {
	    position: absolute;
	    content: "";
	    width: 0%;
	    height: 0%;
	    visibility: hidden;
	    z-index: 0;
	}

	.blog-list .stories_box::after {
	    bottom: -2px;
	    right: -2px;
	    border-left: 2px solid #f62ac1;
	    border-bottom: 2px solid #f62ac1;
	    transition: width .1s ease .1s, height .1s ease, visibility 0s .2s;
	}

	.blog-list .stories_box::before {
	    top: -2px;
	    left: -2px;
	    border-top: 2px solid #f62ac1;
	    border-right: 2px solid #f62ac1;
	    transition: width .1s ease .3s, height .1s ease .2s, visibility 0s .4s;
	}

	.blog-list .stories_box:hover {
	    animation: pulse 1s ease-out .4s;
	    color: #222222;
	}

	.blog-list .stories_box:hover::after,
	.blog-list .stories_box:hover::before {
	    width: calc(100% + 4px);
	    height: calc(100% + 3px);
	    visibility: visible;
	    transition: width .1s ease .2s, height .1s ease .3s, visibility 0s .2s;
	}

	.blog-list .stories_box:hover::after {
	    transition: width .1s ease .2s, height .1s ease .3s, visibility 0s .2s;
	}

	.blog-list .stories_box:hover::before {
	    transition: width .1s ease, height .1s ease .1s;
	}
	.blog-list .stories_box:hover{
		margin-top: 30px;
	}
	.stories_box a.btn_r, .blog-list .stories_box h4 a, .stories_img a{
		position: relative;
		z-index: 9;
	}
	.side_bx{
		background: #fff;
		box-shadow:0 2px 20px rgb(0 0 0 / 20%);
		padding: 15px;
		border-bottom: 1px dotted #ccc;
	}
	.side_bx a{
		border-bottom: 1px dotted #ccc;
		padding-bottom: 6px;
	}
	.side_bx a:last-child{
		border-bottom: none;
		padding-bottom: 0px;
	}
	.stories_box a.btn_r {
    	color: #fff;
	    font-weight: normal;
	    background: #742ea0;
	}
	.stories_box a.btn_r:hover{
		color: #fff;
	    font-weight: normal;
	    background: #742ea0;
	}
	.side_bx .c_list a{
		color: #000;
		font-size: 14px;
	}
	.side_bx h4 {
	    font-size: 20px!important;
	}
	.side_bx .t_list li a{
		background: #fff;
		color: #000;
		border: 1px solid #000;
		border-radius: 28px;
		font-size: 12px;
	}
	.c_list{
		margin-top: 15px;
		padding-bottom: 0px;
	}
	.side_bx .t_list{
		margin-top: 15px;
	}
	.side_bx h4:after {
	    content: '';
	    position: absolute;
	    width: 19px;
	    height: 2px;
	    background: var(--black);
	    right: -28px;
	    top: 12px;
	}
	.bg-list h2{
		text-transform: uppercase;
		margin-top: 10px;
	}
</style>

<div class="middle_part mt-5 pt-0">
	<div class="container">
		<!-- <div class="row">
			<div class="col-sm-12">
				<div class="style_story">
					<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/story.jpg" class="img-fluid">
				</div>
			</div>
		</div> -->
		<div class="row">
    		<div class="col-sm-12 bg-list text-center">
    			<h2>Style Stories</h2>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-sm-9">
    			<div class="row blog-list">
    			    
    			    <?php if(!empty($datas)) { foreach($datas as $data) { ?>
    			            
		    		    <div class="col-sm-12">
			    			<div class="stories_box">
			    				<div class="row">
			    		    		<div class="col-sm-3">
			    		    			<div class="stories_img mb-2">
					    					<a href="<?= base_url('style-stories/').$data->blogSlug ?>">
					    						<?php  if (file_exists($image_path = FCPATH . 'assets/images/story/' . $data->blogImage)) { ?>
												    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/story/'.$data->blogImage) ?>"  class="img-fluid">
												<?php  } else { ?>
												    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/stylist/no-image.jpg') ?>"  class="img-fluid">
												<?php  } ?>
												
					    						<!-- <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/story/').$data->blogImage ?>" class="img-fluid"> -->
					    					</a>
					    					<div class="time"><?=  date('M j, Y',strtotime($data->created_at)); ?></div>
					    				</div>
			    		    		</div>
			    		    		<div class="col-sm-9">
			    		    			<!--<small><i>by <?=  ucwords($data->fname.' '.$data->lname); ?></i></small>-->
					    				<h4><a href="<?= base_url('style-stories/').$data->blogSlug ?>"><?=  $data->blogTitle; ?></a></h4>
					    				<p class="mt-2"><?=  mb_strimwidth($data->shortData,0,156, '....'); ?></p>
					    				<a href="<?= base_url('style-stories/').$data->blogSlug ?>" class="btn_r">Read More</a>
			    		    		</div>
			    		    	</div>
			    			</div>
		    		</div>
		    		<?php }  ?>
		    <!--		<div class="col-sm-12 mt-5 paginate">-->
		    <!--			<nav aria-label="Page navigation example">-->
						<!--  <ul class="pagination justify-content-center">-->
						<!--    <li class="page-item">-->
						<!--      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Pre</a>-->
						<!--    </li>-->
						<!--    <li class="page-item active"><a class="page-link" href="#">1</a></li>-->
						<!--    <li class="page-item"><a class="page-link" href="#">2</a></li>-->
						<!--    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
						<!--    <li class="page-item">-->
						<!--      <a class="page-link" href="#">Next</a>-->
						<!--    </li>-->
						<!--  </ul>-->
						<!--</nav>-->
		    <!--		</div>-->
                    <?php }  else { ?>
                       <div class="col-sm-9">
                                   <h3 class="h2 text-center mt-5 shadow-lg p2"><?= $this->uri->segment(3); ?> Tag related Style Stories not found</h3> 
                        </div>
                    <?php } ?>
		    		
	    		</div>
	    	</div>

    			<div class="col-sm-3 mt-4">
    			<div class="side_bx mb-5">
	    			<h4>Categories</h4>
	    			<hr>
	    			<div class="c_list">
	    			 <?php if(!empty($categorys)) {  foreach($categorys as $category) { ?>    
	    			    <a href="<?= base_url('style-stories/category/').$category->blogCategorySlug  ?>"><?= $category->blogCategoryName ?> <span>(<?= $category->categoryCount ?>)</span></a>
	    			 <?php } } ?>    
	    		  </div>
    			</div>
    			<div class="side_bx mb-5">
	    			<h4>Tags</h4>
	    			<hr>
	    			<ul class="t_list">
	    			     <?php if(!empty($tags)) {  foreach($tags as $tag) { ?>  
	    				    <li><a href="<?= base_url('style-stories/tag/').$tag->tagSlug  ?>"><?= $tag->tagName ?></a></li>
	    				 <?php } } ?>
	    		    </ul>
    			</div>

    			<div class="side_bx">
	    			<h4>Archives</h4>
	    			<hr>
	    			<div class="c_list">
                        <?php $arr = array();?>
                        <?php if(!empty($archives)) { ?>
                        	<?php foreach($archives as $archive) { ?>	    			    
	                        	<?php if(!in_array($archive->fullmonth.' '.$archive->year, $arr)) { ?>	    			    
			    			        <a href="<?= base_url("style-stories/$archive->year/$archive->month");?>"><?= $archive->fullmonth.' '.$archive->year ?></a>
			    			        <?php array_push($arr, $archive->fullmonth.' '.$archive->year);?>
			    			  	<?php } ?>
		    			  	<?php } ?>
                       <?php } ?>
	    			</div>
    			</div>
    		</div>
    		
    	</div>
    </div>
</div>


<?php $this->load->view('Page/template/footer'); ?>