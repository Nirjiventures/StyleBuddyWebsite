<?php  $this->load->view('Page/template/header'); ?>
<?php // print_r($archives); ?>
<div class="middle_part mt-5 pt-0">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="style_story">
					<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/story.jpg" class="img-fluid">
				</div>
			</div>
		</div>
		<div class="row">
    		<div class="col-sm-12 mt-5">
    			<h2>Style Stories</h2>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-sm-9">
    			<div class="row">
    			    
    			    <?php if(!empty($datas)) { foreach($datas as $data) { ?>
    			            
		    		    <div class="col-md-12 col-lg-6 col-sm-6 ">
		    			<div class="stories_box">
		    				<div class="stories_img mb-2">
		    					<a href="<?= base_url('style-stories/').$data->blogSlug ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/story/').$data->blogImage ?>" class="img-fluid"></a>
		    					<div class="time"><?=  date('M j, Y',strtotime($data->created_at)); ?></div>
		    				</div>
		    				<!--<small><i>by <?=  ucwords($data->fname.' '.$data->lname); ?></i></small>-->
		    				<h4><a href="<?= base_url('style-stories/').$data->blogSlug ?>"><?=  $data->blogTitle; ?></a></h4>
		    				<p class="mt-2"><?=  mb_strimwidth($data->shortData,0,156, '....'); ?></p>
		    				<a href="<?= base_url('style-stories/').$data->blogSlug ?>" class="btn_r">Read More</a>
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
                                   <h3 class="h2 text-center mt-5 shadow-lg p2"><?= $this->uri->segment(3); ?> Categories related Style Stories not found</h3> 
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