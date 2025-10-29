<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$totalPages = isset($_SESSION['total_pages']) ? intval($_SESSION['total_pages']) : 1;
$page = isset($_SESSION['page']) ? intval($_SESSION['page']) : 1;

if ($totalPages > 1): ?>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= ($i == $page ? 'active' : '') ?>" id="<?= $i ?>" style="z-index: 1;">
            <span class="page-link"><?= $i ?></span>
        </li>
    <?php endfor; ?>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function() {
    // Highlight active page
    const current_page = "<?php echo $page; ?>";
    $("#" + current_page).addClass("active");
});

$(".page-item").click(function() {
    $(".page-item").removeClass("active");
    show_indicator('block');

    const page = $(this).attr('id');
    $("#" + page).addClass("active");

    const dt_from = "<?php echo $_SESSION['ses_datefrom'] ?? ''; ?>";
    const dt_to   = "<?php echo $_SESSION['ses_dateto'] ?? ''; ?>";

    view_table(dt_from, dt_to, page);
});
</script>
