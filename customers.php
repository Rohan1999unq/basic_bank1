<?php
require_once('include/header.php');
require_once('include/navbar.php');
?>
<div class="container">
  <div class="row mt-3">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header bg-primary"><h5 class="text-light">Customers</h5></div>
        <div class="card-body">
          <div class="table-responsive-sm" id="customerdata">
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<?php
require_once('include/footer.php');
?>

<script type="text/javascript">
          function loaddata() {
                 $.ajax({
                  url: "include/controller.php",
                  type: "POST",
                  data: {'action':'showcustomer'},
                  success: function (data) {
                    responece=JSON.parse(data);
                    $('#customerdata').html(responece.message);
                  }
              });
          }
    loaddata();

      function deletedata(input) {
          var clientid=$(input).data('id');
          var permission = confirm("Do you want to delete?");
      if (permission == true) {
          $.ajax({
              url: "include/controller.php",
              type: "POST",
              data: {'action':'deletecustomer','client':clientid},
              success: function (data) {
                  responece=JSON.parse(data);
                if(responece.status=='success'){
                    swal({
                        title: "Success!",
                        text: "Account has been delete successfully!",
                        icon: "success",
                        button: "Close",
                      });                 
                }else{
                    swal({
                        title: "Failed!",
                        text: "Sorry, Account not delete please try again!",
                        icon: "error",
                        button: "Close",
                      });
                }
               loaddata();
              }
          });
      }

      }

   
</script>