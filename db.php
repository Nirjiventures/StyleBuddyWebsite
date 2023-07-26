<?php
$con = mysqli_connect("162.240.36.96","acthubst_ci_27_11_22","k0Xbv[sk9kU+","acthubst_ci_27_11_22");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
echo "Successfull";
}
?>