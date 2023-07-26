<div class="container-fluid p-0">

   <div class="row">

      <div class="col-md-12">

         <nav aria-label="breadcrumb">

            <ol class="breadcrumb pl-3 mr-3 ">

               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>

               <li class="breadcrumb-item active" aria-current="page">User order</li>

            </ol>

         </nav>

      </div>

   </div>

</div>

<div class="container">

	<div class="row">

		<div class="col-md-12 mt-5">

		    <div id="message" class="text-primary text-center"></div>

			<div class="table-responsive ">

			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>

                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		

                

			<table class="table table-bordered text-center table-hover shadow-lg text-nowrap" id="example">

					<thead>

						<tr>

							<th class="no">No</th>

							<th class="no">Thumb</th>
							<th class="no">Order ID</th>

							<th class="name">Name</th>

							<th class="date">Date</th>

							 

							<th class="status">Payment Type</th>

							<th class="total">Total  Amount</th>

							<th class="action">Status</th>

							<th class="action">Details</th>

							<!--<th class="action">Action</th>-->

						</tr>

					</thead>

				<tbody>

				 <?php $num = 1; if(!empty($datas)) { foreach($datas as $value) { 

				        $date = strtotime($value->created_at); $fdate = date('d M, Y',$date);

				 ?>
				 <?php 
							if (!in_array($value->cart_type, $cart_typeArray)) {
								array_push($cart_typeArray, $value->cart_type);
							}
							$img = image_exist($value->productImg,'assets/images/product/'); 
                            if ($value->cart_type == 'service') {
                                $img = $value->productImg;
                            }

						?>

						<tr>

						   <td><?= $num ?></td>
						    <td><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="min_pro" style= "width:60px;height: 60px;" ></td>
						   <td><?= $value->order_id ?></td>

							<td><?= ucfirst($value->user_row->fname.' '.$value->user_row->lname);  ?></td>

							<td><?= $fdate ?></td>

							

							<!--<td><?= $value->order_id ?></td>-->

							<td class="hold"><?= $value->method ?></td>

							<td> &#8377; <?= number_format($value->totalPrice) ?></td>

							<td><?= $value->order_status ?></td>

							<td><a href="<?= base_url('admin/orders/userOrderDetails/').$value->id ?>" class="btn btn-success">View</a></td>

							 

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