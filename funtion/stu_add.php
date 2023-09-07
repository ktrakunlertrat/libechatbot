<?php

include '../db_connection.php';
$conn = createDBConnection();
header("Location: ../stushow.php");
//header =  กลับไปหน้าเดิม

?>
<?php
    // Get the form data
    $user_id = $_POST['studentID'];
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
   

  
    // Insert the data into the database
    $sql = "INSERT INTO students (studentID, firstName, lastName) 
            VALUES ('$studentID', '$firstName', '$lastName')";
    
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script>window.location='../stushow.php';</script>";
    } else{
        echo "Error updating data: " . mysqli_error($result);
        echo "<script>alert('ไม่สามารถบันทึกข้อมูล!');</script>";
        echo "<script>window.location='../stushow.php';</script>";
    }

// Close the database connection
mysqli_close($conn);
?>