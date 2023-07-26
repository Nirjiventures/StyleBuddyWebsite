<?php $this->load->view('admin/template/header'); ?>

<?php $url1  =$this->uri->segment(1);?>

<?php $url2  =$this->uri->segment(2);?>

<?php $url3  =$this->uri->segment(3);?>

<div class="card-content collapse show">
	<div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">

	    <?php if($this->session->flashdata('success')){?>

		    	<span class="text-center text-info mb-2 flash_message" id="susid"> <?php echo $this->session->flashdata('success');?></span>

		    	 
	    <?php }?>

	    <?php if($this->session->flashdata('error')){?>

          <span class="text-center text-danger mb-2 flash_message" id="errid"> <?php echo $this->session->flashdata('error');?></span>

          

        <?php }?>
        <div class="row">

      	    <div class="col-sm-6">

				<p style="font-weight:700; margin-top:15px;">Showing result for: <?=($start_limit + 1).'-'.$end_limit.' of '.$numRows?></p>

			</div>

			<div class="col-sm-6">

				 

	      	<a href="<?= base_url('admin/vendor/allProductsExcel/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white mb-3">Export Data</a>

	      </div>

		</div>
         
		<div class="row">
                
	    	<div class="col-sm-12">

    			<div class="table-responsive ">

    			    <table id="table" class="table table-striped table-bordered file-export" data-toggle="table" data-pagination="false" data-search="true" data-show-columns="true" data-key-events="true" data-show-toggle="true"  data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar">

    					<thead class="text-white bg-primary">

    						<tr>

        						<th class=''>S. No.</th>

        						<th class=''>Vendor Name</th>

        						<th class=''>Category</th>

        						<th class=''>Product Name</th>

        						 
        						<th class=''>Image</th>

        						<th class=''>Price</th>

        						<th class=''>Discount (%)</th>

        						<th class=''>Added On</th>

        						<th class=''>Size</th>

        						<th class=''>Status</th>

        						

        					</tr>

    					</thead>

    					<tbody>

    						<?php  if(!empty($list)) { ?>

    								<?php $num=1; ?>

    								<?php  foreach($list as $data) { ?>

    									<tr>

                    						<td class='text-primary'><?=  $num; ?></td>						

                    						<td class=''><?= ucwords($data->fname.' '.$data->lname); ?></td>

                    					    <td class=''><?= $data->category_name; ?></td>

                    					    <td class=''><p class="pc_name"><?= $data->product_name; ?></p></td>

                    					     

                    					     
<td class=''><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=40&image='.'assets/images/product/'.$data->image)?>" class="img-thumbnail border border-primary"></td>

                    					    <td class=''><i class="fa fa-inr"></i>  <?= $data->price; ?></td>

                    					    <td class=''><?= $data->discount; ?></td>

                    					    <td class=''><?= date('j F, Y',strtotime($data->created_at)); ?></td>

                    					    <td class=''>

                    					        <?php $values = ""; $arrayVal = explode(',',$data->size); foreach ($sizes as $size) {  ?>

                    					        <?php if( in_array($size->id , $arrayVal)) {  $values .= ", $size->size_name"; } ?>

                    					        <?php } ?>

                    					        <?= substr($values,1); ?>

                    					    </td>

                    					     <td><button type="button" id="<?= $data->id; ?>" class="status_checks btn btn-sm mt-1 <?= ($data->admin_status == 1)?"btn-primary":"btn-danger"; ?> ">

                    						    <?= ($data->admin_status == 1)?"Activate":"Deactivate"; ?>

                    						    </button>

                    						</td>

                    					    

                    					    

                    						

                    					</tr>

    							   	<?php $num++; ?>

    						   	<?php } ?>

    							<?php } else { ?>

    						   	<tr><td colspan="4" class="text-center">Result Not Available</td></tr>

    						<?php } ?>

    					</tbody>

    				</table>
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
	</div>
</div>

<?php $this->load->view('admin/template/footer'); ?>


