<?php $this->load->view('front/template/header'); ?>
<?php 



    $url1 = $this->uri->segment(1);



    $url2 = $this->uri->segment(2);



    $url3 = $this->uri->segment(3);



?>



<div class="container-fluid p-0">
    <div class="row m-0 justify-content-end">
        <div class="col-sm-3 p-0 black_bg">
            <div class="sidebar">
                <?php $this->load->view('front/user/siderbar'); ?>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="rightbar1">
                <h2>My Styling Reports</h2>
                <hr />
                <div class="table-responsive">		
                                
        			<table class="table table-bordered text-center table-hover shadow-lg text-nowrap" id="example">
    					<thead>
    						<tr>
    							<th>No</th>
    							<th>Name</th>
                                <th>Service Name</th>
    							<th>Attachment</th>
    							<!-- <th>Total  Amount</th> -->
    							<th>Date</th>
                                <!-- <th class="action">Details</th> -->
    						</tr>
    					</thead>
        				<tbody>
            				 <?php  $num = 1; if(!empty($list)) { foreach($list as $value) { 
            				        $date = strtotime($value->created_at); $fdate = date('d M, Y',$date);
            				 ?>
    						<tr>
    						    <td><?= $num ?></td>
    						    <td><?= ucfirst($value->user_row->fname.' '.$value->user_row->lname);  ?></td>
                                <td><?= ucfirst($value->order_detail->productName);  ?></td>
    							<td>
                                    <?php if (!empty($value->image)) { ?>
                                        <?php  $img = image_exist($value->image,'assets/images/package_report/'); ?>
                                        <a target="_blank" href="<?= base_url($img) ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('assets/images/pdf_24x24.png')?>" />Attachment</a>
                                    <?php } ?>
                                </td>
    							<!-- <td> <span style="text-decoration-line: line-through;">&#8377; <?= number_format($value->order_detail->totalMrpPrice) ?></span> &#8377; <?= number_format($value->order_detail->totalPrice) ?></td> -->
    							<td><?= $fdate ?></td>
                                
                                <!-- <td><a href="<?= base_url($url1.'/'.$url2.'detail/').$value->id ?>" class="btn btn-success">View</a></td> -->
    							 
    						</tr>
    						<?php $num++; }} else {?>
    						    <tr>
    						        <td colspan="9" class="text-center"><h6>Order is not available</h6></td>
    						    </tr>
    						<?php }?>
        				</tbody>
        			</table>
    			</div>
             
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('front/template/footer'); ?>
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
                      url: "<?= base_url('admin/update_fashion_services_status'); ?>", 
                      data: {"status":newstatus, "id":id}, 
                      success: function(data) {
                      location.reload();
                      }         
                 });
            }
        });    
    });
</script>