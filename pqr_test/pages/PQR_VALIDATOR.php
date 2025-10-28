<?php 
include 'db_connection.php';
include 'query/user_login.php';

$recordsPerPage = 20;
$page = isset($_SESSION['page']) ? intval($_SESSION['page']) : 1;
$offset = ($page - 1) * $recordsPerPage;
$selected_datefrom = isset($_SESSION['ses_datefrom']) ? $_SESSION['ses_datefrom'] : date('Y-m-d');
$selected_dateto = isset($_SESSION['ses_dateto']) ? $_SESSION['ses_dateto'] : date('Y-m-d');
$selected_page = isset($_SESSION['page']) ? $_SESSION['page'] : '';
?>

<style>
/* ======= Base Layout ======= */
.container-fluid {
  padding: 15px;
  width: 100%;
  max-width: 100%;
}

.card {
  border-radius: 10px;
  background-color: #F6F6F9;
  border: none;
}

/* ======= Filter Bar ======= */
.filter-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
  padding: 8px 15px;
}

.filter-bar .dropdown .btn {
  width: 100%;
  text-align: left;
}

/* ======= Pagination ======= */
.pagination {
  flex-wrap: nowrap;
  overflow-x: auto;
  white-space: nowrap;
  padding: 0 5px;
}

.pagination .page-item .page-link {
  border-radius: 8px;
  margin: 0 2px;
}

.custom-scrollbar::-webkit-scrollbar {
  height: 6px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #aaa;
  border-radius: 5px;
}

/* ======= Progress Bar ======= */
.marquee-progress {
  position: relative;
  height: 5px;
  overflow: hidden;
  background-color: #e9ecef;
  border-radius: 5px;
}

.marquee-progress-bar {
  position: absolute;
  height: 100%;
  width: 100%;
  background-color: #0d6efd;
  animation: marquee 5s linear infinite;
  border-radius: 5px;
}

@keyframes marquee {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

/* ======= Table Container ======= */
.container-body {
  height: 75vh;
  width: 100%;
  background-color: #F6F6F9;
  border-radius: 10px;
  overflow-y: auto;
  padding: 10px;
}

.table {
  font-size: 0.9rem;
}

.table th {
  white-space: nowrap;
}

/* ======= Image Thumbnails ======= */
.img-thumbnail {
  height: 90px;
  width: 130px;
  object-fit: cover;
  border-radius: 8px;
}

/* ======= Responsive Tweaks ======= */
@media (max-width: 992px) {
  .filter-bar {
    flex-direction: column;
    align-items: stretch;
  }

  .filter-bar .dropdown,
  .filter-bar .pagination {
    width: 100%;
  }

  .pagination {
    justify-content: center;
  }

  .container-body {
    height: auto;
    min-height: 60vh;
  }

  .table {
    font-size: 0.85rem;
  }
}
/* ======= Image Modal ======= */
#imagemodal .modal-dialog {
  max-width: 90vw;
}

#imagemodal .modal-body {
  padding: 0;
  text-align: center;
  background: #000;
}

#imd_prev {
  width: 100%;
  max-height: 85vh;
  object-fit: contain;
}

.modal-header {
  border-bottom: none;
}

.modal-header .btn-close {
  filter: invert(1);
}

</style>

<div class="container-fluid">
  <!-- Filter + Pagination Header -->
  <div class="card mb-3">
    <div class="filter-bar">

      <div class="dropdown">
        <a class="btn btn-light btn-sm dropdown-toggle w-100" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-calendar-event"></i> Filter Date
        </a>
        <ul class="dropdown-menu p-3">
          <li><input class="form-control mb-2" type="date" id="dt_from" value="<?php echo $selected_datefrom ?>"></li>
          <li><input class="form-control mb-2" type="date" id="dt_to" value="<?php echo $selected_dateto ?>"></li>
          <li><a class="btn btn-primary w-100" href="#" id="btn_submit">Done</a></li>
        </ul>
      </div>
       <div class="col-2">
      <select name="" id="SELECT_FILTER" class="form-control form-control-md">
        <option value="All">All</option>
        <option value="DEFAULT">Has Pending Default</option>
        <option value="CLVB">Has Pending ISKU</option>
      </select>
    </div>
    <div class="col-2">
      <select name="" id="SELECT_DSP" class="form-control form-control-md SEL">
        <option value="All">All</option>
        <?php 
$query = "select * from [dbo].[Aquila_Seller] where COMPANY_ID = '{$_SESSION['comp_id']}' AND SITE_ID ='{$_SESSION['ses_site']}' AND STATUS = 'ACTIVE'";
$item =$conn->query($query);
while($row_seller = $item->fetch(PDO::FETCH_ASSOC)){ 
  ?>
   <option value="<?php echo $row_seller['SELLER_SUB_ID'] ?>"><?php echo $row_seller['SELLER_SUB_ID'] ?></option>
  <?php
}
         ?>
      </select>
    </div>


      <div class="d-flex justify-content-center flex-grow-1 custom-scrollbar">
        <ul class="pagination mb-0">
          <li class="page-item active" id="1"><span class="page-link">1</span></li>
        </ul>
      </div>
    </div>

    <div class="marquee-progress">
      <div class="marquee-progress-bar"></div>
    </div>
  </div>
  <!-- Main Table -->
  <div class="container-body shadow-sm">
    <table class="table table-striped table-hover table-responsive align-middle">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Action</th>
           <th>Brand</th>
          <th>Seller Code</th>
          <th>Store Name</th>
          <th>Store Code</th>
          <th>Capture Date</th>
          <th>Distance</th>
          <th>Before Image</th>
          <th>After Image</th>
        </tr>
      </thead>
      <tbody id="tbody"></tbody>
    </table>
  </div>
</div>

<script>
function view_table(dt_from, dt_to, page_) {
  var seller_id = $("#SELECT_DSP").val();
    var brand = $("#SELECT_FILTER").val()
  $.ajax({
    url: 'query/VIEW_PQR.php',
    method: 'POST',
    data: { dtfrom: dt_from, dtto: dt_to, page: page_ ,seller_id:seller_id,brand:brand},
    success: function(data) {
      $("#tbody").html(data);
      view_paging(dt_from, dt_to);
      show_indicator('none');
    }
  });
}
$("#SELECT_FILTER").change(function(){
  var brand = $(this).val();
  show_indicator('block');
  const dt_from = $("#dt_from").val();
  const dt_to = $("#dt_to").val();

  view_table(dt_from, dt_to, 1);
})
$("#SELECT_DSP").change(function(){
  var seller_id = $(this).val();
  show_indicator('block');
  const dt_from = $("#dt_from").val();
  const dt_to = $("#dt_to").val();

  view_table(dt_from, dt_to, 1);
})
$(".page-item").click(function() {
  alert('page');
});

function show_indicator(is_visible) {
  $(".marquee-progress").css('display', is_visible);
  $(".table").css('display', is_visible === 'none' ? 'block' : 'none');
}

function view_paging(dt_from, dt_to) {
  $.ajax({
    url: 'query/view_pagnation.php',
    method: 'POST',
    data: { dtfrom: dt_from, dtto: dt_to },
    success: function(data) {
      $(".pagination").html(data);
      show_indicator('none');
    }
  });
}

$("#btn_submit").click(function() {
  show_indicator('block');
  const dt_from = $("#dt_from").val();
  const dt_to = $("#dt_to").val();

  view_table(dt_from, dt_to, 1);
});

$(document).ready(function() {
  const dt_from = $("#dt_from").val();
  const dt_to = $("#dt_to").val();
  view_table(dt_from, dt_to);
  $("#date").hide();
  $("#btn_addnew").click(function() {
    location.href = "?page=add_newuser";
  });
});
</script>
<!-- Image Preview Modal -->
<div class="modal fade" id="imagemodal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark text-white border-0">
      <div class="modal-header">
        <h6 class="modal-title" id="imageModalLabel">Image Preview</h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="" id="imd_prev" alt="Preview" class="img-fluid rounded shadow-sm" />
      </div>
    </div>
  </div>
</div>
