<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block"><?php echo $pagename ?></h4>
                <a class="btn btn-primary pull-right" href="<?php echo $page['url'] ?>"> Back </a>
            </div>
            <div class="card-body">
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar-->
                </div>
                <table class="table table-striped" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td width="20%">First Name</td>
                            <td><?= isset($data->firstName) && !empty($data->firstName) ? $data->firstName : "-" ?></td>
                        </tr>

                        <tr>
                            <td width="20%">Last Name</td>
                            <td><?= isset($data->lastName) && !empty($data->lastName) ? $data->lastName : "-" ?></td>
                        </tr>

                        <tr>
                            <td width="20%">Email</td>
                            <td><?= isset($data->email) && !empty($data->email) ? $data->email : "-" ?></td>
                        </tr>

                        <tr>
                            <td width="20%">Phone</td>
                            <td><?= isset($data->phone) && !empty($data->phone) ? $data->phone : "-" ?></td>
                        </tr>

                        <tr>
                            <td width="20%">Subject</td>
                            <td><?= isset($data->subject) && !empty($data->subject) ? $data->subject : "-" ?></td>
                        </tr>

                        <tr>
                            <td width="20%">Message</td>
                            <td><?= isset($data->message) && !empty($data->message) ? $data->message : "-" ?></td>
                        </tr>
                       
                        <tr>
                            <td width="20%">Status</td>
                            <td>
                                <?php if($data->status==0){echo "Inactive";}elseif($data->status==1){echo "Active";}elseif($data->status==3){echo "Contacting";}else{echo "Closed";} ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Created Date</td>
                            <td><?= isset($data->createdDate) && !empty($data->createdDate) ? $data->createdDate : "-" ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>   
    
    

</div>
<script>
// $('#datatable3').DataTable();

$(document).ready(function() {
    $('#datatable-protest-list').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, -1],
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
            url: "<?php  echo base_url('admin/user/getProtestList');?>",
            type: "post", data : {"userId": "<?php echo $data->id; ?>"},
            error: function () {
                $(".datagrid-error").html("");                
                $("#datagrid_processing").css("display", "none");
            },
        },
    });
    
});
</script>
          