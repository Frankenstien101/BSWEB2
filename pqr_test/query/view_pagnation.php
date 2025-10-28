 <?php

 session_start();
 if (isset($_SESSION['page'])) {
     $totalPages = isset($_SESSION['total_pages']) ? $_SESSION['total_pages']:1;
 $page = $_SESSION['page'];
 if ($totalPages>1) { ?>
    <?php
    for ($i = 1; $i <= $totalPages; $i++){?><li class="page-item" id="<?php echo $i; ?>" style="z-index: 1;"><span class="page-link"><?php echo $i; ?></span></li> 
    <?php }}
 }
 
 ?>  

<script type="text/javascript">
        $(document).ready(function(){

            var current_page = "<?php echo $page ?>";
            $("#"+current_page).addClass("active");
        });
        $(".page-item").click(function(){
            $(this).removeClass("active")
            show_indicator('block');
            var page = $(this).attr('id');
             $("#"+page).addClass("active");
            var dt_from='<?php echo  $_SESSION['ses_datefrom'] ?>';
            var dt_to='<?php echo  $_SESSION['ses_dateto'] ?>';
            view_table(dt_from,dt_to,page);
        });
</script>