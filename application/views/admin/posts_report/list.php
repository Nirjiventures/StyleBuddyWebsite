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
					<th>User</th>	
					<th>Post Name</th>	
					<th>Message</th>	
					<th>Report type</th>	
					<th>Created</th>
					<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".'posts/edit',$permission)){ ?>
                        <th>Block User</th>
                        <th>Block Post</th>
					<?php } ?>
					<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".'posts/delete',$permission)){ ?>
				        <th class=''>Delete Posts</th>
					<?php } ?>	
					 
					<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                        <th class=''>Delete Comment</th>
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

            				<td><?php echo !empty($row->user->fname) ? $row->user->fname : 'N/A' ?></td>
            				<td><?php echo !empty($row->post->title) ? '<a target="_blank" href="'.base_url('admin/posts/view/'.$row->post->id).'">'.$row->post->title : 'N/A' ?></a></td>
            				<td><?php echo !empty($row->message) ? $row->message : 'N/A' ?></td>

            				<td><?php echo !empty($row->report_type) ? $row->report_type : 'N/A' ?></td>

            				<td><?php echo !empty($row->created_at) ? date("m-d-Y h:i:s A", strtotime($row->created_at)) : '' ?></td>
                            <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".'posts/edit',$permission)){ ?>
                                <td><button type="button" id="<?= $row->post_user->id; ?>" class="status_checks_user btn btn-sm mt-1 <?= ($row->post_user->status == 1)?"btn-primary":"btn-danger"; ?> ">
                                       <?= ($row->post_user->status == 1)?"Publish":"Blocked"; ?>
                                       </button>
                                </td>
                            <?php }?>
                            <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".'posts/edit',$permission)){ ?>
                                <td><button type="button" id="<?= $row->post->id; ?>" class="status_checks btn btn-sm mt-1 <?= ($row->post->status == 1)?"btn-primary":"btn-danger"; ?> ">
                                       <?= ($row->post->status == 1)?"Publish":"Blocked"; ?>
                                       </button>
                                </td>
                            <?php }?>
            				<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".'posts/delete',$permission)){ ?>
								<td style="width: 100px;!important">
									<a href="<?php echo base_url($url1.'/'.$url2.'/post_delete/').$row->post_id;?>" class="btn btn-danger" data-record-id="<?php echo $row->post_id ?>"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> </a>
								</td>
							<?php } ?>
            				 <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
								<td style="width: 100px;!important">
									<a href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>" class="btn btn-danger" data-record-id="<?php echo $row->id ?>"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> </a>
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
<script>
    $(document).on('click','.status_checks_user',function() {

        var id = (this.id);

        var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 

        var msg = (status=='0')? 'Unblocked':'Blocked';

        var newstatus = (status=='0')? '1':'0';



        console.log(newstatus);

        console.log(id);

        if(confirm("Are you sure to "+ msg)) {

            $.ajax({

                type:"POST",

                url: "<?= base_url('admin/posts_report/changeStatusUser'); ?>", 

                data: {"status":newstatus, "id":id}, 

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

        var msg = (status=='0')? 'Unblocked':'Blocked';

        var newstatus = (status=='0')? '1':'0';



        console.log(newstatus);

        console.log(id);

        if(confirm("Are you sure to "+ msg)) {

            $.ajax({

                type:"POST",

                url: "<?= base_url('admin/posts_report/changeStatusPost'); ?>", 

                data: {"status":newstatus, "id":id}, 

                success: function(data) {

                    console.log(data);

                    location.reload();

                }         

            });

         }

    }); 

</script>