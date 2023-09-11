<?php

include 'db_connection.php';
$conn = createDBConnection();

header("Location: show_stu.php");
//header =  กลับไปหน้าเดิม
$studentID = $_POST['studentID'];
$fname = $_POST['firstName'];
$lname = $_POST['lastName'];



$sql = "UPDATE students SET 
firstName = '$fname',
lastName = '$lname'

WHERE studentID='$studentID' ";

$result = mysqli_query($conn,$sql);

if($result){
    echo "Data updated successfully.";
    echo "<script>alert('อัพเดทข้อมูลเรียบร้อย');</script>";
    echo "<script>window.location='show_stu.php';</script>";
}else{
    echo "Error updating data: " . mysqli_error($conn);
    echo "<script>alert('ไม่สามารถอัพเดทข้อมูลได้');</script>";
}

mysqli_close($conn);

?>