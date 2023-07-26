<?php $this->load->view('front/template/header'); ?>


<div class="main">

	<div class="row m-0 justify-content-end">



		<div class="col-sm-3 p-0 black_bg">

			<div class="sidebar">

				<?php $this->load->view('Page/user/siderbar'); ?>

			</div>

		</div>





		<div class="col-sm-9">

			<div class="rightbar1">

				<h2>Address</h2>

				

				<hr>

					<div class="row">

						<div class="col-sm-5">

							<div class="address_pp">

								<address>

									Maddy Singh <br>

									123 Street Name, City Name <br>

									Los Angeles, Kedah 03100 <br>

									Malaysia <br>

									(123) 789-6150 <br>

								</address>

								<hr>

								<div class="address-box-action clearfix">

									<a href="#" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>



									<a href="#" class="btn btn-sm btn-outline-secondary float-right"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

								</div>

							</div>

						</div>

					</div>

				   	

				

				<hr>

				

				<div class="row mt-5">

				  

				 

				  

					<div class="col-sm-6">

					

						<div class="form-group boot_sp">

							<input type="text" id="House" name="House" value="" class="form-control box_in3">

							<label class="form-control-placeholder2" for="House">House No./ Flat no.</label>

						</div>

						

						<div class="form-group boot_sp">

							<input type="text" id="Floor" name="Floor" value="" class="form-control box_in3">

							<label class="form-control-placeholder2" for="Floor">Floor / Street</label>

						</div>

					

						<div class="form-group boot_sp">

							<input type="text" id="Apartment" name="Apartment" value="" class="form-control box_in3">

							<label class="form-control-placeholder2" for="Apartment">Apartment / Block No.</label>

						</div>

						

						<div class="form-group boot_sp">

							<input type="text" id="Address" name="Address" value="" class="form-control box_in3">

							<label class="form-control-placeholder2" for="Address">Address / area</label>

						</div>

					

						

					</div>

				 

					<div class="col-sm-6">

					

						<div class="form-group boot_sp">

							<select id="Country" name="Country" class="form-control box_in3">

								<option>-select-</option>

								<option>India</option>

								<option>Singapore</option>

								<option>UAE</option>

								<option>USA</option>

								<option>Canada</option>

							</select>

							<label class="form-control-placeholder2" for="Country">Country</label>

						</div>

						<div class="form-group boot_sp">

							<select id="State" name="State" class="form-control box_in3">

								<option>-select-</option>

								<option>Uttar Pradesh</option>

								<option>Delhi</option>

								<option>Bihar</option>

								<option>Haryana</option>

								<option>Punjab</option>

							</select>

							<label class="form-control-placeholder2" for="State">State</label>

						</div>

						<div class="form-group boot_sp">

							<select id="City" name="City" class="form-control box_in3">

								<option>-select-</option>

								<option>Agra</option>

								<option>Meerut</option>

								<option>Lucknow</option>

								<option>Muzaffarnagar</option>

								<option>Mathura</option>

							</select>

							<label class="form-control-placeholder2" for="City">City</label>

						</div>

						

						<div class="form-group boot_sp">

							<input type="text" id="Pin" name="Pin" value="" class="form-control box_in3">

							<label class="form-control-placeholder2" for="Pin">Pin / Postal code</label>

						</div>

					

					

					</div>

				  

				  <div class="col-sm-12">

					<input type="submit" value="Update Now" class="sub" >

				  </div>

				  

				</div>

				

			</div>

		</div>

	</div>

</div>

<?php $this->load->view('front/template/footer'); ?>