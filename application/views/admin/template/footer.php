                                                </div> 
                                        </div> 

                                </div> 

                        </div> 

                </div> 


         </div>

      </div>

   </div>

   <!-- JavaScript files-->

<style>
    .lead_mm{display:none;}
</style>
   <script src="<?php echo base_url();?>assets/admin/vendor/jquery/jquery.min.js"></script>

   <script src="<?php echo base_url();?>assets/admin/vendor/popper.js/umd/popper.min.js"> </script>

   <script src="<?php echo base_url();?>assets/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

   <script src="<?php echo base_url();?>assets/admin/vendor/jquery-validation/jquery.validate.min.js"></script>

   <script src="<?php echo base_url();?>assets/admin/js/our.js"></script>
   <!-- Main File-->
   <script src="<?php echo base_url();?>assets/admin/js/front.js"></script>
   <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    

</body>
<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script type="text/javascript">
        var x = $("#editor1").length;
    	if( $("#editor1").length > 0){
    	   CKEDITOR.replace( 'editor1', { height: 300,  filebrowserUploadUrl: "https://www.stylebuddy.in/upload_image_ckeditor/index" });
    	}
    	var x = $("#editor2").length;
        if( $("#editor2").length > 0){
           CKEDITOR.replace( 'editor2', { height: 300,  filebrowserUploadUrl: "https://www.stylebuddy.in/upload_image_ckeditor/index" });
        }
        var x = $("#editor3").length;
        if( $("#editor3").length > 0){
           CKEDITOR.replace( 'editor3',{'height':150,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
         },]} ); 
        }
        var x = $("#editor4").length;
        if( $("#editor4").length > 0){
           CKEDITOR.replace( 'editor4',{'height':150,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
         },]} ); 
        }
        
        $('.onlyInteger').on('keypress', function(e) {
                keys = ['0','1','2','3','4','5','6','7','8','9','.']
                return keys.indexOf(event.key) > -1
        })
    </script>
    <script>
        $('#lead_management').change(function() {
            var page = $("#lead_management").val();
            if(page){
                var new_url = '<?php echo base_url().'admin/'; ?>'+page;
                //console.log(new_url);
                window.location = new_url;
            }
        });
    </script>
     
</html>