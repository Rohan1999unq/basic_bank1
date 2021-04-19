
<?php 
if(empty($_GET['i'])){
    header("Location: customers.php");
    exit();
}
    require_once('include/header.php');
    require_once('include/navbar.php');
?>
<div class="container" style="height: 950px;">
  <div class="row mt-3">
    <div class="col-md-2"></div>
    <div class="col-md-8">

       <div class="card">
      <div class="card-header bg-primary"><h5 class="text-light">Customer Info</h5></div>
      <div class="card-body">
        <span id="customerinfo"></span>
      </div>
    </div>

      <div class="card mt-4">
      <div class="card-header bg-primary"><h5 class="text-light">Transfer Amount</h5></div>
      <div class="card-body">
        <span id="customerinfo"></span>
       <form action="" method="POST" onsubmit="return transfermoney(this)" id="transferform">
            <div class="form-group">
              <label>Send money to:</label>
              <select class="form-control" name="receiverby" id="receiverby">
                <option>Select Receiver Name</option>
              </select>
              <input type="hidden" class="form-control" name="sendby" value="<?php echo $_GET['i']?>">
            </div>
             <div class="form-group">
              <label>Amount:</label>
              <input type="Number" class="form-control" name="trns_amt" id="trns_amt" placeholder="e.g 1000" >
            </div>
            <div class="form-group">
              <label>Message:</label>
              <textarea class="form-control" rows="2" name="trns_msg" id="trns_msg" id="comment"></textarea>
            </div>
            <input type="hidden" class="form-control" name="action" value="transferamount">
            <button type="submit" class="btn btn-primary">Send Money</button>
          </form>
      </div>
    </div>
  </div>
    <div class="col-md-2"></div>
  </div>
</div>
<?php 
    require_once('include/footer.php');
?>
<script type="text/javascript">
          function loadcustomerlist() {
                 $.ajax({
                  url: "include/controller.php",
                  type: "POST",
                  data: {'action':'listcustomer','customer':<?php echo $_GET['i']?>},
                  success: function (data) {
                    responece=JSON.parse(data);
                    $('#receiverby').html(responece.message);
                  }
              });
          }
    loadcustomerlist();

      function loadcustomerinfo() {
                 $.ajax({
                  url: "include/controller.php",
                  type: "POST",
                  data: {'action':'infocustomer','customer':<?php echo $_GET['i']?>},
                  success: function (data) {
                    responece=JSON.parse(data);
                    $('#customerinfo').html(responece.message);
                  }
              });
          }
    loadcustomerinfo();



        function transfermoney(form) {
      // alert("okk working");
      var formData = new FormData(form);
      $.ajax({
          url: "include/controller.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function (data) {
            responece=JSON.parse(data);
              if(responece.status=='success'){
                  swal({
                      title: "Success!",
                      text: responece.message,
                      icon: "success",
                      button: "Close",
                    });                 
                 $('#transferform')[0].reset();
              }else{
                  swal({
                      title: "Failed!",
                      text: responece.message,
                      icon: "error",
                      button: "Close",
                    });
              }
          }
      });
      return false;
  }
   
</script>