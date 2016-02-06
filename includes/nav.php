<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo SERVER; ?>">
                <img src="<?php echo SERVER; ?>/assets/img/logo/logo_with_text.png" width="50px">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
            <form class="navbar-form navbar-left" role="search" method="get" action="<?php echo SERVER; ?>/searchResult">
                <div class="form-group">
                    <input type="search" class="form-control" placeholder="Search" name="search">
                </div>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo SERVER; ?>#service">Services</a></li>
                <li><a href="<?php echo SERVER; ?>#menu">Menu</a></li>
                <?php if($login): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo SERVER; ?>/profile"><i class="fa fa-user font17"></i>&nbsp;&nbsp;Personal Info</a></li>
                            <li><a href="<?php echo SERVER; ?>/myBookings"><i class="fa fa-cutlery"></i>&nbsp;&nbsp;My Bookings</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo SERVER; ?>/changePass"><i class="fa fa-lock"></i>&nbsp;&nbsp;Change Password</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li><a href="<?php echo SERVER; ?>/booking">Book Now</a></li>
                <?php if(!$login): ?>
                    <li><a href="<?php echo SERVER; ?>/login">Login</a></li>
                <?php else: ?>
                    <li><a href="<?php echo SERVER; ?>/controller/logout">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div> <!--</navbar-collapse-->
    </div> <!--</container>-->
</nav>