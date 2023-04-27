<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/favicon.png'); ?>">
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php echo getenv('WEBSITE_NAME') . " : " . (isset($pageTitle['title']) ? $pageTitle['title'] : "Admin panel"); ?></title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="<?php echo base_url('assets/backend/css/bootstrap.min.css'); ?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/backend/css/now-ui-dashboard.css?v=1.4.0'); ?>" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url(); ?>assets/backend/demo/demo.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/backend/css/intlTelInput.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/backend/css/select2.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/backend/css/style.css" rel="stylesheet" />
  <?php echo $this->template->stylesheet; ?>
  <!--   Core JS Files   -->
  <script src="<?php echo base_url(); ?>assets/backend/js/core/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/js/core/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/js/core/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/moment.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/jquery.dataTables.min.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/additional-methods.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/select2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/intlTelInput.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-datepicker.min.js"></script>
  <?php echo $this->template->javascript; ?>
  
</head>

<body class="sidebar-mini">
  <div class="wrapper ">
    <!-- <div class="sidebar" data-color="red"> -->
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          MD
        </a>
        <a href="#" class="simple-text logo-normal">
            My Demo
        </a>
        <div class="navbar-minimize">
          <button id="minimizeSidebar" class="btn btn-simple btn-icon btn-neutral btn-round">
            <i class="now-ui-icons text_align-center visible-on-sidebar-regular"></i>
            <i class="now-ui-icons design_bullet-list-67 visible-on-sidebar-mini"></i>
          </button>
        </div>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="<?php echo base_url()."assets/uploads/".$this->session->userdata('adminImage');?>" onerror='this.onerror=null;this.src="<?php echo base_url("assets/img/default_user.jpg"); ?>";'/>
          </div>
          <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span>
              <?php echo $this->session->userdata('adminname'); ?>
                <!-- <b class="caret"></b> -->
              </span>
            </a>
            <div class="clearfix"></div>
            <!-- <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li>
                  <a href="#">
                    <span class="sidebar-mini-icon">MP</span>
                    <span class="sidebar-normal">My Profile</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="sidebar-mini-icon">EP</span>
                    <span class="sidebar-normal">Edit Profile</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="sidebar-mini-icon">S</span>
                    <span class="sidebar-normal">Settings</span>
                  </a>
                </li>
              </ul>
            </div> -->
          </div>
        </div>
        <ul class="nav">
          <li class="<?php echo $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
            <a href="<?php echo base_url('admin/dashboard'); ?>">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="<?php echo $this->uri->segment(2) == 'user' ? 'active' : ''; ?>">
            <a href="<?php echo base_url('admin/user'); ?>">
              <i class="fa fa-user"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="<?php echo isset($page['menu']) && $page['menu'] == 'Cms' ? 'active' : '' ?>">
	            <a data-toggle="collapse" href="#post3">
	              <i class="fas fa-laptop-code"></i>
	              <p>Cms Masters<b class="caret"></b></p>
	            </a>
	            <div class="collapse <?php echo isset($page['menu']) && $page['menu'] == 'Cms' ? 'show' : '' ?>" id="post3">
	              <ul class="nav">
                    <li class="<?php echo isset($page['submenu']) && $page['submenu'] == 'cms' ? 'active' : '' ?>">
                      <a href="<?php echo base_url(); ?>admin/cms">
                        <span class="sidebar-mini-icon"><i class="fas fa-laptop-code"></i></span>
                        <span class="sidebar-normal">Cms</span>
                      </a>
                    </li> 
                    <li class="<?php echo isset($page['submenu']) && $page['submenu'] == 'faq' ? 'active' : '' ?>">
                      <a href="<?php echo base_url(); ?>admin/faq">
                        <span class="sidebar-mini-icon"><i class="fas fa-question-circle"></i></span>
                        <span class="sidebar-normal">Faq</span>
                      </a>
                    </li>
                    <li class="<?php echo isset($page['submenu']) && $page['submenu'] == 'apiresponse' ? 'active' : '' ?>">
                      <a href="<?php echo base_url(); ?>admin/apiresponse">
                        <span class="sidebar-mini-icon"><i class="fas fa-users"></i></span>
                        <span class="sidebar-normal">Apiresponse</span>
                      </a>
                    </li>   
                    <?php /* <li class="<?php echo isset($page['submenu']) && $page['submenu'] == 'Resources' ? 'active' : '' ?>">
                      <a href="<?php echo base_url(); ?>admin/resources">
                        <span class="sidebar-mini-icon"><i class="fas fa-laptop-code"></i></span>
                        <span class="sidebar-normal">Resources</span>
                      </a>
                    </li> */ ?>                
	              </ul>
	            </div>
          </li>

          <li class="<?php echo isset($page['menu']) && $page['menu'] == 'ticket' ? 'active' : '' ?>">
            <a href="<?php echo base_url(); ?>admin/ticket">
              <i class="fas fa-ticket-alt"></i>
                <p>Support Tickets</p>
            </a>
          </li>

          <li class="<?php echo isset($page['menu']) && $page['menu'] == 'ContactUs' ? 'active' : '' ?>">
            <a href="<?php echo base_url(); ?>admin/contactUs">
            <i class="far fa-address-card"></i>
                <p>Contact Us</p>
              </a>
          </li>

          <li class="<?php echo isset($page['menu']) && $page['menu'] == 'appreview' ? 'active' : '' ?>">
            <a href="<?php echo base_url(); ?>admin/Appreview">
            <i class="fas fa-star"></i>
              <p>App FeedBack</p>
            </a>
          </li>

          <li class="<?php echo isset($page['menu']) && $page['menu'] == 'setting' ? 'active' : '' ?>">
            <a href="<?php echo base_url(); ?>admin/Setting">
            <i class="fas fa-cog"></i>
              <p>Settings</p>
            </a>
          </li>

          <li class="<?php echo isset($page['menu']) && $page['menu'] == 'notification' ? 'active' : '' ?>">
            <a href="<?php echo base_url(); ?>admin/Notification">
            <i class="fas fa-bell"></i>
              <p>Notification</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="<?= $page['url']; ?>"><?= $page['name']; ?></a>
          </div>
          <div class="d-flex justify-content-end align-items-center">
            <div class="dropdown">
              <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> -->
              <div class="position-relative bellPar"  id="notificationMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell bellico mr-2" aria-hidden="true"></i>
              </div>
              <!-- </button> -->
              <div class="dropdown-menu notificationDropMenu" aria-labelledby="notificationMenu">
              </div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>
                      <span class="d-lg-none d-md-block">Some Actions</span>
                    </p>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?php echo  base_url('admin/profile'); ?>">Profile</a>
                    <a class="dropdown-item" href="<?php echo  base_url('admin/logout'); ?>">Logout</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">

      </div>
      <div class="content">
        <?php
          echo $this->template->content;
        ?>
      </div>
      <footer class="footer">
        <div class=" container-fluid ">
          <div class="copyright" id="copyright">
            Copyright
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>
            <a href="#"><?php echo getenv('WEBSITE_NAME') ?></a> All rights reserved.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/sweetalert2.min.js"></script>
  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-datetimepicker.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/nouislider.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url(); ?>assets/backend/js/now-ui-dashboard.js?v=1.4.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="<?php echo base_url(); ?>assets/backend/demo/demo.js"></script> -->
  <script src="<?php echo base_url('assets/backend/js/date.format.js'); ?>"></script>
  <?php echo $this->template->javascript; ?>
  <?php if ($this->session->flashdata('error')) : ?>
    <script>
      $(document).ready(function() {
        jQuery.notify({
          message: '<?php echo $this->session->flashdata('error'); ?>',
        }, {
          type: 'danger',
          delay: 5000,
        });
      });
    </script>
  <?php endif; ?>

  <?php if ($this->session->flashdata('success')) : ?>
    <script>
      $(document).ready(function() {
        jQuery.notify({
          message: "<?php echo $this->session->flashdata('success'); ?>",
        }, {
          type: 'success',
          delay: 5000,
        });
      });
    </script>
  <?php endif; ?>
</body>

</html>