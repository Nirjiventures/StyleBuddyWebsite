<?php $this->load->view('front/vandor/header'); ?>
<link href='<?=base_url()?>assets/calender/main.css' rel='stylesheet' />
<script src='<?=base_url()?>assets/calender/main.js'></script>

<style type="text/css">
	.switch {
    width: 96px;
}
.switch-input:checked ~ .switch-handle {
    left: 72px;
}
</style>

<div id="createBookingModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add an Booking on: <span class="startDate"></span></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> <span class="sr-only">close</span></button>
            </div>
            <div id="modalBody" class="modal-body">
            	<p class="text-danger msg_msg"></p>
            	<input type="hidden" id="selected_date" name="selected_date">
                <div class="form-group">
                    <label for="bookingName">Start Time</label>
                    <input type="time" class="form-control" id="start_time" name="start_time" placeholder="Booking Name">
                    <div id="start_time_err"></div>
                </div>

                <div class="form-group">
                    <label for="bookingEndDate">End Time</label>
                	<input type="time" class="form-control" id="end_time" name="end_time" placeholder="mm/dd/yyyy">
                	<div id="end_time_err"></div>
                </div>
            
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="createBookingModal1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add an Booking on: <span class="startDate"></span></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> <span class="sr-only">close</span></button>
            </div>
            <div id="modalBody" class="modal-body">
            	<p><b>Please select future date</b></p>
            </div>
        </div>
    </div>
</div>
 

<div class="main">
	<div class="container">
		
		<!--<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
			  <?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>-->

		<div class="col-sm-12">
			<div class="rightbar">

				<div class="container p-0">
					<div class="row">
						<div class="col-sm-9">
							<h3>Available Dates</h3></div>

							<div class="col-sm-3 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

					</div>
					<hr>
				</div>

				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('success'); ?></div>
				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('error'); ?></div>
				
				<div>
					<div class="input-group date" data-provide="datepicker">
		              	<input type="hidden" class="form-control" name="date_id" id="datepicker">
		              	<div id="date_Err"></div>
		            </div>
		            <div>
		              	<div id="slots"> </div>
		            </div>

				</div>
				<div style="display: none;">
					<div class="table-responsive" >
						<table class="table table-bordered odc text-nowrap" id="table">
							<thead>
								<tr>
									<th class="date col-sm-2">Date</th>
									<th class="date col-sm-2">Time</th>
									<th class="date col-sm-2">Status</th>
									<th class="action col-sm-2">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if(!empty($stylist_availability)) {  $count = count($stylist_availability);?>
								<?php foreach($stylist_availability as $blog)  {  ?>
									<tr>
										<td><i class="fa fa-calendar" aria-hidden="true"></i> <?= date('F j, Y',strtotime($blog->availability_date)) ?></td>
										<td><i class="fa fa-calendar" aria-hidden="true"></i> <?= date('h:i A',strtotime($blog->availability_time)) ?></td>
										
										<td>
											<label class="switch switch-green">
											  <input type="checkbox" class="switch-input" onclick="blogStatus(<?= $blog->id ?>,<?= $blog->status ?>)"  id="<?= $blog->status ?>" <?= ($blog->status == 1)?'checked':'' ?> >
											  <span class="switch-label" data-on="Available" data-off="Booked"></span>
											  <span class="switch-handle"></span>
											</label>
										</td>
										<td>
												<?php if ($blog->availability_date >= date('Y-m-d')) { ?>
										    	<a href="<?= base_url('vendor/available_dates_delete/').$blog->id ?>" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
										    <?php } ?>
										</td>
									</tr>
								<?php }?>
							<?php } else {  ?>
							    <tr><td colspan="6" class="text-center">Dates not available.</td></tr>
							<?php  } ?>	
							</tbody>
						</table>
					</div>
					<?php $dates = array();?>
					<?php foreach($stylist_availability as $k=>$v){ ?>
						<?php array_push($dates,$v->availability_date);?>
					<?php }?>
					<p>
						<?php 
								if(!empty($dates)){
									 /*echo implode(', ', $dates);*/
								} 
						?>
					</p>
					<?= form_open_multipart('',['id'=>'registration-form','name'=>'registration-form']) ?>
						<div class="row mt-5">
							<div class="col-sm-12">
								<input type="text" autocomplete="off" id="datepicker" name="dates" class="form-control" placeholder="Choose Date and Time" />
							</div>
							<div class="col-sm-12">
								<hr/>
							</div>
							<div class="col-sm-12">
								<input type="submit" id="submit" class="sub btn btn-info ">
							</div>
						</div>
							 
					 
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<style type="text/css">
	.text-green{
		font-weight: bold;
		color: green!important;
	}
</style>
<?php $this->load->view('front/vandor/footer'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<script>
  	var dates = new Array();
</script>
<script type="text/javascript">
    console.log(dates)
    document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('slots');
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();


		if(d<10){
		d = '0'+d
		} 
		if(m<10){
		m = '0'+(m+1)
		} 


	    today = y+'-'+m+'-'+d;
	    var calendar = new FullCalendar.Calendar(calendarEl, {
	        /*initialDate: today,
	        selectMirror: true,*/
	        eventClick: function(arg) {
	          console.log(arg.event.title);
	          console.log(arg.event.extendedProps);
	          var date_id = arg.event.extendedProps.date_id;
	          var dd = arg.event.extendedProps.availability_date;
	          var tt = arg.event.extendedProps.availability_time; 
	          if (dates.includes(dd)){
	              $('#datepicker').val(date_id);
	              $('#date_Err').html('Your selected date : '+dd + ' '+tt);
	          }else{
	            $('#datepicker').val('');
	            $('#date_Err').html('Please select available date');
	          }

	           
	        },
	        select: function(start, end, allDay,callback) {
	          	if (start.startStr < today) {
	            	$('#datepicker').val('');
	            	//$('#date_Err').html('Please select future date');
	            	
	            	$('#createBookingModal1 .modal-header .modal-title span').text(start.startStr);
	            	$('#createBookingModal1').modal('show');
	            	$('.close').on('click', function() {
					  	$('#createBookingModal1').modal('hide');
					});
	          	}else{
	          		$('#createBookingModal .modal-header .modal-title span').text(start.startStr);
	      			$('#createBookingModal').modal('show');
	      			$('.close').on('click', function() {
					  	$('#createBookingModal').modal('hide');
					});

	      			$('#selected_date').val(start.startStr)
	          		$('#submitButton').on('click', function(e){
					    e.preventDefault();
					     
					    $('#start_time_err').html('');
						$('#end_time_err').html('');
						$('#date').html('');
						 

						if($('#start_time').val() == '') {
							$('#start_time_err').html('<span class="text-danger">Please Enter Start Time</span>');
							$('#start_time').focus();
							return false;
						} else if($('#end_time').val() == '') {
							$('#end_time_err').html('<span class="text-danger">Please Enter End Time</span>');
							$('#end_time').focus();
							return false;
						}else{

							$.ajax({
						        url: '<?=base_url('vendor/available_dates_submit')?>',
						        //dataType: 'POST',
						        data: {
						           'selected_date': $('#selected_date').val(),
						           'start_time': $('#start_time').val(),
						           'end_time': $('#end_time').val(),

						        },
						        success: function(response){
						        	console.log(response);
						        	
						        	var d= $.parseJSON(response);
						        	console.log(d);
						        	$('.msg_msg').html(d.msg)
						          	//window.location.reload();
						        	if (d.status == 'success') { 
						            	/*events.push({
							                title: d.data.title,
							                start: d.data.start,
							            });*/
						          	}
						          	window.setTimeout(function(){
								        window.location.reload();
								    }, 1000);

						        }
					      	});

							return true;
						}

					    //doSubmit();
					});
	      			
	          	}
	        },
	        eventColor: '#378006',
	        //events: <?=json_encode($stylist_dates_availability)?>,
	        events: '<?=base_url('vendor/available_dates_json')?>',
	        editable: true,
	        //weekNumbers: true,
	        selectable: true,
	        //businessHours: true,
	        dayMaxEvents: true,
      	});
      	calendar.render();
    });
    
</script>
<script>
jQuery(function($) {
    $("#datepicker").datetimepicker(
    	{dateFormat: "yy-mm-dd", minDate: 1}
    	);
});
</script>
