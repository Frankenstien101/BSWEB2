<?php
$selected_datefrom = isset($_SESSION['ses_datefrom']) ? $_SESSION['ses_datefrom'] : date('Y-m-d'); ;
$selected_dateto = isset($_SESSION['ses_dateto']) ? $_SESSION['ses_dateto'] : date('Y-m-d');
?>

<div class="container-fluid" >
	 <div class="card card-body" style=" height: 80vh;background-color:#F6F6F9">
       <div class="row">   
       	<div class="card-header col-12">
       	<div class="row">
       <div class="form-group col-md-1" >
       	<a href="#" type="button" class="btn btn-sm btn-outline-secondary back-button"><i class='bx bx-left-arrow-alt'></i></a>
       </div>    		
                    <div class="form-group col-md-2">
                       <select class="form-select form-select-sm SEL" id="TYPE_REPORT">
                        <option value="SITE_CODE">Site Summary</option>
                        <option value="b.SELLER_ID">DSP Summary</option>
                       </select>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="date" id="REP_DT_FROM" value="<?php echo $selected_datefrom  ?>" class="form-control  form-select-sm" name="">
                    </div> -
                      <div class="form-group col-md-2">
                        <input type="date" id="REP_DT_TO"  value="<?php echo $selected_dateto ?>" class="form-control form-select-sm" name="">
                    </div>
                    <div class="form-group col-md-2">
                       <button class="btn btn-sm btn-primary" id="BTN_FILTER"><span class="spinner-border spinner-border-sm visually-hidden spinner" aria-hidden="true"></span>
  <span role="status">Filter</span></button>
                    </div>
                </div>
                </div>
             <div class="col-12" id="_body" style=" height: 65vh;background-color:#F6F6F9; overflow:scroll">
              
                    </div> 
                </div>	
    </div>

</div>
<script type="text/javascript">
		$(".back-button").click(function(event) {
    event.preventDefault(); // Prevent the default anchor link behavior
    window.history.back();
    });
	function SHOW_PQR_SUM(TYPE, DTFROM,DTTO) {

$.ajax({
  url:'query/VIEW_SUMMARY_PQR.php',
  method:'POST',
  data:{type:TYPE, dtto:DTTO, dtfrom:DTFROM},
  success:function(data) {
  $("#_body").html(data)
  $(".spinner").addClass("visually-hidden");
$("#BTN_FILTER").attr('disabled',false)
  }
})
  }
  $("#BTN_FILTER").click(function(){
  $(this).attr('disabled', true)  
$(".spinner").removeClass("visually-hidden");    
var type = $("#TYPE_REPORT").val()
var ddfrom = $("#REP_DT_FROM").val()
var ddto = $("#REP_DT_TO").val()
SHOW_PQR_SUM(type,ddfrom,ddto) 

  })
</script>