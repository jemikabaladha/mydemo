<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/backend/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/backend/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        <?php echo $this->config->item('website_name'); ?>
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
        <div class="full-page login-page section-image" filter-color="black" data-image="<?php echo base_url(); ?>assets/backend/img/login-bg.jpg">
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
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger mb-0">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <span><?php echo $this->session->flashdata('error'); ?></span> 
                        </div>
                    <?php } ?>
                    <div class="alert alert-success sucessNotifcation d-none mb-0">
                        <a href="#" class="close" data-dismiss="alert" title="Close" >&times;</a>
                        <span class="text"></span> 
                    </div>

                    <div class="alert alert-danger failNotifcation d-none mb-0">
                        <a href="#" class="close" data-dismiss="alert" title="Close" >&times;</a>
                        <span class="text"></span> 
                    </div>


                    <div class="card card-login card-plain">
                        <div class="card-header ">
                            <div class="logo-container">
                                <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="">
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
                            <div class="input-group no-border form-control-lg d-none vCode">
                                <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                </span>
                                <input type="text" name="vCode" class="form-control" placeholder="Verification Code*" id="vCode">
                            </div>
                            <div class="input-group no-border form-control-lg d-none resetPassword">
                                <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                </span>
                                <input type="text" name="password" class="form-control" placeholder="Password*" id="password">
                            </div>
                            <div class="input-group no-border form-control-lg d-none resetPassword">
                                <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                </span>
                                <input type="text" name="cPassword" class="form-control" placeholder="Confirm Password*" id="cPassword">
                            </div>
                        </div>
                        <div class="card-footer ">
                        <button type="submit" onclick="ForgotPassword();" class="btn btn-primary btn-round btn-lg btn-block mb-3" id="ForgotButton">Submit</button>
                        <button type="submit" onclick="VerifyCode();" class="btn btn-primary btn-round btn-lg btn-block mb-3 d-none" id="VerifyButton">Verify</button>
                        <button type="submit" onclick="ResetPassword();" class="btn btn-primary btn-round btn-lg btn-block mb-3 d-none" id="ResetPasswordButton">Reset Password</button>
                        <!-- <div class="pull-left">
                            <h6>
                            <a href="#pablo" class="link footer-link">Create Account</a>
                            </h6>
                        </div> -->
                        <div class="form-group text-right mr-3">
                                Already an user? <a href="<?php echo base_url("admin/login"); ?>" class="forgot-link underline-animation">Sign In</a>                             
                            </div>
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
                    <a href="#"><?php echo $this->config->item('website_name'); ?></a> All rights reserved.
                </div>
            </div>
        </footer>
        </div>
    </div>
</body>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo base_url(); ?>assets/backend/js/now-ui-dashboard.min.js?v=1.4.0" type="text/javascript"></script>
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?php echo base_url(); ?>assets/backend/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
        demo.checkFullPageBackgroundImage();
        });
    </script>
   <script>
        function hidealert() {
            window.setTimeout(function () {
                $(".alert").addClass("d-none", 1000, "easeOutBounce");
            }, 4000);
        }
        hidealert();
        function ResetPassword(){
            $("#auth-form").validate();
            var form = $("#auth-form");
            if (form.valid() == false) {
                return false;
            }
            else{
                $("#ResetPasswordButton").addClass("d-none");
                $(".loader").removeClass("d-none");      
            }

            var data = new FormData();
            data.append('email', $("#email").val());
            data.append('newPassword', $("#password").val());
            data.append('role', localStorage.getItem("user_type")); 
        
            $.ajax({
                url: "<?php echo base_url('admin/login/resetPassword'); ?>",
                type: 'post',
                dataType: 'html',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                   
                    data = JSON.parse(data);

                   
                    if (data.status == 1) {          
                       window.location = "<?php echo base_url('admin/login'); ?>";
                    }else if(data.status == 0){    
                        $("#ResetPasswordButton").removeClass("d-none");
                        $(".loader").addClass("d-none");                   
                        $(".failNotifcation .text").html(data.message);
                        $(".failNotifcation").removeClass("d-none");
                        hidealert();
                    }
                    else{
                        $("#ResetPasswordButton").removeClass("d-none");
                        $(".loader").addClass("d-none");
                        $(".failNotifcation .text").html("Something went wrong please try again");
                        $(".failNotifcation").removeClass("d-none");
                        hidealert();
                    }
                  
                }
            });
        }
        function VerifyCode(){
            $("#auth-form").validate();
            var form = $("#auth-form");
            if (form.valid() == false) {
                return false;
            }
            else{
                $("#VerifyButton").addClass("d-none");
                $(".loader").removeClass("d-none");      
            }

            var data = new FormData();
            data.append('email', $("#email").val());
            data.append('verificationCode', $("#vCode").val());
            data.append('role', localStorage.getItem("user_type")); 
        
            $.ajax({
                url: "<?php echo base_url('admin/login/verifyForgotPasswordCode'); ?>",
                type: 'post',
                dataType: 'html',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                  
                    data = JSON.parse(data);

                    $("#VerifyButton").removeClass("d-none");
                    $(".loader").addClass("d-none");
                    if (data.status == 1) {          
                        $("#vCode").attr("disabled","disabled");         
                        $("#VerifyButton").remove();    
                        $(".resetPassword").removeClass("d-none");     
                        $("#ResetPasswordButton").removeClass("d-none");                         
                        $(".sucessNotifcation .text").html(data.message);
                        $(".sucessNotifcation").removeClass("d-none");
                        hidealert();
                    }else if(data.status == 0){                       
                        $(".failNotifcation .text").html(data.message);
                        $(".failNotifcation").removeClass("d-none");
                        hidealert();
                    }
                    else{
                        $(".failNotifcation .text").html("Something went wrong please try again");
                        $(".failNotifcation").removeClass("d-none");
                        hidealert();
                    }
                }
            });
        }
        function ForgotPassword(){
            
            var form = $("#auth-form");
            if (form.valid() == false) {
                return false;
            }
            else{
                $("#ForgotButton").addClass("d-none");
                $(".loader").removeClass("d-none");      
            }

            var data = new FormData();
            data.append('email', $("#email").val());
            data.append('role', localStorage.getItem("user_type")); 
        
            $.ajax({
                url: "<?php echo base_url('admin/login/forgotPasswordRequest'); ?>",
                type: 'post',
                dataType: 'html',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);

                    $("#ForgotButton").removeClass("d-none");
                    $(".loader").addClass("d-none");
                    if (data.status == 1) {          
                        $("#email").attr("disabled","disabled");  
                        $("#email").focus();
                        $("#ForgotButton").remove();       
                        $("#VerifyButton").removeClass("d-none");         
                        $(".vCode").removeClass("d-none");                    
                        $(".sucessNotifcation .text").html(data.message);
                        $(".sucessNotifcation").removeClass("d-none");
                        
                        hidealert();
                    }else if(data.status == 0){                       
                        $(".failNotifcation .text").html(data.message);
                        $(".failNotifcation").removeClass("d-none");
                        hidealert();
                    }
                    else{
                        $(".failNotifcation .text").html("Something went wrong please try again");
                        $(".failNotifcation").removeClass("d-none");
                        hidealert();
                    }
                    /*
                    if (data.status == 3) {                                          
                        window.location.href = "<?php echo base_url('verification'); ?>";
                    }
                    else{
                        
                        $("#VerifyButton").removeClass("d-none");
                        $(".loader").addClass("d-none");     

                        $("#register-alert .text").html(data.message);
                        $("#register-alert").removeClass("d-none");

                        hidealert();
                    }*/
                   
                }
            });
        }
        $("#auth-form").validate({
            errorClass: 'error text-left',
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.insertAfter($(element).parent('div'));
            },
            rules:
            {                
                email: {
                    required: true,
                    email: true
                },
                vCode: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 20
                },
                cPassword: {
                    required: true,
                    equalTo:"#password"
                },            
            },
            messages:
            {
                email:{
                    required: "Please enter your email address",
                    email: "Enter valid email address"
                },
                vCode:{
                    required: "Please enter your verification code"
                },
                password:{
                    required: "Please enter a password",
                },
                cPassword:{
                    required: "Please your confirm password",
                    equalTo: "Password do not match"
                },
            },
        });
   </script>
<!-- </body> -->

</html>
