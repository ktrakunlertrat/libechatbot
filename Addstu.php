<?php
   session_start();

   // ตรวจสอบว่ามีการล็อกอินหรือไม่
   if (!isset($_SESSION['username'])) {
       header("Location: login.php");
       exit();
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Thesis  </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        
        
        
        <nav class= " navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <img src="ass/NULOGO-Download-297x300.png" alt="logo" width="50" height="50">
                <a class="nav-item nav-link active" href="Homepage.php">Home</a>
                <a class="nav-item nav-link" href="Scanner.php">เช็คชื่อ</a>
                <a class="nav-item nav-link" href="Addstu.php">เพิ่มนักเรียนลงระบบ</a>
                <a class="nav-item nav-link" href="Updatestu.php">แก้ไขนักเรียนในระบบ</a>
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
    <body background="ass/Backbround.png">
        <h3>เพิ่มข้อมูลนักเรียน</h3>
        <form action="store_addstu.php" method="post">
            <label for="firstName">ชื่อ:</label>
            <input type="text" id="firstName" name="firstName" required><br><br>
        
            <label for="lastName">นามสกุล:</label>
            <input type="text" id="lastName" name="lastName" required><br><br>
        
            <label for="studentID">รหัสนักเรียน:</label>
            <input type="text" id="studentID" name="studentID" required><br><br>
        
            <input type="submit" value="เพิ่มข้อมูล">
            <br></br>
            <a href="Homepage.php">Back to Main Page</a>
        </form>
    </body>
</html>
