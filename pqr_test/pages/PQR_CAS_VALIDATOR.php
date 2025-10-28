<?php 
include 'db_connection.php';
include 'query/user_login.php';
$recordsPerPage = 20;
$page = isset($_SESSION['page']) ? intval($_SESSION['page']) : 1;
$offset = ($page - 1) * $recordsPerPage;
$selected_datefrom = isset($_SESSION['ses_datefrom']) ? $_SESSION['ses_datefrom'] : date('Y-m-d'); ;
$selected_dateto = isset($_SESSION['ses_dateto']) ? $_SESSION['ses_dateto'] : date('Y-m-d');
$selected_page = isset($_SESSION['page']) ? $_SESSION['page'] : '';
    $comp_id = isset($_SESSION['comp_id'])?$_SESSION['comp_id']:'';
    $site_id = isset($_SESSION['ses_site'])?$_SESSION['ses_site']:'';
?>
<style>
    .img-thumbnail {
        height: 100px;
        width: 150px;
        object-fit: cover;
    }
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
    .custom-scrollbar {
        overflow-y: hidden;
        overflow-x: auto;
        white-space: nowrap;

    }

    .custom-scrollbar::-webkit-scrollbar {
        height: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .container {
        height: 100vh;

    }

    .table {
        border-radius: 10px;
        background-color: #F6F6F9;
    }

    .active_card {
        transform: translateY(-10px);
        /* Light blue background */
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        /* Enhanced shadow */
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card-icon {
        font-size: 4rem;
        color: #495057;
    }

    .bi {
        font-size: 30px;
        color: #EEEEEE;
    }

    .card-title {
        margin-top: 15px;
        font-weight: bold;
        color: #343a40;
    }

    .card-text {
        color: #6c757d;
    }

    .text-decoration-none:hover .card {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
</style>
<div class="container-fluid">
<div class="marquee-progress">
  <div class="marquee-progress-bar"></div>
</div>
<div id="main_body">
           

</div>

</div>


<script type="text/javascript">
    $("#SELECT_pqrid").removeClass("hidden");
     $("#date").css("display", "none");
    function view_cas(compid,siteid){
      $.ajax({
        url:'query/PQR_CAS_VIEW.php',
        method:'POST',
        data:{comp_id:compid, site_id:siteid},
        success:function(data){                
           $("#main_body").html(data);      
           show_indicator('none');
       }
   })
  }
    function show_indicator(is_visible){
      $(".marquee-progress").css('display',is_visible)
      if(is_visible == 'none'){  $(".table").css('display','block')}
        else{ $(".table").css('display','none')}
    }

$("#SELECT_SITE").change(function(){
    show_indicator('block');
    var site_id=$("#SELECT_SITE").val();
    var comp= $("#sel_comp").val();
    view_cas(comp, site_id);
})
$("#sel_comp").change(function(){

    show_indicator('block');
    var site_id=$("#SELECT_SITE").val();
    var comp= $("#sel_comp").val();
    view_cas(comp, site_id);
})
$(document).ready(function() {
    show_indicator('block');  
    var site_id=$("#SELECT_SITE").val();
    var comp= $("#sel_comp").val();
    view_cas(comp, site_id);
});
</script>