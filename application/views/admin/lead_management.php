<?php $url1  = $this->uri->segment(1);?>
<?php $url2  = $this->uri->segment(2);?>
<?php $url3  = $this->uri->segment(3);?>
<div class="col-sm-5 text-center mt-3 jkd">
	        
	        <p style="margin-bottom: 15px;">All Leads Management</p>
	       
	       <div class="my_source">
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
        </div>