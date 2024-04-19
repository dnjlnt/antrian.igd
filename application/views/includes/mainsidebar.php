<aside class="main-sidebar sidebar-light-olive">
    <a href="index3.html" class="brand-link">
        <img src="<?php echo base_url();?>assets/dist/img/Logo-CH.png" class="brand-image" style="opacity: .8; margin-left: 30px;">
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" style="width:50px;">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    Denny Julianto<br>
                    <small>Corporate</small>
                </a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo base_url();?>dashboard" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url();?>formrequest" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Form Request</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Meeting Room
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url();?>meetingroom/request" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Request</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url();?>meetingroom/approved" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Approved</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>