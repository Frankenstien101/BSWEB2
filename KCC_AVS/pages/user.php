<div class="container-fluid">
    <div class="row">
        <div class="card col-12 mb-2" style="height: 50px;">
            <div class="d-flex justify-content-end align-items-center" style="height: 100%;">
                <button class="btn btn-sm btn-primary" id="btn_addnew" data-toggle="modal" data-target="#exampleModal">Add New</button>
                <button class="btn btn-sm btn-primary ml-3" style="margin-left:10px">Download</button>

            </div>
        </div>
        <div class="col-12">
            <table id="tbl_user" class="table table-striped table-horver" style="width:100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Source</th>
                        <th>User Code</th>
                        <th>Company</th>
                        <th>Site</th>
                        <th>Fullname</th>
                        <th>Account Type</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $item = $conn->query("select * from [dbo].[KAVS_USERS] KA JOIN [dbo].[KAVS_SITE] KS ON KA.SITE_ID=KS.SITE_ID");
                    $i = 0;
                    foreach ($item as $row) {
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['USER_SOURCE'] ?></td>
                            <td><?= $row['USERNAME'] ?></td>
                            <td><?= $row['COMPANY_ID'] ?></td>
                            <td><?= $row['CODE'] ?></td>
                            <td><?= $row['FULLNAME'] ?></td>
                            <td><?= $row['ACCOUNT_TYPE'] ?></td>
                            <td><?= $row['LOGIN_USERNAME'] ?></td>
                            <td><?= $row['PASSWORD'] ?></td>
                            <td><?= $row['STATUS'] ?></td>
                            <td><button class="btn btn-sm btn-primary">Edit</button></td>
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
        $('#tbl_user').DataTable();
    });
</script>