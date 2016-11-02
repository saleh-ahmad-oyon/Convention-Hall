<?php
    session_start();

    require 'controller/define.php';
    require_once 'controller/indexControl.php';

    $login = false;
    if (isset($_COOKIE['user']) || isset($_SESSION['user'])) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $_COOKIE['user'];
        }
        $login = true;

        $user    = $_SESSION['user'];
        $proInfo = getPersonalInfo($user);
    } elseif (!$login) {
        header('Location: '.SERVER.'/404');
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <?php require_once 'includes/head.php'; ?>
    <link href="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?= SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
    <link href="<?= SERVER; ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
    <style>
        body { padding-top: 51px; }
    </style>
</head>
<body>
    <div id="wrap">
        <main>
            <header>
                <?php require 'includes/nav.php'; ?>
            </header>
            <section>
                <div class="profile-back"></div>
                <div class="col-md-12">
                        <div class="col-md-offset-4 col-md-4 col-sm-offset-2 col-sm-8">
                            <div class="padding-20">
                                <div class="padding-border solid-border">
                                    <h3 class="text-center">Personal Information</h3><br/>
                                    <form action="<?php echo SERVER; ?>/controller/editInfoSuccess.php" method="post">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text"
                                                   class="onlyChars form-control"
                                                   name="userName"
                                                   value="<?= htmlentities(stripslashes($proInfo['u_fname'])), " ", htmlentities(stripslashes($proInfo['u_lname'])); ?>"
                                                   pattern="(?=.*[a-zA-Z])+([.,\s])*.{2,}"
                                                   title="Only letters, space, dot and comma allowed"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email"
                                                   class="form-control"
                                                   name="email"
                                                   value="<?= htmlentities(stripslashes($proInfo['u_email'])); ?>"
                                                   pattern="[([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)]i"
                                                   title="Please insert a valid email" />
                                        </div>
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <input type="tel"
                                                   class="phnNum form-control"
                                                   name="contact"
                                                   id="phone"
                                                   value="<?= htmlentities(stripslashes($proInfo['u_contact'])); ?>" />
                                        </div>
                                        <br/>
                                        <div class="text-center">
                                            <button type="submit"
                                                    class="btn btn-success"
                                                    name="editInfo"
                                                    pattern="(?=.*[0-9])+.{5,}"
                                                    title="please insert a valid Phone Number">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-2 hidden-xs"></div>
                    </div>
            </section>
            <br /><br />
        </main>
    </div>
    <footer>
        <?php require "includes/footer.php";?>
    </footer>

    <script src="<?= SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
    <script src="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
    <script src="<?= SERVER; ?>/assets/js/jquery.maskedinput.min.js"></script>
    <script src="<?= SERVER; ?>/assets/js/custom.js"></script>
</body>
</html>