<div class="container-fluid">
    <div class="row">
        <div class="card col-12 mb-2" style="height: 50px;">
            <div class="d-flex justify-content-end align-items-center gap-1" style="height: 100%;">
                <select class="form-select form-select-sm mr-2" style="width:150px;" id="filter_account_type">
                    <option selected>Account Type</option>
                    <?php
                    $account_types = $conn->query("SELECT DISTINCT ACCOUNT_TYPE FROM [dbo].[KAVS_ACCOUNTS] WHERE COMPANY_ID = {$_SESSION['selected_comp']} AND SITE_ID = {$_SESSION['selected_site']} AND STATUS=1 ");
                    foreach ($account_types as $type) {
                    ?>
                        <option value="<?= $type['ACCOUNT_TYPE'] ?>"><?= $type['ACCOUNT_TYPE'] ?></option>
                    <?php
                    }
                    ?>

                </select>
                <select class="form-select form-select-sm mr-2" style="width:150px;" id="filter_category">
                    <option selected>Category</option>
                    <?php
                    $account_types = $conn->query("SELECT DISTINCT STORE_CATEGORY FROM [dbo].[KAVS_ACCOUNTS] WHERE COMPANY_ID = {$_SESSION['selected_comp']} AND SITE_ID = {$_SESSION['selected_site']} AND STATUS=1 ");
                    foreach ($account_types as $type) {
                    ?>
                        <option value="<?= $type['STORE_CATEGORY'] ?>"><?= $type['STORE_CATEGORY'] ?></option>
                    <?php
                    }
                    ?>

                </select>
                <select class="form-select form-select-sm mr-2" style="width:150px;" id="filter_geotag_status">
                    <option selected>GeoTag Status</option>

                    <option value="2">Geotagged</option>
                    <option value="2">Geotagged</option>
                    <option value="1">For Geotagged</option>

                </select>
                <a class="btn btn-sm btn-primary" href="index.php?page=account_monitoring_map">Maps View</a>
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
                        <th>Geotaged</th>
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
                            <td><?= $row['STATUS'] ?></td>
                            <td><?= $row['IS_FOR_GEOTAG'] ?></td>
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
            if (selectedCategory === "Category") {
                tbl.column(9).search('').draw();
            } else {
                tbl.column(9).search('^' + selectedCategory + '$', true, false).draw();
            }
        });
        $('#filter_account_type').on('change', function() {
            var selectedType = $(this).val();
            if (selectedType === "Select Account Type") {
                tbl.column(4).search('').draw();
            } else {
                tbl.column(4).search('^' + selectedType + '$', true, false).draw();
            }
        });
        $(document).on('click', '.img-thumb', function() {
            const imgSrc = $(this).data('img');
            $('#modalImage').attr('src', imgSrc);
        });

    });
</script>