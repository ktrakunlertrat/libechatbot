<?php
include '../db_connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลนิสิต</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
        <img src="ass/NULOGO-Download-297x300.png" alt="logo" width="50" height="50">
</head>

<body background="ass/Backbround.png">
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #fe965a;">
        <div class="container">
            <a class="navbar-brand text-light" href="../index.php">ระบบลงทะเบียนเรียน</a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item <?=$active_admin?>">
                        <a class="nav-link text-light" href="login-page.php"></a>
                    </li>
                    <li class="nav-item <?=$active_admin?>">
                        <a class="nav-link text-light" href="login-page.php">กำหนดตารางสอนอาจารย์</a>
                    </li>
                    <li class="nav-item <?=$active_admin?>">
                        <a class="nav-link text-light" href="login-page.php">กำหนดตารางสอนนิสิต</a>
                    </li>
                    <li class="nav-item <?=$active_admin?>">
                        <a class="nav-link text-light" href="login-page.php"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <br>
        <div class="col-md-auto">
            <h1 class="text-center" style="color: #fe965a;">เพิ่มข้อมูลนิสิต</h1><br>
        </div>
        <div class="row justify-content-md-center">
            <div class="col col-lg-2"></div>
            <div class="col-md-auto">

            <form action="../funtion/stu_add.php" method="post">

                <label style="color: #fe965a;">รหัสนิสิต</label>
                <input type="text" name="user_id" required><br>
                <br>
                <label style="color: #fe965a;">ชื่อ</label>
                <input type="text" name="fname" required>

                <label style="color: #fe965a;">นามสกุล</label>
                <input type="text" name="lname" required>

                <label style="color: #fe965a;">เพศ</label>
                <select name="gender" id="gender" required>
                    <option value="ชาย">ชาย</option>
                    <option value="หญิง">หญิง</option>
                </select>

                <label style="color: #fe965a;">วัน/เดือน/ปีเกิด</label>
                <input type="date" name="birth" required><br>
                <br>

                <label style="color: #fe965a;">คณะ</label>
                <select name="faculty" require>
                    <?php $sql = "SELECT * FROM faculty ";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)): ?>
                    <option value="<?php echo $row['fac_id']; ?>">
                    <?php echo $row['fac_name']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label style="color: #fe965a;">สาขา</label>
                <select name="branch" required>        
                    <?php  $sql = "SELECT * FROM branch ";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)): ?>
                    <option value="<?php echo $row['branch_id']; ?>">
                    <?php echo $row['branch_name']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label style="color: #fe965a;">โทรศัพท์</label>
                <input type="text" name="phone" required><br><br>

                <label style="color: #fe965a;">email</label>
                <input type="email" name="email" required>

                <label style="color: #fe965a;">ที่อยู่</label>
                <input type="text" name="address" required>
                <br>
                <br>
                
                <button style="color: white;" class="btn btn-success" type="submit" name="submit" value="submit">บันทึกข้อมูล</button>
                <a href="../form/stu_addForm.php" class="btn btn-danger">Cancel</a>
            </form>
</div>

<?php mysqli_close($conn); ?>

</body>

</html>