<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block"><?php echo $pagename ?></h4>
                <a class="btn btn-primary pull-right" href="<?php echo $page['url'] ?>"> Back </a>
                <a class="btn btn-primary pull-right" href="<?php echo base_url('admin/user/set/').$id ?>"> Edit </a>
            </div>
            <div class="card-body">
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar-->
                </div>
                <table class="table table-striped" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td width="20%">Profile image</td>
                            <td width="30%"><img src="<?php echo $data->thumbprofileimage; ?>" onerror='this.onerror=null;this.src="<?php echo base_url("assets/uploads/default_user.jpg"); ?>";'  width= 15% /></td>
                            <td width="20%">License image</td>
                            <td width="30%"><img src="<?php echo $data->licenseImageUrl; ?>" onerror='this.onerror=null;this.src="<?php echo base_url("assets/uploads/no-img.png"); ?>";'  width= 15% /></td>
                        </tr>
                        <tr>
                            <td width="20%">Name</td>
                            <td width="30%"><?= isset($data->fullName) && !empty($data->fullName) ? $data->fullName : "-" ?></td>
                            <td width="20%">Cosmetology license number</td>
                            <td width="30%"><?= isset($data->cosmetologyLicenseNumber) && !empty($data->cosmetologyLicenseNumber) ? $data->cosmetologyLicenseNumber : "-" ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Email</td>
                            <td width="30%"><?= isset($data->email) && !empty($data->email) ? $data->email : "-" ?></td>
                            <td width="20%">License date</td>
                            <td width="30%"><?php echo isset($data->licenseDate) && !empty($data->licenseDate) ? date("m/d/Y", strtotime($data->licenseDate)):"-" ?></td>      
                        </tr>
                        <tr>
                        <td width="20%">Phone</td>
                            <td width="30%"><?= isset($data->phone) && !empty($data->phone) ? (isset($data->phone_code) && !empty($data->phone_code) ? "+".$data->phone_code . " " . $data->phone : $data->phone) : "-" ?></td>
                            <td width="20%">State issued</td>
                            <td width="30%">
                                <?php
                                    $statedata = "-";
                                    if(!empty($state)){
                                        foreach($state as $stateval){
                                            if($stateval->id == $data->licenseStateId) { $statedata = $stateval->name; }
                                        }
                                    }
                                    echo $statedata;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Status</td>
                            <td width="30%">
                                <?php if($data->status==0){echo "Need to Verify";}elseif($data->status==1){echo "Active";}elseif($data->status==2){echo "Admin Blocked";} ?>
                            </td>
                            <td width="20%">Created Date</td>
                            <td width="30%"><?= $data->createdDate ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Order list</h4>
            </div>
            <div class="card-body">
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar -->
                </div>
                <table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="font-weight-bold">Seller Name</th>
                            <th class="font-weight-bold">Driver Name</th>
                            <th class="font-weight-bold">Address</th>
                            <th class="font-weight-bold">Total Price</th>
                            <th class="font-weight-bold">Quantity</th>
                            <th class="font-weight-bold">Payment Status</th>
                            <th class="font-weight-bold">Order Status</th>
                            <th class="font-weight-bold">Status</th>
                            <th class="disabled-sorting font-weight-bold">Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Seller Name</th>
                            <th>Driver Name</th>
                            <th>Address</th>
                            <th>Total Price</th>
                            <th>Quantity</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>Status</th>
                            <th class="disabled-sorting">Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],
            ],            
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            },
            "serverSide": true,
            "ordering": false,
		    "processing": true,
            "ajax": {
                url: "<?php echo current_url();?>",
                type: "post",
                data: {userId:"<?php echo $data->id; ?>"},
                error: function () {
                    $(".datagrid-error").html("");
                    //$("#datagrid").append('<tbody class="datagrid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#datagrid_processing").css("display", "none");
                },
            },
        });
    });
</script>
          