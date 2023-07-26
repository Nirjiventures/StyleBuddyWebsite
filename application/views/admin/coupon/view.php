<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Coupon Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-5">
		    <div id="message" class="text-primary text-center"></div>
			<a href="<?php echo base_url('admin/add-coupon') ;?>" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Add New Coupon </a>
			<div class="table-responsive ">
			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-bordered text-center table-hover shadow-lg">
				<thead>
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Coupon Code</th>
						<th class=''>Start Date</th>
						<th class=''>End Date</th>
						<th class=''>Coupon Value (%)</th>
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
						<td class=''><?php echo $data->coupon_code; ?></td>
						<td class=''><?php echo ($data->start_date); ?></td>
						<td class=''><?php echo ($data->end_date) ?></td>
						<td class=''><?php echo ($data->coupon_value) ?> %</td>
						<td class=''><?php  if ($data->status == 1) {echo 'Active';} else {echo 'Inactive';} ?></td>
						<td class=''>
					   <!--<a href="<?php echo base_url('edit-category/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>-->
					   <a href="javascript:void(0)" id="<?= $data->id ?>" class="cremove"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> 
						</td>
					</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="5">Coupon data not available.</td></tr>
				   <?php }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
