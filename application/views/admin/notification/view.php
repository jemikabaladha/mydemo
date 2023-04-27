<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block"><?php echo $pagename ?></h4>
                <a class="btn btn-primary pull-right" href="<?php echo $page['url'] ?>"> Back </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5 col-md-8 notiContent">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-8 notiLoadMore">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var page = 1;
    $(document).ready(function() {
        getMyNotificationData(page);
    });

    function getMyNotificationData(page='') {
        $('.notiContent').html("");
        $('.notiLoadMore').html("");
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/dashboard/getNotificationList'); ?>',
            data: {page:page},
            success: function(response){
                var Data = $.parseJSON(response);
                var notificationData = Data.data;
                if(Data.status == '1'){
                    var html='';
                    var loadmorehtml='';
                    var totalpage = Data.totalPages;
                    html += myNotificationRecordsHtml(notificationData);
                    if(totalpage>1 && totalpage!=page){
                        loadmorehtml = `<a href="javascript:void(0);" class="d-flex justify-content-center notiLoadMoreBtn">View more</a>
                        <a class="viewMoreLoader d-none" href="javascript:void(0);"><div class="d-flex justify-content-center"><div class="spinner-border text-info viewMoreSpinner" role="status"><span class="sr-only">Loading...</span></div></div></a>`;
                    }
                    $(html).appendTo('.notiContent');
                    $(loadmorehtml).prependTo('.notiLoadMore');
                }else{
                    $('.notiContent').html('<a class="notiTxt nonotificationdiv" href="javascript:void(0);">Notification not found</a>');
                    $('.notiLoadMore').html("");
                }
            }
        });  
    }

    function myNotificationRecordsHtml(dataarr=''){
        var html='';
        $.each(dataarr, function(k,v) {
            var model = '';
            if(typeof v.model !== "undefined" && v.model != ""){
              model = v.model;
            }
            var model_id = '';
            if(typeof v.model_id !== "undefined" && v.model_id != ""){
              model_id = v.model_id;
            }
            var senderName = '';
            if(typeof v.senderName !== "undefined" && v.senderName != ""){
              senderName = v.senderName;
            }
            var title = '';
            if(typeof v.title !== "undefined" && v.title != ""){
              title = v.title;
            }
            var time = '';
            if(typeof v.time !== "undefined" && v.time != ""){
              time = v.time;
            }
            if(model == 'adminNewSupportTicketMsg') {
              html += `<a href="<?php echo base_url('admin/ticket/set/'); ?>` + model_id + `"><div class="notiTxt"><span>`+senderName+` reply on `+title+`</span><span class="float-right">`+time+`</span></div></a>`;
            } else if(model == 'adminNewSupportTicket') {
              html += `<a href="<?php echo base_url('admin/ticket/set/'); ?>` + model_id + `"><div class="notiTxt"><span>New ticket(`+title+`) created by `+senderName+`</span><span class="float-right">`+time+`</span></div></a>`;
            }
        });
        return html;
    }
</script>
<script>
    $(".notiLoadMore").delegate(".notiLoadMoreBtn", "click", function() {
        page += 1;
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/dashboard/getNotificationList'); ?>',
            data: {page:page},
            beforeSend: function(){
                $(".viewMoreLoader").removeClass("d-none");
                $(".notiLoadMoreBtn").addClass("d-none");
            },
            success: function(response){
                var Data = $.parseJSON(response);
                var notificationData = Data.data;
                if(Data.status == '1'){
                    var html='';
                    var loadmorehtml='';
                    var totalpage = Data.totalPages;
                    console.log(totalpage);
                    console.log(page);
                    html += myNotificationRecordsHtml(notificationData);
                    $('.notiLoadMore').html("");
                    if(totalpage>1 && totalpage!=page){
                        loadmorehtml = `<a href="javascript:void(0);" class="d-flex justify-content-center notiLoadMoreBtn">View more</a>
                        <a class="viewMoreLoader d-none" href="javascript:void(0);"><div class="d-flex justify-content-center"><div class="spinner-border text-info viewMoreSpinner" role="status"><span class="sr-only">Loading...</span></div></div></a>`;
                    }
                    $(html).appendTo('.notiContent');
                    $(loadmorehtml).prependTo('.notiLoadMore');
                }else{
                  $('.notiContent').html('<a class="notiTxt nonotificationdiv" href="javascript:void(0);">Notification not found</a>');
                  $('.notiLoadMore').html("");
                }     
            },
            error: function (error) {
                $(".viewMoreLoader").addClass("d-none");
                $(".notiLoadMoreBtn").removeClass("d-none");
            }
        });   
    });
</script>

          