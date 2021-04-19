<?php 
    require_once('include/header.php');
    require_once('include/navbar.php');
?>
<div class="container">
  <div class="row mt-3">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="card">
      <div class="card-header bg-primary"><h5 class="text-light">Create Customers</h5></div>
      <div class="card-body">
        <form action="" method="POST" onsubmit="return insertdata(this)" id="customerform">
            <div class="form-group">
              <label>Customer Name:</label>
              <input type="text" class="form-control" name="cus_name" id="cus_name" placeholder="e.g Jhon Deo" required="">
            </div>  
            <div class="form-group">
              <label>Customer Email:</label>
              <input type="email" class="form-control" name="cus_mail" id="cus_mail" placeholder="e.g jhondeo@email.com" required="">
            </div>
             <div class="form-group">
              <label>Deposit Amount:</label>
              <input type="Number" class="form-control" name="cus_amt" id="cus_amt" placeholder="e.g 1000" required="">
            </div>
            <input type="hidden" class="form-control" name="action" id="action" value="addcustomer">
            <button type="submit" class="btn btn-primary">Create Customer</button>
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

    function insertdata(form) {
      // alert("okk working");
      var formData = new FormData(form);
      $.ajax({
          url: "include/controller.php",
          type: "POST",
          data: formData,
          // cache: false,
          contentType: false,
          // contentType: 'multipart/form-data',
          processData: false,
          success: function (data) {
            responece=JSON.parse(data);
              // console.log(responece.status);
              if(responece.status=='success'){
                  swal({
                      title: "Success!",
                      text: "Account has been created successfully!",
                      icon: "success",
                      button: "Close",
                    });                 
                 $('#customerform')[0].reset();
              }else{
                  swal({
                      title: "Failed!",
                      text: "Sorry, Account not created please try again!",
                      icon: "error",
                      button: "Close",
                    });
              }
          }
      });
      return false;
  }

   
</script>