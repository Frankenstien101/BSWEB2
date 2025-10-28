<?php 
include 'db_connection.php';
include 'query/user_login.php';

$recordsPerPage = 20;
$page = isset($_SESSION['page']) ? intval($_SESSION['page']) : 1;
$offset = ($page - 1) * $recordsPerPage;
$selected_datefrom = $_SESSION['ses_datefrom'] ?? date('Y-m-d');
$selected_dateto = $_SESSION['ses_dateto'] ?? date('Y-m-d');
$comp_id = $_SESSION['comp_id'] ?? '';
$site_id = $_SESSION['ses_site'] ?? '';
?>

<style>
/* 🌐 General Layout */
body {
  background: #f8fafc;
  font-family: "Poppins", sans-serif;
}

.container-fluid {
  padding: 15px;
  max-width: 100%;
  overflow-x: hidden;
}

/* 🧭 Filter Section */
#filter-dsp {
  background: #fff;
  border-radius: 12px;
  padding: 15px;
  margin-bottom: 15px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
}

#filter-dsp .col-md-2,
#filter-dsp .col-sm-12 {
  flex: 1 1 180px;
  min-width: 160px;
}

.dropdown .btn {
  border-radius: 10px;
  border: 1px solid #dee2e6;
  background-color: #f8f9fa;
  color: #333;
}

.form-control {
  border-radius: 10px;
}

/* 🕓 Loading Progress */
.marquee-progress {
  position: relative;
  height: 5px;
  overflow: hidden;
  background-color: #e9ecef;
  border-radius: 5px;
  margin-bottom: 15px;
}

.marquee-progress-bar {
  position: absolute;
  height: 100%;
  width: 100%;
  background-color: #0d6efd;
  animation: marquee 1.5s linear infinite;
  border-radius: 5px;
}

@keyframes marquee {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

/* 📋 Table Wrapper */
#main_body {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  padding: 10px;
  overflow-x: auto;
}

.table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.9rem;
  background: #fafafa;
  border-radius: 8px;
}

.table th {
  white-space: nowrap;
  background: #f1f3f6;
  color: #333;
  font-weight: 500;
}

.table td {
  vertical-align: middle;
}

/* 🖼️ Image Thumbnail */
.img-thumbnail {
  height: 100px;
  width: 150px;
  object-fit: cover;
  border-radius: 10px;
  transition: transform 0.2s;
}

.img-thumbnail:hover {
  transform: scale(1.05);
  cursor: pointer;
}

/* 📱 Responsive Tweaks */
@media (max-width: 992px) {
  #filter-dsp {
    flex-direction: column;
    align-items: stretch;
  }
}

@media (max-width: 576px) {
  .img-thumbnail {
    height: 80px;
    width: 120px;
  }
  .dropdown .btn {
    font-size: 0.9rem;
  }
  .form-control {
    font-size: 0.9rem;
  }
  .table {
    font-size: 0.8rem;
  }
}
/* 🔧 Ultra-tight mobile filter spacing */
@media (max-width: 767.98px) {
  #filter-dsp {
    display: flex;
    flex-direction: column;
    gap: 2px !important;       /* minimal vertical gap */
    padding: 8px 10px !important;
  }

  #filter-dsp .col-md-3,
  #filter-dsp .col-sm-12 {
    flex: 1 1 auto;
    margin-bottom: 0 !important; /* remove bottom margin */
    padding: 0 !important;       /* remove Bootstrap column padding */
  }

  .dropdown .btn {
    padding: 6px 10px;
    font-size: 0.9rem;
    height: 36px;
  }

  #SELECT_FILTER {
    margin-top: 0 !important;
    height: 36px;
    font-size: 0.9rem;
  }
  /* Optional: reduce dropdown menu spacing */
  .dropdown-menu {
    margin-top: 2px !important;
  }
}


</style>

<div class="container-fluid">
  <!-- Filter Section -->
  <div class="row g-2" id="filter-dsp">
    <!-- Date Filter -->
    <div class="col-md-3 col-sm-12">
      <div class="dropdown w-100">
        <a class="btn btn-light btn-sm dropdown-toggle w-100" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-calendar-event"></i> Filter Date
        </a>
        <ul class="dropdown-menu p-3 w-100 shadow-sm">
          <li>
            <label class="small text-muted">From</label>
            <input class="form-control mb-2" type="date" id="dt_from" value="<?php echo $selected_datefrom; ?>">
          </li>
          <li>
            <label class="small text-muted">To</label>
            <input class="form-control mb-2" type="date" id="dt_to" value="<?php echo $selected_dateto; ?>">
          </li>
          <li>
            <a class="btn  btn-apply w-100" style="color: white;background-color: #2296F3;"  href="#" id="btn_submit1">Apply</a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Filter Dropdown -->
    <div class="col-md-3 col-sm-12">
      <select id="SELECT_FILTER" class="form-control">
        <option value="All" selected>All</option>
        <option value="Pending">Has Pending ISKU</option>
      </select>
    </div>
  </div>

  <!-- Loader -->
  <div class="marquee-progress">
    <div class="marquee-progress-bar"></div>
  </div>

  <!-- Data Display -->
  <div id="main_body" class="table-responsive"></div>
</div>

<script>
function show_indicator(state) {
  $(".marquee-progress").css("display", state);
  if (state === "none") $(".table").css("display", "block");
  else $(".table").css("display", "none");
}

$("#btn_submit1").click(function(e) {
  e.preventDefault();
  show_indicator("block");
  let dt_from = $("#dt_from").val();
  let dt_to = $("#dt_to").val();
  let site_id = $("#SELECT_SITE").val();
  let comp = $("#sel_comp").val();
  view_cas(comp, site_id, dt_from, dt_to);
});

function view_cas(compid, siteid, dt_from, dt_to) {
var status = $("#SELECT_FILTER").val();
  $.ajax({
    url: 'query/PQR_DSP_VIEW.php',
    method: 'POST',
    data: { comp_id: compid, site_id: siteid, dt_from: dt_from, dt_to: dt_to,status: status },
    success: function(data) {
      $("#main_body").html(data);
      show_indicator("none");
    }
  });
}
$("#SELECT_FILTER").change(function(){
show_indicator("block");
  let dt_from = $("#dt_from").val();
  let dt_to = $("#dt_to").val();
  let site_id = $("#SELECT_SITE").val();
  let comp = $("#sel_comp").val();
  view_cas(comp, site_id, dt_from, dt_to);
})
$(document).ready(function() {
  show_indicator("block");
  let site_id = $("#SELECT_SITE").val();
  let comp = $("#sel_comp").val();
  let dt_from = $("#dt_from").val();
  let dt_to = $("#dt_to").val();
  view_cas(comp, site_id, dt_from, dt_to);
});
</script>
