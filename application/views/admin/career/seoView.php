<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">career SEO Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-5">
		    <div id="message" class="text-primary text-center"></div>
		    <a href="<?php echo base_url('admin/career') ;?>" class="btn btn-primary float-right mb-3 ml-3 ">Jobs</a>
			<div class="table-responsive ">
			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-bordered text-center table-hover shadow-lg">
				<thead>
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Title</th>
						<th class=''>Meta Tag</th>
						<th class=''>Meta Description</th>
						<th class=''>Action</th>					
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
                    //foreach($datas as $data) { ?>
					<tr>
						<td class=''><?php echo $num; ?></td>						
						<td class=''><?php echo ucwords($datas->title); ?></td>
						<td class=''><?php echo $datas->metaTag; ?></td>
						<td class=''><?php echo $datas->metaDescription; ?></td>
						<td class=''>
					   <a href="<?php echo base_url('admin/edit-career-seo/').$datas->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
						</td>
					</tr>
				   <?php $num++;  }  else {?>
				   <tr><td colspan="5">career SEO data not available.</td></tr>
				   <?php }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
