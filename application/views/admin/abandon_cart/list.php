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

		<?php }?>

	    <?php if($this->session->flashdata('error')){?>

          	<span class="text-center text-danger mb-2 flash_message" id="errid"> <?php echo $this->session->flashdata('error');?></span>

        <?php }?>

        

        



		<p style="font-weight:700; margin-top:15px;">Showing result for: <?=$start_limit.'-'.$end_limit.' of '.$numRows?></p>

		<table id="table" class="table table-striped table-bordered file-export" data-toggle="table" data-pagination="false" data-search="true" data-show-columns="true" data-key-events="true" data-show-toggle="true"  data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar">

			<thead>

				<tr>

					<th>S.No.</th>	

					<th>Name</th>	

					<th>Email</th>	

					<th>Mobile</th>	

					<th>Total Price</th>	

					<th>Created</th>

					<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission) || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                                <th class=''>Action</th>
                            <?php } ?> 

				</tr>

            </thead>

            <tbody>

                <?php

                if (!empty($list)) {

                    $count = 1;

                    foreach ($list as $row) { ?>

                        <tr class="even"  data-val="<?=$row->id?>">

                            <td><?=$count;?></td>

            				<td><?php echo ($row->name); ?></td>

            				<td><?php echo($row->email); ?></td>

            				<td><?php echo($row->mobile); ?></td>

            				<td><?php echo '<i class="fa fa-inr"></i> '.$row->sessionArray->display_total; ?></td>

            				<td><?php echo !empty($row->created_at) ? date("m-d-Y", strtotime($row->created_at)) : '' ?></td>

            				 <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission) || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                                <td class=''>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>
                                   <a class="btn btn-primary"  href="<?php echo base_url($url1.'/'.$url2.'/view/').$row->id;?>"><i class="fa fa-eye  fa-lg" aria-hidden="true"></i></a>
                                   <?php } ?>
                                   <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                                   <a class="btn btn-danger"  href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash  fa-lg" aria-hidden="true"></i></a>
                                <?php } ?>
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

		<div class="pagenation" style="float:right">

		    <?=$links;?>

		</div>

		<div class="clearfix"></div>

    </div>

</div>