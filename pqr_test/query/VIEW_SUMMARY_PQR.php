
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel="stylesheet">
<table class="table table-striped" id="example">
    <thead>
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Total Doors</th>
            <th>Compliant</th>
            <th>Non Compliant</th>
            <th>No Photo</th>
            <th>Percentage</th>
        </tr>
    </thead>
    <tbody id="body_tbl">
        <?php
        include '../db_connection.php';
        session_start();
        $site = $_SESSION['ses_site'];
        $comp_id= $_SESSION['comp_id'];
        $dtFrom = $_POST['dtfrom'];
        $dtTo = $_POST['dtto'];
        $type = htmlspecialchars($_POST['type']);



        $query = "select $type AS CODE, COUNT(*) AS TOTAL_DOORS,
                  SUM(CASE WHEN c.STATUS = 'COMPLIANT' AND c.DATE_PROCESS BETWEEN '{$dtFrom}' AND '{$dtTo}' THEN 1 ELSE 0 END) AS COMPLIANT,
                  SUM(CASE WHEN c.STATUS = 'NON-COMPLIANT' AND c.DATE_PROCESS BETWEEN '{$dtFrom}' AND '{$dtTo}' THEN 1 ELSE 0 END) AS NON_COMPLIANT,
                  (COUNT(*)-SUM(CASE WHEN c.DATE_PROCESS BETWEEN '{$dtFrom}' AND '{$dtTo}' THEN 1 ELSE 0 END)) NO_PHOTO,
                  ROUND((CAST(SUM(CASE WHEN c.STATUS = 'COMPLIANT' AND c.DATE_PROCESS BETWEEN '{$dtFrom}' AND '{$dtTo}' THEN 1 ELSE 0 END) AS DECIMAL) / COUNT(*))*100, 2) AS PERCENTAGE
                  from [dbo].[Aquila_Customers] a 
                  LEFT join [dbo].[Aquila_Coverage] b on a.STORE_CODE = b.CUSTOMER_ID AND a.STATUS = b.STATUS
				  	  AND a.COMPANY_ID=b.COMPANY_ID
                  LEFT JOIN [dbo].[Aquila_PQR_Incentive] c ON a.STORE_CODE = c.CUSTOMER_ID AND b.COMPANY_ID = c.COMPANY_ID
                  join [dbo].[Aquila_Sites] d on b.SITE_ID = d.SITEID  
                  WHERE A.COMPANY_ID='{$comp_id}' AND b.STATUS='ACTIVE' AND a.STATUS='ACTIVE'
                  GROUP BY $type ORDER BY $type DESC";


        $result = $conn->query($query);
        $i = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $i++;
            echo "<tr>
                    <td>{$i}</td>
                    <td>{$row['CODE']}</td>
                    <td>{$row['TOTAL_DOORS']}</td>
                    <td><a href='../PQR/pages/view_details_pqr.php' target='_blank'>{$row['COMPLIANT']}</a></td>
                    <td><a href='#'>{$row['NON_COMPLIANT']}</a></td>
                    <td><a href='#'>{$row['NO_PHOTO']}</a></td>
                    <td>".round($row['PERCENTAGE'], 2)."%</td>
                  </tr>";
        }
        ?>
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Download Excel',
                titleAttr: 'Download as Excel',
            }
        ]
    });
});
</script>

