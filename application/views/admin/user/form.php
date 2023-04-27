<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header ">
                <h4 class="card-title d-inline-block"><?php echo $pagename ?></h4>
                <a class="btn btn-primary pull-right" href="<?php echo $page['url'] ?>">Back</a>
                <a class="btn btn-primary pull-right" href="<?php echo base_url('admin/user/view/').$id; ?>">View</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post" id="form" enctype="multipart/form-data" action="<?php echo $page['url'] ?>/set"  autocomplete="off">
                            <input type="hidden" name="id" value="<?php echo isset($data->id)?$data->id:"" ?>">
                            <div class="form-group mb-3">
                                <label>Profile image</label>
                                <div class="row">
                                    <?php  if(isset($data->thumbprofileimage)) { ?> 
                                        <div class="col-md-12 mb-2">
                                            <a href="<?php echo isset($data->thumbprofileimage) ? $data->thumbprofileimage : base_url('assets/uploads/default_user.jpg'); ?>" target="_blank">
                                                <img id="imagePreview" src="<?php echo isset($data->thumbprofileimage)?$data->thumbprofileimage:""; ?>" onerror="this.onerror=null;this.src='<?php echo base_url('assets/uploads/default_user.jpg') ?>';" width="100px"/>
                                            </a>
                                        </div> 
                                    <?php } else {
                                        ?>
                                            <div class="col-md-12 mb-2">
                                                    <img class="d-none" id="imagePreview" src="<?php echo isset($data->thumbprofileimage)?$data->thumbprofileimage:"" ?>" width="100px" />
                                            </div>
                                        <?php
                                    } ?>
                                    <div class="col-md-12">
                                        <input type="file" class="form-control newimage" name="image" id="image" >
                                        <input type="hidden" class="oldimages" name="oldimages" value="<?php echo isset($data->image)?$data->image:""; ?>">
                                    </div>
                               </div>
                            </div>
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" class="form-control" name="firstName"  value="<?php echo isset($data->firstName)?$data->firstName:"" ?>">
                            </div>
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" class="form-control" name="lastName"  value="<?php echo isset($data->lastName)?$data->lastName:"" ?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email"  value="<?php echo isset($data->email)?$data->email:"" ?>"  autocomplete="off" >
                            </div>
                            <div class="form-group intelphone">
                                <label>Phone</label>
                                <input type="text" id="phone" class="form-control" name="cphone" value="<?php echo isset($data->phone) ? isset($data->phone_code) ? "+".$data->phone_code . $data->phone : $data->phone : "" ?>">
                                <input type="hidden" name="phone" id="hiddennumber" class="form-control" value="<?php echo isset($data->phone) ? $data->phone : "" ?>">
                                <input type="hidden" name="phone_code" id="hiddenphonecode" class="form-control" value="<?php echo isset($data->phone_code) ? $data->phone_code : "" ?>">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password"  value=""  autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Is cosmetologist?</label>
                                <div class="d-flex align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="isCosmetologist" value="<?php echo (isset($data->cosmetologyLicenseNumber) && !empty($data->cosmetologyLicenseNumber)) || (isset($data->licenseDate) && !empty($data->licenseDate)) || (isset($data->licenseStateId) && !empty($data->licenseStateId)) || (isset($data->licenseImage) && !empty($data->licenseImage)) ? "1" : "0" ?>" <?php echo (isset($data->cosmetologyLicenseNumber) && !empty($data->cosmetologyLicenseNumber)) || isset($data->licenseDate) && !empty($data->licenseDate) || (isset($data->licenseStateId) && !empty($data->licenseStateId)) || (isset($data->licenseImage) && !empty($data->licenseImage)) ? "checked" : "" ?>>
                                        <label class="custom-control-label" for="customCheck">Is cosmetologist?</label>
                                    </div> 
                                </div>
                            </div>
                            <div class="cosmetology_div <?php echo (isset($data->cosmetologyLicenseNumber) && !empty($data->cosmetologyLicenseNumber)) || (isset($data->licenseDate) && !empty($data->licenseDate)) || (isset($data->licenseStateId) && !empty($data->licenseStateId)) || (isset($data->licenseImage) && !empty($data->licenseImage)) ? "" : "d-none" ?>">
                                <div class="form-group">
                                    <label>Cosmetology license number</label>
                                    <input type="text" class="form-control" name="cosmetologyLicenseNumber"  value="<?php echo isset($data->cosmetologyLicenseNumber)?$data->cosmetologyLicenseNumber:"" ?>">
                                </div>
                                <div class="form-group">
                                    <label>License date</label>
                                    <input type="text" class="form-control datepicker1" name="licenseDate" value="<?php echo isset($data->licenseDate) && !empty($data->licenseDate) ? date("m/d/Y", strtotime($data->licenseDate)):"" ?>" >
                                </div>
                                <div class="form-group">
                                    <label>State issued</label>
                                    <select class="form-control" name="licenseStateId">
                                    <option value="">Select state issued</option>
                                        <?php
                                        if(!empty($state)){
                                            foreach($state as $stateval){
                                                ?><option value="<?php echo $stateval->id ?>" <?php echo isset($data->licenseStateId) && $data->licenseStateId == $stateval->id ? "selected" : "" ?>><?php echo $stateval->name ?></option><?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>License image</label>
                                    <div class="row">
                                        <?php  if(isset($data->licenseImageUrl)) { ?> 
                                            <div class="col-md-12 mb-2">
                                                <a href="<?php echo isset($data->licenseImageUrl) ? $data->licenseImageUrl : base_url('assets/uploads/no-img.png'); ?>" target="_blank">
                                                    <img id="licenseImagePreview" src="<?php echo isset($data->licenseImageUrl)?$data->licenseImageUrl:""; ?>" onerror="this.onerror=null;this.src='<?php echo base_url('assets/uploads/no-img.png') ?>';" width="100px"/>
                                                </a>
                                            </div> 
                                        <?php } else {
                                            ?>
                                                <div class="col-md-12 mb-2">
                                                        <img class="d-none" id="licenseImagePreview" src="<?php echo isset($data->licenseImageUrl)?$data->licenseImageUrl:"" ?>" width="100px" />
                                                </div>
                                            <?php
                                        } ?>
                                        <div class="col-md-12">
                                            <input type="file" class="form-control newlicenseImage" name="licenseImage" id="licenseImage" >
                                            <input type="hidden" class="oldlicenseImage" name="oldlicenseImage" value="<?php echo isset($data->licenseImage)?$data->licenseImage:""; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" <?php echo isset($data->status) && $data->status == '1' ? 'selected' : '' ?>>Active</option>
                                    <option value="2" <?php echo isset($data->status) && $data->status == '2' ? 'selected' : '' ?>>Admin Block</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-fill btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        showHideCosmetology();
    });

    $("input[name='isCosmetologist']").change(function(e){
        showHideCosmetology();
    });

    function showHideCosmetology() {
        if ($("#customCheck").prop("checked")) {
            $("#customCheck").val("1");
            $(".cosmetology_div").removeClass("d-none");
        } else {
            $("#customCheck").val("0");
            $(".cosmetology_div").addClass("d-none");
        }
    }
</script>

<script>
    $( ".datepicker1" ).datepicker({
        format: 'mm/dd/yyyy',
        "autoclose": true
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            if (!input.files[0].type.match('image.*')) {return true; }
            
            else{                            
                    reader.onload = function(e) {
                        $('#imagePreview').removeClass("d-none");
                        $('#imagePreview').attr("src", e.target.result );
                
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function() {
        readURL(this);
    }); 

    //licenseImage
    function readLicenseURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            if (!input.files[0].type.match('image.*')) {return true; }
            
            else{                            
                    reader.onload = function(e) {
                        $('#licenseImagePreview').removeClass("d-none");
                        $('#licenseImagePreview').attr("src", e.target.result );
                
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#licenseImage").change(function() {
        readLicenseURL(this);
    }); 

    $.validator.addMethod('validnumber1', function (value, element, param) {
        return iti.isValidNumber();
    }, 'Enter valid phone number');
	$("#form").validate({
		rules: {
            image: {
				required: function () {
                    var oldimg = $(".oldimages").val();
                    var newimg = $(".newimage").val();
                    if(oldimg !== "" || newimg !== ""){
                        return false;
                    }else{
                        return true;
                    }
                },
                //extension: "jpg,jpeg, png",
                extension: "jpg,JPG,jpeg,JPEG,png,PNG,webp",
			},
            firstName: {
				required: true,
				normalizer: function(value) {
					return $.trim(value);
				},
			},
            email:{
                email: true,
			},
            cphone: {
                required: true,
                number: true,
                remote: {
                    url: "<?php echo base_url('admin/driver/checkPhoneExist').(isset($data->id) ? "/".$data->id : "" ) ?>",
                    type: "post",
                    data: {
                        phone: function () {
                            return $("#hiddennumber").val();
                        },
                        "role": "2"
                    }
                },
                validnumber1: true,
            },
		},
		messages: {
            image: {
                required: "Please choose image",
                extension: "You're only allowed to upload jpg or png images.",
            },
            firstName: {
				required: "Please enter first name",
			},
            cphone: {
                required: "Please enter phone number",
                number: "Please enter valid phone number",
                remote: "Phone number already exist",
            },
		},
    });

    var input = document.querySelector("#phone");
    var iti = window.intlTelInput(input,{
        initialCountry: "gb",
        formatOnDisplay:false,
        autoPlaceholder:"polite",
        nationalMode : true,
        separateDialCode : true,
        utilsScript:"<?php echo base_url(ADMIN_JS_URL); ?>utils.js"

    });
    input.addEventListener("countrychange", function() {
        setphonenumber();
    });
    $('#phone').change(function(){
        setphonenumber();
    });
    $("#phone").keyup(function(){
        setphonenumber();
    });
    function setphonenumber(){
        if(iti.isValidNumber()){
            var fullnumber = iti.getNumber();
            var phonecode = iti.getSelectedCountryData().dialCode;
            var dummyphone = fullnumber.replace(phonecode,'');
            var phone = dummyphone.replace('+','');
            $("#hiddennumber").val(phone);
            $("#hiddenphonecode").val(phonecode);
        }else{
            $("#hiddennumber").val($("#phone").val());
            $("#hiddenphonecode").val(iti.getSelectedCountryData().dialCode);
        }
        $("#hiddennumber").valid();
    }

</script>