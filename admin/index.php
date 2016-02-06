<?php
session_start();
require '../controller/define.php';
require '../controller/adminControl.php';
$isLogin = false;
if(isset($_SESSION['admin'])){
    $isLogin = true;
    $totalUser = totalUser();
    $pendingBookings = pendingBookings();
    $approve = approvedBookings();
    $totalBookings = totalBookings();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

    <?php require_once '../includes/head.php'; ?>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
    <style>
        .login-page .login-header {
            padding: 0;
        }
    </style>

</head>

<?php if(!$isLogin): ?>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">
    <!-- This is needed when you send requests via Ajax -->
    <script type="text/javascript">
        var baseurl = '<?php echo SERVER ?>/controller/';
    </script>

    <div class="login-container">
        <div class="login-header login-caret">
            <div class="login-content">
                <a href="<?php echo SERVER; ?>" class="logo">
                    <img src="<?php echo SERVER; ?>/assets/img/logo/logo_with_text.png" width="120" alt="" />
                </a>
                <!-- progress bar indicator -->
                <div class="login-progressbar-indicator">
                    <h3>43%</h3>
                    <span>logging in...</span>
                </div>
            </div>
        </div>
        <div class="login-progressbar">
            <div></div>
        </div>

        <div class="login-form">

            <div class="login-content">

                <div class="form-login-error">
                    <h3>Invalid login</h3>
                    <p>Please enter correct username and password.</p>
                </div>
                <form method="post" role="form" id="form_login">

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-user"></i>
                            </div>
                            <input type="text" autofocus="autofocus" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-key"></i>
                            </div>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-login">
                            <i class="entypo-login"></i>
                            Login In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php else: ?>
<body class="page-body  page-fade" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	
	<?php include 'menu.php'; ?>

	<div class="main-content">
		<div class="row">
			<!-- Profile Info and Notifications -->
			<div class="col-md-6 col-sm-8 clearfix">
			</div>
			<!-- Raw Links -->
			<div class="col-md-6 col-sm-4 clearfix hidden-xs">
				<ul class="list-inline links-list pull-right">
					<li class="sep"></li>
					<li>
						<a href="<?php echo SERVER; ?>/controller/logout">
							Log Out <i class="entypo-logout right"></i>
						</a>
					</li>
				</ul>
			</div>
		
		</div>

		<hr />
        <br/><br/><br/><br/>
		<div class="row">
            <div class="col-sm-3 col-xs-6"></div>
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-red">
					<div class="icon"><i class="entypo-users"></i></div>
					<div class="num" data-start="0" data-end="<?php echo $totalUser; ?>" data-postfix="" data-duration="500" data-delay="0">0</div>
		
					<h3>Registered users</h3>
					<p>so far in our website.</p>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="tile-stats tile-green">
					<div class="icon"><i class="entypo-attention"></i></div>
					<div class="num" data-start="0" data-end="<?php echo $pendingBookings; ?>" data-postfix="" data-duration="500" data-delay="600">0</div>
					<h3>Pending Bookings</h3>
					<p>so far by our website</p>
				</div>
			</div>
            <div class="col-sm-3 col-xs-6"></div>
		</div>
        <br/><br/>
        <div class="row">
            <div class="col-sm-3 col-xs-6"></div>
            <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-check"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $approve; ?>" data-postfix="" data-duration="500" data-delay="1200">0</div>

                    <h3>Approved Bookings</h3>
                    <p>so far by our website</p>
                </div>
            </div>

            <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-box"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $totalBookings; ?>" data-postfix="" data-duration="500" data-delay="1800">0</div>

                    <h3>Total Bookings</h3>
                    <p>so far by our website</p>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6"></div>
        </div>

		<!-- Footer -->
		<footer>
		
		</footer>
	</div>
</div>
<?php endif; ?>
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
	<link rel="stylesheet" href="assets/js/rickshaw/rickshaw.min.css">

	<!-- Bottom scripts (common) -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/neon-login.js"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


	<!-- Imported scripts on this page -->
	<script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
	<script src="assets/js/jquery.sparkline.min.js"></script>
	<script src="assets/js/rickshaw/vendor/d3.v3.js"></script>
	<script src="assets/js/rickshaw/rickshaw.min.js"></script>
	<script src="assets/js/raphael-min.js"></script>
	<script src="assets/js/morris.min.js"></script>
	<script src="assets/js/toastr.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/neon-custom.js"></script>


	<!-- Demo Settings -->
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>