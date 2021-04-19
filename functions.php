<?php
include('class_database.php');


function getCustomerinfo($cusid)
{ 
  $clientArr=array();
     $sql = "SELECT * FROM `client_tbl` WHERE cli_id ='".$cusid."'";
     $result = mysqli_query($GLOBALS['conn'], $sql);
     if (mysqli_num_rows($result) > 0) {               
        while($row = mysqli_fetch_assoc($result)) {
          	$clientArr['status']='success';
            $clientArr['cli_name']=$row['cli_name'];
            $clientArr['cli_mail']=$row['cli_mail'];
            $clientArr['cli_amt']=$row['cli_amt'];
            $clientArr['cli_open_deposit']=$row['cli_open_deposit'];
            $clientArr['cli_doc']=$row['cli_doc'];
            $clientArr['cli_dom']=$row['cli_dom'];
            $clientArr['cli_status']=$row['cli_status'];
          }
        }else{
          $clientArr['status']='fail';
           $clientArr['cli_name']="No Data";
            $clientArr['cli_mail']="No Data";
            $clientArr['cli_amt']="No Data";
            $clientArr['cli_open_deposit']="No Data";
            $clientArr['cli_doc']="No Data";
            $clientArr['cli_dom']="No Data";
            $clientArr['cli_status']="No Data";

            $clientArr['error']="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      return($clientArr);
  }

?>