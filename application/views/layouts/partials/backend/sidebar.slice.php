<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>SRS</span></a>
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?=base_url('assets/images/isyana.jpg')?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= $this->session->userdata('username');?></h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="<?=base_url('home')?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
                    <li><a href="<?=base_url('list_data')?>"><i class="fa fa-book"></i> List Data </a></li>
                    <li><a href="<?=base_url('list_perusahaan')?>"><i class="fa fa-book"></i> List Perusahaan </a></li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>