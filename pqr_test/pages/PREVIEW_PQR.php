<?php
$selected_datefrom = isset($_SESSION['ses_datefrom']) ? $_SESSION['ses_datefrom'] : date('Y-m-d'); ;
$selected_dateto = isset($_SESSION['ses_dateto']) ? $_SESSION['ses_dateto'] : date('Y-m-d');
$page_now = isset($_SESSION['last_page']) ? $_SESSION['last_page'] : 1;
?>
<style type="text/css">
    .marquee-progress {
        position: relative;
        height: 5px;
        overflow: hidden;
        background-color: #f1f1f1;
        border-radius: .25rem;
    }

    .marquee-progress-bar {
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: #0d6efd;
        animation: marquee 5s linear infinite;
        border-radius: .25rem;
    }

    @keyframes marquee {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    @media print {
        .page-break {
            page-break-after: always;
        }
    }
</style>
<div class="container-fluid">

    <div class="row">
        <div class="marquee-progress">
            <div class="marquee-progress-bar"></div>
        </div>
        <div class="row col-md-10 body" style="height: 90vh;overflow:scroll;">
            <div class="body_list">

            </div>
            <div class="card" style="height: 100px; align-self: flex-end;align-items: center;
          background-color: #F6F6F9;">
                <span class="spinner-border spinner-border-sm" style="font-size:40px" role="status" aria-hidden="true"></span>
                <span>Loading....</span>
                <button class="btn btn-sm btn-default col-12 mt-2" id="btn_try">Show More</button>
            </div>
        </div>

        <div class="card col-2 ml-2 " style="height:50vh;background-color:#F6F6F9">
            <div class="col-12 mt-2 mb-2">
                <span class="text-muted">Filter Data</span>
            </div>
                   <div class="form-group mt-2 col-12">
                <input type="date" class="form-control"  id="dt_from" value="<?php echo $selected_datefrom; ?>" placeholder="search..." name="">
            </div>
                   <div class="form-group mt-2 col-12">
                <input type="date" class="form-control" id="dt_to" value="<?php echo $selected_dateto; ?>" name="">
            </div>
            <div class="form-group mt-2 col-12">
                <input type="text" class="form-control"   name="">
            </div>
            <button class="btn btn-sm btn-primary col-12 mt-2" id="btn_show">Show</button>
             <a  href="index.php?page=PRINT_PQR" class="btn btn-sm btn-primary col-12 mt-2" id="btn_show">Print</a>
        </div>


    </div>
</div>
</div>
<script type="text/javascript">
    $(".back-button").click(function(event) {
        event.preventDefault(); // Prevent the default anchor link behavior
        window.history.back();
    });
    // Function to fetch and append new data
    function view_pqr(p_h, page, site_, com_,dt_from_, dt_to_) {
        var prev_site = "<?php echo $_SESSION['ses_site']; ?>"
        // Hide body content and show loading spinner
        $(".body_list").hide();
        $(".marquee-progress").show();
        // Fetch data via AJAX
        $.ajax({
            url: 'query/view_pqr_list.php',
            method: 'POST',
            data: {
                page_now: page,
                site1: site_,
                comp1: com_,
                dt_from: dt_from_,
                dt_to : dt_to_
            },
            success: function(data) {
                if (prev_site == site_) {
                    $(".body_list").append(data);
                    $(".body_list").show();
                    $(".marquee-progress").hide();
                    $('.body').scrollTop(p_h);
                } else {
                    $(".body_list").html(data);
                    $(".body_list").show();
                    $(".marquee-progress").hide();
                    $('.body').scrollTop(0);
                }
                // Append new data to body_list           
                // Show body content, hide loading spinner
            }
        });
    }
     function view_pqr_new(p_h, page, site_, com_,dt_from_, dt_to_) {
        var prev_site = "<?php echo $_SESSION['ses_site']; ?>"
        // Hide body content and show loading spinner
        $(".body_list").hide();
        $(".marquee-progress").show();
        // Fetch data via AJAX
        $.ajax({
            url: 'query/view_pqr_list.php',
            method: 'POST',
            data: {
                page_now: page,
                site1: site_,
                comp1: com_,
                dt_from: dt_from_,
                dt_to : dt_to_
            },
            success: function(data) {

                    $(".body_list").html(data);
                    $(".body_list").show();
                    $(".marquee-progress").hide();
                  //  $('.body').scrollTop(p_h);
               
                // Append new data to body_list           
                // Show body content, hide loading spinner
            }
        });
    }
    var page_now = 1;
    var prev_hh = "";

    // Event handler for the Show button
    $("#btn_show").click(function() {
        var site = $("#SELECT_SITE").val()
        var comp = $("#sel_comp").val()
       var dtfrom = $("#dt_from").val()
        var dtto = $("#dt_to").val()
        var prev_h = $(".body").scrollTop();

        view_pqr(prev_h, 1, site, comp, dtfrom, dtto);
    });

    // Event handler for the Try button
    $("#btn_try").click(function() {
        page_now++;
        var dtfrom = $("#dt_from").val()
        var dtto = $("#dt_to").val()
        var site = $("#SELECT_SITE").val()
        var comp = $("#sel_comp").val()
        var prev_h = $(".body").scrollTop();
        view_pqr(prev_h, page_now, site, comp, dtfrom, dtto)
        prev_hh = prev_h;
    });

    $(document).ready(function() {
        $("#date").hide()
        var dtfrom = $("#dt_from").val()
        var dtto = $("#dt_to").val()
        view_pqr(prev_hh, page_now, null, null,dtfrom, dtto);

    });
</script>