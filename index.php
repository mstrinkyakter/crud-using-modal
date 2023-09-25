<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Operation using Modal</title>
    <!-- boostrap css  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

  

<!-- Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
           <label for="completename" class="form-label">Name</label>
           <input type="email" class="form-control" id="completename" placeholder="Enter Your Name">
        </div>
        <div class="mb-3">
           <label for="completeemail" class="form-label">Email</label>
           <input type="text" class="form-control" id="completeemail" placeholder="Enter Your Email">
        </div>
        <div class="mb-3">
           <label for="completemobile" class="form-label">Mobile</label>
           <input type="email" class="form-control" id="completemobile" placeholder="Enter Your Mobile">
        </div>
        <div class="mb-3">
           <label for="completeplace" class="form-label">Place</label>
           <input type="email" class="form-control" id="completeplace" placeholder="Enter Your Place">
        </div>
        
       
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-dark" onclick='adduser()'>Submit</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

<!-- update modal  -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
           <label for="updatename" class="form-label">Name</label>
           <input type="email" class="form-control" id="updatename" placeholder="Enter Your Name">
        </div>
        <div class="mb-3">
           <label for="updateemail" class="form-label">Email</label>
           <input type="text" class="form-control" id="updateemail" placeholder="Enter Your Email">
        </div>
        <div class="mb-3">
           <label for="updatemobile" class="form-label">Mobile</label>
           <input type="email" class="form-control" id="updatemobile" placeholder="Enter Your Mobile">
        </div>
        <div class="mb-3">
           <label for="updateplace" class="form-label">Place</label>
           <input type="email" class="form-control" id="updateplace" placeholder="Enter Your Place">
        </div>
        
       
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-dark" onclick='updateDetails()'>Update</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="hidden" id="hiddendata">
      </div>
    </div>
  </div>
</div>

    <div class="container my-5">
        <h1 class="text-center">PHP CRUD Operation using Boostrap Modal</h1>
          <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark my-4" data-bs-toggle="modal" data-bs-target="#completeModal">
         Add New Users</button>
         <div id="displayDataTable"></div>
    </div>
    <!-- jquery cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- boostrap js  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>

$(document).ready(function(){
  displayData();
})
function displayData(){
  var displayData="true";
  $.ajax({
    url:"display.php",
    type:'post',
    data:{
      displaySend:displayData
    },
    success:function(data,status){
        $('#displayDataTable').html(data);
    }
  });
}

  function adduser(){
    var nameAdd=$('#completename').val();
    var emailAdd=$('#completeemail').val();
    var mobileAdd=$('#completemobile').val();
    var placeAdd=$('#completeplace').val();

    $.ajax({
      url:"insert.php",
      type:'post',
      data:{
        nameSend:nameAdd,
        emailSend:emailAdd,
        mobileSend:mobileAdd,
        placeSend:placeAdd
      },
      success:function(data,status){
        $('#completeModal').modal('hide');
        displayData();
      }

    });
  }

  function deleteUser(deleteid){
    $.ajax({
      url:"delete.php",
      type:'post',
      data:{
        deleteSend:deleteid
      },
      success:function(data,status){
        displayData();
      }
    })
  }

  function getDetails(updateid){
    $('#hiddendata').val(updateid);

    $.post("update.php",{updateid:updateid},function(data,status){
    var userid=JSON.parse(data);
    $('#updatename').val(userid.name);
    $('#updateemail').val(userid.email);
    $('#updatemobile').val(userid.mobile);
    $('#updateplace').val(userid.place);
    });
   $('#updateModal').modal("show");
  }

  function updateDetails(){
    var updatename=$('#updatename').val();
    var updateemail=$('#updateemail').val();
    var updatemobile=$('#updatemobile').val();
    var updateplace=$('#updateplace').val();
    var hiddendata=$('#hiddendata').val();

    $.post("update.php",{
      updatename:updatename,
      updateemail:updateemail,
      updatemobile:updatemobile,
      updateplace:updateplace,
      hiddendata:hiddendata
    },function(data,status){
      $('#updateModal').modal('hide');
      displayData();
    });
  }
</script>
</body>
</html>