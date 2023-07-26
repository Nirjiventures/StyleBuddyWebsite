<?php $this->load->view('Page/template/header'); ?>
<div class="middle_part mt-5 pt-0">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
				    <li class="breadcrumb-item"><a href="<?= base_url('style-stories') ?>">Style Stories</a></li>
				    <li class="breadcrumb-item active" aria-current="page"><?= $datas->blogTitle ?></li>
				  </ol>
				</nav>
			</div>
		</div>
    	<div class="row">
    		<div class="col-sm-9">
    			<div class="row">
		    		<div class="col-sm-12">
		    			<div class="stories_box st_detail">
		    				<div class=" mb-2">
		    					<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/story/').$datas->blogImage ?>" class="img-fluid">
		    					<div class="time"><?= date('F j, Y',strtotime($datas->created_at)) ?></div>
		    				</div>
		    				<!--<small><i>by <?= ucfirst($datas->fname.' '.$datas->lname) ?></i></small>-->
		    				<h2><?= $datas->blogTitle ?></h2>
		    				    <?= $datas->longData ?>
		    			</div>

		    			<div class="stories_box st_detail">
		    				<!--<div class="d-flex  p-3">
							    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="John Doe"
							         class="flex-shrink-0 me-3 mt-3 rounded-circle" style="width:60px;height:60px;">
							    <div>
							        <h4 class="mb-1">John Doe</h4>
							        <p class="mb-1"><small>Posted on February 19, 2016</small></p>
							        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
							            dolore magna aliqua.</p>
							    </div>
							</div>
							<div class="d-flex  p-3">
							    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="John Doe"
							         class="flex-shrink-0 me-3 mt-3 rounded-circle" style="width:60px;height:60px;">
							    <div>
							        <h4 class="mb-1">John Doe</h4>
							        <p class="mb-1"><small>Posted on February 19, 2016</small></p>
							        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
							            dolore magna aliqua.</p>
							    </div>
							</div>-->

							<div class="p-3">
								<h4>Leave Your Comments</h4>
								<br>
								<?=$this->session->flashdata('success');?>
									<br>
								<?= form_open_multipart('',['id'=>'comment_form','name'=>'comment_form']) ?>
									<input type="hidden" id="blog_id" name="blog_id" value="<?= $datas->id ?>">
									<div class="form-group">
										<input type="text" id="comment_name" name="comment_name" value="<?=$loggedRow['fname']?> <?=$loggedRow['lname']?>" class="form-control" placeholder="Your Name">
										<div id="comment_name_err"></div>
									</div>
									<div class="form-group">
										<input type="text" id="email" name="email" class="form-control" value="<?=$loggedRow['email']?>" placeholder="Your Email">
										<div id="email_err"></div>
									</div>
									<div class="form-group">
										<textarea id="comment_message" name="comment_message" class="form-control" rows="5">Enter Message</textarea>
										<div id="comment_message_err"></div>
									</div>
									<input type="submit" value="SUBMIT" id="comment_on_story" class="btn_msg">
								<?= form_close() ?>
							</div>
		    			</div>
		    		</div>
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
<script type="text/javascript">
	$('#comment_form').on('submit',function(e){
        e.preventDefault();
        $('#comment_name_err').html('');
        $('#comment_message_err').html('');
        $('#email_err').html('');

        
        if($('#comment_name').val() == '' || $('#comment_name').val().trim().length == '') {
            $('#comment_name_err').html('<span class="text-red">Please enter Name</span>');
            $('#comment_name').focus();
            return false;
        } else if($('#email').val() == '') {
            $('#email_err').html('<span class="text-red">Please enter email</span>');
            $('#email').focus();
            return false; 
        } else if(!IsEmail($('#email').val())) {
            $('#email_err').html('<span class="text-red">Please enter correct email</span>');
            $('#email').focus();
            return false; 
        } else if($('#comment_message').val() == '' || $('#comment_message').val().trim().length == '') {
            $('#comment_message_err').html('<span class="text-red">Please enter Message</span>');
            $('#comment_message').focus();
            return false;
        }else{
			$('#comment_form').get(0).submit();
			return true;
		}
    });
    $('.onlyInteger').on('keypress', function(e) {
      keys = ['0','1','2','3','4','5','6','7','8','9','.']
      return keys.indexOf(event.key) > -1
    })
    function validateAlphabet(value) {         
        var regexp = /^[a-zA-Z ]*$/;         
        return regexp.test(value);    
    }
	function checkWord(id,count){
		var words= $('#'+id).val().length;
    	if (words > count) {
    		$('#'+id+'_err').html('');
    	}else{
    		$('#'+id+'_err').html('<span class="text-red">' + (words + 1) + ' character. Please enter minimum '+count + ' character.</span>');
    		 
    	}
    	
    }
	function IsEmail(email) {     
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       
        return regex.test(email);   
    }
</script>