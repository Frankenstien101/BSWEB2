<?php 
    include "../db_connection.php";
    session_start();
    $comp_id = isset($_POST['comp_id'])?$_POST['comp_id']:'';
    $site_id = isset($_POST['site_id'])?$_POST['site_id']:'';
    $seller_id = isset($_POST['seller_id'])?$_POST['seller_id']:'';
 ?>
<div class="row">
    <div class="col-1">
        <a type="button" class="btn btn-sm btn-outline-secondary back-button"><i class='bx bx-left-arrow-alt'></i></a>
    </div>
    <div class="col-8">
        <h3 class="text-header"><?php echo  $seller_id ?></h3>
    </div>
    <div class="col-2">
      <select name="" id="SELECT_FILTER" class="form-control form-control-md">
        <option value="ALL">All</option>
           <option value="PENDING">Has Pending</option>
      </select>
    </div>
</div>
<div class="container-body" style="height: 85vh; width: 100%; background-color: #F6F6F9;border-radius:   10px; overflow-y: scroll; padding:    10px; ">

<div class="row body">   
     
</div>

</div>
<script>
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
 
    $(".back-button").click(function(){
  show_indicator('block');
    var site_id=$("#SELECT_SITE").val();
    var comp= $("#sel_comp").val();
    view_cas(comp, site_id);
    })

 function view_cas_stres(_filter){

    show_indicator('block');
    var siteid='<?php echo  $site_id ; ?>';
    var comp= '<?php echo  $comp_id ; ?>';
    var sellerid= '<?php echo  $seller_id ; ?>';

      $.ajax({
        url:'query/PQR_CAS_VIEW_STORES_DETAILS.php',
        method:'POST',
        data:{comp_id:comp, site_id:siteid,seller_id:sellerid,filter:_filter},
        success:function(data){   
        //alert(data) 
        $(".body").html(data);      
           show_indicator('none');
       },
        error: function(jqXHR, textStatus, errorThrown) {
            // This block will catch and display any errors
            console.error("Error Details:", {
                status: jqXHR.status,           // HTTP status code
                statusText: textStatus,         // Status text like 'timeout', 'error'
                responseText: jqXHR.responseText,  // Full server response
                error: errorThrown              // Exception object or text
            });
            alert("An error occurred: " + textStatus + " - " + errorThrown);
        }      
   })
  }
$("#SELECT_FILTER").change(function(){
    var filter = $(this).val()
    view_cas_stres(filter);
})
$(document).ready(function(){
view_cas_stres("ALL");
});
</script>