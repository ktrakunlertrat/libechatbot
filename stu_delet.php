<?php
include 'db_connection.php';
$conn = createDBConnection();

header("Location: show_stu.php");
//header =  กลับไปหน้าเดิม
$id = $_GET['studentID'];

if (isset($_GET['studentID'])) {
    $id = $_GET['studentID'];
    
    // ตรวจสอบค่า studentID ว่ามีค่าหรือไม่
    if (!empty($id)) {
        // ทำการเชื่อมต่อฐานข้อมูล
        $conn = createDBConnection();

        $sql = "DELETE FROM students WHERE studentID='$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
            echo "<script>window.location='show_stu.php';</script>";
        } else {
            echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
        }

        mysqli_close($conn);
    } else {
        echo "<script>alert('ค่า studentID ไม่ถูกส่งมาใน URL');</script>";
    }
} else {
    echo "<script>alert('ไม่พบค่า studentID ใน URL');</script>";
}

mysqli_close($conn);


?>