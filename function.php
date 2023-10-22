<?php


// เช็คค่า value รับค่ามาต้องเป็น int ยังเดียว และก็ ต้องมี ขนาด 8 ถ้ามากกว่า หรือ เท่ากับ 14 ให้เอาตำแหน่งที่ 5 กับ 8
// สำหรับเช็ค บัตรนิสิต มน ของไฟล์ store_scanned
function extractDesiredValue($scannedValue, $valueLength) {
    return ($valueLength === 14) ? substr($scannedValue, 5, 8) : $scannedValue;
}




// ฟังก์ชั่นเรียกใช้งานเก็บข้อมูลลงตาราง Checklist ของ scanner       
// v1เพิมตาราง v2ส่งกลับไลน์ได้ v3ส่งคืนเวลา v4 ส่งคืนเวลา ณ เวลาล่าสุดได้
function insertDataIntoChecklist($conn, $escapedValue) {
    $insertDataSql = "INSERT IGNORE INTO checklistdata (studentID) VALUES ('$escapedValue')";

    if ($conn->query($insertDataSql) === TRUE) {
        $linkSelectQuery = "SELECT user_id FROM linelink WHERE studentID = '$escapedValue'";
        $linkResult = $conn->query($linkSelectQuery);

        if ($linkResult) {
            $linkRow = $linkResult->fetch_assoc(); // ดึงข้อมูล user_id ออกมา
            $user_id = $linkRow['user_id'];
 
            $replyUserTimeATQuery = "SELECT MAX(created_at) AS latest_created_at FROM checklistdata WHERE studentID = '$escapedValue'";
            $replyUserTimeATResult = $conn->query($replyUserTimeATQuery);
            
            if ($replyUserTimeATResult && $replyUserTimeATResult->num_rows > 0) {
                $replyUserTimeATRow = $replyUserTimeATResult->fetch_assoc();
                $replyUserTimeAT = $replyUserTimeATRow['latest_created_at'];
            
                // เตรียมข้อมูลสำหรับส่งไปยัง Line Messaging API
                $message = "Your ID is $escapedValue. เช็คชื่อแล้ว วันที่ $replyUserTimeAT";

                // เรียกใช้ฟังก์ชันส่งข้อความผ่าน Line Messaging API
                sendLineMessage($message, $user_id);

                // ทำการเปลี่ยนหน้าไปยัง scanner.html
                header("Location: scanner.php");
                exit(); // ออกจากการทำงานของฟังก์ชัน

            } else {
                return "เกิดข้อผิดพลาดในการดึงข้อมูล: " . $conn->error;
            }
        } else {
            return "เกิดข้อผิดพลาดในการดึงข้อมูล: " . $conn->error;
        }
    } else {
        return "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
    }
}


//// เมื่อสแกนเสร็จ ส่งข้อความกลับไปที่ studentID ... user_id ที่เก็บข้อมูล
function sendLineMessage($message, $user_id) {
    // กำหนด Channel Access Token ที่คุณได้รับจาก Line Developer
    $channelAccessToken = 'FPOOzuLqvy2eobZXRZY40CxYg2a8iTPrSwA83OqOKfwtvMGyFq7kQgYTw/0XK+XPdPG1tOP3SsBmmjdgiJJaVkp/1NIHRgy/a7gSoWvOZtyJO9dplcMLmrZ3jAdl6UywjL0tPRItFyr+EBJ+rk94gQdB04t89/1O/w1cDnyilFU=';

    // ข้อมูลที่ต้องการส่งไปยัง Line Messaging API
    $data = array(
        'to' => $user_id, // ค่า USER_ID ของผู้ใช้ Line Chat ที่คุณต้องการส่งข้อความถึง
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $message
            )
        )
    );

    // ตั้งค่า HTTP headers สำหรับส่งข้อมูลไปยัง Line Messaging API
    $headers = array(
        'Authorization: Bearer ' . $channelAccessToken,
        'Content-Type: application/json'
    );

    // ใช้ cURL เพื่อส่งข้อมูลไปยัง Line Messaging API
    $ch = curl_init('https://api.line.me/v2/bot/message/push');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    // ตรวจสอบค่าที่ได้จากการใช้งาน cURL
    // ถ้าส่งข้อความสำเร็จ ค่าที่ควรได้คือ string(0) ""
    var_dump($result);
   }



   
   function updateStudentData($conn, $studentID, $newFirstName, $newLastName) {
    // สร้างคำสั่ง SQL สำหรับการอัพเดตข้อมูล
    $sql = "UPDATE students SET firstName='$newFirstName', lastName='$newLastName' WHERE studentID='$studentID'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>setTimeout(function(){ window.location.href = 'Addstu.php'; }, 3000);</script>";
        return "อัพเดตข้อมูลนักเรียนเรียบร้อยแล้ว <br> กำลังกลับหน้าหลักเอง 5 วิ โปรดรอสักครู่";
    } else {
        return "เกิดข้อผิดพลาดในการอัพเดตข้อมูล: " . $conn->error;
    }
}


function getStudentsData($conn) {
    // SQL สำหรับดึงข้อมูลนักเรียน
    $sql = "SELECT * FROM students";
    
    // ทำการ query ข้อมูล
    $result = $conn->query($sql);

    // เช็คว่า query สำเร็จหรือไม่
    if (!$result) {
        die("เกิดข้อผิดพลาดในการ query: " . $conn->error);
    }

    // สร้างอาร์เรย์เพื่อเก็บข้อมูลนักเรียน
    $studentsData = array();

    // วนลูปเพื่อดึงข้อมูลแต่ละแถว
    while ($row = $result->fetch_assoc()) {
        $studentsData[] = $row;
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();

    // ส่งค่าอาร์เรย์ข้อมูลนักเรียนกลับ
    return $studentsData;
}



// ฟังก์ชันสำหรับดึงข้อมูลการเช็คชื่อโดยใช้ Student ID
function getCheckDataByStudentID($student_id, $conn) {
    $sql = "SELECT created_at FROM checklistdata WHERE studentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $checkData = array();
    while ($row = $result->fetch_assoc()) {
        $checkData[] = $row;
    }
    return $checkData;
}

function filterDataByMonth($selected_month, $conn) {
    $sql = "SELECT * FROM checklistdata WHERE DATE_FORMAT(created_at, '%Y-%m') = ?";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $selected_month);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $filteredData = array();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $filteredData[] = $row;
            }
        }
        
        $stmt->close();
    } else {
        // จัดการข้อผิดพลาดตามที่คุณต้องการ
    }
    
    return $filteredData;
}




// กรองวันที่ v3 ฉบับรวม ?


/// ทดสอบ ฉบับแยก ของการค้นหา
            function filterDataByYear($selected_year, $conn) {
                $sql = "SELECT * FROM checklistdata WHERE YEAR(created_at) = '$selected_year'";
                
                $result = $conn->query($sql);
                
                $filteredData = array();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $filteredData[] = $row;
                    }
                }

                return $filteredData;
            }

            function filterDataByMonthYear($selected_date, $conn) {
                $sql = "SELECT * FROM checklistdata WHERE DATE_FORMAT(created_at, '%Y-%m') = '$selected_date'";
                
                $result = $conn->query($sql);
                
                $filteredData = array();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $filteredData[] = $row;
                    }
                }

                return $filteredData;
            }

            function filterDataByFullDate($selected_date, $conn) {
                $sql = "SELECT * FROM checklistdata WHERE DATE(created_at) = '$selected_date'";
                
                $result = $conn->query($sql);
                
                $filteredData = array();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $filteredData[] = $row;
                    }
                }

                return $filteredData;
            }

// ฟังก์ชันเพื่อแสดงข้อมูลนักเรียน
function displayStudentData($filteredData) {
    $checkedStudents = array();
    $newCheckCount = array();

    foreach ($filteredData as $row) {
        $studentID = $row["studentID"];
        $checkDateTime = $row["created_at"];

        if (in_array($studentID, $checkedStudents)) {
            $newCheckCount[$studentID]++;
            echo "ชื่อ: $studentID (เช็คชื่อครั้งที่ $newCheckCount[$studentID]) - วันเวลาเช็ค: $checkDateTime<br>";
        } else {
            echo "ชื่อ: $studentID - วันเวลาเช็ค: $checkDateTime<br>";
            $checkedStudents[] = $studentID;
            $newCheckCount[$studentID] = 1;
        }
    }
    # แสดงสรุป
    $reversedStudents = array_reverse($checkedStudents);
    foreach ($reversedStudents as $studentID) {
        echo "รหัสนักเรียน $studentID มีเช็คชื่อ $newCheckCount[$studentID] ครั้ง <br>";
    }



}





?>