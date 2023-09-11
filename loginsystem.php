<?php
include 'db_connection.php';

session_start();

// เชื่อมต่อฐานข้อมูล
$conn = createDBConnection();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ตรวจสอบข้อมูลจากฐานข้อมูล
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // ล็อกอินสำเร็จ
        $_SESSION['username'] = $username;
        header("Location: index.php"); // ส่งไปหน้า dashboard หรือหน้าที่คุณต้องการ
    } else {
        // ล็อกอินไม่สำเร็จ
        echo "Invalid username or password";
    }
}

mysqli_close($conn);
?>
