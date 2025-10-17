<?php 
include 'db_connection.php';
include 'query/user_login.php';
$recordsPerPage = 20;
$page = isset($_SESSION['page']) ? intval($_SESSION['page']) : 1;
$offset = ($page - 1) * $recordsPerPage;
$selected_datefrom = isset($_SESSION['ses_datefrom']) ? $_SESSION['ses_datefrom'] : date('Y-m-d'); ;
$selected_dateto = isset($_SESSION['ses_dateto']) ? $_SESSION['ses_dateto'] : date('Y-m-d');
$selected_page = isset($_SESSION['page']) ? $_SESSION['page'] : '';
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
</style>
<div class="container-fluid">
   <div class="row justify-content-center">
    <div class="card col-12 mb-2" style="height: 50px; background-color: #F6F6F9; border-radius: 10px;">
      <div class="d-flex justify-content-end align-items-center" style="height: 100%;">
        <div class="dropdown col-md-2">
          <a class="btn btn-sm btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-calendar-event"></i>
            Filter Date
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li>
              <input class="form-control w-100 mb-2" type="date" id="dt_from" value="<?php echo $selected_datefrom ?>" name="">
            </li>
            <li>
              <input class="form-control w-100 mb-2" type="date" id="dt_to" value="<?php echo $selected_dateto ?>" name="">
            </li>
            <li>
              <a class="btn btn-primary w-100" href="#" id="btn_submit">Done</a>
            </li>
          </ul>
        </div>
       
        <div class="d-flex justify-content-end col-md-8">
          <ul class="pagination custom-scrollbar mb-0">
            <li class="page-item active" id="1"><span class="page-link">1</span></li>
          </ul>
        </div>
      </div>
     <div class="marquee-progress">
      <div class="marquee-progress-bar"></div>
    </div>
    </div>

  </div>

<div class="container-body" style="height: 75vh; width: 100%; background-color: #F6F6F9;border-radius:   10px; overflow-y: scroll; padding:    10px; ">
    <table class="table table-striped table-hover "> 
        <thead >
            <tr >
                <th>#</th>
                <th>Action</th>
                <th>Seller Code</th>
                <th>Store Name</th>
                <th>Store Code</th>
                <th> Capture Date</th>
                <th>Distance</th>
                <th>Before Image</th>
                <th>After Image</th>
            </tr>
        </thead>
        <tbody id="tbody" style="width:500px">

        </tbody>
    </table>
</div>
</div>
<script type="text/javascript">
function view_table(dt_from, dt_to, page_) {
  $.ajax({
    url: 'query/VIEW_PQR.php',
    method: 'POST',
    data: { dt_from: dt_from, dt_to: dt_to, page: page_ },
    success: function (data) {
      $("#tbody").html(data);
      view_paging(dt_from, dt_to);
      show_indicator('none');
    },
    error: function (xhr, status, error) {
      alert("AJAX Error:"+status+" "+error);
      show_indicator('none');
    }
  });
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
