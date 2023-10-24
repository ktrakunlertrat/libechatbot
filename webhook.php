<?php
include 'functionforline.php';
include 'db_connection.php';

// Access Token
$access_token = 'FPOOzuLqvy2eobZXRZY40CxYg2a8iTPrSwA83OqOKfwtvMGyFq7kQgYTw/0XK+XPdPG1tOP3SsBmmjdgiJJaVkp/1NIHRgy/a7gSoWvOZtyJO9dplcMLmrZ3jAdl6UywjL0tPRItFyr+EBJ+rk94gQdB04t89/1O/w1cDnyilFU=';



//  รับค่าที่ส่งมาจากผู้ใช้ ที่เป็น รหัสนักเรียน
$content = file_get_contents('php://input');
// แปลงเป็น JSON
$events = json_decode($content, true);
if (!empty($events['events'])) {
    foreach ($events['events'] as $event) {
        if ($event['type'] === 'message' && $event['message']['type'] === 'text') {
            $user_id = $event['source']['userId'];
            $message = $event['message']['text'];

            $conn = createDBConnection();
    
    // ค้นหา studentID ที่ตรงกับข้อความในตาราง students
    $query = "SELECT studentID FROM students WHERE studentID = '$message'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        // studentID ตรงกัน ตรวจสอบว่า user_id มีอยู่ในตาราง linelink หรือไม่
        $check_sql = "SELECT user_id FROM linelink WHERE user_id = '$user_id'";
        $check_result = $conn->query($check_sql);
        
        //ข้อความที่ตอบกลับไปหาผู้ใช้
        $messages = array(
            'type' => 'text',
            // 'text' => 'Reply message : '.$event['message']['text']."\nUser ID : ".$event['source']['userId'],
            'text' => 'Reply message:' . "\n" . 'ผู้ใช้ได้ผูกกับรหัสนักเรียนอื่นแล้วและไม่สามารถเพิ่มได้มากกว่า 1 ถ้าต้องการแก้ไขให้ติดต่อกับเจ้าหน้าที่',
        );
        $post = json_encode(array(
            'replyToken' => $event['replyToken'],
            'messages' => array($messages),
        ));
        
        if ($check_result->num_rows == 0) {
            // user_id ยังไม่มีอยู่ในตาราง linelink ให้เพิ่มข้อมูล
            $insert_sql = "INSERT INTO linelink (user_id, studentID) VALUES ('$user_id', '$message')";
            $conn->query($insert_sql);

            //ข้อความที่ตอบกลับไปหาผู้ใช้
            $messages = array(
                'type' => 'text',
                // 'text' => 'Reply message : '.$event['message']['text']."\nUser ID : ".$event['source']['userId'],
                'text' => 'Reply message:' . "\n" . 'User ID: บันทึกเรียบร้อย ถ้าต้องการแก้ไขให้ติดต่อกับเจ้าหน้าที่',
            );
            $post = json_encode(array(
                'replyToken' => $event['replyToken'],
                'messages' => array($messages),
            ));


        }
    }
    else {
        // ถ้าไม่พบ studentID ใน students
        if (strlen($message) !== 8) {
            // รหัสนักเรียนไม่มี 8 หลัก
            $messages = array(
                'type' => 'text',
                'text' => 'รหัสนักเรียนในระบบของเรามี 8 หลัก โปรดใส่ให้ครบ 8 หลัก',
            );
            $post = json_encode(array(
                'replyToken' => $event['replyToken'],
                'messages' => array($messages),
            ));
        } else {
            // รหัสนักเรียนไม่มีในระบบ
            $messages = array(
                'type' => 'text',
                'text' => 'ไม่มีรหัสนักเรียนในระบบ โปรดติดต่อกับเจ้าหน้าที่',
            );
            $post = json_encode(array(
                'replyToken' => $event['replyToken'],
                'messages' => array($messages),
            ));
        }
    }

    // URL ของบริการ Replies สำหรับการตอบกลับด้วยข้อความอัตโนมัติ
    $url = 'https://api.line.me/v2/bot/message/reply';
    $headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
    
    $conn->close();
            
        }
        //เก็บข้อมูลลง DB
        $conn = createDBConnection();
        if (!empty($events['events'])) {
            foreach ($events['events'] as $event) {





                // ตรวจสอบว่าเป็นข้อมูลของข้อความ
                if ($event['type'] === 'message' && $event['message']['type'] === 'text') {
                    // ดึง UID ของผู้ใช้ที่ส่งข้อความมา
                    $user_id = $event['source']['userId'];
                    $message = $event['message']['text'];
    
                    // ทำการเก็บ User ID และข้อความที่ผู้ใช้งานส่งมาลงในฐานข้อมูล
                    $sql = "INSERT INTO usersline (user_id, message_content) VALUES ('$user_id', '$message')";
                    $conn->query($sql);

                    $push_message = array(
                        'to' => $user_id , // ใส่ User ID ของผู้ใช้ที่คุณต้องการส่ง
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => ''
                            )
                        )

                    );
                    $url = 'https://api.line.me/v2/bot/message/push';
                    $headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($push_message));
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    $result = curl_exec($ch);
                    curl_close($ch);
                    echo $result;
                    




                }
            }
        }
        $conn->close();   





      




        



    }
}

