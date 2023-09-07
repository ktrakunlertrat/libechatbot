<?php

include '../db_connection.php';
$conn = createDBConnection();
header("Location: ../show_stu.php");
//header =  กลับไปหน้าเดิม

?>
<?php
    // Get the form data
    $studentID = $_POST['studentID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
   

  
    // Insert the data into the database
    $sql = "INSERT INTO students (studentID, firstName, lastName) 
            VALUES ('$studentID', '$firstName', '$lastName')";
    
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script>window.location='../show_stu.php';</script>";
    } else{
        echo "Error updating data: " . mysqli_error($result);
        echo "<script>alert('ไม่สามารถบันทึกข้อมูล!');</script>";
        echo "<script>window.location='../show_stu.php';</script>";
    }

// Close the database connection
mysqli_close($conn);
?>