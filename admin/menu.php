<div class="sidebar-menu fixed">

    <div class="sidebar-menu-inner">

        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <a href="index.html">
                    <img src="<?php echo SERVER; ?>/assets/img/logo/logo_with_text.png" width="60" alt="Ahmad Convention" />
                </a>
            </div>

            <!-- logo collapse icon -->
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                    <i class="entypo-menu"></i>
                </a>
            </div>


            <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                    <i class="entypo-menu"></i>
                </a>
            </div>

        </header>


        <ul id="main-menu" class="main-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            <li>
                <a href="<?php echo SERVER; ?>/admin">
                    <i class="entypo-gauge"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo SERVER; ?>/admin/pendingBookings">
                    <i class="entypo-attention"></i>
                    <span class="title">Pending Bookings</span>
                </a>
            </li>
            <li>
                <a href="<?php echo SERVER; ?>/admin/allBookings">
                    <i class="entypo-box"></i>
                    <span class="title">All Bookings</span>
                </a>
            </li>
            <li>
                <a href="<?php echo SERVER; ?>/admin/calendar">
                    <i class="entypo-calendar"></i>
                    <span class="title">Calendar View</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="entypo-newspaper"></i>
                    <span class="title">Services</span>
                </a>
                <ul>
                    <li>
                        <a href="<?php echo SERVER; ?>/admin/allCharges">
                            <span class="title">All Charges</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo SERVER; ?>/admin/advantages">
                            <span class="title">Advantages</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo SERVER; ?>/admin/features">
                            <span class="title">Features</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo SERVER; ?>/admin/schedule">
                            <span class="title">Schedule</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo SERVER; ?>/admin/miscellaneous">
                            <span class="title">miscellaneous</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="entypo-doc-text"></i>
                    <span class="title">Gate</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="entypo-air"></i>
                    <span class="title">Stage</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="entypo-menu"></i>
                    <span class="title">Food Menu</span>
                </a>
                <ul>
                    <li>
                        <a href="#">
                            <span class="title">Set Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title">Additional Items</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title">Special Items</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>