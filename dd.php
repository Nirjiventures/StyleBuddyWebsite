<?php

    $hostName = '162.240.36.96';
    //$hostName = 'localhost';
    $dbUserName = 'acthubst_ci_27_11_22';
    $dbPassword = 'k0Xbv[sk9kU+';
    $databaseName = 'acthubst_ci_27_11_22';
    $con=mysqli_connect($hostName,$dbUserName,$dbPassword,$databaseName);
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        echo "Successfull<br/>";
        /*$sql="select * from users";
        $result_query = $con-> query($sql);
        $total_row=mysqli_num_rows($result_query); 
        
        $output = '';
        if($total_row > 0){
        	while ($row = $result_query->fetch_assoc()) {
        	    var_dump($row);
        	}
        }*/
    }
    $hostName = '162.240.57.201';
    //$hostName = 'localhost';
    $dbUserName = 'odmuajmy_stylebuddy';
    $dbPassword = 'bU3vv,LFhjAD';
    $databaseName = 'odmuajmy_stylebuddy_23_april_1'; 

    $con=mysqli_connect($hostName,$dbUserName,$dbPassword,$databaseName);
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        echo "Successfull<br/>";
        /*$sql="select * from users";
        $result_query = $con-> query($sql);
        $total_row=mysqli_num_rows($result_query); 
        
        $output = '';
        if($total_row > 0){
        	while ($row = $result_query->fetch_assoc()) {
        	    var_dump($row);
        	}
        }*/
    }
?>
