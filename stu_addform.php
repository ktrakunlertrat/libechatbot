<?php
include 'db_connection.php';
$conn = createDBConnection();
?>

<?php
   session_start();

   // ตรวจสอบว่ามีการล็อกอินหรือไม่
   if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}


// อัพเดตล่าสุด เพิ่มการใช้งาน phpspreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file'])) {
  $file = $_FILES['excel_file']['tmp_name'];
  $spreadsheet = IOFactory::load($file);
  $worksheet = $spreadsheet->getActiveSheet();

  // สร้างการเชื่อมต่อกับฐานข้อมูล MySQL
  $conn = createDBConnection();

  if (!$conn) {
      die('การเชื่อมต่อกับฐานข้อมูลล้มเหลว');
  }

  // ลูปผ่านข้อมูลใน Excel และบันทึกลงในฐานข้อมูล
  foreach ($worksheet->getRowIterator() as $row) {
      $rowData = $row->getCellIterator();
      $studentID = $rowData->current()->getValue();
      $rowData->next();
      $firstName = $rowData->current()->getValue();
      $rowData->next();
      $lastName = $rowData->current()->getValue();

              // ตรวจสอบว่า studentID ไม่ซ้ำกันก่อนที่จะทำการบันทึก
        $query = "SELECT studentID FROM students WHERE studentID = ?";
        $stmt_check = $conn->prepare($query);
        $stmt_check->bind_param('i', $studentID);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            // ถ้า studentID ซ้ำกันแล้ว ให้ทำการอัปเดตหรือจัดการตามที่คุณต้องการ
            $query = "UPDATE students SET firstName = ?, lastName = ? WHERE studentID = ?";
            $stmt_update = $conn->prepare($query);
            $stmt_update->bind_param('ssi', $firstName, $lastName, $studentID);

            if ($stmt_update->execute()) {
                echo "อัปเดตข้อมูลสำเร็จ: Student ID: $studentID, First Name: $firstName, Last Name: $lastName<br>";
            } else {
                echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $stmt_update->error;
            }
        } else {
            // ถ้า studentID ไม่ซ้ำกัน ให้ทำการเพิ่มข้อมูล
            $query = "INSERT INTO students (studentID, firstName, lastName) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('iss', $studentID, $firstName, $lastName);

            if ($stmt->execute()) {
                echo "บันทึกข้อมูลสำเร็จ: Student ID: $studentID, First Name: $firstName, Last Name: $lastName<br>";
            } else {
                echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $stmt->error;
            }
        }
      }
    }

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
                
                <a class="nav-item nav-link" href="show_stu.php">ข้อมูลนักเรียนในระบบ (current) </a>
                <a class="nav-item nav-link" href="show_history.php">ประวัติการเข้าเรียน</a>
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
            <h1 class="text-center" style="color: #fe965a;">เพิ่มข้อมูลนิสิต</h1><br>
        </div>
        <div class="row justify-content-md-center">
            <div class="col col-lg-2"></div>
            <div class="col-md-auto">

            <form action="stu_add.php" method="post">

                <label style="color: #fe965a;">รหัสนิสิต</label>
                <input type="text" name="studentID" required><br>
                <br>
                <label style="color: #fe965a;">ชื่อ</label>
                <input type="text" name="firstName" required>

                <label style="color: #fe965a;">นามสกุล</label>
                <input type="text" name="lastName" required>

              
                <br>

               
                <br>
                
                <button style="color: white;" class="btn btn-success" type="submit" name="submit" value="submit">บันทึกข้อมูล</button>
                <a href="show_stu.php" class="btn btn-danger">Cancel</a>
            </form>
</div>

<br>
<br>
<br>
<div class="row justify-content-md-center">
<div class="col col-lg-2"></div>
<div class="col-md">
  นำเข้าด้วยไฟล์ Excel
      <form method="post" enctype="multipart/form-data">
              <input type="file" name="excel_file">
              <input type="submit" value="นำเข้า Excel">
      </form>
</div>
</div>
</div>

<?php mysqli_close($conn); ?>


</body>



</html>