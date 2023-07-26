<?php
$urlSegment = $this->uri->segment_array();
if (!empty($urlSegment)) {
    $uriString = end($urlSegment);
}
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Send Notification</h2>
			    <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left" data-parsley-validate=""  method="post" enctype="multipart/form-data" action="<?php echo current_url() ?>">
					<div class="form-group">
						<div class="col-sm-12">
    					    <label class="control-label">Title *</label>
    						<input type="text" class="form-control neo" name="title" value ="StyleBuddy is the right platform for you to show your talent and get noticed" placeholder="Enter title..." required="required">
    						<?php echo form_error('title') ? '<span class="error">'.form_error('title').'</span>' : ''?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
						    <label class="control-label">Notice</label>
							<textarea  class="form-control neo" name="description"  placeholder="Description">StyleBuddy is the right platform for you to show your talent and get noticed</textarea>
							<?php echo form_error('description') ? '<span class="error">'.form_error('description').'</span>' : ''?>
					    </div>
					</div>
					<div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="stick">
    							<button type="submit" class="btn btn-success">Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
