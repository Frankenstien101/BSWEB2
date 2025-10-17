<style type="text/css">    
         @media print {
            .page-break{
                page-break-after: always;
            }
        }
</style>
    <div class="container-fluid">

                <button id="printButton" class="btn btn-primary col-3 mb-3">
                    Print
                </button>      
        <div class="row" id="print_body" style="height:80vh;overflow-y: scroll;padding: 10px;">
        <?php          
            include 'db_connection.php';      
            for ($i=0; $i < 10 ; $i++) { 
            ?>
            <div class="card  border-danger col-12 mb-2">
             <div class="card mt-2  col-lg-12 bg-danger" style="height:100px;">
                <table class="table" style="background-color: white;">
                    <tr> 
                        <th><span style="color: #3289C8;font-size: 12PX; ">SELLER CODE</span></th>
                       <th><span style="color: #3289C8;font-size: 12PX;">CUSTOMER INFO(CU_ID | CU_NAME)</span></th>
                           <th><span style="color: #3289C8;font-size: 12PX;">DATE</span></th>
                               <th><span style="color: #3289C8;font-size: 12PX;">ADDRESS INFO:</span> <span style="color: #3289C8;float: right;font-size: 12PX;"> DISTANCE: <span style="color: black;"><?php echo "SAMPLE1" ?></span> </span></th>
                    </tr>
                                <tr>
                                  <td style="font-size:12px; font-weight: bold;"><?php echo "SAMPLE1" ?></td>
                                  <td style="font-size:12px; font-weight: bold;"><?php echo "SAMPLE1" ?></td>
                                  <td style="font-size:12px; font-weight: bold;"><?php echo "SAMPLE1" ?></td>
                                  <td style="font-size:12px; font-weight: bold;"><?php echo ("SAMPLE1") ; ?></td>
                              </tr>
                </table>
                </div>
                  <table class="table">
                      <tr>
                        <th>BEFORE: <span style="font-weight: normal; font-size: 12px;"><?php echo strtoupper("DASD") ?></span></th>
                        <th>AFTER: <span style="font-weight: normal;font-size: 12px;"><?php echo strtoupper("DASD") ?></span></th>
                    </tr>
                    <tr>
                        <td>      
                            <img height="500px" width="500px" src="<?php echo $row['before_link'] ?>">
                        </td>
                        <td>
                          <img  height="500px" width="500px"  src="<?php echo $row['after_link'] ?>">
                      </td>
                  </tr>
              </table>

          </div>
          <?php 
          if (($i + 1) % 2 == 0) { ?>
            <div class="page-break"></div>
        <?php } 
    } ?>
</div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">

   function printDiv(divId) {
        var divContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = divContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

$("#printButton").on("click", function() {
        printDiv("print_body");
    });

         
</script>