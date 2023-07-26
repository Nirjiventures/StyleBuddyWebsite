<?php  $this->load->view('Page/template/header'); ?>
<div class="banner_inner">
	<div class="top_title">
		<div class="container"><h3>Response</h3></div>
	</div>
</div>

<div class="middle_part">
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="response">
	        
	    
		 <?php 
		    $decryptValues=explode('&', $rcvdString);
        	$dataSize=sizeof($decryptValues);
        	
        	$order_status="";
        	echo "<center>";
        	for($i = 0; $i < $dataSize; $i++) {
        		$information=explode('=',$decryptValues[$i]);
        		if($i==3)	$order_status=$information[1];
        	}
        
        	if($order_status==="Success"){
        		echo "<h3>Thank you for shopping with us. </h3><p>Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.</p>";
        		
        	} else if($order_status==="Aborted"){
        		echo "<h3>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail</h3>";
        	
        	} else if($order_status==="Failure"){
        		echo "<h3>Thank you for shopping with us.However,the transaction has been declined.</h3>";
        	} else{
        		echo "<h3>Security Error. Illegal access detected</h3>";
        	
        	}
        
        	echo "<br><br>";
        
        	echo "<table class='table table-striped' cellspacing=4 cellpadding=4>";
        	for($i = 0; $i < $dataSize; $i++) {
        		$information=explode('=',$decryptValues[$i]);
        		if(!empty($information[1]) && $information[1]!= 'null'){
        		    if($information[0] == 'order_id'){
        		        $product_order = $information[1];
        		        
        		        if(strlen($product_order) == 1){
                			$serial_number1 = '00000'.$product_order;
                		}else if(strlen($product_order) == 2){
                			$serial_number1 = '0000'.$product_order;
                		}else if(strlen($product_order) == 3){
                			$serial_number1 = '000'.$product_order;
                		}else if(strlen($product_order) == 4){
                			$serial_number1 = '00'.$product_order;
                		}else if(strlen($product_order) == 5){
                			$serial_number1 = '0'.$product_order;
                		}else{
                			$serial_number1 = $product_order;
                		}
                		
        		       echo '<tr><td>'.ucwords(implode(' ',explode('_',$information[0]))).': </td><td>#'.$serial_number1.'</td></tr>'; 
        		    }else{
        		       echo '<tr><td>'.ucwords(implode(' ',explode('_',$information[0]))).': </td><td>'.$information[1].'</td></tr>'; 
        		    }
        		    
        		}
        	    
        	}
        
        	echo "</table><br>";
        	echo "</center>";
        	
		 ?> 
		 </div>
		 </div>
	    </div>
	</div>
</div>
<?php $this->load->view('Page/template/footer'); ?>
