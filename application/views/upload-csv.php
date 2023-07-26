	<div class="card-header">
		<div class="row">
			<div class="col-md-6"><h2 class="card-title"><?=$title?></h2></div>
			<div class="col-md-6 text-right">
				<a href="<?=base_url('admin/uploads/import_sweat_shirts')?>" class="btn btn-primary">Upload sweat shirts</a>
				<a href="<?=base_url('admin/uploads/import_polos')?>" class="btn btn-primary">Upload polos</a>
				<a href="<?=base_url('admin/uploads/import_outerwear')?>" class="btn btn-primary">Upload outerwear</a>
				<a href="<?=base_url('admin/uploads/import_woven_shirts')?>" class="btn btn-primary">Upload woven shirts</a>
				<a href="<?=base_url('admin/uploads/import_fleece')?>" class="btn btn-primary">Upload fleece</a>
				<a href="<?=base_url('admin/uploads/import_headwear')?>" class="btn btn-primary">Upload Headwear</a>
				<a href="<?=base_url('admin/uploads/updateprice')?>" class="btn btn-primary">Update Price</a>
				<a href="<?=base_url('admin/uploads/updatebrand')?>" class="btn btn-primary">Update Brand</a>
				

			</div>
		</div>
	</div>


	<div class="card-content collapse show">
		<div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
			 
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left"   data-parsley-validate=""  method="post" enctype="multipart/form-data" action="">
					<div class="form-group">
						<div class="col-sm-2">
 						    <label class="control-label">Upload</label>
						</div>
						<div class="col-sm-10">
							<input type="file" name="importfile" accept="*">
						</div>
					</div>
					<div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                            <div class="stick">
    							<button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
