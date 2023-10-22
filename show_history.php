<?php
session_start();
include 'function.php';
include 'db_connection.php';
$conn = createDBConnection();

// ตรวจสอบว่ามีการล็อกอินหรือไม่
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

//ไม่แสดงข้อความ warning บนเว็บไซต์
error_reporting(1);


?>
<!DOCTYPE html>
<html>
  
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> NCS  </title>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

       
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
                <a class="nav-item nav-link" href="show_history.php">ประวัติการเข้าเรียน (current) </a>
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
                    <div class="row justify-content-md-center">
                    <div class="container py-5">   <br>
                   
                     <div class="col-md-auto">
                    <h1 class="text-center" style="color: black;">ประวัติการเข้าเรียน</h1><br>
                    </div>

        

            <div class="container-xxl">
             <div class="row">
                  
            <div class="col">
            <!-- ส่วนของแนวคอลัมที่ 1 -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="selected_date">กรอกวันที่ (รูปแบบ: YYYY-MM-DD):</label>
                <input type="text" id="selected_date" name="selected_date" placeholder="ป้อนวันที่">
                <button type="submit">ค้นหา</button> <br><br>
        </form>              

            <!-- การนำแสดงข้อมูลมาแสดงโชว์ในช่องค้นหา เดือนปี วันเดือนปี เดือน 
            v1 -> ทำการค้นหาได้แค่ วันเดือนปี v2 bug v3 bug (v4*ใช้ตอนนี้)  -->      
            <?php
                

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // รับค่าวันที่จากแบบฟอร์ม
                    $selected_date = $_POST["selected_date"];

                    // แสดงวันที่ที่ผู้ใช้เลือก
                    echo "<p>ข้อมูลสำหรับ : $selected_date</p";

                    $filteredData = array();

                    if (strpos($selected_date, '-') !== false) {
                        // ถ้าวันที่มีเครื่องหมาย - แสดงว่าผู้ใช้เลือกเดือน-ปี หรือวัน-เดือน-ปี
                        if (strlen($selected_date) === 7) {
                            // ถ้าความยาวเป็น 7 ตัวอักษร แสดงว่าเป็นเดือน-ปี
                            $filteredData = filterDataByMonthYear($selected_date, $conn);
                        } elseif (strlen($selected_date) === 10) {
                            // ถ้าความยาวเป็น 10 ตัวอักษร แสดงว่าเป็นวัน-เดือน-ปี
                            $filteredData = filterDataByFullDate($selected_date, $conn);
                        }
                    } else {
                        // ถ้าไม่มีเครื่องหมาย - แสดงว่าผู้ใช้เลือกปี
                        $filteredData = filterDataByYear($selected_date, $conn);
                    }

                    if (empty($filteredData)) {
                        // ไม่พบข้อมูลสำหรับวันที่ที่ผู้ใช้เลือก
                        echo "<p>ไม่พบข้อมูลสำหรับ : $selected_date</p>";
                    } else {
                        // เรียกใช้ฟังก์ชันแสดงข้อมูลนักเรียน
                        displayStudentData($filteredData);
                        
                        

                    }
                }
            ?>





         

    </div>

    <div class="col ">
      <!-- ส่วนของแนวคอลัมที่ 2 -->
      <br>
                                <form method="post" action="">
                            <label for="student_id">ค้นหา Student ID:</label>
                            <input type="text" name="student_id">
                            <input type="submit" value="ค้นหา">
                            </form>

                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    // รับค่า Student ID จากแบบฟอร์ม
                                    $student_id = $_POST["student_id"];

                                    // แสดง Student ID ที่ผู้ใช้ค้นหา
                                    echo "<p>Student ID ที่คุณค้นหา: $student_id</p>";

                                    $checkData = getCheckDataByStudentID($student_id, $conn);

                                    if (!empty($checkData)) {
                                        // แสดงข้อมูลการเช็คชื่อของ Student ID ที่ค้นหา
                                        echo "<h2>รายการการเช็คชื่อของ Student ID: $student_id</h2>";
                                        echo "<p>จำนวนยอด: " . count($checkData) . "</p>";
                                        echo "<ul>";
                                        foreach ($checkData as $check) {
                                            $checkDateTime = $check["created_at"];
                                            echo "<li>วันที่เช็คชื่อ: $checkDateTime</li>";
                                        }
                                        echo "</ul>";
                                    } else {
                                        echo "ไม่พบข้อมูลการเช็คชื่อสำหรับ Student ID: $student_id";
                                    }
                                }
                            ?>
                            
    </div>
    <div class="col ">
      <!-- ส่วนของแนวคอลัมที่ 3 -->
      <br>
                                <button id="showChecklistButton">Show Checklist</button> กดซ้ำเพื่อ ล่าสุด/เก่าสุด
                        <table class="table" id="checklistTable" style="display: none;">
                            <thead>
                                <tr>
                                    <th class="col-1">รหัสนิสิต</th>
                                    <th class="col-1">เวลา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM checklistdata ORDER BY created_at DESC";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)):
                                ?>
                                <tr>
                                    <td><?php echo $row['studentID']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                       
            
                        <script>
                            var checklistTable = document.getElementById('checklistTable');
                            var sortOrder = 'desc';

                            document.getElementById('showChecklistButton').addEventListener('click', function () {
                                if (sortOrder === 'desc') {
                                    sortOrder = 'asc';
                                    checklistTable.style.display = 'none';
                                    // ลดลำดับของข้อมูลแถว
                                    var rows = Array.from(checklistTable.querySelectorAll('tbody tr'));
                                    rows.sort(function (a, b) {
                                        var aDate = new Date(a.cells[1].textContent);
                                        var bDate = new Date(b.cells[1].textContent);
                                        return sortOrder === 'asc' ? aDate - bDate : bDate - aDate;
                                    });
                                    var tbody = checklistTable.querySelector('tbody');
                                    tbody.innerHTML = '';
                                    rows.forEach(function (row) {
                                        tbody.appendChild(row);
                                    });
                                    checklistTable.style.display = 'table';
                                } else {
                                    sortOrder = 'desc';
                                    checklistTable.style.display = 'none';
                                    // เรียงลำดับของข้อมูลแถว
                                    var rows = Array.from(checklistTable.querySelectorAll('tbody tr'));
                                    rows.sort(function (a, b) {
                                        var aDate = new Date(a.cells[1].textContent);
                                        var bDate = new Date(b.cells[1].textContent);
                                        return sortOrder === 'asc' ? aDate - bDate : bDate - aDate;
                                    });
                                    var tbody = checklistTable.querySelector('tbody');
                                    tbody.innerHTML = '';
                                    rows.forEach(function (row) {
                                        tbody.appendChild(row);
                                    });
                                    checklistTable.style.display = 'table';
                                }
                                // อัปเดตแสดงจำนวนยอด
                                var recordCount = rows.length;
                                document.getElementById('recordCount').textContent = 'จำนวนยอดทั้งหมด: ' + recordCount;
                            });
                        </script>
    </div>
  </div>
</div>

</html>