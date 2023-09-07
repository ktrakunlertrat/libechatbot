<?php
include 'db_connection.php';
header("Location: index.php");
//header =  กลับไปหน้าเดิม
$studentID = $_POST['studentID'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
  //  $gender = $_POST['gender'];
  // $birth = $_POST['birth'];
  //  $faculty = $_POST['faculty'];
  //  $branch = $_POST['branch'];
  //  $phone = $_POST['phone'];
  //  $email = $_POST['email'];
  //  $address = $_POST['address'];


$sql = "UPDATE students SET 
firstname = '$fname',
lastname = '$lname',

WHERE studentID='$studentID' ";

$result = mysqli_query($conn,$sql);

if($result){
    echo "Data updated successfully.";
    echo "<script>alert('อัพเดทข้อมูลเรียบร้อย');</script>";
    echo "<script>window.location='stu_show.php';</script>";
}else{
    echo "Error updating data: " . mysqli_error($conn);
    echo "<script>alert('ไม่สามารถอัพเดทข้อมูลได้');</script>";
}

mysqli_close($conn);

?>