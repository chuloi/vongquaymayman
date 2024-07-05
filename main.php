<?php include 'connect.php';?>


<?php
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['numbers'])) {
    $phone = $input['phone']; 

    $conn = new mysqli('localhost', 'root', '123456', 'testphp');

    if ($conn->connect_error) {
        echo json_encode(['result' => false, 'message' => 'Database connection error']);
        exit();
    }

    $sql = "UPDATE user SET count_random = count_random - 1 WHERE phone_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $phone);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    $receivedNumbers = $input['numbers'];

    $resultNumber = 0;
    foreach ($receivedNumbers as $number) {
        $resultNumber = $resultNumber * 10 + $number;
    }

    if (1 <= $resultNumber && $resultNumber <= 10) {
        $message = 'iphone 15 promax';
    } else if (10 < $resultNumber && $resultNumber <= 50) {
        $message = 'iphone 14 promax';
    } else if (50 < $resultNumber && $resultNumber <= 100) {
        $message = 'iphone 13 promax';
    } else if (100 < $resultNumber && $resultNumber <= 200) {
        $message = 'iphone 12 promax';
    } else {
        $message = 'Chúc bạn may mắn lần sau';
    }
    $response = [
        'result' => true,
        'message' => $message
    ];
} else {
    $response = [
        'result' => false,
        'message' => 'Lỗi'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
