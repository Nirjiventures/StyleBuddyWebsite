<?php $url1  =$this->uri->segment(1);?>

<?php $url2  =$this->uri->segment(2);?>

<?php $url3  =$this->uri->segment(3);?>

<?php 
     $rrr = getUserPermission();
     //echo $this->db->last_query();
     $permission = unserialize($rrr['permission']);
     //var_dump($permission);
?>

<div class="card-content collapse show">

	<div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">

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

        

		<p style="font-weight:700; margin-top:15px;">Showing result for: <?=$start_limit.'-'.$end_limit.' of '.$numRows?></p>

		<table id="table" class="table table-striped table-bordered file-export" data-toggle="table" data-pagination="false" data-search="true" data-show-columns="true" data-key-events="true" data-show-toggle="true"  data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar">

			<thead>

				<tr>

					<th  data-field="state"  data-checkbox="true"></th>

                    <th>S.No.</th>	

					<th>Message From</th>	

					<th>Message To</th>	

					<th>Created</th>
					<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                        <th class=''>Action</th>
                   	<?php } ?>	
					 

				</tr>

            </thead>

            <tbody>

                <?php

                if (!empty($list)) {

                    $count = 1;

                    foreach ($list as $row) {

                        

                        ?>

                        <tr class="even"  data-val="<?=$row->id?>">

                            <td></td>

                            <td><?=$count;?></td>

            				<td><?php echo !empty($row->message) ? $row->message : 'N/A' ?></td>

            				<td><?php echo !empty($row->message_to) ? $row->message_to : 'N/A' ?></td>

            				<td><?php echo !empty($row->created_at) ? date("m-d-Y", strtotime($row->created_at)) : '' ?></td>

                             
            				<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
								<td style="width: 100px;!important">

									<a href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>" class="btn btn-danger" data-record-id="<?php echo $row->id ?>"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>

								</td>
							<?php } ?>
            				 

						</tr>

                        <?php $count++;

                    }

                }

                ?>

            </tbody>

        </table>

        <p style="font-weight:700; margin-top:15px;">Showing result for: <?=$start_limit.'-'.$end_limit.' of '.$numRows?></p>

		<div class="pagination" style="float:right">

		    <?=$links;?>

		</div>

		<div class="clearfix"></div>

    </div>

</div>