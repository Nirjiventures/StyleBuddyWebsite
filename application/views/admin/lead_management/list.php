<?php $url1 = $this->uri->segment(1);?>

<?php $url2 = $this->uri->segment(2);?>

<?php $url3 = $this->uri->segment(3);?>

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



	               <li class="breadcrumb-item active" aria-current="page">vendors Details</li>



	            </ol>



         	</nav>



      	</div>



   	</div>



</div>



<div class="container">



	<div class="mt-1">



		<div id="message" class="text-primary text-center"></div>



	 

		<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>



        <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		



      



      <form name="frm" action="<?=base_url($url1.'/'.$url2.'/')?>">



      	<div class="row"> 

           	<div class="col-sm-5 my_source">
                   <label class="control-label" for="sip_code">Source</label>
                   <select id="lead_management" name="lead_management" class="form-control form-select all_source">
                        <option value="">Select Leads </option>
                        <option <?php if($url2 == 'ask-quote-form'){ echo 'selected'; } ?> value="ask-quote-form">Ask a Fashion Stylist</option>
                        <option <?php if($url2 == 'collaborate'){ echo 'selected'; } ?> value="collaborate">Collaborate with Us</option>
                        <option <?php if($url2 == 'RakhiLeads'){ echo 'selected'; } ?> value="RakhiLeads">Rakhi Leads</option>
                        <option <?php if($url2 == 'DiwaliLeads'){ echo 'selected'; } ?> value="DiwaliLeads">Diwali Leads</option>
                        <option <?php if($url2 == 'fashionExpertConsultation'){ echo 'selected'; } ?> value="fashionExpertConsultation">Fashion Expert Consultation</option>
                        <option <?php if($url2 == 'survey_log'){ echo 'selected'; } ?> value="survey_log">Survey Log</option>
                        <option <?php if($url2 == 'ask_for_quote_log'){ echo 'selected'; } ?> value="ask_for_quote_log">Ask for quote log</option>
                        <option <?php if($url2 == 'get_started'){ echo 'selected'; } ?> value="get_started">Get started log</option>
                        <!--<option <?php //if($url2 == 'report_an_issue_question'){ echo 'selected'; } ?> value="report_an_issue_question">Report Issue Question</option>-->
                        <option <?php if($url2 == 'report_an_issue'){ echo 'selected'; } ?> value="report_an_issue">Report Issue</option>
                        <option <?php if($url2 == 'check_availability'){ echo 'selected'; } ?> value="check_availability">Check Availability Leads</option>
                        <option <?php if($url2 == 'freesession'){ echo 'selected'; } ?> value="freesession">Book Free Session</option>
                   </select>

           	</div>
			
			<div class="clearfix"></div>

           	<div class="col-sm-12"></div>

           	



         </div>



      </form>



      



      



      <div class="row">


		</div>



		<div class="row">






		</div>



		<div class="row">






			<div class="col-sm-6">

			</div>



		</div>



	</div>



</div>



 







<script>



    $(document).ready(function(){



        $('#example').DataTable();    



        $(document).on('click','.display_status',function() {

    

            var id = (this.id);

    

            var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 

    

            var msg = (status=='0')? 'Published':'Unpublished';

    

            var newstatus = (status=='0')? '1':'0';

    

             if(confirm("Are you sure to "+ msg)) {

    

                      $.ajax({

    

                      type:"POST",

    

                      url: "<?= base_url('admin/vender/display_statusUpdate'); ?>", 

    

                      data: {"display_status":newstatus, "id":id}, 

    

                      success: function(data) {

    

                      location.reload();

    

                      }         

    

                 });

    

             }

    

        });  

        $(document).on('click','.status_checks',function() {

    

            var id = (this.id);

    

            var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 

    

            var msg = (status=='0')? 'Published':'Unpublished';

    

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

<style type="text/css">



    

</style>