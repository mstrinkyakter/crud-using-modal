<?php
include 'connect.php';
if(isset($_POST['displaySend'])){
  $table='<table class="table">
  <thead class="table-dark">
    <tr>
      <th scope="col">Sl no</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Place</th>
      <th scope="col">Operations</th>
    </tr>
   
  </thead>';

  $sql="select* from `boostrap_crud`";
  $result=mysqli_query($conn,$sql);
  $number=1;
  while($row=mysqli_fetch_assoc($result)){
    $id=$row['Id'];
    $name=$row['name'];
    $email=$row['email'];
    $mobile=$row['mobile'];
    $place=$row['place'];
    $table.=' <tr>
    <td scope="row">'.$number.'</td>
    <td>'.$name.'</td>
    <td>'.$email.'</td>
    <td>'.$mobile.'</td>
    <td>'.$place.'</td>
    <td>
    <button class="btn btn-dark" onclick="getDetails('.$id.')">Update</button>
     <button class="btn btn-danger" onclick="deleteUser('.$id.')">Delete</button>
    </td>
  </tr>';
  $number++;
  }
  $table.='</table>';
  echo $table;
}
?>

