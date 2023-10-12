<?php
include 'db_connection.php';
$conn = createDBConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> NCS  </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        
        
        
        <nav class= " navbar navbar-expand-lg">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">

                <img src="ass/NULOGO-Download-297x300.png" alt="logo" width="50" height="50">
                
                <a class="nav-item nav-link active" href="index.php">Home</a>
                <a class="nav-item nav-link" href="scanner.php">เช็คชื่อ</a>
                
                <a class="nav-item nav-link" href="show_stu.php">ข้อมูลนักเรียนในระบบ</a>
                <a class="nav-item nav-link" href="show_history.php">ประวัติการเข้าเรียน</a>
                <a class="nav-item nav-link" href="show_chart.php">กราฟ</a>
                <a class="nav-item nav-link" href="page_addrole.php">เพิ่มบทบาท (current)</a>
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

    <div class="container py-5">
        <br>
        <div class="col-md-auto">
            <h1 class="text-center" style="color: #fe965a;">เพิ่มบทบาท</h1><br>
        </div>
        <div class="row justify-content-md-center">
            <div class="col col-lg-2"></div>
            <div class="col-md-auto">

            <form action="store_addrole.php" method="post">

                <label style="color: #fe965a;">Username</label>
                <input type="text" name="username" required>

                <label style="color: #fe965a;">Password</label>
                <input type="password" name="password" required>
                
                <br>
                <input type="radio" id="user" name="role" value="user">
                <label for="user">User</label>
                <input type="radio" id="admin" name="role" value="admin">
                <label for="admin">Admin</label>

              
                <br>

               
                <br>
                
                <button style="color: white;" class="btn btn-success" type="submit" name="submit" value="submit">บันทึกข้อมูล</button>
                <a href="show_stu.php" class="btn btn-danger">Cancel</a>
            </form>
            
            <script>
              // ซ่อนฟิลด์ที่มี ID "hiddenField"
              document.getElementById("password").style.display = "none";
            </script>

            
</div>

<?php mysqli_close($conn); ?>

</body>

</html>