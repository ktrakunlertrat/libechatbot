<?php
include '../db_connection.php';
$conn = createDBConnection();

header("Location: ../show_stu.php");
//header =  กลับไปหน้าเดิม
$id = $_GET['studentID'];


$sql = "DELETE FROM students WHERE studentID='$id' ";
$result = mysqli_query($conn,$sql);



if($result){
    echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
    echo "<script>window.location='show_stu.php';</script>";
}else{
    echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
}

mysqli_close($conn);

?>