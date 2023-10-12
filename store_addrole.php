<?php

include 'db_connection.php';
$conn = createDBConnection();
//header =  กลับไปหน้าเดิม

?>
<?php
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
   

  
    // Insert the data into the database
    $sql = "INSERT INTO users (username, password, role) 
            VALUES ('$username', '$password', '$role')";
    
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script>window.location='show_stu.php';</script>";
    } else{
        echo "Error updating data: " . mysqli_error($result);
        echo "<script>alert('ไม่สามารถบันทึกข้อมูล!');</script>";
        echo "<script>window.location='page_addrole';</script>";
    }

// Close the database connection
mysqli_close($conn);
?>