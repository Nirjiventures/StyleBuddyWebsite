<?php
	$url1 = $this->uri->segment(1);
	$url2 = $this->uri->segment(2);
	$url3 = $this->uri->segment(3);
?>
<?php 
     $rrr = getUserPermission();
     //echo $this->db->last_query();
     $permission = unserialize($rrr['permission']);
     //var_dump($permission);
?>
<div class="container-fluid p-0">



   <div class="row">



      <div class="col-md-12">



         <nav aria-label="breadcrumb">



            <ol class="breadcrumb pl-3 mr-3 ">



               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>



               <li class="breadcrumb-item active" aria-current="page">Category Details</li>



            </ol>



         </nav>



      </div>



   </div>



</div>



<div class="container">



	<div class="row">



		<div class="col-md-12 mt-3">



		   <div id="message" class="text-primary text-center"></div>


		   <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/add',$permission)){ ?>
         	<a href="<?php echo base_url('admin/add-category') ;?>" class="btn btn-primary float-right "><i class="fa fa-plus" aria-hidden="true"></i> Add New Category </a>
			<?php } ?>
			

				<div class="row">

					<?php 	if(count($parent_category)){ ?>

						<div class="col-sm-3">

							<form name="frm" action="<?=base_url('admin/category')?>">

							<label class="" for="sip_code">Main Category</label>

							<select class="form-control" onchange="frm.submit()" name="category">

								<option value="">Select All </option>

								<?php  foreach($parent_category as $k=>$v){  if($v['id']==$_GET['category']){$sel = 'selected';}else{$sel = '';}?>

										<option value="<?=$v['id']?>" <?= $sel?>> <?=$v['name']?> </option>

										<?php foreach($v['child'] as $v1){ ?><?php if($v1['id']==$_GET['category']){$sel = 'selected';}else{$sel = '';}?>

											<option value="<?=$v1['id']?>" <?= $sel?>>- <?=$v1['name']?> </option>

											<?php foreach($v1['child'] as $v2){ ?><?php if($v2['id']==$_GET['category']){$sel = 'selected';}else{$sel = '';}?>

												<option value="<?=$v2['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;-- <?=$v2['name']?> </option>

												<?php foreach($v2['child'] as $v3){ ?><?php if($v3['id']==$_GET['category']){$sel = 'selected';}else{$sel = '';}?>

													<option value="<?=$v3['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- <?=$v3['name']?> </option>

													<?php foreach($v3['child'] as $v4){ ?><?php if($v4['id']==$_GET['category']){$sel = 'selected';}else{$sel = '';}?>

														<option value="<?=$v4['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- <?=$v4['name']?> </option>

													<?php } ?>

												<?php } ?>

											<?php } ?>

										<?php } ?>

								<?php } ?>

							</select>

							</form>

						</div>

					<?php } ?>

					<?php 	if(count($parent_sub_category)){ ?>

						<div class="col-sm-3">

							<form name="frm1" action="<?=base_url('admin/category')?>">

							<input type="hidden" name="category" value="<?=$_GET['category']?>">

							<label class="" for="sip_code">Sub Category</label>

							<select class="form-control" onchange="frm1.submit()" name="sub_category">

								<option value="">Select All </option>

								<?php  foreach($parent_sub_category as $k=>$v){  if($v['id']==$_GET['sub_category']){$sel = 'selected';}else{$sel = '';}?>

										<option value="<?=$v['id']?>" <?= $sel?>> <?=$v['name']?> </option>

										<?php foreach($v['child'] as $v1){ ?><?php if($v1['id']==$_GET['sub_category']){$sel = 'selected';}else{$sel = '';}?>

											<option value="<?=$v1['id']?>" <?= $sel?>>- <?=$v1['name']?> </option>

											<?php foreach($v1['child'] as $v2){ ?><?php if($v2['id']==$_GET['sub_category']){$sel = 'selected';}else{$sel = '';}?>

												<option value="<?=$v2['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;-- <?=$v2['name']?> </option>

												<?php foreach($v2['child'] as $v3){ ?><?php if($v3['id']==$_GET['sub_category']){$sel = 'selected';}else{$sel = '';}?>

													<option value="<?=$v3['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- <?=$v3['name']?> </option>

													<?php foreach($v3['child'] as $v4){ ?><?php if($v4['id']==$_GET['sub_category']){$sel = 'selected';}else{$sel = '';}?>

														<option value="<?=$v4['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- <?=$v4['name']?> </option>

													<?php } ?>

												<?php } ?>

											<?php } ?>

										<?php } ?>

								<?php } ?>

							</select>

							</form>

						</div>

					<?php } ?>

				</div>

			

			<div class="table-responsive ">



			    <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>



                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		



                



			<table class="table table-bordered text-center table-hover shadow-lg">



				<thead class="bg-primary text-white">



					<tr>



						<th class=''>Sl No.</th>



						<th class=''>Category</th>



						<th class=''>Image</th>







						<th class=''>Status</th>



						<th class=''>Featured</th>


						<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/sliderDelete',$permission) || in_array($url1."/".$url2.'/edit',$permission)){ ?>
                       <th class=''>Action</th>
                   <?php } ?>
						 


					</tr>



				</thead>



				<tbody>



					<?php



					if(!empty($datas)) {



					 $num = 1 ; 



					foreach($datas as $data) { ?>



					<tr>



						<td class='text-primary'><?php echo $num; ?></td>						



						<td class=''><?php echo ucwords($data->name); ?></td>



						<td class=''>



							<?php if ($data->cat_image ): ?>



								<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url().''.$data->cat_image;?> " style="width:60px; height:60px;" clas="img-thumbnail"> 



							<?php endif ?>



						</td>


						<?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='status_checks';}?>
                  <td><button type="button" id="<?= $data->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
                          <?= ($data->status == 1)?"Activated":"De-activated"; ?>
                          </button>
                  </td>
						 


                  <?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='display_status';}?>
						<td>
					       <button type="button" id="<?= $data->id; ?>" class="<?=$cls?> btn btn-sm  <?= ($data->featured == 1)?"btn-primary":"btn-danger"; ?> ">
						   <?= ($data->featured == 1)?"Featured":"UnFeatured"; ?>
						   </button>
						</td>
						 

						<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/sliderDelete',$permission) || in_array($url1."/".$url2.'/edit',$permission)){ ?>
							<td class=''>

								<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>

						   		<a class="btn btn-primary" href="<?php echo base_url('admin/edit-category/').$data->id;?>"><i class="fa fa-pencil-square-o  fa-lg" aria-hidden="true"></i></a>
						   	<?php } ?>

						   	<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>
						   		<a class="btn btn-danger" href="<?php echo base_url('admin/delete-category/').$data->id;?>"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a> 

						   	<?php } ?>

							</td>
						<?php } ?>


					</tr>



				   <?php $num++;  } } else {?>



				   <tr><td colspan="5">Category data not available.</td></tr>



				   <?php }?>



				</tbody>



			</table>



			</div>



		</div>



	</div>



</div>



<script>



    $(document).ready(function(){



        


    	$(document).on('click','.display_status',function() {
    
            var id = (this.id);
    
            var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 
    
            var msg = (status=='0')? 'Featured':'UnFeatured';
    
            var newstatus = (status=='0')? '1':'0';
    
             if(confirm("Are you sure to "+ msg)) {
    
                      $.ajax({
    
                      type:"POST",
    
                      url: "<?= base_url('admin/Dashboard/changeFeaturedStatus'); ?>", 
    
                      data: {"display_status":newstatus, "id":id}, 
    
                      success: function(data) {
    							console.log(data);
                      location.reload();
    
                      }         
    
                 });
    
             }
    
        });  
        
    $(document).on('click','.status_checks',function() {



        var id = (this.id);



        var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 



        var msg = (status=='0')? 'Activate':'Deactivate';



        var newstatus = (status=='0')? '1':'0';



         if(confirm("Are you sure to "+ msg)) {



                  $.ajax({



                  type:"POST",



                  url: "<?= base_url('update_category_status'); ?>", 



                  data: {"status":newstatus, "id":id}, 



                  success: function(data) {



                  location.reload();



                  }         



             });



         }



      });    



    });







    function changeFeaturedStatus(id,controller){



		var base_url = "<?php echo base_url(); ?>";	



		var ckbox = $('#chk-status-featured-'+id); 



		var r = confirm("Are you sure to change status!");



		if (r == true) {



			if (ckbox.is(':checked')) {



				$.ajax({



					type: 'GET',



					url : base_url+'admin/Dashboard/changeFeaturedStatus/'+id+'/1',



					success:function(data){



						console.log(data);



						if(data==1){



							alert('Status changed successfully');



							window.location.reload();



						}



					}	



				});



				



			} else {



				$.ajax({



					type: 'GET',



					url : base_url+'admin/Dashboard/changeFeaturedStatus/'+id+'/0',



					success:function(data){ 



						console.log(data);



						if(data==0){ 



							alert('Status changed successfully');



							window.location.reload();



						}



					}	



				});						



			}



		}else{



			window.location.reload();



		}



	}







	$('#featuredAll').on('click', function(e) {



		var controller = 'Dashboard';



		var tableControl= document.getElementById('table');



		var arrayOfValues = [];



		$('tr.selected', tableControl).each(function() {



				arrayOfValues.push($(this).attr('data-val'));



				console.log( $(this).attr('data-val'));



		});



		var base_url = "<?php echo base_url(); ?>";	



		var controller = $('#controllerName').val(); 



		var r = confirm("Are you sure to change status of selected rows!");



		if (r == true) {



			$.ajax({



				type: 'post',



				url : base_url+'admin/'+controller+'/changeFeaturedStatusAll/',



				data:{ids:arrayOfValues,type:1,'<?php echo $this->security->get_csrf_token_name(); ?>': csrf},



				success:function(data){ 



					console.log(arrayOfValues);



					console.log(data);



					if(data==1){



						alert('Featured status changed successfully');



						window.location.reload();



					}



				}	



			});



		}else{



			



		}



	});



   $('#unFeaturedAll').on('click', function(e) {



		var controller = 'Dashboard';



		var tableControl= document.getElementById('table');



		var arrayOfValues = [];



		$('tr.selected', tableControl).each(function() {



				arrayOfValues.push($(this).attr('data-val'));



				console.log( $(this).attr('data-val'));



		});



		var base_url = "<?php echo base_url(); ?>";	



		var controller = $('#controllerName').val(); 



		var r = confirm("Are you sure to change status of selected rows!");



		if (r == true) {



			$.ajax({



				type: 'post',



				url : base_url+'admin/'+controller+'/changeFeaturedStatusAll/',



				data:{ids:arrayOfValues,type:0,'<?php echo $this->security->get_csrf_token_name(); ?>': csrf},



				success:function(data){ 



					console.log(arrayOfValues);



					console.log(data);



					if(data==0){



						alert('Featured status changed successfully');



						window.location.reload();



					}



				}	



			});



		}else{



			



		}



	});







</script>



