<style>.border-left{ border-left: 4px solid #ef5285!important; border-radius: 10px;}</style>
<div class="container">
    <?php if($this->session->userdata('admin_id') == 1){ ?>
    
	    <div class="row">
        <?php 
            $tbl_name = 'vender';
            $str = " WHERE user_type = '3' ORDER BY id desc";
            $list   =  $this->common_model->get_all_details_distinct_query('id',$tbl_name,$str);
            $numRows =  $list->num_rows();
        ?>
        <div class="col-md-4 mt-5 ">
            <div class="card shadow-lg border-left">
                <div class="card-header">Total User</div>
                <div class="card-body h1 text-center"><?=  $numRows; ?></div>
                <div class="card-footer text-right"><a href="<?= base_url('admin/webuser') ?>" class="text-decoration-none">User List<i class="fa fa-arrow-circle-right text-primary fa-1x" aria-hidden="true"></i></a></div>
            </div>
        </div>
        <?php 
            $tbl_name = 'user_order_details';
            $str = " WHERE cart_type = 'service' ORDER BY id desc";
            $list   =  $this->common_model->get_all_details_distinct_query('id',$tbl_name,$str);
            $numRows =  $list->num_rows();
        ?>
        <div class="col-md-4 mt-5">
            <div class="card shadow-lg border-left">
                <div class="card-header">Total styling service orders</div>
                <div class="card-body h1 text-center"><?=  $numRows; ?></div>
                <div class="card-footer text-right"><a href="<?= base_url('admin/packagePurchasedUsers') ?>" class="text-decoration-none">Orders List <i class="fa fa-arrow-circle-right text-primary fa-1x" aria-hidden="true"></i></a></div>
            </div>
        </div>
        <?php 
            $tbl_name = 'user_order_details';
            $str = " WHERE cart_type != 'service' ORDER BY id desc";
            $tbl_name = 'user_order';
            $str = " ORDER BY id desc";
            $list   =  $this->common_model->get_all_details_distinct_query('id',$tbl_name,$str);
            $numRows =  $list->num_rows();
        ?>
        <div class="col-md-4 mt-5">
            <div class="card shadow-lg border-left">
                <div class="card-header">Total shop orders</div>
                <div class="card-body h1 text-center"><?=  $numRows; ?></div>
                <div class="card-footer text-right"><a href="<?= base_url('admin/user-order') ?>" class="text-decoration-none">Orders List <i class="fa fa-arrow-circle-right text-primary fa-1x" aria-hidden="true"></i></a></div>
            </div>
        </div>
        <?php 
            $tbl_name = 'giftcard_booking';
            $str = " ORDER BY id desc";
            $list   =  $this->common_model->get_all_details_distinct_query('id',$tbl_name,$str);
            $numRows =  $list->num_rows();
        ?>
        <div class="col-md-4 mt-5">
            <div class="card shadow-lg border-left">
                <div class="card-header">Total gift cards bought</div>
                <div class="card-body h1 text-center"><?=  $numRows; ?></div>
                <div class="card-footer text-right"><a href="<?= base_url('admin/gift_booking') ?>" class="text-decoration-none">Gift gift cards bought List <i class="fa fa-arrow-circle-right text-primary fa-1x" aria-hidden="true"></i></a></div>
            </div>
        </div>
        <?php 
            $tbl_name = 'posts';
            $str = " ORDER BY id desc";
            $list   =  $this->common_model->get_all_details_distinct_query('id',$tbl_name,$str);
            $numRows =  $list->num_rows();
        ?>
        <div class="col-md-4 mt-5">
            <div class="card shadow-lg border-left">
                <div class="card-header">Total posts on SB app</div>
                <div class="card-body h1 text-center"><?=  $numRows; ?></div>
                <div class="card-footer text-right"><a href="<?= base_url('admin/posts') ?>" class="text-decoration-none">Posts List <i class="fa fa-arrow-circle-right text-primary fa-1x" aria-hidden="true"></i></a></div>
            </div>
        </div>
        <!-- <div class="col-md-4 mt-5 ">
            <div class="card shadow-lg border-left">
                <div class="card-header">Total Stylist</div>
                <div class="card-body h1 text-center"><?=  $this->db->where('user_type','2')->count_all_results('vender'); ?></div>
                <div class="card-footer text-right"><a href="<?= base_url('admin/register-vendors') ?>" class="text-decoration-none">Stylist List <i class="fa fa-arrow-circle-right text-primary fa-1x" aria-hidden="true"></i></a></div>
            </div>
        </div>
        <div class="col-md-4 mt-5">
            <div class="card shadow-lg border-left">
                <div class="card-header">Total Orders</div>
                <div class="card-body h1 text-center"><?=  $this->db->count_all_results('user_order'); ?></div>
                <div class="card-footer text-right"><a href="<?= base_url('admin/user-order') ?>" class="text-decoration-none">Orders Details <i class="fa fa-arrow-circle-right text-primary fa-1x" aria-hidden="true"></i></a></div>
            </div>
        </div>
        <div class="col-md-4 mt-5 ">
            <div class="card shadow-lg border-left">
                <div class="card-header">Total Products</div>
                <div class="card-body h1 text-center"><?=  $this->db->count_all_results('products'); ?></div>
                <div class="card-footer text-right"><a href="<?= base_url('admin/allproducts') ?>" class="text-decoration-none">Products Details <i class="fa fa-arrow-circle-right text-primary fa-1x" aria-hidden="true"></i></a></div>
            </div>
        </div> -->
	</div>
	<?php } ?>
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
