<?php $this->load->view('admin/template/header'); ?>
<?php  //print_r($vender) 
    
?>
<style type="text/css">
   
</style>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Stylist Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-5">
		    <div id="message" class="text-primary text-center"></div>
			<!--<a href="<?php echo base_url('admin/add-fashion-services') ;?>" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Add New Fashion Service </a>-->
			<a href="<?= base_url();?>admin/register-vendors" class="btn float-right btn-primary text-white mb-3">Back</a>
			<div class="table-responsive ">
			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-striped text-center table-hover text-nowrap shadow-lg" id="example">
				<tbody class="text-left">
				       <tr>
                        <th>Profile Image</th>
                        <td><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/vandor/').$vender->image ?>" style=" width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #333;
    padding: 3px; "></td>
                       </tr>
                       <tr>
                        <th>Full Name</th>
                        <td><?= $vender->fname.' '.$vender->lname ?></td>
                       </tr>
                       <tr>
                        <th>Email</th>
                        <td><?= $vender->email ?></td>
                       </tr>
                        <tr>
                        <th>Registered Date</th>
                        <td><?= date('F j, Y',strtotime($vender->created_at)) ?></td>
                       </tr>
                       <tr>
                        <th>Area Of Expertise</th>
                        <td><?= ($expertise)?$expertise:'' ?></td>
                       </tr>
                       <tr>
                        <th>Contact No</th>
                        <td><?= $vender->mobile ?></td>
                       </tr>
                       <tr>
                        <th>Experience</th>
                        <td><?= ($vender->experience)?"$vender->experience Years":"" ?></td>
                       </tr>
                       <tr>
                        <th>Address</th>
                        <td><?= $vender->address ?> <?= $vender->pin ?></td>
                       </tr>
                       <tr>
                        <th>City</th>
                        <td><?= $city->city ?></td>
                       </tr>
                       <tr>
                        <th>State</th>
                        <td><?= $state->name ?></td>
                       </tr>
                       <tr>
                        <th>Short Details</th>
                        <td><p style="white-space: break-spaces;"><?= $vender->about ?></p></td>
                       </tr>
                       <tr>
                        <th>Long Details</th>
                        <td><?= $vender->more_about ?></td>
                       </tr>
                       <tr>
                        <th>Facebook Link</th>
                        <td><?= $vender->facebook_link ?></td>
                       </tr>
                       <tr>
                        <th>Twitter Link</th>
                        <td><?= $vender->twitter_link ?></td>
                       </tr>
                       <tr>
                        <th>Instagram Link</th>
                        <td><?= $vender->instagram_nlink ?></td>
                       </tr>
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
                  url: "<?= base_url('admin/update_vender_status'); ?>", 
                  data: {"status":newstatus, "id":id}, 
                  success: function(data) {
                  location.reload();
                  }         
             });
         }
      });    
    });
</script>
<?php $this->load->view('admin/template/footer'); ?>