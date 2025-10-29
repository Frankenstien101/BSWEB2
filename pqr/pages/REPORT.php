<?php 
include 'db_connection.php';
 $query_principal = "SELECT  A.PRINCIPAL_ID,B.PRINCIPAL_CODE FROM BTM_PRINCIPAL_SITE_MAPPING A JOIN [dbo].[BTM_PRINCIPAL] B ON A.PRINCIPAL_ID=B.PRINCIPAL_ID
JOIN [dbo].[BTM_SITE] C ON A.SITE_ID=C.SITE_ID WHERE USER_ID={$_SESSION['user_id']} AND A.STATUS=1 AND B.STATUS=1  group by  A.PRINCIPAL_ID,B.PRINCIPAL_CODE order by A.PRINCIPAL_ID ASC";
 $query_branch = "SELECT  A.SITE_ID,C.SITE_CODE FROM BTM_PRINCIPAL_SITE_MAPPING A JOIN [dbo].[BTM_PRINCIPAL] B ON A.PRINCIPAL_ID=B.PRINCIPAL_ID
JOIN [dbo].[BTM_SITE] C ON A.SITE_ID=C.SITE_ID WHERE  a.PRINCIPAL_ID={$selected_comp} AND USER_ID={$_SESSION['user_id']} AND A.STATUS=1 AND B.STATUS=1 order by A.PRINCIPAL_ID ASC";
$selected_datefrom = isset($_SESSION['ses_datefrom']) ? $_SESSION['ses_datefrom'] : date('Y-m-d'); ;
$selected_dateto = isset($_SESSION['ses_dateto']) ? $_SESSION['ses_dateto'] : date('Y-m-d');
?>
<style type="text/css">
  .upload-card {

            background-color: #F6F6F9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #202241;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 1.5rem;
        }
        .card-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: #01ABE6;
            border-color: #01ABE6;
        }
        .btn-primary:hover {
            background-color: #007BAA;
            border-color: #007BAA;
        }
</style>
<div class="container-fluid" style="overflow-y:scroll; height: 80vh;">
 <div class="header">
  <div class="left">
    <h3>Reports</h3>
  </div>
</div>
<div class="row">
    <div class="col-md-4">
      <div class="card">
        <a href="?page=REPORT_PQR_SUMTRANS" type="button"  id="btn_pqr_result" class="btn btn-block btn-light hover-effect" >
          <i class="bi bi-graph-up"></i> PQR Result %
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <a href="?page=REPORT_PQR_CAS_SUMTRANS" type="button"  class="btn btn-block btn-light hover-effect" >
          <i class="bi bi-graph-up"></i> PQR CAS Result %
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <button class="btn btn-block btn-light hover-effect">
          <i class="bi bi-calendar"></i> Schedule
        </button>
      </div>
    </div>
  </div>
 <div class="header">
  <div class="left">
    <h3>Reports</h3>
  </div>
</div>
<div class="row">
<div class="col-lg-4">
                <div class="card upload-card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">PQR Validated Detail</h6>
                    </div>
                    <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-6 mb-3">
                      <input type="date" id="dt_from_det" value="<?php echo $selected_datefrom ?>" class="form-control"  />
                    </div>
                    <div class="form-group col-md-6 mb-3">
                      <input type="date"  id="dt_to_det" value="<?php echo $selected_dateto ?>"  class="form-control"  />
                    </div>
                      </div>
                    <div class="form-group col-md-12 mb-3">
        <select class="form-select col-1 sel sel-site" id="select_user" multiple>
          <?php 


          $query = "select SITEID,SITE_CODE from [dbo].[Aquila_Sites]  s join [dbo].[Aquila_PQR_Users_Branch_Mapping] b on s.SITEID=b.SITE_ID  where COMPANY_ID='".$_SESSION['comp_id']."' and USER_ID={$_SESSION['id']}";
          foreach($conn->query($query) as $row) {
            ?>
            <option selected value="<?php echo $row['SITEID'] ?>" ><?php echo $row["SITE_CODE"] ?></option>
            <?php
          }
          ?>
        </select>
      </div>
        <!-- <div class="alert alert-success col-12" role="alert">
        Sucessfully Generate!
        </div> -->
                    </div>
                    <div class="card-footer text-muted text-center">
                        <p class="mb-0">Download Template</p>
                        <button class="btn btn-primary" id="btn_gen_pqrdet"  >
                        <span class="spinner-border spinner-border-sm spinner visually-hidden " id="spin_det" aria-hidden="true"></span>
                        <span id="btn_txt_det">Generate</span>
                      </button>
                      <button class="btn btn-show" data-id="tbl_pqr_det"><i class="bi bi-view-stacked"></i></button>
<diV id="tbl_pqr_det" style="max-height: 30vh; overflow:auto; display:none">
</diV>
                         </div>

                </div>        
</div>



<div class="col-lg-4">
                <div class="card upload-card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">PQR CAS Details</h6>
                    </div>

                    <div class="card-body">    
                    <div class="form-group col-md-12 mb-3">
        <select class="form-select col-1 sel sel-site" id="g_id">
         <option>Select Guidelines</option>
                <?php
                $query = "select GUIDELINES_ID,DESCRIPTION from [dbo].[SNAP_GUIDELINE_SETUP_TRANSACTION] where COMPANY_ID ='$selected_comp'";
                foreach ($conn->query($query) as $row) {
                ?>
                    <option value="<?php echo $row['GUIDELINES_ID'] ?>" <?php echo isset($selected_guideline) && $selected_guideline == $row['GUIDELINES_ID'] ? 'selected' : '' ?>><?php echo $row["GUIDELINES_ID"]." | ".$row["DESCRIPTION"] ?></option>
                <?php
                }
                ?>
          
        </select>
      </div>                                           
                    <div class="form-group col-md-12 mb-3">
        <select class="form-select col-1 sel sel-site"  multiple id="p_pqrcasdetails">
          <?php 
          $query = "select SITEID,SITE_CODE from [dbo].[Aquila_Sites] where COMPANY_ID='".$_SESSION['comp_id']."'";
          foreach($conn->query($query) as $row) {
            ?>
            <option selected value="<?php echo $row['SITEID'] ?>" ><?php echo $row["SITE_CODE"] ?></option>
            <?php
          }
          ?>
        </select>
      </div>
                    </div>
                    <div class="card-footer text-muted text-center">        
        <button class="btn btn-primary btn_dl" id="btn_gen_pqrdet" data-id="pqrcasdetails" >
          <span class="spinner-border spinner-border-sm spinner visually-hidden " id="spin_det" aria-hidden="true"></span>
          <span id="btn_txt_det"><i class="bi bi-download fs-5"></i> Download</span>
        </button>
      </div>

                </div>        
</div>

<div class="col-lg-4">
                <div class="card upload-card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Sales Inv Details</h6>
                    </div>
                    <div class="card-body">
                      <div class="row">
                      <div class="form-group col-md-6 mb-3">
                      <input type="date" id="dt_from_inv" value="<?php echo $selected_datefrom ?>" class="form-control"  />
                    </div>
                    <div class="form-group col-md-6 mb-3">
                      <input type="date" id="dt_to_inv" value="<?php echo $selected_dateto?>"  class="form-control"  />
                    </div>
                      </div>
                    
                    <div class="form-group col-md-12 mb-3">
        <select class="form-select col-1 sel sel-site_inv" id="select_user_inv"  multiple>
          <?php 
          $query = "select SITEID,SITE_CODE from [dbo].[Aquila_Sites] where COMPANY_ID='".$_SESSION['comp_id']."'";
          foreach($conn->query($query) as $row) {
            ?>
            <option selected value="<?php echo $row['SITEID'] ?>" ><?php echo $row["SITE_CODE"] ?></option>
            <?php
          }
          ?>
        </select>
      </div>
                    </div>
                <div class="card-footer text-muted text-center">
                        <p class="mb-0">Download Template</p>
                        <button class="btn btn-primary" id="btn_gen_inv_det"  >
                        <span class="spinner-border spinner-border-sm spinner visually-hidden " id="spin_inv" aria-hidden="true"></span>
                        <span id="btn_txt_inv">Generate</span>
                      </button>
                      <button class="btn btn-show" data-id="tbl_inv_det"><i class="bi bi-view-stacked"></i></button>
<diV id="tbl_inv_det" style="max-height: 30vh; overflow:auto; display:none">
</diV>
                         </div>
                </div>        
</div>


</div>
</div>
<script type="text/javascript">
  $("#try").click(function(){
var a = $("#select_user").val();
$.ajax({
url:'query/start_process.php',
method:'POST',
data:{sites:a},
success:function(data){
  alert(data)
}

})
  })
  $(".btn-show").click(function(){   
    var id_tbl = $(this).attr('data-id');
    $("#"+id_tbl).toggle();
    show_dl("PQR_DETAILED","tbl_pqr_det");
    show_dl("INV_DETAILED","tbl_inv_det");
  });
   show_dl("PQR_DETAILED","tbl_pqr_det");
show_dl("INV_DETAILED","tbl_inv_det");
function show_dl(type, TABLE){
$.ajax({
url:'query/show_dl_logs.php',
method:"POST",
data:{TYPE:type},
success:function(data){
$("#"+TABLE).html(data)
}
})
}

function generate(dt_from, dt_to, sites, query,_btn_generate,_spin) {   

  var select_site = sites;
  var dt_from = dt_from;
  var dt_to =dt_to;
  var btn_generate = btn_generate;
  var spin = _spin;

  $("#"+btn_generate).attr("disable",true)
  $("#"+_spin).removeClass("visually-hidden")
  $("#"+btn_generate).html("Generating..")

  $.ajax({
  url: 'query/download_pqrdetails.php',
                    method: 'POST',
                    data:{sites:select_site, dtfrom:dt_from, dtto:dt_to},
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.status === 'success') {
     
                        }
                         else {
                          alert(data.message)
                        } 
                        $("#spin_det").addClass("visually-hidden")
                        $("#btn_txt_det").html("Generate")
                        $("#btn_txt_det").attr("disable",false)
                    },
                    error: function() {
                      alert(data.message);                       
                    }  
                });  
}

$("#btn_gen_inv_det").click(function(){
  var select_site = $("#select_user_inv").val();
  var dt_from = $("#dt_from_inv").val();
  var dt_to =$("#dt_to_inv").val();
  $("#btn_txt_inv").attr("disable",true)
  $("#spin_inv").removeClass("visually-hidden")
  $("#btn_txt_inv").html("Generating..")
  $.ajax({
                    url: 'query/dowload_sales_inv_details.php',
                    method: 'POST',
                    data:{sites:select_site, dtfrom:dt_from, dtto:dt_to},
                    success: function(response) {
                        var data = JSON.parse(response);

                        if (data.status === 'success') {                                         
                        }
                        else {
                          alert(data.message)
                        }
                        $("#spin_inv").addClass("visually-hidden")
                        $("#btn_txt_inv").html("Generate")
                        $("#btn_txt_inv").attr("disable",false)
                    },
                    error: function() {
                      alert(data.message);                       
                    }  
                });
})

$("#btn_gen_pqrdet").click(function(){
  var select_site = $("#select_user").val();
  var dt_from = $("#dt_from_det").val();
  var dt_to =$("#dt_to_det").val();
  $("#btn_txt_det").attr("disable",true)
  $("#spin_det").removeClass("visually-hidden")
  $("#btn_txt_det").html("Generating..")
  $.ajax({
                    url: 'query/download_pqrdetails.php',
                    method: 'POST',
                    data:{sites:select_site, dtfrom:dt_from, dtto:dt_to},
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.status === 'success') {
                      
                        }
                         else {
                          alert(data.message)
                        }
                        $("#spin_det").addClass("visually-hidden")
                        $("#btn_txt_det").html("Generate")
                        $("#btn_txt_det").attr("disable",false)
                    },
                    error: function() {
                      alert(data.message);                       
                    }  
                });
})

$("#btn_pqr_result").click(function(){

})
$("#btn_dl_stores").click(function() {
var selectusers = $("#select_user").val()
$.ajax({
type:'POST',
url:'query/sample2.php',
data:{users:selectusers},
success:function(data){
alert(data)
}
})

});

$(document).ready(function() {

    $('.sel').select2({
        placeholder: 'Select Sites',
        closeOnSelect: false
    });
    $("#date").css("display", "none");
});


$(".btn_dl").click(function(){
    dl_report($(this));    
  })

  function dl_report(_btn){
    _btn.prop('disabled', true);
    var _dl_type = _btn.attr('data-id');
    var site =$("#s_"+_dl_type).val();
    var principal = $("#p_"+_dl_type).val();

  _btn.find("#spin_det").removeClass("visually-hidden");
     $.ajax({
        url: 'query/download_'+_dl_type+'.php', // URL to your PHP file
        method: 'POST', // Use POST if you're sending data
        data: {principal_id:principal,site_id:site}, // Add data if necessary (e.g., filters)
        xhrFields: {
            responseType: 'blob' // Expect a binary file (Blob) in the response
        },
        success: function (response, status, xhr) {

            // Create a Blob from the response
            const blob = new Blob([response], { type: xhr.getResponseHeader('Content-Type') });
            // Create a temporary <a> element
            const a = document.createElement('a');
            const url = window.URL.createObjectURL(blob); // Create an object URL for the Blob
            a.href = url;

            // Extract filename from the headers (if available) or set a default filename
            const contentDisposition = xhr.getResponseHeader('Content-Disposition');
            const filename = contentDisposition ? 
                contentDisposition.split('filename=')[1]?.replace(/"/g, '') : 
                _dl_type+'MASTER.csv';
            a.download = filename;

            // Programmatically trigger the download
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a); // Clean up

            // Revoke the Blob URL to free memory
            window.URL.revokeObjectURL(url);
             _btn.find("#spin_det").addClass("visually-hidden");
               _btn.prop('disabled', false);

        },
        error: function (xhr, status, error) {
            alert('Error downloading file: ' + error);
             _btn.find("#spin_det").addClass("visually-hidden");
                     _btn.prop('disabled', false);
        }
    });  

  }
</script>