<?php
   session_start();
  // ตรวจสอบว่ามีการล็อกอินหรือไม่
  if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include 'db_connection.php';

// เชื่อมต่อฐานข้อมูล
$conn = createDBConnection();

// ตรวจสอบว่ามีข้อมูลจากฟอร์มหรือไม่
if (isset($_POST['startTimestamp']) && isset($_POST['endTimestamp'])) {
    // รับช่วงเวลาจากฟอร์ม
    $startTimestamp = $_POST['startTimestamp'];
    $endTimestamp = $_POST['endTimestamp'];

    // นับจำนวนนักเรียนทั้งหมด
    $sqlTotal = "SELECT COUNT(*) AS totalStudents FROM students";
    $resultTotal = mysqli_query($conn, $sqlTotal);
    $rowTotal = mysqli_fetch_assoc($resultTotal);
    $totalStudents = $rowTotal['totalStudents'];

    // นับจำนวนนักเรียนที่เช็คชื่อในช่วงเวลา
    $sqlChecked = "SELECT COUNT(DISTINCT studentID) AS checkedCount FROM checklistdata WHERE created_at BETWEEN '$startTimestamp' AND '$endTimestamp'";
    $resultChecked = mysqli_query($conn, $sqlChecked);
    $rowChecked = mysqli_fetch_assoc($resultChecked);
    $checkedCount = $rowChecked['checkedCount'];

    // นับจำนวนนักเรียนที่ขาดในช่วงเวลา
    $missingCount = $totalStudents - $checkedCount; // คำนวณจากข้อมูลที่มี
}
?>



<!DOCTYPE html>
<html>
    <head>
    
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> NCS  </title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        
        <nav class= " navbar navbar-expand-lg">
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

            <a class="nav-item nav-link" href="stu_stat.php"> สถิติ (current)</a>
            
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
    <div class="container">

   

    <form method="post" action="stu_stat.php">
    <label for="startTimestamp">เริ่มต้นช่วงเวลา:</label>
    <input type="datetime-local" name="startTimestamp" id="startTimestamp" required>

    <label for="endTimestamp">สิ้นสุดช่วงเวลา:</label>
    <input type="datetime-local" name="endTimestamp" id="endTimestamp" required>

    <button type="submit">ค้นหา</button>
    </form>

    <!-- ส่วนการแสดงกราฟ --> <br>
    <div class="row">
            <div class="col-md-6">
            <canvas id="myChart" style="width: 50%; height: auto;"></canvas>
    </div>
        </div> 

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['นักเรียนทั้งหมด', 'นักเรียนที่เช็คชื่อ', 'นักเรียนที่ขาด'],
                datasets: [{
                    label: 'จำนวนคน',
                    data: [<?= $totalStudents ?>, <?= $checkedCount ?>, <?= $missingCount ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(60, 179, 113, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    
 



    
    </div>
</body>

</html>
