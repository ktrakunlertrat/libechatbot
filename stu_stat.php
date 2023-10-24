<?php
   session_start();
  // ตรวจสอบว่ามีการล็อกอินหรือไม่
  if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();




   include 'function.php';
   include 'db_connection.php';

   $conn = createDBConnection();
}
?>


<!DOCTYPE html>
<html>
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
            
            <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>

            <a class="nav-item nav-link" href="scanner.php">เช็คชื่อ</a>
            
            <a class="nav-item nav-link" href="show_stu.php">ข้อมูลนักเรียนในระบบ</a>

            <a class="nav-item nav-link" href="show_history.php">ประวัติการเข้าเรียน</a>

            <a class="nav-item nav-link" href="stu_stat.php">กราฟ (current)</a>
            
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <body background="ass/Background.png">


    <form method="post" action="your_php_script.php">
        <label for="start_date">วันเริ่มต้น:</label>
        <input type="date" id="start_date" name="start_date" required>
      
        <label for="end_date">วันสิ้นสุด:</label>
        <input type="date" id="end_date" name="end_date" required>
      
        <input type="submit" value="ค้นหา">
    </form>
      
      
    <?php
            // ดึงข้อมูลจากตาราง students
        $sql = "SELECT studentID FROM students";
        $result = $conn->query($sql);


        $studentIDs = array(); // เก็บรายชื่อ studentID

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $studentIDs[] = $row["studentID"];
            }
        }

       
       
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $start_date = $_POST["start_date"];
          $end_date = $_POST["end_date"];
        
          // ตรวจสอบว่า $start_date และ $end_date ถูกต้องหรือไม่
        
          $sql = "SELECT studentID, COUNT(*) as absent_count FROM checklistdata
                  WHERE created_at BETWEEN '$start_date' AND '$end_date'
                  GROUP BY studentID";
          
          // ต่อ database และดำเนินการ query ได้เหมือนเดิม
          $result = $conn->query($sql);
        
          // ใช้ $result เพื่อดึงข้อมูลที่คุณต้องการ
        }
        
        




    ?>















    </body>
</html>
