<div class="container-fluid">
    <div class="row">
        <div class="card col-12 mb-2" style="height: 50px;">
            <div class="d-flex justify-content-end align-items-center" style="height: 100%;">
                <a class="btn btn-sm btn-primary" href="index.php?page=account_monitoring_map">Maps View</a>
            </div>
        </div>
        <div class="col-12">
            <table id="tbl_user1" class="table table-striped table-horver" style="width:100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <td>Img</td>
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
                    WHERE C.COMPANY_ID = {$_SESSION['selected_comp']} AND C.SITE_ID = {$_SESSION['selected_site']} AND C.STATUS = 1");
                    $i = 0;
                    foreach ($item as $row) {
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><img src="<?= $row['IMG1'] ?>" alt="IMG1"></td>
                            <td><?= $row['ACCOUNT_ID'] ?></td>
                            <td><?= $row['ACCOUNT_TYPE'] ?></td>
                            <td><?= $row['NAME'] ?></td>
                            <td><?= $row['LANDMARK'] . " | " . $row['ADDRESS'] ?></td>
                            <td><?= $row['ADS_TYPE'] ?></td>
                            <td><?= $row['ADS_SPECIFIC'] ?></td>
                            <td><?= $row['STORE_CATEGORY'] ?></td>
                            <td><?= $row['STATUS'] ?></td>
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
        $('#tbl_user1').DataTable();
    });
</script>