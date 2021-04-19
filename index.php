<?php 
    require_once('include/header.php');
    require_once('include/navbar.php');
?>
<div class="container">
  <h3 class="text-center mt-5 mb-5" style="font-family: 'Alata';color: #f39766;">WELCOME TO SPARX BANK- MONEY FOR LIFE</h3>
  <div class="row mt-3">
    <div class="col-md-4">
      <div class="card">
      <div class="card-body">
        <p>Total Customer &nbsp;<a href="customers.php" class="btn btn-sm btn-primary">Visit</a></p>
        <h5 id="totalCustomer"></h5>
        
      </div>
    </div>
  </div>
  <div class="col-md-4">
      <div class="card">
      <div class="card-body">
        <p>Total Transection</p>
        <h5 id="totalTransection"></h5>
      </div>
    </div>
  </div>
  <div class="col-md-4">
      <div class="card">
      <div class="card-body">
        <p>Todays Transection</p>
        <h5 id="todayTransection"></h5>
      </div>
    </div>
  </div>

  </div>
</div>
<?php 
    require_once('include/footer.php');
?>

<script type="text/javascript">
    function totalTransection() {
                 $.ajax({
                  url: "include/controller.php",
                  type: "POST",
                   data: {'action':'showtotaltransection'},
                  success: function (data) {
                    // console.log("showtotaltransection "+data);
                    responece=JSON.parse(data);
                    $('#totalTransection').html(responece.message);
                  }
              });
          }
    totalTransection();
    function totalCustomer() {
                 $.ajax({
                  url: "include/controller.php",
                  type: "POST",
                   data: {'action':'showtotalcustomer'},
                  success: function (data) {
                    // console.log("showtotalcustomer "+data);
                    responece=JSON.parse(data);
                    $('#totalCustomer').html(responece.message);
                  }
              });
          }
    totalCustomer();
    function todaysTransection() {
                 $.ajax({
                  url: "include/controller.php",
                  type: "POST",
                   data: {'action':'showtodaystransection'},
                  success: function (data) {
                    // console.log("showtodaystransection "+data);
                    responece=JSON.parse(data);
                    $('#todayTransection').html(responece.message);
                  }
              });
          }
    todaysTransection();


   
</script>