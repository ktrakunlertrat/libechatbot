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

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == 'admin') {
            header("Location: index.php");
        } else {
            header("Location: user_index.php");
        }
    } else {
        // ล็อกอินไม่สำเร็จ
        echo "<script>alert('ใส่รหัสผ่านผิด หรือรหัสผ่านไม่มีในระบบ');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
    }
}

mysqli_close($conn);
?>
