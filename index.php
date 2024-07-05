<?php include 'connect.php';?>

<?php

mysqli_select_db($conn, 'testphp');
$sql = "SELECT phone_number, count_random FROM user";
$retval = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    while ($row = mysqli_fetch_assoc($retval)) {
        if ($phone == $row['phone_number']) {
            $value_ramdom = $row['count_random'];
            header("Location: home.php?phone=" . urlencode($phone) . "&value=" . urlencode($value_ramdom));
            exit();
        }
    }
}
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
     <form action="" method="POST">
         <div class="form-group ">
             <label for="phone">Nhập số điện thoại</label>
             <input type="tel" class="form-control" name = "phone" id="phoneInput" placeholder="Nhập số điện thoại">
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>
     </form>         
 </body>
 </html>