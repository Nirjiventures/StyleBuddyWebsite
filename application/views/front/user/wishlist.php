<style>
    .pro_photo_pp img {
     width: 100%;
     height: 260px!important;
    }
    .my_wish_l i {
    line-height: 30px;
}
</style>

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
				<h2>Wishlist</h2>
				<hr>
				<div class="row mt-4">
					<?php  foreach ($wishlistArray as $key => $value) { ?>
						<?php  	$product = $value->productRow; ?>
						<?php 	$gallary = $this->db->get_where('product_galary',['product_id'=> $product->id ])->result(); ?>
		          	  	<div class="col-6 col-sm-3">
		          	  		<?php $product->gallary = $gallary; ?>
		          	  		<?php $product->site_currency = $this->site->currency; ?>
		          			<?=product_div($product);?>
		          		</div>     	 
		          	<?php  	} ?>
				</div>
			</div>
		</div>
	</div>
</div> 

<?php $this->load->view('front/template/footer'); ?>

<script>
    $('.btn_wish').click(function() {
            
            let id = $(this).data("id");
            let catId = $(this).data("catid");
            let venderId = $(this).data("venderid");
            let loggedid = $(this).data("loggedid");
             
             
                $.ajax({
                     url:"<?=base_url()?>user/wishlistadd",
                     type:"POST", 
                     //dataType:"json",
                     data:{id:id,catId:catId,venderId:venderId,loggedid:loggedid},
                     success:function(data){
                            console.log(data);
                            /*ss = $.parseJSON(data);
                            if(ss.status == 1) {
                                $('#btn_wish_'+id+'').removeClass('fa-heart-o');
                                $('#btn_wish_'+id+'').addClass('fa-heart');
                            
                            }else{
                                $('#btn_wish_'+id+'').removeClass('fa-heart');
                                $('#btn_wish_'+id+'').addClass('fa-heart-o'); 
                            }*/
                            window.location.reload();
                            /*console.log($(this).find('i'));
                            console.log($(this).children('i'));
                            if(ss.status == 1) {
                                $(this).find('i').removeClass('fa-heart-o');
                                $(this).find('i').addClass('fa-heart');
                                //window.location.reload();
                            }else{
                                $(this).find('i').removeClass('fa-heart');
                                $(this).find('i').addClass('fa-heart-o'); 
                            }    */    
                       }
               });   
       });
        
</script>

