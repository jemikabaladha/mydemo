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
                            <td width="30%"><img src="<?php echo $data->thumbProfileImage; ?>" onerror='this.onerror=null;this.src="<?php echo base_url("assets/uploads/default_user.jpg"); ?>";'  width= 15% /></td>
                            <td width="20%">Email</td>
                            <td width="30%"><?= isset($data->email) && !empty($data->email) ? $data->email : "-" ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Name</td>
                            <td width="30%"><?= isset($data->fullName) && !empty($data->fullName) ? $data->fullName : "-" ?></td>
                            <td width="20%">Phone</td>
                            <td width="30%"><?= isset($data->phone) && !empty($data->phone) ? (isset($data->phoneCode) && !empty($data->phoneCode) ? "+".$data->phoneCode . " " . $data->phone : $data->phone) : "-" ?></td>
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
    </div>
</div>
          