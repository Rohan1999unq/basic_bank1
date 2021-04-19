<?php
require_once('class_database.php');
require_once('functions.php');
// print_r($_POST);
// exit();
// add customer 

switch ($_POST['action']) {
    // add customer data start 
  case "addcustomer":
      if(empty($_POST['cus_name'] or $_POST['cus_mail'] or $_POST['cus_amt'])){
               $data['status']="fail";
               $data['message']="Please fill all form fields";
      }else{
         $sql = "INSERT INTO `client_tbl`(`cli_name`, `cli_mail`, `cli_amt`, `cli_open_deposit`) 
            VALUES ('$_POST[cus_name]','$_POST[cus_mail]','$_POST[cus_amt]','$_POST[cus_amt]')";

            if (mysqli_query($conn, $sql)) {
              $data['status']="success";
              $data['message']="New Customer Create Successfully";
            } else {
                $data['status']="fail";
                $data['message']="Error: " . $sql . "<br>" . mysqli_error($conn);
            }
      }
       
    break;
  // add customer data end 

    // show customer data start 
  case "showcustomer":
    $output="";
    $sno=1;
     $sql = "SELECT * FROM `client_tbl` WHERE cli_status='ACTIVE'";
     $result = mysqli_query($conn, $sql);
      $output.="<table class='table table-bordered'>
              <thead>
                <tr>
                  <th>S No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Current Balance</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>"; 
     if (mysqli_num_rows($result) > 0) {               
        while($row = mysqli_fetch_assoc($result)) {
           $output.="<tr>
                  <td>".$sno."</td>
                  <td>".$row['cli_name']."</td>
                  <td>".$row['cli_mail']."</td>
                  <td>₹ ".number_format($row['cli_amt'])."</td>
                  <td><a href='transfer.php?i=".$row['cli_id']."'><button type='button' class='btn btn-sm btn-primary'>Transfer Money</button></a>
                    <a href='view.php?i=".$row['cli_id']."'><button type='button' class='btn btn-sm btn-success'>View</button></a>
                    <button type='button' class='btn btn-sm btn-danger' onclick='deletedata(this);' data-id='".$row['cli_id']."'>Delete</button></td>
                </tr>";
                $sno++;
          }
        } else {
          $output.="<tr><td colspan='5'>No Data</td></tr>";
        }
        $output.="</tbody></table>";
          $data['status']="success";
          $data['message']=$output;
        
    break;
  // show customer data end 

    // List customer data start 
  case "listcustomer":
    $output="";
    $sno=1;
     $sql = "SELECT * FROM `client_tbl` WHERE cli_status='ACTIVE'";
     $result = mysqli_query($conn, $sql);
      $output.="<select class='form-control' name='trns_cust' id='trns_cust'>"; 
     if (mysqli_num_rows($result) > 0) {       
     $output.="<option selected disabled>Select Receiver Name</option>";        
          while($row = mysqli_fetch_assoc($result)) {
              if($row['cli_id']!=$_POST['customer']){
                $output.="<option value=".$row['cli_id'].">".$row['cli_name']."</option>";
                    $sno++;
              }
          }
        } else {
          $output.="<option selected disabled>No Receiver Name</option>";
        }
        $output.="</select>";
          $data['status']="success";
          $data['message']=$output;
        
    break;
  // List customer data end 

    // Single customer info data start 
  case "infocustomer":
    $output="";
    $sno=1;
     $sql = "SELECT * FROM `client_tbl` WHERE cli_id ='{$_POST['customer']}'";
     $result = mysqli_query($conn, $sql);
      $output.="<table class='table table-bordered'>
                <tbody>"; 
       if (mysqli_num_rows($result) > 0) {               
          while($row = mysqli_fetch_assoc($result)) {
             $output.="<tr>
                    <td><b>Sender Name</b></td>
                    <td>".$row['cli_name']."</td>
                  </tr>";
              $output.="<tr>
                    <td><b>Current Amount</b></td>
                    <td>₹ ".number_format($row['cli_amt'])."</td>
                  </tr>";
            }
          } else {
            $output.="<tr>
                    <td colspan='2'><b>No Data</b></td>
                  </tr>";
          }
          $output.="</tbody></table>";
          $data['status']="success";
          $data['message']=$output;
        
    break;
  // Single customer info data end 

// delete customer data start 
 case "deletecustomer":
        $sql = "UPDATE `client_tbl` SET `cli_status`='INACTIVE' WHERE `cli_id`='$_POST[client]'";
        if (mysqli_query($conn, $sql)) {
          $data['status']="success";
          $data['message']="Customer Delete Successfully";
        } else {
            $data['status']="fail";
            $data['message']="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    break;
// delete customer data end 

  // transfer amount data start 
  case "transferamount":
    // print_r($_POST);
    $msg=(!empty($_POST['trns_msg'])?$_POST['trns_msg']:'');
      if(empty($_POST['receiverby'] or $_POST['sendby'] or $_POST['trns_amt'])){
               $data['status']="fail";
               $data['message']="Please fill all form fields";

      }else{  
        // get receiver data
         $receiverSql = "SELECT * FROM `client_tbl` WHERE cli_id ='{$_POST['receiverby']}'";
                  $receiverResult = mysqli_query($conn, $receiverSql);
                    if (mysqli_num_rows($receiverResult) > 0) {               
                      while($receiverRow = mysqli_fetch_assoc($receiverResult)) {
                          $receiverCurrentAmt=(int)$receiverRow['cli_amt'];
                          $receivername=$receiverRow['cli_name'];
                      }
                    }else{
                       $data['status']="fail";
                       $data['message']="Receiver data not found in Database! Try Again!";
                       $data['error']="Error: " . $receiverSql . "<br>" . mysqli_error($conn);
                    }

                    
              // Get sender informations 
                  $senderData = "SELECT * FROM `client_tbl` WHERE cli_id ='{$_POST['sendby']}'";
                  $senderResult = mysqli_query($conn, $senderData);
                    if (mysqli_num_rows($senderResult) > 0) {               
                      while($senderRow = mysqli_fetch_assoc($senderResult)) {
                        if($senderRow['cli_amt']>=$_POST['trns_amt'])
                        {
                           $transSql = "INSERT INTO `transfer_tbl`(`trns_amt`, `trns_sender`, `trns_receiver`, `trns_msg`) VALUES ('$_POST[trns_amt]','$_POST[sendby]','$_POST[receiverby]','$msg')";
                              if (mysqli_query($conn, $transSql)) {
                                  $lastTransId=mysqli_insert_id($conn);
                                if(!empty($lastTransId)){
                                      $SenderCurrentAmt=(int)$senderRow['cli_amt'];
                                      $afterTransferSenderAmt=$SenderCurrentAmt-(int)$_POST['trns_amt'];
                                      $afterTransferReceiverAmt=$receiverCurrentAmt+(int)$_POST['trns_amt'];

                                    // update sender amount 
                                       $senderAmtUpdateSql = "UPDATE `client_tbl` SET `cli_amt`='".$afterTransferSenderAmt."' WHERE `cli_id`='".$_POST['sendby']."' "; 
                                       $receiverAmtUpdateSql = "UPDATE `client_tbl` SET `cli_amt`='".$afterTransferReceiverAmt."' WHERE `cli_id`='".$_POST['receiverby']."' ";
                                          $senderAmtUpdateRun=mysqli_query($conn, $senderAmtUpdateSql);
                                          $receiverAmtUpdateRun=mysqli_query($conn, $receiverAmtUpdateSql);
                                          if ($senderAmtUpdateRun &&  $receiverAmtUpdateRun) {
                                             $updateTrnsStatus = "UPDATE `transfer_tbl` SET `trns_status`='SUCCESS' WHERE `trns_id`='".$lastTransId."' "; 
                                              $updateTrnsStatusRun=mysqli_query($conn, $updateTrnsStatus);
                                                $data['status']="success";
                                                $data['message']="₹ ".number_format($_POST['trns_amt'])." has been successfully transfer to ".$receivername;
                                          }
                                          else{
                                            $data['status']="fail";
                                            $data['message']="Sufficent Amount is not present in your Account! Try Again with less amount!";
                                            $data['error']="Error1: " . $senderAmtUpdateSql . "<br>" . mysqli_error($conn)."Error2: " . $receiverAmtUpdateSql . "<br>" . mysqli_error($conn);
                                          }
                                }
                                else{
                                  $data['status']="fail";
                                  $data['message']="Last Transection ID Not Found!";
                                }      
                            }else{
                              $data['status']="fail";
                              $data['message']="Amount Not Transfer! Try Again!";
                              $data['error']="Error: " . $transSql . "<br>" . mysqli_error($conn);
                            }                        
                        }else{
                              $data['status']="fail";
                              $data['message']="Sufficent Amount is not present in your Account! Try Again with less amount!";
                            }          
                      }      
            } else {
                $data['status']="fail";
                $data['message']="Sender data not found in Database! Try Again!";
                $data['error']="Error: " . $senderData . "<br>" . mysqli_error($conn);
            }
      }
    break;
  // transfer amount data end 

  // show customer data start 
  case "showlatesttransection":
    $output="";
    $sno=1;
     $sql = "SELECT * FROM `transfer_tbl` WHERE trns_sender='".$_POST['customer']."' or trns_receiver='".$_POST['customer']."' order by trns_id desc";
     $result = mysqli_query($conn, $sql);
      $output.="<table class='table table-bordered'>
              <thead>
                <tr>
                  <th>S No.</th>
                  <th>Date</th>
                  <th>Sender</th>
                  <th>Receiver</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>"; 
     if (mysqli_num_rows($result) > 0) {               
        while($row = mysqli_fetch_assoc($result)) {
          $senderData=getCustomerinfo($row['trns_sender']);
          $receiverData=getCustomerinfo($row['trns_receiver']);
           $output.="<tr>
                  <td>".$sno."</td>
                  <td>".date('d-m-Y',strtotime($row['trns_doc']))."</td>
                  <td>".$senderData['cli_name']."</td>
                  <td>".$receiverData['cli_name']."</td>
                  <td>₹ ".number_format($row['trns_amt'])."</td>
                  <td>".$row['trns_status']."</td>
                </tr>";
                $sno++;
          }
        } else {
          $output.="<tr><td colspan='5'>No Data</td></tr>";
        }
        $output.="</tbody></table>";
          $data['status']="success";
          $data['message']=$output;
        
    break;
  // show customer data end 


    // show total customer data start 
  case "showtotalcustomer":
     $sql = "SELECT * FROM `client_tbl` WHERE cli_status='ACTIVE'";
     $result = mysqli_query($conn, $sql);
          $data['status']="success";
          $data['message']=mysqli_num_rows($result);
    break;
  // show total customer data end  

  // show total transection data start 
  case "showtotaltransection":
     $sql = "SELECT * FROM `transfer_tbl` WHERE trns_status='SUCCESS'";
     $result = mysqli_query($conn, $sql);
          $data['status']="success";
          $data['message']=mysqli_num_rows($result);
    break;
  // show total transection data end 

// show total transection data start 
  case "showtodaystransection":
    $todayDate=date("Y-m-d");
     $sql = "SELECT * FROM `transfer_tbl` WHERE trns_doc LIKE '%".$todayDate."%'";
     $result = mysqli_query($conn, $sql);
          $data['status']="success";
          $data['message']=mysqli_num_rows($result);
    break;
  // show total transection data end 


  default:
        $data['status']="notfound";
        $data['message']="Action Not Found!!!";
    break;
}



echo json_encode($data);
?>