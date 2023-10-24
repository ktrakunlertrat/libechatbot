<?php
include 'db_connection.php';

// เชื่อมต่อฐานข้อมูล 
$conn = createDBConnection();

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

// แสดงข้อมูลนับในรูปแบบของกราฟ หรือตามที่คุณต้องการ
// คำสั่ง JavaScript สร้างกราฟ อาจต้องใส่ในนี้
// ตรวจสอบว่ามีข้อมูลที่เราต้องการสร้างกราฟหรือไม่
if ($totalStudents >= 0 && $checkedCount >= 0 && $missingCount >= 0) {
    // เริ่มส่วนของ JavaScript สร้างกราฟ
    echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
    echo '<canvas id="myChart"></canvas>';
    echo '<script>
        var ctx = document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["นักเรียนทั้งหมด", "นักเรียนที่เช็คชื่อ", "นักเรียนที่ขาด"],
                datasets: [{
                    label: "จำนวนคน",
                    data: [' . $totalStudents . ', ' . $checkedCount . ', ' . $missingCount . '],
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(255, 206, 86, 0.2)"
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(255, 206, 86, 1)"
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
    </script>';
    // สิ้นสุดส่วนของ JavaScript
} else {
    echo 'ไม่มีข้อมูลที่เพียงพอสำหรับการสร้างกราฟ';
}


?>
