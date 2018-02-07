<?php 
$current_user = get_current_login();
$is_admin = is_admin_login();
$login_type = get_login_type();
?>

<!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler">
                    </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                <li class="sidebar-search-wrapper">
                    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                    <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                    <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                    <form class="sidebar-search " action="extra_search.html" method="POST">
                        <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                        </a>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                            </span>
                        </div>
                    </form>
                    <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>
            <?php if($login_type == 4 ):?>
                
                <li class="<?php echo ($main_content == 'addtoolstemplate' ) ? 'active' : '' ?>">
                    <a href="<?php echo base_url('backend/addtoolstemplate');?>">
                    <i class="icon-note"></i>
                    <span class="title">Tambah Template Jabatan Tools</span>
                    </a>
                </li>
                <li class="<?php echo ($main_content == 'addcompetence' ) ? 'active' : '' ?>">
                    <a href="<?php echo base_url('backend/addcompetence');?>">
                    <i class="icon-note"></i>
                    <span class="title">Tambah Kompetensi</span>
                    </a>
                </li>
            <?php else:?>
                <?php if($login_type == 3 ):?>
                <li class="start <?php echo ($main_content == 'reportlead') ? 'active open' : '' ?>">
                    <a href="<?php echo base_url();?>backend/report">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow hide open"></span>
                    </a>
                </li>
            <?php else: ?>
                <li class="start <?php echo ($main_content == 'dashboard') ? 'active open' : '' ?>">
                    <a href="<?php echo base_url();?>backend">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    </a>
                </li>
            <?php endif ?>
            <?php if($login_type == 0 ): ?>
                <li class="<?php echo ($main_content == 'documentlist') ? 'active open' : '' ?>">
                    <a href="javascript:;">
                    <i class="icon-note"></i>
                    <span class="title">Pendaftaran</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php echo ($main_content == 'documentlist') ? 'active' : '' ?>">
                            <a href="<?php echo base_url();?>backend/documentlist">
                            <i class="icon-paper-clip"></i>
                            Data Dokumen</a>
                        </li>
                    </ul>
                </li>
                
            <?php endif ?>
            <?php if($login_type != 3 ):?>
                <li class="<?php echo ($main_content == 'addassessmentprogram' ) ? 'active' : '' ?>">
                    <a href="<?php echo base_url('backend/addassessmentprogram');?>">
                    <i class="icon-note"></i>
                    <span class="title">Tambah Program Assessment</span>
                    </a>
                </li>
                <li class="<?php echo ($main_content == 'addassessment' || $main_content == 'assessmentlist' || $main_content == 'assessmentreport' ) ? 'active open' : '' ?>">
                    <a href="javascript:;">
                    <i class="icon-note"></i>
                    <span class="title">Assesment</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($is_admin):?>
                        <li class="<?php echo ($main_content == 'addassessment') ? 'active' : '' ?>">
                            <a href="<?php echo base_url();?>backend/addassessment">
                            <i class="icon-plus"></i>
                            Tambah Assesment</a>
                        </li>
                        <?php endif ?>
                        <li class="<?php echo ($main_content == 'assessmentlist') ? 'active' : '' ?>">
                            <a href="<?php echo base_url();?>backend/assessmentlist">
                            <i class="icon-plus"></i>
                            Data Assesment</a>
                        </li>
                        <li class="<?php echo ($main_content == 'assessmentreport') ? 'active' : '' ?>">
                            <a href="<?php echo base_url();?>backend/assessmentreport">
                            <i class="icon-plus"></i>
                            Laporan Assesment</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo ($main_content == 'programlist' ) ? 'active' : '' ?>">
                    <a href="<?php echo base_url('backend/reportprogram');?>">
                    <i class="icon-note"></i>
                    <span class="title">Laporan Program</span>
                    </a>
                </li>
            <?php endif ?>
<?php endif?>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->