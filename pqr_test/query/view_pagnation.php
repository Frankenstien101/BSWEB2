<?php
// ✅ Always ensure session is accessible
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Explicitly bring $_SESSION into scope (fixes 'Undefined global variable' on Azure)
global $_SESSION;

// ✅ Read safely with defaults
$totalPages = isset($_SESSION['total_pages']) ? intval($_SESSION['total_pages']) : 1;
$page       = isset($_SESSION['page']) ? intval($_SESSION['page']) : 1;
$dt_from    = $_SESSION['ses_datefrom'] ?? '';
$dt_to      = $_SESSION['ses_dateto'] ?? '';
?>

<?php if ($totalPages > 1): ?>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= ($i == $page ? 'active' : '') ?>" id="<?= $i ?>" style="z-index: 1;">
            <span class="page-link"><?= $i ?></span>
        </li>
    <?php endfor; ?>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function() {
    const current_page = "<?php echo $page; ?>";
    $("#" + current_page).addClass("active");

    $(".page-item").click(function() {
        $(".page-item").removeClass("active");
        show_indicator('block');

        const page = $(this).attr('id');
        $("#" + page).addClass("active");

        const dt_from = "<?php echo addslashes($dt_from); ?>";
        const dt_to   = "<?php echo addslashes($dt_to); ?>";

        view_table(dt_from, dt_to, page);
    });
});
</script>
