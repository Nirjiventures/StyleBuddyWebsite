<?php $url1 = $this->uri->segment(1);?>

<?php $url2 = $this->uri->segment(2);?>

<?php $url3 = $this->uri->segment(3);?>
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

               <li class="breadcrumb-item active" aria-current="page">Register User Details</li>

            </ol>

         </nav>

      </div>

   </div>

</div>

<div class="container">

    <div class="row">

  		<div class="col-sm-6">

			<p style="font-weight:700; margin-top:15px;">Showing result for: <?=($start_limit + 1).'-'.$end_limit.' of '.$numRows?></p>

		</div>

		<div class="col-sm-6">

      		<a href="<?= base_url('admin/Vender/userExport/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white mb-3">Export Data</a>

      	</div>



      	



	</div>

	<div class="row">

		<?php 	if(count($referral)){ ?>

			<div class="col-sm-3">

				<form name="frm" action="">

					<label class="" for="sip_code">Filter by referral code. </label>

					<select class="form-control" onchange="frm.submit()" name="referral">

						<option value="">Select All </option>

						<?php  foreach($referral as $k=>$v){  if($v['id']==$_GET['referral']){$sel = 'selected';}else{$sel = '';}?>

							<option value="<?=$v['id']?>" <?= $sel?>> <?=$v['referral_code']?> </option>

						<?php } ?>

					</select>

				</form>

			</div>

		<?php } ?>

	</div>



	<div class="row">

		<div class="col-md-12 mt-3">

		    <div id="message" class="text-primary text-center"></div>

			<div class="table-responsive shadow-lg">

				<table class="table table-bordered text-center table-hover text-nowrap shadow-lg" id="table">



					<thead class="text-white bg-primary">



						<tr>

							<th class=''>S. No.</th>

							<th class=''>Name</th>

							<th class=''>Email</th>

							<th class=''>Mobile</th>

							<th class=''>Created at</th>

							<th class=''>Status</th>

							<!-- <th class=''>Action</th> -->					

						</tr>

					</thead>

					<tbody>

						<?php

						if(!empty($datas)) {

						 $num = 1 ; 

						foreach($datas as $data) { ?>

						<tr>

							<td class=''><?php echo $num; ?></td>						

							<td class='text-left'><?php echo ucwords($data->fname.' '.$data->lname); ?></td>

							<td class='text-left'><?php echo ucwords($data->email); ?></td>

							<td class=''><?php echo ucwords($data->mobile); ?></td>

							 

							<td>

							    <?php 

							        if($data->created_at){

							           echo date('F j, Y',strtotime($data->created_at)); 

							        }else{

							           echo  date('F j, Y',strtotime($data->updated_at));

							        }

							     ?>

							</td>
							<?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='status_checks';}?>

                            <td><button type="button" id="<?= $data->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
                                <?= ($data->status == 1)?"Activated":"De-activated"; ?>
                                </button>
                            </td>
                             

							<!-- <td> -->

						    	<!--<a href="<?php echo base_url('edit-category/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>-->

						        <!-- <a href="javascript:void(0)" id="<?= $data->id ?>" class="cremove1"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> -->

					        <!-- </td> -->

						</tr>

					   <?php $num++;  } } else {?>

					   <tr><td colspan="5">Register User Details not available.</td></tr>

					   <?php }?>

					</tbody>

				</table>

			</div>

			<div class="row">



	      	    <div class="col-sm-6">



					<p style="font-weight:700; margin-top:15px;">Showing result for: <?=($start_limit + 1).'-'.$end_limit.' of '.$numRows?></p>



				</div>



				<div class="col-sm-6">



					<div class="pagination" style="float:right">



						<?=$links;?>



					</div>



				</div>



			</div>

		</div>

	</div>

</div>



<script>

    $(document).ready(function(){

        $('#example').DataTable();    

        $(document).on('click','.status_checks',function() {

            var id = (this.id);

            var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 

            var msg = (status=='0')? 'Activate':'Deactivate';

            var newstatus = (status=='0')? '1':'0';

            if(confirm("Are you sure to "+ msg)) {

                      $.ajax({

                      type:"POST",

                      url: "<?= base_url('admin/update_registeruser_status'); ?>", 

                      data: {"status":newstatus, "id":id}, 

                      success: function(data) {

                      location.reload();

                      }         

                 });

            }

        });    

    });

    $('.cremove1').on('click', function(){

        var id = $(this).attr('id');

        if(confirm('Are you sure to remove this ?')) {

            $.ajax({

                 url: "<?= base_url('admin/vender/userDelete'); ?>", 

                type:"post",

                data:{id:id},

                success:function(result){

                    window.location.reload();

                    $('#message').html(result);

                    $('#message').delay(2500).fadeOut(1500);

                }

            });

        }

   });

</script>







