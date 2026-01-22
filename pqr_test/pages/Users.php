<?php
include 'db_connection.php';
?>
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<!-- DataTables Buttons CSS -->
<link href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- DataTables Bootstrap 5 Integration JS -->
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-trash3-fill"></i> Delete User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="" id="txt_id">
                <span>Are you sure want to delete this user? </span>
            </div>
            <div class="modal-footer">
                <button id="btn_yes" class="btn btn-secondary">Yes</a>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center"> <!-- Center the content horizontally -->
        <div class="card col-12 mb-2" style="height: 50px;">
            <div class="d-flex justify-content-start align-items-center" style="height: 100%;">
                <button class="btn btn-sm btn-primary" id="btn_addnew" data-toggle="modal" data-target="#exampleModal">Add New</button>
                <button class="btn btn-sm btn-primary ml-3" style="margin-left:10px">Download</button>

            </div>
        </div>

        <div id="BODY_" class="row ">
            <div class="col-12">
                <table id="example" class="table table-striped table-horver" style="width:100%;">
                    <thead>
                        <th>Principal</th>
                        <th>Site</th>
                        <th>Fullname</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db_connection.php';

                        $Q = "SELECT * FROM Aquila_PQR_User";
                        $stmt = $conn->query($Q);

                        foreach ($stmt as $row) {

                            // 🔹 Get principal sites
                            $principal_stmt = $conn->prepare("
        SELECT s.SITE_CODE 
        FROM [dbo].[Aquila_PQR_Users_Branch_Mapping] m
        JOIN [dbo].[Aquila_Sites] s ON m.SITE_ID = s.SITEID
        WHERE m.USER_ID = ?
        GROUP BY s.SITE_CODE
    ");
                            $principal_stmt->execute([$row['ID']]);
                            $principal_rows = $principal_stmt->fetchAll(PDO::FETCH_COLUMN);

                            // 🔹 Get company codes
                            $site_stmt = $conn->prepare("
        SELECT c.CODE 
        FROM [dbo].[Aquila_PQR_Users_Company_Mapping] m
        JOIN [dbo].[Aquila_COMPANY] c ON m.COMPANY_ID = c.ID
        WHERE m.USER_ID = ?
        GROUP BY c.CODE
    ");
                            $site_stmt->execute([$row['ID']]);
                            $site_rows = $site_stmt->fetchAll(PDO::FETCH_COLUMN);

                            // Convert arrays to comma-separated strings
                            $principal_list = !empty($principal_rows) ? implode(', ', $principal_rows) : '-';
                            $site_list = !empty($site_rows) ? implode(', ', $site_rows) : '-';
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($site_list) ?></td>
                                <td><?= htmlspecialchars($principal_list) ?></td>

                                <td><?= htmlspecialchars($row["FULLNAME"]) ?></td>
                                <td><?= htmlspecialchars($row["USERNAME"]) ?></td>
                                <td><?= htmlspecialchars($row["PASSWORD"]) ?></td>
                                <td><?= htmlspecialchars($row["ROLE"]) ?></td>
                                <td><?= ($row["STATUS"] == 1) ? 'ACTIVE' : 'INACTIVE' ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-pencil-square"></i> Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="?page=add_newuser&LINE_ID=<?= $row['ID'] ?>" class="dropdown-item">
                                                    <i class="bi bi-pencil-fill"></i> Update
                                                </a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item btn_delete" type="button" data-id="<?= $row['ID'] ?>">
                                                    <i class="bi bi-trash3-fill"></i> Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTables JS -->



    <script type="text/javascript">
        $("#btn_yes").click(function() {
            $("#exampleModal").modal("hide");
            var ID = $("#txt_id").val();
            $.get("query/delete_user.php?LINE_ID=" + ID, function(response) {
                // Handle the response from the server
                showNotification("Deleted User", response)
            }).fail(function(xhr, status, error) {
                // Handle errors that occur during the AJAX request
                showNotification("Shomething Wrong!", error)
            });
            setInterval(function() {
                location.reload();
            }, 2000);
        });

        $(".btn_delete").click(function() {
            $("#txt_id").val($(this).attr('data-id'))
            $("#exampleModal").modal("show");
        })

        $(document).ready(function() {

            $("#date").css("display", "none");
            $("#btn_addnew").click(function() {
                location.href = "?page=add_newuser";
            });
            $('#example').DataTable({
                buttons: [
                    'copy', 'excel', 'pdf' // Add the desired export buttons
                ]
            });
        });
    </script>