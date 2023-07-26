<?php if(!empty($categorys)) {?>
	<div class="side_bx mb-5">
		<h4>Categories</h4>
		<hr>
		<div class="c_list">
			<ul>
			 	<?php foreach($categorys as $category) { ?> 
    			 	<?php if($category->categoryCount){ ?>   
    			    	<li><a href="<?= base_url('style-stories/category/').$category->blogCategorySlug  ?>"><?= $category->blogCategoryName ?> <span>(<?= $category->categoryCount ?>)</span></a></li>
    			 	<?php }  ?>  
			 	<?php }  ?>  
			</ul>  
		</div>
	</div>
<?php }  ?> 
<?php if(!empty($tags)) {?>  
	<div class="side_bx mb-5">
		<h4>Tags</h4>
		<hr>
		<ul class="t_list">
		     <?php if(!empty($tags)) {  foreach($tags as $tag) { ?>  
			    <li><a href="<?= base_url('style-stories/tag/').$tag->tagSlug  ?>"><?= $tag->tagName ?></a></li>
			 <?php } } ?>
	    </ul>
	</div>
<?php }  ?>
<?php if(!empty($archives)) { ?>   
	<div class="side_bx">
		<h4>Archives</h4>
		<hr>
		<div class="c_list">
			<ul>
			<?php $arr = array();?>
            <?php if(!empty($archives)) { ?>
            	<?php foreach($archives as $archive) { ?>	    			    
                	<?php if(!in_array($archive->fullmonth.' '.$archive->year, $arr)) { ?>	    			    
    			        <li><a href="<?= base_url("style-stories/$archive->year/$archive->month");?>"><?= $archive->fullmonth.' '.$archive->year ?></a></li>
    			        <?php array_push($arr, $archive->fullmonth.' '.$archive->year);?>
    			  	<?php } ?>
			  	<?php } ?>
           <?php } ?>
       </ul>
		</div>
	</div>
<?php }  ?>