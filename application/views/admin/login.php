<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/favicon.png'); ?>">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        <?php echo getenv('WEBSITE_NAME'); ?>
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/backend/css/now-ui-dashboard.css?v=1.4.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo base_url(); ?>assets/backend/demo/demo.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/backend/css/style.css" rel="stylesheet" />
</head>

<body class="login-page sidebar-mini ">
    <div class="wrapper wrapper-full-page ">
        <div class="full-page login-page section-image" filter-color="black" data-image="<?php echo base_url('assets/backend/img/login_bg.jpg'); ?>">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="content">
            <div class="container">
            <div class="col-md-4 ml-auto mr-auto">
                <form class="form" id="admin_login" method="post">
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong><?php echo $this->session->flashdata('error'); ?></strong> 
                        </div>
                    <?php } ?>
                    <div class="card card-login card-plain">
                        <div class="card-header ">
                        <div class="logo-container">
                            <img src="<?php echo base_url('assets/backend/img/logo.png'); ?>" alt="">
                        </div>
                        </div>
                        <div class="card-body ">
                        <div class="input-group no-border form-control-lg">
                            <span class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            </span>
                            <input type="email" name="email" class="form-control" placeholder="Email address">
                        </div>
                        <div class="input-group no-border form-control-lg">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                                <!-- <i class="now-ui-icons text_caps-small"></i> -->
                            </div>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        </div>
                        <div class="card-footer ">
                        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">Signin</button>
                        <!-- <div class="pull-left">
                            <h6>
                            <a href="#pablo" class="link footer-link">Create Account</a>
                            </h6>
                        </div> -->
                        <!-- <div class="pull-right">
                            <h6>
                            <a href="#pablo" class="link footer-link">Forgot password?</a>
                            
                            </h6>
                        </div> -->
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        <footer class="footer">
            <div class=" container-fluid ">
                <div class="copyright" id="copyright">
                    Copyright
                    &copy;
                    <script>
                    document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                    </script> 
                    <a href="#"><?= getenv('WEBSITE_NAME'); ?></a> All rights reserved.
                </div>
            </div>
        </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?php echo base_url(); ?>assets/backend/js/core/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend/js/core/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend/js/core/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/moment.min.js"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/sweetalert2.min.js"></script>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/jquery.validate.min.js"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-selectpicker.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-datetimepicker.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/jquery.dataTables.min.js"></script>
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
    <script src="<?php echo base_url(); ?>assets/backend/js/now-ui-dashboard.min.js" type="text/javascript"></script>
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?php echo base_url(); ?>assets/backend/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();
        });
    </script>
    <script>
	    $("#admin_login").validate({
            errorClass: 'error text-left',
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.insertAfter($(element).parent('div'));
            },
            rules:{
                email: {
                    required: true,
                },
                password: {
                    required: true,
                },
            },
            messages:{
                email:{
                    required: "Please enter email",
                    email: "Enter valid email"
                },
                password:{
                    required: "Please enter password"
                },
            },
        });
    </script>
</body>

</html>
