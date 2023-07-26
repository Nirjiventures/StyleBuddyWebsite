<?php $this->load->view('front/template/header'); ?>
<div class="container-fluid p-0">
	<div class="row m-0 justify-content-end">
		<div class="col-sm-3 p-0 black_bg">
			<div class="sidebar">
				<?php $this->load->view('front/user/siderbar'); ?>
			</div>
		</div>
		<div class="col-sm-9">

			<div class="rightbar1">

				<h2>Orders</h2>

				

				<hr>

				

				
				<div class="table-responsive">
				<table class="table table-border table-striped mt-3">

					<thead>

						<td style="width:80px;">S.No</td>

						<td nowrap="nowrap">Order ID</td>

						<td nowrap="nowrap">Total Price</td>

						<td nowrap="nowrap">Order Date</td>

						<td nowrap="nowrap">Status</td>

						<td nowrap="nowrap">Action</td>

					</thead>

					<?php $no = 1; if($order) { foreach($order as $list ) { ?>
						<tbody>
					<tr>

						<td><?= $no; ?></td>

						<td><?= $list->order_id; ?></td>

						<td><?= $this->site->currency.' '.number_format($list->total_price); ?></td>

						<td><?= date('j F, Y',strtotime($list->created_at)) ?></td>

						<td class="text-warning"><?= $list->order_status; ?></td>

						<td> <a href="<?= base_url('user/user-orders/').$list->id; ?>" class="btn btn-success">View</a></td>

					</tr>
					</tbody>
				   <?php $no++; } } ?>	

				

				</table>
			</div>
				

				

			</div>

		</div>
	</div>
</div>
<?php $this->load->view('front/template/footer'); ?>