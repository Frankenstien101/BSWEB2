<?php
include '../db_connection.php';
session_start();

if (empty($_SESSION['comp_id']) || empty($_SESSION['ses_site'])) {
    exit("No data available!");
}

# ==============================
# CONFIG
# ==============================
$recordsPerPage = 100;
$page = max(1, intval($_POST['page'] ?? ($_SESSION['page'] ?? 1)));
$_SESSION['page'] = $page;
$offset = ($page - 1) * $recordsPerPage;

$comp_id = $_SESSION['comp_id'];
$site_id = $_SESSION['ses_site'];
$dtFrom = $_POST['dtfrom'] ?? $_SESSION['ses_datefrom'];
$dtTo   = $_POST['dtto'] ?? $_SESSION['ses_dateto'];
$_SESSION['ses_datefrom'] = $dtFrom;
$_SESSION['ses_dateto'] = $dtTo;

$seller_id = $_POST['seller_id'] ?? '';
$seller_filter = ($seller_id && $seller_id !== 'All') ? "AND SELLER_SUB_ID = :seller_id" : "";

# ==============================
# COUNT QUERY (OPTIMIZED)
# ==============================
$countSql = "
SELECT COUNT(DISTINCT CONCAT(CU_ID, '-', DATE_PROCESS)) AS total
FROM [dbo].[Aquila_PQR] WITH (NOLOCK)
WHERE COMPANY_ID = :comp_id 
  AND SITE_ID = :site_id 
  AND DATE_PROCESS BETWEEN :dtFrom AND :dtTo
";
$stmt = $conn->prepare($countSql);
$stmt->execute([
    ':comp_id' => $comp_id,
    ':site_id' => $site_id,
    ':dtFrom'  => $dtFrom,
    ':dtTo'    => $dtTo
]);
$totalRecords = (int) $stmt->fetchColumn();
$totalPages = ceil($totalRecords / $recordsPerPage);
$_SESSION['total_pages'] = $totalPages;

# ==============================
# MAIN QUERY (OPTIMIZED)
# ==============================
$sql = "
;WITH CTE AS (
    SELECT 
        MAX(A.LINE_ID) AS ID,
        MIN(A.DISTANCE) AS CAP_DISTANCE,
        ISNULL(A.BRAND, 'DEFAULT') AS BRAND,
        A.COMPANY_ID,
        A.SITE_ID,
        A.SELLER_SUB_ID,
        A.SELLER_ID,
        A.DATE_PROCESS,
        A.CU_ID,
        A.CU_NAME,
        CONCAT(A.CU_ID, '-', A.DATE_PROCESS) AS TRANS_ID,
        COALESCE(MAX(A.BEFORE_LINK), MAX(B.BEFORE_LINK)) AS BEFORE_LINK,
        COALESCE(MAX(A.AFTER_LINK), MAX(B.AFTER_LINK)) AS AFTER_LINK,
        CASE 
            WHEN (MAX(A.BEFORE_LINK) IS NULL OR MAX(A.AFTER_LINK) IS NULL)
                 AND (MAX(B.BEFORE_LINK) IS NULL OR MAX(B.AFTER_LINK) IS NULL)
            THEN 'NON-COMPLIANT'
            ELSE 'COMPLIANT'
        END AS STATUS
    FROM [dbo].[Aquila_PQR] A WITH (NOLOCK)
    LEFT JOIN [dbo].[Aquila_PQR_Link] B WITH (NOLOCK) ON A.PQR_ID = B.PQR_ID
    WHERE A.COMPANY_ID = :comp_id
      AND A.SITE_ID = :site_id
      AND A.BRAND != 'CLVB'
      $seller_filter
      AND A.DATE_PROCESS BETWEEN :dtFrom AND :dtTo
    GROUP BY 
        CONCAT(A.CU_ID, '-', A.DATE_PROCESS),
        A.CU_ID, A.BRAND, A.DATE_PROCESS,
        A.SELLER_ID, A.SELLER_SUB_ID, A.CU_NAME, A.COMPANY_ID, A.SITE_ID
)
SELECT 
    B.ID, B.CU_ID, B.CU_NAME, B.SELLER_ID, B.SELLER_SUB_ID,
    B.BRAND, B.CAP_DISTANCE, B.COMPANY_ID, B.SITE_ID, B.DATE_PROCESS,
    B.BEFORE_LINK, B.AFTER_LINK, B.STATUS,
    ISNULL(I.A_COMMENT, '') AS A_COMMENT,
    ISNULL(I.B_COMMENT, '') AS B_COMMENT,
    ISNULL(I.STATUS, '') AS stat_fin
FROM CTE B
LEFT JOIN [dbo].[Aquila_PQR_Incentive] I WITH (NOLOCK) ON B.ID = I.PQR_ID
ORDER BY B.ID
OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY;
";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':comp_id', $comp_id, PDO::PARAM_STR);
$stmt->bindValue(':site_id', $site_id, PDO::PARAM_STR);
$stmt->bindValue(':dtFrom', $dtFrom, PDO::PARAM_STR);
$stmt->bindValue(':dtTo', $dtTo, PDO::PARAM_STR);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $recordsPerPage, PDO::PARAM_INT);
if ($seller_filter) $stmt->bindValue(':seller_id', $seller_id, PDO::PARAM_STR);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$rows) exit("No data available!");

$ids = array_column($rows, 'ID');
?>

<!-- Render Table -->
<?php foreach ($rows as $i => $row): 
    $finalStatus = $row['stat_fin'] ?: $row['STATUS'];
    $btnClass = $finalStatus === 'COMPLIANT' ? 'btn-success' : 'btn-danger';
?>
<tr>
    <td><?= $i + 1 ?></td>
    <td>
        <button class="btn btn-stat btn-sm <?= $btnClass ?>" 
                data-stat="<?= htmlspecialchars($finalStatus) ?>" 
                data-id="<?= $row['ID'] ?>" 
                id="BTN<?= $row['ID'] ?>">
            <span class="spinner-border spinner-border-sm visually-hidden" id="spin<?= $row['ID'] ?>"></span>
            <span id="msg_stat<?= $row['ID'] ?>"><?= htmlspecialchars($finalStatus) ?></span>
        </button>
    </td>
    <td><?= htmlspecialchars($row['BRAND']) ?></td>
    <td><?= htmlspecialchars($row['SELLER_ID']) ?></td>
    <td><?= htmlspecialchars($row['CU_ID']) ?></td>
    <td><?= htmlspecialchars($row['CU_NAME']) ?></td>
    <td><?= htmlspecialchars($row['DATE_PROCESS']) ?></td>
    <td><?= htmlspecialchars($row['CAP_DISTANCE']) ?></td>
    <td>
        <div class="d-flex flex-column align-items-center">
            <img class="img-thumbnail mb-2 img_click" src="<?= htmlspecialchars($row['AFTER_LINK']) ?>" alt="After Image">
            <select class="form-select form-select-sm select_after" data-id="<?= $row['ID'] ?>" style="width:20vh">
                <option value="Proper Execution">Proper Execution</option>
                <option value="Not Proper Execution">Not Proper Execution</option>
            </select>
        </div>
    </td>
    <td>
        <div class="d-flex flex-column align-items-center">
            <img class="img-thumbnail mb-2 img_click" src="<?= htmlspecialchars($row['BEFORE_LINK']) ?>" alt="Before Image">
            <select class="form-select form-select-sm select_before" data-id="<?= $row['ID'] ?>" style="width:20vh">
                <option value="Proper Execution">Proper Execution</option>
                <option value="Not Proper Execution">Not Proper Execution</option>
            </select>
        </div>
    </td>
</tr>
<?php endforeach; ?>

<script>
function updateStatus(pqrId, status) {
    $.post('query/update_status.php', { PQR_ID: pqrId, STATUS: status }, function(data) {
        const btn = $("#BTN" + pqrId);
        const msg = $("#msg_stat" + pqrId);
        btn.removeClass("btn-success btn-danger").addClass(data === "COMPLIANT" ? "btn-success" : "btn-danger");
        msg.text(data);
    });
}

$(".btn-stat").on('click', function() {
    const btn = $(this);
    const id = btn.data('id');
    const status = btn.data('stat') === "COMPLIANT" ? "NON-COMPLIANT" : "COMPLIANT";
    btn.data('stat', status);
    updateStatus(id, status);
});

$(".select_before, .select_after").on('change', function() {
    const id = $(this).data('id');
    const type = $(this).hasClass("select_before") ? "BEFORE" : "AFTER";
    const status = $(this).val();
    $.post('query/update_status_ba.php', { PQR_ID: id, STATUS: status, type });
});

$(".img_click").on('click', function() {
    const src = $(this).attr("src");
    if (src) {
        $("#imd_prev").attr("src", src);
        $("#imageModalLabel").text($(this).attr("alt"));
        $("#imagemodal").modal("show");
    }
});
</script>

<?php
# ==============================
# BATCH UPDATE (OPTIMIZED)
# ==============================
if (!empty($ids)) {
    $userid = $_SESSION['id'] ?? null;
    $now = date('Y-m-d H:i:s');
    $in  = str_repeat('?,', count($ids) - 1) . '?';
    $sql = "
        UPDATE dbo.Aquila_PQR
        SET PHOTO_STATUS = 'COMPLIANT',
            VALIDATED_DATE = ?,
            USER_ID = ?
        WHERE LINE_ID IN ($in)
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array_merge([$now, $userid], $ids));
}
?>
