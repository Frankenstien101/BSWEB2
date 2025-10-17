<?php  
include '../db_connection.php';
session_start();

// Securely get session and POST values
$site = $_SESSION['ses_site'] ?? '';
$comp_id = $_SESSION['comp_id'] ?? '';
$type = htmlspecialchars($_POST['type'] ?? '', ENT_QUOTES, 'UTF-8');

// Fetch brands in a single optimized query
$query_brand = $conn->prepare("
  SELECT DISTINCT BRAND 
  FROM [dbo].[SNAP_GUIDELINE_SETUP_TRANSACTION] a
  JOIN [SNAP_GUIDELINE_SETUP_DETAILS] b ON a.GUIDELINES_ID = b.GUIDELINES_ID
  WHERE :currentDate BETWEEN EFFECTIVE_FROM AND EFFECTIVE_TO 
  AND a.COMPANY_ID = '5' 
  AND a.STATUS = 'ACTIVE' 
  AND b.STATUS = 'ACTIVE'
  ");
$query_brand->execute(['currentDate' => date('Y-m-d')]);
$brands = $query_brand->fetchAll(PDO::FETCH_ASSOC);

// Function to fetch data based on brand
function fetchData($conn, $type, $brand = null) {
    $brandFilter = $brand ? "AND SD.BRAND = :brand" : ""; // Add brand filter if applicable

    $query = "
    WITH CTE AS (
      SELECT 
      a.SITE_ID, SITE_CODE, STORE_CODE, CUSTOMER_NAME, 
      b.SELLER_ID, GUIDELINES_ID, SD.LINEID, SD.BRAND, SD.DESCRIPTION,
      SD.SHELVING_FACING_COUNT AS SHOULD_BE_FC, 
      CASE WHEN SL.LINEID IS NULL THEN 0 ELSE 1 END AS W_PHOTO, 
      CASE WHEN SL.STATUS = 'PENDING' THEN 1 ELSE 0 END AS PENDING,
      CASE WHEN SL.STATUS = 'NON COMPLIANT' THEN 1 ELSE 0 END AS NON_COMPLIANT,
      CASE WHEN SL.STATUS = 'COMPLIANT' THEN 1 ELSE 0 END AS COMPLIANT
      FROM Aquila_Customers a
      JOIN Aquila_Coverage b ON a.STORE_CODE = b.CUSTOMER_ID AND a.COMPANY_ID = b.COMPANY_ID
      JOIN [dbo].[Aquila_Seller] AQS ON b.SELLER_ID = AQS.SELLER_SUB_ID
      JOIN [dbo].[Aquila_Sites] STS ON AQS.SITE_ID = STS.SITEID
      CROSS JOIN [SNAP_GUIDELINE_SETUP_DETAILS] SD 
      LEFT JOIN [dbo].[SNAP_EXECUTION_LINES] SL 
      ON SD.GUIDELINES_ID = SL.GUIDELINE_ID 
      AND a.STORE_CODE = SL.STORE_ID 
      AND SD.LINEID = SL.GUIDELINE_QUESTION_LINEID
      WHERE 
      b.SELLER_ID NOT LIKE '%PRE%' 
      AND SELLER_TYPE = 'PRE SELLER' 
      AND b.COMPANY_ID = '5' 
      AND SD.COMPANY_ID = '5'
      AND a.STATUS = 'ACTIVE' 
      AND b.STATUS = 'ACTIVE'
      $brandFilter
      )
    SELECT 
    $type AS CODE, 
    COUNT(SITE_CODE) AS TO_BE_EXECUTED, 
    SUM(W_PHOTO) AS EXECUTED, 
    SUM(PENDING) AS TO_VALIDATE,
    SUM(NON_COMPLIANT) AS NON_COMPLIANT, 
    SUM(COMPLIANT) AS COMPLIANT  
    FROM CTE 
    GROUP BY $type 
    ORDER BY $type ASC
    ";

    $stmt = $conn->prepare($query);
    if ($brand) {
      $stmt->execute(['brand' => $brand]);
    } else {
      $stmt->execute();
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

// Fetch general data
  $generalData = fetchData($conn, $type);
  ?>

  <div class="container-fluid">
    <div id="carouselExample" class="carousel carousel-dark slide">
      <div class="carousel-inner">

        <!-- General Data Slide -->
        <div class="carousel-item active">
           <div class="row justify-content-center">
              <div class="col-4 text-center mb-2 mt-2">
              <button class="btn btn-primary btn-sm saveBrand" data-brand="Total" data-id="0">
                <i class="bi bi-download"></i> Download as PNG
              </button>                        
            </div>
          </div>
          <table class="table table-striped" id="card-det0">
            <thead>
              <tr class="bg-secondary text-light">
                <th colspan="7" class="text-center">Total | <?php echo date('y-m-d') ?></th>
              </tr>
              <tr>    
                <th>Code</th>
                <th>To Be Executed</th>
                <th>Executed</th>
                <th>To Validate</th>
                <th>Non Compliant</th>
                <th>Compliant</th>
                <th>Percentage</th>  
              </tr>                
            </thead>
            <tbody>
              <?php foreach ($generalData as $row): ?>
                <tr>
                  <td><?= htmlspecialchars($row['CODE']) ?></td>
                  <td><?= $row['TO_BE_EXECUTED'] ?></td>
                  <td><?= $row['EXECUTED'] ?></td>
                  <td><?= $row['TO_VALIDATE'] ?></td>               
                  <td><a href="#"><?= $row['NON_COMPLIANT'] ?></a></td>
                  <td><a href="../PQR/pages/view_details_pqr.php" target="_blank"><?= $row['COMPLIANT'] ?></a></td>
                  <td><?= round(($row['COMPLIANT'] / ($row['TO_BE_EXECUTED'] ?: 1)) * 100, 2) . '%' ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Brand-wise Data Slides -->
        <?php
$i = 0;
         foreach ($brands as $brand): 
          $brandData = fetchData($conn, $type, $brand['BRAND']);
          $i++;
          ?>
          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-4 text-center mb-2 mt-2">
              <button class="btn btn-primary btn-sm saveBrand" data-brand="<?php echo  str_replace(' ', '', $brand['BRAND'])  ?>" data-id="<?php echo $i ?>">
                <i class="bi bi-download"></i> Download as PNG
              </button>                        
            </div>
          </div>
          <table class="table table-striped" id="card-det<?php echo $i ?>">
            <thead>
              <tr class="bg-secondary text-light">
                <th colspan="7" class="text-center"><?= htmlspecialchars($brand['BRAND'])." | ".date('Y-m-d') ?>
              </th>
            </tr>
            <tr>    
              <th>Code</th>
              <th>To Be Executed</th>
              <th>Executed</th>
              <th>To Validate</th>
              <th>Non Compliant</th>
              <th>Compliant</th>
              <th>Percentage</th>  
            </tr>                
          </thead>
          <tbody>
            <?php foreach ($brandData as $row): ?>
              <tr>
                <td><?= htmlspecialchars($row['CODE']) ?></td>
                <td><?= $row['TO_BE_EXECUTED'] ?></td>
                <td><?= $row['EXECUTED'] ?></td>
                <td><?= $row['TO_VALIDATE'] ?></td>               
                <td><a href="#"><?= $row['NON_COMPLIANT'] ?></a></td>
                <td><a href="../PQR/pages/view_details_pqr.php" target="_blank"><?= $row['COMPLIANT'] ?></a></td>
                <td><?= round(($row['COMPLIANT'] / ($row['TO_BE_EXECUTED'] ?: 1)) * 100, 2) . '%' ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Carousel Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
$(".table").DataTable();
  $(".saveBrand").click(function(){  
    html2canvas(document.querySelector("#card-det"+$(this).attr('data-id'))).then(canvas => {

                    var brand = $(this).attr('data-brand');

                    let image = canvas.toDataURL("image/png"); // Convert to image format
                    let link = document.createElement("a");
                    link.href = image;
                    link.download = "Brand_"+brand+"<?php echo date('Ymd'); ?>"+".png";
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                  });
  })
</script>