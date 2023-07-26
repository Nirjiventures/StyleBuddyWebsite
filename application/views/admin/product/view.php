<?php 
// echo "<pre>";
// print_r($datas);
// exit;
?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Subcategory Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-5">
		    <div id="message" class="text-primary text-center"></div>
			<a href="<?php echo base_url('add-product') ;?>" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i>Add New Product</a>
			<div class="table-responsive ">
			<table class="table table-bordered text-center table-hover shadow-lg ">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead>
					<tr>
						<th class=''>S.No.</th>
						<th class=''>Category</th>
						<th class=''>Sub Category</th> 
						<th class=''>Product Name</th>
						<th class=''>Trending Product</th>
						<th class=''>Image</th>
						<th class=''>Video</th>
						<th class=''>Price</th>
						<th class=''>Quantity</th>
						<th class=''>Size</th>
						<th class=''>Status</th>
						<th class=''>Action</th>					
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) { ?>
					<tr>
						<td class=''><?php echo $num; ?></td>						
						<td class=''><?php echo $data->category; ?></td>
						<td class=''><?php echo $data->subcategory; ?></td>
						<td class=''><?php echo $data->product_name; ?></td>
						<td class="<?= ($data->trending_product == 1)?'text-info btn btn-sm':'text-danger btn btn-sm' ?>" ><?= ($data->trending_product == 1)?'YES':'NO' ?></td>
						<td class=''><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('upload/assets/image/').$data->product_image ?>" style="height:50px;width:50px" class="responsive"></td>
						<td class='<?= (!empty($data->product_video))? "text-info btn btn-sm":"text-danger btn btn-sm"  ?>'> <?php echo (!empty($data->product_video))? 'YES':'NO' ?></td>
						<td class=''><i class="fa fa-inr"></i>  <?php echo $data->product_price; ?></td>
						<td class=''><?php echo $data->product_qty; ?></td>
					    <td class=''><?php echo $data->size; ?></td>
						<td class='<?= ($data->status == 1)? "text-info btn btn-sm":"text-danger btn btn-sm"  ?>'><?php  if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';} ?></td>
						<td class=''>
					   <a href="<?php echo base_url('edit-product/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					   <a href="<?php echo base_url('admin/delete-product/').$data->id ?>" >  <i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> 
						</td>
					</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="5">Product data not available.</td></tr>
				   <?php }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
