<style>
    table tbody th {
        background:#f62ac1;color:white;
        margin-left: 20px!important;
        width:200px;
    }
    .table td, .table th {
    padding: 0.45rem;
    vertical-align: middle!important;
    border-top: 1px solid #dee2e6;
}
</style>
<?php $segment1  = $this->uri->segment(1);?>
<?php $segment2  = $this->uri->segment(2);?>
<?php $segment3  = $this->uri->segment(3);?>
<?php 
     $rrr = getUserPermission();
     //echo $this->db->last_query();
     $permission = unserialize($rrr['permission']);
     //var_dump($permission);
?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Website Setting Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container1">
	<div class="row">
		<div class="col-md-12 mt-3">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive shadow-lg">
			<table class="table table-bordered text-left table-hover">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
		          <tbody class="">
		              <?php if(!empty($datas)) { ?>
                        <?php if($this->session->userdata('admin_id') == 1 || in_array($segment1.'/'.$segment2.'/edit',$permission)){ ?>
		                 <tr><td colspan="2" class="text-right"> <a href="<?= base_url('admin/edit-site-setting/').$datas[0]->id ?>" class="btn btn-sm btn-primary">Edit</a> </td></tr>
                    <?php } ?>
                        <tr>
                        <th>Logo</th>
                        <td><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/').$datas[0]->logo ?>" ></td>
                        </tr>
                        
                        <tr>
                        <th>Short Description</th>
                        <td><?= $datas[0]->short_details ?></td>
                        </tr>
                        
                        <tr>
                        <th>Address</th>
                        <td><?= $datas[0]->address ?></td>
                        </tr>
                        
                        <tr>
                        <th>Email</th>
                        <td><?= $datas[0]->email ?></td>
                        </tr>
                        
                        <tr>
                        <th>Mobile</th>
                        <td><?= $datas[0]->mobile ?></td>
                        </tr>
                        <tr>
                           <th>GSTIN</th>
                           <td><?= $datas[0]->gstin ?></td>
                        </tr>
                        <tr>
                        <th>Linkedin Link</th>
                        <td><?= $datas[0]->linkedin ?></td>
                        </tr>
                        
                        <tr>
                        <th>Facebook Link</th>
                        <td><?= $datas[0]->facebook ?></td>
                        </tr>
                        
                        <tr>
                        <th>Twitter Link</th>
                        <td><?= $datas[0]->twitter ?></td>
                        </tr>
                        
                        <tr>
                        <th>Instagram Link</th>
                        <td><?= $datas[0]->instagram ?></td>
                        </tr>
                        <tr>
                        <th>Youtube Link</th>
                        <td><?= $datas[0]->youtube ?></td>
                        </tr>
                        
                        <tr>
                        <th>Home Meta Title</th>
                        <td><?= $datas[0]->meta_title ?></td>
                        </tr>
                        
                        <tr>
                        <th>Home Meta Keyword</th>
                        <td><?= $datas[0]->meta_keyword ?></td>
                        </tr>
                        
                        <tr>
                        <th>Home Meta Description</th>
                        <td><?= $datas[0]->meta_description ?></td>
                        </tr>
                        
                        <?php } else { ?>
                         <td> Data Not found </td>
                        <?php }?>
		          </tbody>
			</table>

			</div>
		</div>
	</div>
</div>
