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
            
            <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>

            <a class="nav-item nav-link" href="scanner.php">เช็คชื่อ</a>
            
            <a class="nav-item nav-link" href="show_stu.php">ข้อมูลนักเรียนในระบบ</a>

            <a class="nav-item nav-link" href="show_history.php">ประวัติการเข้าเรียน</a>

            <a class="nav-item nav-link" href="show_chart.php">กราฟ (current)</a>
            
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <body background="ass/Background.png">
      
      <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>
      
        <script>
        const xValues1 = ["จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์"];
        const yValues1 = [55, 49, 44, 24, 15];
        const barColors1 = ["red", "green","blue","orange","brown"];

        new Chart("myChart", {
          type: "bar",
          data: {
            labels: xValues1,
            datasets: [{
              backgroundColor: barColors1,
              data: yValues1
            }]
          },
          options: {
            legend: {display: false},
            title: {
              display: true,
              text: "กราฟการเข้าเรียน"
            }
          }
        });
        </script>

    </body>
</html>
