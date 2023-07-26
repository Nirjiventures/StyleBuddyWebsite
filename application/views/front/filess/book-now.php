<?php $this->load->view('Page/template/header'); ?>
<link href='<?=base_url()?>assets/calender/main.css' rel='stylesheet' />
<script src='<?=base_url()?>assets/calender/main.js'></script>

<!--========Banner Area ========-->

<div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>/assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3>Booking Now</h3></div>
	</div>
	
</div>

<!--========End Banner Area ========-->	


<div class="middle_part">
	
	<div class="container book_online">
	
		<div class="col-sm-12 text-center mb-5"><h1><?= $datas->name ?></h1><p>Check out our availability and book the date and time that works for you</p></div>
	    <?= form_open('',['id'=>'book-online']) ?>
		<div class="row m-0">
			
			<div class="col-sm-5">

				<div class="input-group date" data-provide="datepicker">
					<input type="hidden" class="form-control" id="datepicker"  min="<?php echo date("Y-m-d"); ?>">
					<div id="date_Err"></div>
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-th"></span>
						<input type="hidden" name="id" id="id" value="<?= $datas->id ?>">
						<input type="hidden" name="price" id="price" value="<?= $datas->price ?>">
						<input type="hidden" name="name" id="name" value="<?= $datas->name ?>">
						<input type="hidden" name="hour" id="hour" value="<?= $datas->time ?>">
					</div>
				</div>
				<div>
					<div id="slots"> </div>

				</div>
			
			</div>	
				
			<div class="col-sm-3">
				<div class="time_table" id="wrapper-radios3">
			
					<p><b>Morning</b></p>
					
					<div class="radios">
						<input type="radio" value='10 AM' name='radio-price1' id='radio_time1' >
						<label for='radio_time1'><span>10 AM</span></label>
					</div>
					<div class="radios">
						<input type="radio" value='11:00 am' name='radio-price1' id='radio_time2'>
						<label for='radio_time2'><span>11:00 AM</span></label>
					</div>
					
					<p><b>Afternoon</b></p>
					
					<div class="radios">
						<input type="radio" value='12:30 PM' name='radio-price1' id='radio_time3' >
						<label for='radio_time3'><span>12:30 PM</span></label>
					</div>
					<div class="radios">
						<input type="radio" value='1:30 PM' name='radio-price1' id='radio_time4'>
						<label for='radio_time4'><span>1:30 PM</span></label>
					</div>
					<div class="radios">
						<input type="radio" value='3 PM' name='radio-price1' id='radio_time5' checked>
						<label for='radio_time5'><span>3 PM</span></label>
					</div>
					
					<p><b>Evening</b></p>
					<div class="radios">
						<input type="radio" value='5:30 PM' name='radio-price1' id='radio_time6' >
						<label for='radio_time6'><span>5:30 PM</span></label>
					</div>
					
				</div>
			</div>
				
			<div class="col-sm-4">
				<div class="book_summery">
					
					<select class="staff" name="stafff" id="stafff">
						<option value="">---- Select Staff ----</option>
						<option value="Jyoti">Jyoti</option>
						<option value="Meera">Meera</option>
					</select>
					<div id="stafff_Err"></div>
					<div class="dat_tt mb-4">
						<ul>
						<li><b>Date </b><span id="datev"></span></li>
						<li><b>Time </b><span id="timev"></span></li>
						</ul>
					</div>
					<hr>
					<h4><?= $datas->name ?></h4>
					<hr>
					<p><b>Price -</b> <?= $datas->price ?> | <b>Time - </b><?= $datas->time ?> Hr </p>
					<hr>
					<p>You need to purchase a pricing plan to book this service.</p>
					
					<div class="text-center">
						<!--<a href="#" class="btn2">Next</a>-->
						<input type="submit" class="btn2" name="Next" value="Next">
						<p class="mt-3"><small>Already a member? <a href="<?= base_url('login') ?>">Log In</a></small></p>
					</div>
				</div>
			</div>
		</div>
		<?= form_close() ?>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
         $(function () {
             $('.dat_tt').hide(); // checked
            $('#book-online').on('submit',function(e){
            e.preventDefault();
            var error ;   
            var id = $('#id').val();
            var date = $('#datepicker').val();
            var time = $("input[name='radio-price1']:checked").val();
            var staff = $('#stafff option:selected').val();
            var price = $('#price').val();
            var name = $('#name').val();
            var meetingHour = $('#hour').val();
            
            $('#datepicker').removeClass('box_in3_err');
            $('#staff').removeClass('box_in3_err');

            $('#date_Err').html('');
            $('#stafff_Err').html('');

			if(!$('#datepicker').val()) {
				$('#datepicker').addClass('box_in3_err');
				$('#date_Err').html('Please select date');
				return false;
			} else if(!$('#stafff').val()) {
				$('#stafff').addClass('box_in3_err');
				$('#stafff_Err').html('Please select staff');
				return false;
			} else {
				$('.dat_tt').show();
				$('#datev').text(date);
				$('#timev').text(time);

				$.ajax({
					type: 'post',
					dataType:"json",
					url: "<?= base_url('book-now-process') ?>",         
					data: {id:id,date:date,time:time,staff:staff, price:price, name:name, meetingHour:meetingHour },
					success: function(data){
						//console.log(data.status);
						//console.log(data.redirect);
						if(data.status == true) {
							//console.log(data.redirect);
							window.location.href =  "<?= base_url()?>"+data.redirect;
						}
					}         
				});         
			}
		});
	});
</script>    



<?php $this->load->view('Page/template/footer'); ?>
<script type="text/javascript">

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
			//initialDate: today,
			selectable: true,
			selectMirror: true,

			eventClick: function(arg) {
				console.log(arg.event.extendedProps);
				var dddd = arg.event.extendedProps;
			},

			select: function(start, end, allDay) {
				//console.log(start)
				if (start.startStr < today) {
					$('#datepicker').val('');
					$('#date_Err').html('Please select future date');
				}else{
					$('#datepicker').val(start.startStr);
					$('#date_Err').html('Your selected date : '+start.startStr);
				}
			},
			editable: true,
			//weekNumbers: true,
			selectable: true,
			//businessHours: true,
			dayMaxEvents: true,
		});
		calendar.render();
	});
</script>
</script>

<style type="text/css">

	.fc-view-harness.fc-view-harness-active {

    height: 452px!important;

}

table.fc-scrollgrid-sync-table {

    width: 100%!important;

    height: 420px!important;

}

.fc-daygrid-body,table.fc-col-header  {

    width: 100%!important;

}

button.fc-today-button.fc-button.fc-button-primary {

    text-transform: capitalize;

}

</style>