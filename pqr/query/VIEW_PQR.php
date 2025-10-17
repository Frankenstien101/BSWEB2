
<?php
include '../db_connection.php';
session_start();
if (isset($_SESSION['comp_id']) && isset($_SESSION['ses_site'])) {
    $recordsPerPage = 100;
    $page = $_POST['page'] ?? $_SESSION['page'] ?? 1;
    if (isset($_POST['page'])) {
        $_SESSION['page'] = $_POST['page'];
    }
    $page = intval($_SESSION['page']) ?? 1;
    
    $offset = ($page - 1) * $recordsPerPage;

    $comp_id = $_SESSION['comp_id'];
    $site_id = $_SESSION['ses_site'];
    $dtFrom = isset($_POST['dtfrom']) ? $_POST['dtfrom'] : $_SESSION['ses_datefrom'];
    $dtTo = isset($_POST['dtto']) ? $_POST['dtto'] : $_SESSION['ses_datefrom'];

    $_SESSION['ses_datefrom'] = $dtFrom;
    $_SESSION['ses_dateto'] = $dtTo;
    $values = [];

    $query1 = "
    SELECT COUNT(*) as total
    FROM (
    SELECT DISTINCT CONCAT(CU_ID, '-', DATE_PROCESS) AS TRANS_ID
    FROM [dbo].[Aquila_PQR]
    WHERE COMPANY_ID = :comp_id 
    AND SITE_ID = :site_id 
    AND DATE_PROCESS BETWEEN :dtFrom AND :dtTo
    ) AS unique_trans_ids;";

    $stmt = $conn->prepare($query1);
    $stmt->bindParam(':comp_id', $comp_id, PDO::PARAM_STR);
    $stmt->bindParam(':site_id', $site_id, PDO::PARAM_STR);
    $stmt->bindParam(':dtFrom', $dtFrom, PDO::PARAM_STR);
    $stmt->bindParam(':dtTo', $dtTo, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalRecords = $result['total'];
    $totalPages = ceil($totalRecords / $recordsPerPage);

    $_SESSION['total_pages'] = $totalPages;
    $_SESSION['page'] = $page;

    $Q = " WITH CTE AS (
    SELECT 
        MAX(A.LINE_ID) AS ID,
        MIN(DISTANCE) AS CAP_DISTANCE,
        COMPANY_ID,
        SITE_ID,
        SELLER_SUB_ID,
        SELLER_ID,
        DATE_PROCESS,
        CU_ID,
        CU_NAME,
        CONCAT(CU_ID, '-', DATE_PROCESS) AS TRANS_ID,
     ISNULL(MAX(A.BEFORE_LINK),MAX(B.BEFORE_LINK))   AS BEFORE_LINK,
       ISNULL(MAX(A.AFTER_LINK),MAX(B.AFTER_LINK))   AS AFTER_LINK,
        CASE 
            WHEN (MAX(A.BEFORE_LINK) IS NULL OR MAX(A.AFTER_LINK) IS NULL) AND (MAX(B.BEFORE_LINK) IS NULL OR MAX(B.AFTER_LINK) IS NULL)  
            THEN 'NON-COMPLIANT' 
            ELSE 'COMPLIANT' 
        END AS STATUS
    FROM [dbo].[Aquila_PQR] A left join Aquila_PQR_Link B ON A.PQR_ID=B.PQR_ID
   WHERE COMPANY_ID = '".$comp_id."' AND SITE_ID = '".$site_id."' AND DATE_PROCESS BETWEEN '".$dtFrom."' AND '".$dtTo."'
     GROUP BY 
        CONCAT(CU_ID, '-', DATE_PROCESS),
        CU_ID,
        DATE_PROCESS,
        SELLER_ID,
        SELLER_SUB_ID,
        CU_NAME,
        COMPANY_ID,
        SITE_ID
)
SELECT 
    A.A_COMMENT,
    A.B_COMMENT,
    A.STATUS as stat_fin,
    B.ID,
    B.CAP_DISTANCE,
    B.COMPANY_ID,
    B.SITE_ID,
    B.SELLER_SUB_ID,
    B.SELLER_ID,
    B.DATE_PROCESS,
    B.CU_ID,
    B.CU_NAME,
    B.TRANS_ID,
    B.BEFORE_LINK,
    B.AFTER_LINK,
    B.STATUS
FROM CTE B
LEFT JOIN [dbo].[Aquila_PQR_Incentive] A ON B.ID = A.PQR_ID
ORDER BY B.ID
    OFFSET :offset ROWS FETCH NEXT :recordsPerPage ROWS ONLY
    ";
    $stmt = $conn->prepare($Q);

    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
    $stmt->execute();

    $row_count = $stmt->rowCount();
    $i = 0;

    if ($row_count == 0) {
        echo "No data available!";
    } else {
        $ids = [];
        foreach ($stmt as $row) {
$date_now = date('Y-m-d');
            $ids[] = $row['ID'];

            $values[] = "('{$row['COMPANY_ID']}', '{$row['SITE_ID']}', '{$row['ID']}', '0', '0', '{$row['CU_ID']}', '{$row['CU_NAME']}', '{$row['DATE_PROCESS']}', '0', '0', '0', '{$row['STATUS']}', 'PROPER EXECUTION', 'PROPER EXECUTION','{$date_now}')";
            $i++;
            ?>
            <tr>
                <td><?php echo    $i; ?></td>
                <td>
                    <button class="btn btn-stat btn-sm <?php echo (htmlspecialchars(($row['stat_fin'] != null) ? $row['stat_fin'] : $row['STATUS']) == "COMPLIANT") ? 'btn-success' : 'btn-danger'; ?>" data-stat="<?php echo htmlspecialchars(($row['stat_fin'] != null) ? $row['stat_fin'] : $row['STATUS'])?>" data-id="<?php echo $row['ID'] ?>" id="BTN<?php echo $row['ID'] ?>">
                <span class="spinner-border spinner-border-sm visually-hidden" id="spin<?php echo $row['ID'] ?>" role="status" aria-hidden="true" ></span><span id="msg_stat<?php echo $row['ID'] ?>"><?php echo htmlspecialchars(($row['stat_fin'] != null) ? $row['stat_fin'] : $row['STATUS']); ?></span>  
                </button>

                <td><?php echo htmlspecialchars($row['SELLER_ID']); ?></td>
                <td><?php echo htmlspecialchars($row['CU_ID']); ?></td>
                <td><?php echo htmlspecialchars($row['CU_NAME']); ?></td> 
                 <td><?php echo htmlspecialchars($row['DATE_PROCESS']); ?></td> 
                <td><?php echo htmlspecialchars($row['CAP_DISTANCE']); ?></td>
                             <td>
                    <div class="d-flex flex-column align-items-center">
                        <img class="img-thumbnail mb-2 img_click" src="<?php echo htmlspecialchars($row['AFTER_LINK']); ?>" alt="After Image">
                        <select class="form-select form-select-sm select_after "  data-id="<?php echo $row['ID'] ?>"  style="width:20vh">
                            <option value="Proper Execution">Proper Execution</option>
                            <option value="Not Proper Execution">Not Proper Execution</option>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-column align-items-center">
                        <img class="img-thumbnail mb-2 img_click" src="<?php echo htmlspecialchars($row['BEFORE_LINK']); ?>" alt="Before Image">
                        <select class="form-select form-select-sm select_before" data-id="<?php echo $row['ID'] ?>" style="width:20vh">
                            <option value="Proper Execution">Proper Execution</option>
                            <option value="Not Proper Execution">Not Proper Execution</option>
                        </select>
                    </div>
                </td>
   
            </tr>
            <?php
        }
$valuesJson = json_encode($values);
        ?>
        <script type="text/javascript">
       function UPDATE_STAT_BA(PQR_ID_,TYPE,STATUS_){
        $("#spin"+PQR_ID_).removeClass("visually-hidden");
            $.ajax({
                url:'query/update_status_ba.php',
                method:'POST',
                data:{PQR_ID:PQR_ID_,STATUS:STATUS_,type:TYPE},
                success:function(data){
                if (data === "NON-COMPLIANT") {
                  $("#BTN"+PQR_ID_).attr('data-stat',data)
                  $("#msg_stat"+PQR_ID_).text(data)
                  $("#BTN"+PQR_ID_).removeClass("btn-success");
                  $("#BTN"+PQR_ID_).addClass("btn-danger");   
            }
            else{
               $("#BTN"+PQR_ID_).attr('data-stat',data)
                 $("#msg_stat"+PQR_ID_).text(data)
                $("#BTN"+PQR_ID_).removeClass("btn-danger")
                 $("#BTN"+PQR_ID_).addClass("btn-success")
           }    
           $("#spin"+PQR_ID_).addClass("visually-hidden");
                },
                error:function(er){}
            })
        }
            $(".select_before").change(function(){
            var status = $(this).val()
            var prq_id= $(this).attr('data-id');
            UPDATE_STAT_BA(prq_id,"BEFORE",status);

            })

           $(".select_after").change(function(){
            var status = $(this).val()
            var prq_id= $(this).attr('data-id');
            if (status=="Proper Execution") {
               UPDATE_STAT_BA(prq_id,"AFTER",status);
             $("#"+prq_id).attr('data-stat',status)
                $("#"+prq_id).html("COMPLIANT")
                $("#"+prq_id).removeClass("btn-danger");
                $("#"+prq_id).addClass("btn-success"); 
            }
            else{
             UPDATE_STAT_BA(prq_id,"AFTER",status);
                 $("#"+prq_id).attr('data-stat',status)
                $("#"+prq_id).html("NON-COMPLIANT")
                $("#"+prq_id).removeClass("btn-success");
                $("#"+prq_id).addClass("btn-danger"); 
            }
            })

            function UPDATE_STAT(PQR_ID_, STATUS_){
            $.ajax({
                url:'query/update_status.php',
                method:'POST',
                data:{PQR_ID:PQR_ID_,STATUS:STATUS_},
                success:function(data){

                if (data === "NON-COMPLIANT") {
                  $("#BTN"+PQR_ID_).attr('data-stat',data)
                  $("#msg_stat"+PQR_ID_).text(data)
                  $("#BTN"+PQR_ID_).removeClass("btn-success");
                  $("#BTN"+PQR_ID_).addClass("btn-danger");   
            }
            else{
               $("#BTN"+PQR_ID_).attr('data-stat',data)
                 $("#msg_stat"+PQR_ID_).text(data)
                $("#BTN"+PQR_ID_).removeClass("btn-danger")
                 $("#BTN"+PQR_ID_).addClass("btn-success")
           }    
           $("#spin"+PQR_ID_).addClass("visually-hidden");
                },
                error:function(er){}
            })
           $("#spin"+prq_id).addClass("visually-hidden");
        }
           $(".btn-stat").click(function(){
            var status = $(this).attr('data-stat');
            var prq_id=$(this).attr('data-id');
            $(this).attr('disable',true);
            $("#spin"+prq_id).removeClass("visually-hidden");
            if(status=="COMPLIANT"){
                UPDATE_STAT(prq_id, "NON-COMPLIANT");    
            }
            else{
                UPDATE_STAT(prq_id, "COMPLIANT");    
            }
         
       });



        $(".img_click").click(function() {
            var src = $(this).attr('src');
    $('#imd_prev').attr('src', src); // here assign the image to the modal when the user click the enlarge link
    $('#imagemodal').modal('show');
});
</script>
<?php
insertBatch($values);
}
}
else{
      echo "No data available!";
}
function insertBatch($values) {
    global $conn;

    $query1 = "INSERT INTO [dbo].[Aquila_PQR_Incentive]
    ([COMPANY_ID], [SITE_ID], [PQR_ID], [GLOBAL_RANK], [LOCAL_RANK], [CUSTOMER_ID], [CUSTOMER_NAME], [DATE_PROCESS], 
    [TOTAL_SALES], [SKU_LINE], [TOTAL_SKU_QTY_IT], [STATUS], [A_COMMENT], [B_COMMENT],[DATE_VALIDATED])
    SELECT * FROM (
        VALUES " . implode(',', $values) . "
    ) AS source ([COMPANY_ID], [SITE_ID], [PQR_ID], [GLOBAL_RANK], [LOCAL_RANK], [CUSTOMER_ID], [CUSTOMER_NAME], [DATE_PROCESS], 
    [TOTAL_SALES], [SKU_LINE], [TOTAL_SKU_QTY_IT], [STATUS], [A_COMMENT], [B_COMMENT],[DATE_VALIDATED])
    WHERE NOT EXISTS (
        SELECT 1 FROM [dbo].[Aquila_PQR_Incentive] AS target
        WHERE target.[PQR_ID] = source.[PQR_ID]
    );";
    // Execute the query
    $conn->query($query1);
}
?>


