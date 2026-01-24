<style>
    .card {
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08) !important;
    }

    .form-select {
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .form-select:focus {
        border-color: #4dabf7;
        box-shadow: 0 0 0 0.25rem rgba(77, 171, 247, 0.15);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
    }

    .input-group-text {
        border-radius: 8px 0 0 8px;
        border-right: none;
    }

    .form-select.border-start-0 {
        border-radius: 0 8px 8px 0;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 20px;
    }

    .btn-outline-secondary {
        border-radius: 8px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .col-sm-6 {
            margin-bottom: 0.5rem;
        }
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">

                <div class="row g-3">
                    <!-- Account Type Filter -->
                    <div class="col-md-3 col-sm-6">
                        <label for="filter_account_type" class="form-label small fw-semibold text-muted mb-1">
                            <i class="bi bi-building me-1"></i>Account Type
                        </label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-filter text-secondary"></i>
                            </span>
                            <select class="form-select form-select-sm border-start-0 ps-0" id="filter_account_type">
                                <option value="" selected>All Types</option>
                                <?php
                                $account_types = $conn->query("SELECT DISTINCT ACCOUNT_TYPE FROM [dbo].[KAVS_ACCOUNTS] WHERE COMPANY_ID = {$_SESSION['selected_comp']} AND SITE_ID = {$_SESSION['selected_site']} AND STATUS=1 ");
                                foreach ($account_types as $type) {
                                ?>
                                    <option value="<?= $type['ACCOUNT_TYPE'] ?>"><?= $type['ACCOUNT_TYPE'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="col-md-3 col-sm-6">
                        <label for="filter_category" class="form-label small fw-semibold text-muted mb-1">
                            <i class="bi bi-tags me-1"></i>Category
                        </label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-funnel text-secondary"></i>
                            </span>
                            <select class="form-select form-select-sm border-start-0 ps-0" id="filter_category">
                                <option value="" selected>All Categories</option>
                                <?php
                                $account_types = $conn->query("SELECT DISTINCT STORE_CATEGORY FROM [dbo].[KAVS_ACCOUNTS] WHERE COMPANY_ID = {$_SESSION['selected_comp']} AND SITE_ID = {$_SESSION['selected_site']} AND STATUS=1 ");
                                foreach ($account_types as $type) {
                                ?>
                                    <option value="<?= $type['STORE_CATEGORY'] ?>"><?= $type['STORE_CATEGORY'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- GeoTag Status Filter -->
                    <div class="col-md-3 col-sm-6">
                        <label for="filter_geotag_status" class="form-label small fw-semibold text-muted mb-1">
                            <i class="bi bi-geo-alt me-1"></i>GeoTag Status
                        </label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-geo text-secondary"></i>
                            </span>
                            <select class="form-select form-select-sm border-start-0 ps-0" id="filter_geotag_status">
                                <option value="" selected>All Statuses</option>
                                <?php
                                $geotag_statuses = $conn->query("SELECT DISTINCT ACCOUNT_STATUS FROM [dbo].[KAVS_ACCOUNTS] WHERE COMPANY_ID = {$_SESSION['selected_comp']} AND SITE_ID = {$_SESSION['selected_site']} AND STATUS=1 ");
                                foreach ($geotag_statuses as $status) {
                                ?>
                                    <option value="<?= $status['ACCOUNT_STATUS'] ?>"><?= $status['ACCOUNT_STATUS'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Map View Button -->
                    <div class="col-md-3 col-sm-6 d-flex align-items-end">
                        <a class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2"
                            href="index.php?page=account_monitoring_map">
                            <i class="bi bi-map"></i>
                            <span>View on Map</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <table id="tbl_user1" class="table table-striped table-horver" style="width:100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <td>Img1</td>
                        <td>Img2</td>
                        <th>Account Id</th>
                        <th>Account Type</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Ads Type</th>
                        <th>Ads Specific</th>
                        <th>Category</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $item = $conn->query("SELECT * from [dbo].[KAVS_ACCOUNTS] C JOIN [dbo].[KAVS_ACCOUNT_IMG] I ON C.ACCOUNT_ID=I.ACCOUNT_ID 
                    WHERE C.COMPANY_ID = {$_SESSION['selected_comp']} AND C.SITE_ID = {$_SESSION['selected_site']} ");
                    $i = 0;
                    foreach ($item as $row) {
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <img src="<?= $row['IMG1'] ?>"
                                    alt="IMG1"
                                    class="img-thumb"
                                    data-bs-toggle="modal"
                                    data-bs-target="#imageModal"
                                    data-img="<?= $row['IMG1'] ?>">
                            </td>
                            <td>
                                <img src="<?= $row['IMG2'] ?>"
                                    alt="IMG2"
                                    class="img-thumb"
                                    data-bs-toggle="modal"
                                    data-bs-target="#imageModal"
                                    data-img="<?= $row['IMG2'] ?>">
                            </td>

                            <td><?= $row['ACCOUNT_ID'] ?></td>
                            <td><?= $row['ACCOUNT_TYPE'] ?></td>
                            <td><?= $row['NAME'] ?></td>
                            <td><?= $row['LANDMARK'] . " | " . $row['ADDRESS'] ?></td>
                            <td><?= $row['ADS_TYPE'] ?></td>
                            <td><?= $row['ADS_SPECIFIC'] ?></td>
                            <td><?= $row['STORE_CATEGORY'] ?></td>
                            <td><?= $row['ACCOUNT_STATUS'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        var tbl = $('#tbl_user1').DataTable();
        $("#filter_category").on('change', function() {
            var selectedCategory = $(this).val();
            if (selectedCategory === "") {
                tbl.column(9).search('').draw();
            } else {
                tbl.column(9).search('^' + selectedCategory + '$', true, false).draw();
            }
        });
        $('#filter_account_type').on('change', function() {
            var selectedType = $(this).val();
            if (selectedType === "") {
                tbl.column(4).search('').draw();
            } else {
                tbl.column(4).search('^' + selectedType + '$', true, false).draw();
            }
        });
        $("#filter_geotag_status").on('change', function() {
            var selectedStatus = $(this).val();
            if (selectedStatus === "") {
                tbl.column(10).search('').draw();
            } else {
                tbl.column(10).search('^' + selectedStatus + '$', true, false).draw();
            }
        });
        $(document).on('click', '.img-thumb', function() {
            const imgSrc = $(this).data('img');
            $('#modalImage').attr('src', imgSrc);
        });

    });
</script>