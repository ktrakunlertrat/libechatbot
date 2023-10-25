<?php
   session_start();

   // ตรวจสอบว่ามีการล็อกอินหรือไม่
   if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> NCS  </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        
        
        
        <nav class= " navbar navbar-expand-lg navbar-light" >
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <img src="ass/NULOGO-Download-297x300.png" alt="logo" width="50" height="50">
            
            <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="scanner.php">เช็คชื่อ</a>
            <a class="nav-item nav-link" href="show_stu.php">ข้อมูลนักเรียนในระบบ</a>
            <a class="nav-item nav-link" href="show_history.php">ประวัติการเข้าเรียน</a>
            <a class="nav-item nav-link" href="stu_stat.php">สถิติ</a>
            <a class="nav-item nav-link" href="page_addrole.php">เพิ่มบทบาท</a>
            <a class="nav-item nav-link" href="logout.php">Logout</a>
               
            </div>
            </div>
          </nav>

          <style>
            body.logo{
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100vh;
              opacity: 50%;
            }
          </style>

    </head>
    <body background="ass/Background.png">
      <h3>เช็คชื่อ</h3>
      -ใช้สำหรับเช็คชื่อด้วย Barcode Scanner
      <br></br>
      <h3>ข้อมูลนักเรียนในระบบ</h3>
      -ใช้สำหรับเพิ่มและแก้ไขข้อมูลนักเรียนในระบบฐานข้อมูล
      <br></br>
      <h3>ประวัติการเข้าเรียน</h3>
      -ใช้สำหรับตรวจสอบประวัติการเข้าเรียน
      <br></br>
      <h3>เพิ่มบทบาท</h3>
      -ใช้สำหรับเพิ่มผู้ใช้งาน
    </body>
</html>
