
<?php
$phone = $_GET['phone'] ?? '';

if ($phone != '') {
    $conn = new mysqli('localhost', 'root', '', 'quayso');
    if ($conn->connect_error) {
        echo json_encode(['result' => false, 'message' => 'Database connection error']);
        exit();
    }
    if ($result = mysqli_query($conn, "SELECT * FROM user WHERE phone_number = $phone")) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode([
            'quanlity'=>$row['count_random']
        ]);
      }
} else {
    return  $response = [
        'result' => false,
        'message' => 'Lỗi'
    ];
    echo json_encode($response);
}

?>
