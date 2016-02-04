<?php
session_start();
require 'controller/define.php';

$login =false;
if(isset($_COOKIE['user']) || isset($_SESSION['user'])){
    if(!isset($_SESSION['user'])){
        $_SESSION['user'] = $_COOKIE['user'];
        $_SESSION['id'] = $_COOKIE['id'];
    }
    $login = true;

    $userID = $_SESSION['id'];
    $bookings = true;
} elseif(!$login){
    header('Location: '.SERVER.'/404');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <?php require_once 'includes/head.php'; ?>
    <link href="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
    <link href="<?php echo SERVER; ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="<?php echo SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
    <script src="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
    <style>
        body { padding-top: 51px; }
    </style>
    <script>
        var baseurl = '<?php echo SERVER; ?>/controller/';
        var xmlhttp = new XMLHttpRequest();
        var url = baseurl + "myBookingInfo?id=<?php echo $userID; ?>";

        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                myFunction(xmlhttp.responseText);
            }
        }
        xmlhttp.open("GET", url, true);
        xmlhttp.send();

        function myFunction(response) {
            var arr = JSON.parse(response);
            var i;
            var out = "";

            for(i = 0, j=1; i < arr.length; i++, j++) {
                out += "<tr><td>" +
                    j +
                    "</td><td>" +
                    arr[i].DoB +
                    "</td><td>" +
                    arr[i].DoP +
                    "</td><td>" +
                    arr[i].purpose +
                    "</td><td class='text-right'>&#2547;&nbsp;" +
                    arr[i].totalCost +
                    "</td><td class='text-right'>&#2547;&nbsp;" +
                    (arr[i].totalCost - arr[i].paidCost) +
                    "</td><td class='text-center'><a class='btn btn-info' href='<?php echo SERVER;?>/detailsBooking?order="
                    + arr[i].keyID +
                    "' target='_blank'><span class='glyphicon glyphicon-info-sign'></span></a></td></tr>";
            }
            document.getElementById('myTab').innerHTML = out;
        }
    </script>
</head>
<body>
<div id="wrap">
    <main>
        <header>
            <?php require 'includes/nav.php'; ?>
        </header>
        <section>
            <h1 class="text-center">My Bookings</h1>
            <br/><br/>
            <div class="container orders-list">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                            <th>No.</th>
                            <th>Date of Booking</th>
                            <th>Date of Program</th>
                            <th>Purpose</th>
                            <th class="text-center">Total Payment</th>
                            <th class="text-center">Pending Payment</th>
                            <th></th>
                            </thead>
                            <tbody id="myTab">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <br /><br /><br />
    </main>
</div>
<footer>
    <?php require "includes/footer.php";?>
</footer>
</body>
</html>