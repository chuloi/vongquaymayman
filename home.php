<?php
if (isset($_GET['phone']) && isset($_GET['value'])) {
    $phone = $_GET['phone'];
    $value_random = $_GET['value'];
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div id="content">
        <div class="header">
            <h1>
                Lucky Draw Software
            </h1>
            <p>
                <img src="assets/images/bronze-prize.svg" alt="">
            </p>
            <h3 class="root-color">
                Nhấn nút Quay số để bắt đầu
            </h3>
            <h1 class="winner-name">
                Chào mừng <?php echo $phone ?>. Bạn còn <?php echo  $value_random ?> lượt quay.
            </h1>

        </div>
        <div id="main">
            <div id="box-number">
                <div class="row-number">
                    <div class="number number-1">
                        <img src="assets/images/bronze-prize.svg" alt="">
                    </div>
                    <div class="number number-3">
                        <img src="assets/images/bronze-prize.svg" alt="">
                    </div>
                    <div class="number number-4">
                        <img src="assets/images/bronze-prize.svg" alt="">
                    </div>
                    <div class="number number-5">
                        <img src="assets/images/bronze-prize.svg" alt="">
                    </div>
                    <div class="number number-5">
                        <img src="assets/images/bronze-prize.svg" alt="">
                    </div>
                    <div class="number number-6">
                        <img src="assets/images/bronze-prize.svg" alt="">
                    </div>
                </div>
            </div>
            
            <div id="start" class="d-flex j-center">
                <div onclick="start()" class="btn btn-yellow btn-yellow-secondary ng-binding">
                    Quay số
                </div>
                <div class="btn btn-primary ng-scope">
                    ĐĂNG KÝ
                </div>
            </div>
            <div id="stop" class="d-flex j-center hide">
                <div onclick="stop()" class="btn btn-yellow btn-yellow-secondary ng-binding">
                    CHỐT
                </div>
            </div>
        </div>
    </div>
    <script>
        let run;
        let speed = 50;
        let timesRun = 0;
        let phone = "<?php echo $phone ?>";

        function start() {
            document.getElementById('start').classList.toggle('hide');
            document.getElementById('stop').classList.toggle('hide');
            run = setInterval(rotate, speed);
        }
        function stop() {
            document.getElementById('start').classList.toggle('hide');
            document.getElementById('stop').classList.toggle('hide');
            clearInterval(run);
            timesRun = 0;
            sendNumbers();
            
        }

        let rotate = function () {
            timesRun += 50;
            if (timesRun > 5000) {
                stop();
            }
            let numbers = document.getElementsByClassName('number');

            for (let i = 0; i < numbers.length; i++) {
                numbers[i].innerHTML = randDomNumber();
            }
        }
       
        function randDomNumber() {
            return Math.floor(Math.random() * 9) + 1;
        }

        function sendNumbers() {
            let check = true;
            let numbers = document.getElementsByClassName('number');
            let dataToSend = [];

            for (let i = 0; i < numbers.length; i++) {
                let randomNumber = randDomNumber();
                numbers[i].innerHTML = randomNumber;
                dataToSend.push(randomNumber);
            }

            $.ajax({
                url: 'main.php',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ numbers: dataToSend, phone: phone  }),
                success: function(data) {
                    if (data.result) {
                        let resultMessage = data.message;
                        alert(resultMessage); 
                    } 
                },
                error: function(xhr, status, error) {
                    alert("Lỗi"); 
                }
            });

        }
    </script>

   
</body>

</html>