<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block"><?php echo $pagename ?></h4>
            </div>
            <div class="card-body">
                <div class="toolbar">                    
                </div>
                <table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="font-weight-bold">First Name</th>
                            <th class="font-weight-bold">Last Name</th>
                            <th class="font-weight-bold">Email</th>
                            <th class="font-weight-bold">Phone</th>
                            <th class="font-weight-bold">Subject</th>
                            <th class="font-weight-bold">Status</th>
                            <th class="font-weight-bold">Created Date</th>
                            <th class="disabled-sorting font-weight-bold">Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th class="disabled-sorting">Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50,-1], [10, 25, 50,"All"]],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            },
            "serverSide": true,
            "ordering": false,
		    "processing": true,
            "ajax": {
                url: "<?php  echo current_url();?>",
                type: "post",
                error: function () {
                    $(".datagrid-error").html("");
                    $("#datagrid_processing").css("display", "none");
                },
            },
        });
        
    });
</script>