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
        <title> NCS  </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        
        
        
        <nav class= " navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                 
                <img src="ass/NULOGO-Download-297x300.png" alt="logo" width="50" height="50">

                <a class="nav-item nav-link active" href="index.php">Home</a>
                <a class="nav-item nav-link" href="scanner.php">เช็คชื่อ (current) </a>
               
                <a class="nav-item nav-link" href="show_stu.php">ข้อมูลนักเรียนในระบบ</a>
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
        <form action="store_scanned.php" method="post">
            <label for="scannerInput">Scan Value:</label>
            <input type="text" id="scannerInput" name="scannerInput" autofocus>
            <button type="submit">Submit</button>
          </form>
          <br>
          <a href="index.php">Back to Main Page</a>
    </body>
</html>