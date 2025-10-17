<?php 
include 'db_connection.php';
include 'query/user_login.php';

$selected_datefrom = isset($_SESSION['ses_datefrom']) ? $_SESSION['ses_datefrom'] : date('Y-m-d'); ;
$selected_dateto = isset($_SESSION['ses_dateto']) ? $_SESSION['ses_dateto'] : date('Y-m-d');
$cu_id =  isset($_SESSION['cu_id'])?:'';
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
<div class="row">    
    <div class="marquee-progress">
  <div class="marquee-progress-bar"></div>
</div>
  <div class="col col-12">
 <H1>KOR CAS 1</H1>
  </div>
</div>  
<div class="container-body" style="height: 75vh; width: 100%; background-color: #F6F6F9;border-radius:   10px; overflow-y: scroll; padding:    10px; ">
<div class="accordion" id="accordionPanelsStayOpenExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">

        <span class="text-muted">Fundador   <span class="badge bg-success rounded-pill">14</span> <span class="badge bg-danger rounded-pill">14</span>
     <span class="badge bg-danger rounded-pill">14</span>
  <span class="badge bg-warning rounded-pill">14</span>/
 <span class="badge bg-secondary rounded-pill">100</span>
</span>
</div>
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
      <div class="accordion-body">
     
      </div>
    </div>
  </div>
  
</div>
</div>

<script type="text/javascript">
    function view_table(dt_from,dt_to,page_){
      $.ajax({
        url:'query/VIEW_PQR.php',
        method:'POST',
        data:{dtfrom:dt_from, dtto:dt_to,page:page_},
        success:function(data){
           $("#tbody").html(data);
           view_paging(dt_from,dt_to) ;
           show_indicator('none');
       }
   })
  }
  $(".page-item").click(function(){
//var page = $(this).attr('id');
    alert ('page')
});
  function show_indicator(is_visible){
      $(".marquee-progress").css('display',is_visible)
      if(is_visible == 'none'){  $(".table").css('display','block')}
        else{ $(".table").css('display','none')}
}
function view_paging(dt_from,dt_to) {
  $.ajax({
    url:'query/view_pagnation.php',
    method:'POST',
    data:{dtfrom:dt_from, dtto:dt_to},
    success:function(data){
        $(".pagination").html(data)
        show_indicator('none');
    }
})
}

$("#btn_submit").click(function(){
    show_indicator('block');
    var dt_from = $("#dt_from").val()
    var dt_to = $("#dt_to").val()

    view_table(dt_from,dt_to,1);

});
$(document).ready(function() {
    var dt_from = $("#dt_from").val()
    var dt_to = $("#dt_to").val()
    view_table(dt_from,dt_to);
    $("#date").css("display", "none");
    $("#btn_addnew").click(function(){      
        location.href = "?page=add_newuser";
    });
    $('#example').DataTable({
        buttons: [
                    'copy', 'excel', 'pdf' // Add the desired export buttons
                    ]
    });
});
</script>