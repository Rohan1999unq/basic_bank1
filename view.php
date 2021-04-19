<?php 
    require_once('include/header.php');
    require_once('include/navbar.php');
?>
<div class="container">
  <div class="row mt-3">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card">
      <div class="card-header bg-primary"><h5 class="text-light">Transection Details</h5></div>
      <div class="card-body">
        <div class="table-responsive-sm" id="transectionData">
        </div>
      </div>
    </div>
  </div>
    <div class="col-md-1"></div>
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
                   data: {'action':'showlatesttransection','customer':<?php echo $_GET['i']?>},
                  success: function (data) {
                    responece=JSON.parse(data);
                    $('#transectionData').html(responece.message);
                  }
              });
          }
    loaddata();


   
</script>