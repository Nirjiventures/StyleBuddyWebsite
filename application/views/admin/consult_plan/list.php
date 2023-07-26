<?php $this->load->view('admin/template/header'); ?>

<?php $url1  =$this->uri->segment(1);?>

<?php $url2  =$this->uri->segment(2);?>

<?php $url3  =$this->uri->segment(3);?>
<?php 
     $rrr = getUserPermission();
     //echo $this->db->last_query();
     $permission = unserialize($rrr['permission']);
     //var_dump($permission);
?>
<div class="container">

	<div class="row">

		<div class="col-md-12 mt-2">
            <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/add',$permission)){ ?>
                <a href="<?php echo base_url($url1."/".$url2.'/add');?>" class="btn btn-primary float-right mb-3"><i class="fa fa-bars" aria-hidden="true"></i> Add</a>
            <?php } ?>
			 

		    <div class="table-responsive ">

			    <?php if($this->session->flashdata('success')){?>

    			    	<span class="text-center text-info mb-2 flash_message" id="susid"> <?php echo $this->session->flashdata('success');?></span>

    			    	<script>

                        /*var timeout = 3000; // in miliseconds (3*1000)

                        $('.flash_message').delay(timeout).fadeOut(300);*/

                  </script>

			    <?php }?>

			    <?php if($this->session->flashdata('error')){?>

                  <span class="text-center text-danger mb-2 flash_message" id="errid"> <?php echo $this->session->flashdata('error');?></span>

                  <script>

                        /*var timeout = 3000; // in miliseconds (3*1000)

                        $('.flash_message').delay(timeout).fadeOut(300);*/

                  </script>

                <?php }?>

				<table class="table table-bordered text-center table-hover shadow-lg" id="example">

					<thead class="text-white bg-primary">

						<tr>

							<th class=''>Sr No.</th>

							<th class=''>Package Name</th>

                            <th class=''>Package Price</th>

                            <th class=''>Valid days</th>

                            <th class=''>Total Job</th>

                            <th class=''>UI order</th>

							<th class=''>Status</th>

                             					
                            <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission) || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                                <th class=''>Action</th>
                            <?php }?>
						</tr>

					</thead>

					<tbody>

						<?php  if(!empty($list)) { ?>

								<?php $num=1; ?>

								<?php  foreach($list as $row) { ?>

									 

									<tr style="<?=$style;?>">

										<td class='text-primary'><?php echo $num; ?></td>						

										<td class=''><?php echo ucwords($row->package_name); ?></td>

                                        <td class=''><?php echo ucwords($row->package_price); ?></td>

                                        <td class=''><?php echo ucwords($row->valid_days); ?></td>

                                        <td class=''><?php echo ucwords($row->total_job); ?></td>

                                        <td>
                                            <input style="width:40px;padding:4px" type="text" name="ui_order" id="ui_order<?= $row->id?>" value="<?php echo $row->ui_order; ?>">
                                            <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>
                                                <a onclick="update_ui_order('ui_order<?= $row->id?>',<?= $row->id?>,'<?= $url2?>')" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
                                            <?php }?>
                                        </td>
                                        <?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='status_checks';}?>
                                        <td><button type="button" id="<?= $row->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($row->status == 1)?"btn-primary":"btn-danger"; ?> ">
                                             <?= ($row->status == 1)?"Activated":"De-activated"; ?>
                                             </button>
                                        </td>
                                        <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission) || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                                            <td>
                                                <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>
                                                    <a  class="btn btn-primary"  href="<?php echo base_url($url1.'/'.$url2.'/edit/').$row->id;?>"><i class="fa fa-pencil-square-o text-warning1 fa-lg" aria-hidden="true"></i></a>
                                               <?php }?>
                                               <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                                                    <a class="btn btn-danger" href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash text-danger1 fa-lg" aria-hidden="true"></i></a> 
                                               <?php }?>
                                            </td>
                                        <?php }?>
 

									</tr>

							   	<?php $num++; ?>

						   	<?php } ?>

							<?php } else { ?>

						   	<tr><td colspan="8" class="text-center">Not Available</td></tr>

						<?php } ?>

					</tbody>

				</table>

			</div>

		</div>

	</div>

</div>

<script>

    $(document).ready(function(){

        $('#example').DataTable();

    });



    $(document).on('click','.status_checks',function() {

        var id = (this.id);

        var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 

        var msg = (status=='0')? 'Activate':'Deactivate';

        var newstatus = (status=='0')? '1':'0';



        console.log(newstatus);

        console.log(id);

        if(confirm("Are you sure to "+ msg)) {

            $.ajax({

                type:"POST",

                url: "<?= base_url('admin/'.$url2.'/changeStatus'); ?>", 

                data: {"status":newstatus, "id":id}, 

                success: function(data) {

                    console.log(data);

                    location.reload();

                }         

            });

         }

    }); 



    function update_ui_order(key,id,type){
        var ui_order = $('#'+key).val();
        $.ajax({

            type: 'post',

            url : '<?= base_url('admin/'.$url2); ?>/update_ui_order/'+ui_order+'/'+id,

            success:function(data){ 

                console.log('<?= base_url('admin/'.$url2); ?>/update_ui_order/'+ui_order+'/'+id);

                console.log(data);

                if(data>0){

                    alert('Status changed successfully');

                    window.location.reload();

                }

            }   

        });
    }



    

</script>

<?php $this->load->view('admin/template/footer'); ?>