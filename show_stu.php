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
                <a class="nav-item nav-link active" href="index.php">Home</a>
                <a class="nav-item nav-link" href="scanner.php">เช็คชื่อ</a>
                <a class="nav-item nav-link" href="show_stu.php">ข้อมูลนักเรียนในระบบ (current) </a>
                <a class="nav-item nav-link" href="show_history.php">ประวัติการเข้าเรียน</a>
                <a class="nav-item nav-link" href="show_chart.php">กราฟ</a>
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
    <div class="container py-5">
    <div class="col-md-auto">

        <h1 class="text-center" style="color:black;">ข้อมูลนิสิต</h1><br>

        <table class="table table-bordered">
                <thead>
                    <tr>
                       
                         <th class="col-1">รหัสนิสิต</th>
                         <th class="col-1">ชื่อจริง</th>
                         <th class="col-1">นามสกุล</th>
                
                    </tr>
                </thead>
            <tbody>

            <a href="stu_addform.php" class="btn btn-success">เพิ่มข้อมูลนิสิต</a>

                <?php $sql = "SELECT * FROM students";
                $result = mysqli_query($conn,$sql);
                while ($row = mysqli_fetch_assoc($result)): 
                ?>

               
                        <tr>
                            <td>
                                <?php echo $row['studentID']; ?>
                            </td>
                            <td>
                                <?php echo $row['firstName']; ?>
                            </td>
                            <td>
                                <?php echo $row['lastName']; ?>
                            </td>  

                            
                            <td>
                                <div class="btn-group">
                                    <a href="stu_editform.php?studentID=<?php echo $row['studentID'];?>" class="btn btn-warning">แก้ไข</a> 
                                    <a href="javascript:void(0);" onclick="deleteStudent(<?php echo $row['studentID']; ?>)" class="btn btn-danger">Delete</a>
                                </div>
                            </td>

                        </tr>
                
       
                <?php endwhile; ?>



            </tbody>
        </table>

          
    </div>
    </div>                
    </div>
    </body>





    <script>
        function deleteStudent(studentID) {
            if (confirm('ยืนยันการลบ?')) {
                window.location.href = 'stu_delet.php?studentID=' + studentID;
            }
        }
    </script>










</html>


