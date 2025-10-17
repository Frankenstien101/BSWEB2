 <style>
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .action-dropdown .dropdown-toggle::after {
            display: none;
        }
        .status-active {
            color: #28a745;
            font-weight: 500;
        }
        .status-inactive {
            color: #dc3545;
            font-weight: 500;
        }
        .password-cell {
            font-family: monospace;
        }
        .table-container {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            border-radius: 0.25rem;
            overflow: hidden;
        }
        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>
<body>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="deleteModalLabel"><i class="bi bi-exclamation-triangle-fill text-danger"></i> Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="" id="txt_id">
                    <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="btn_confirm_delete" class="btn btn-danger">Delete User</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-people-fill"></i> User Management</h5>
                        <div>
                            <button class="btn btn-primary btn-sm me-2" id="btn_addnew">
                                <i class="bi bi-plus-lg"></i> Add New User
                            </button> 
                            <button class="btn btn-success btn-sm" id="btn_download">
                                <i class="bi bi-download"></i> Export
                            </button> 
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-container">
                            <table id="userTable" class="table table-hover table-striped" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>Company</th>
                                        <th>Site</th>
                                        <th>Role</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../db_connection.php';
                                    $Q = "SELECT b.CODE, c.SITE_CODE, a.* FROM [dbo].[Aquila_SC3_users] a 
                                          LEFT JOIN [dbo].[Aquila_COMPANY] b ON a.COMPANY_ID = b.ID 
                                          JOIN [dbo].[Aquila_Sites] c ON a.SITE_ID = c.SITEID 
                                          WHERE a.STATUS != 'DELETED'";
                                    foreach($conn->query($Q) as $row) {
                                        $statusClass = ($row["STATUS"] == 'ACTIVE') ? 'status-active' : 'status-inactive';
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row["CODE"]) ?></td>
                                        <td><?php echo htmlspecialchars($row["SITE_CODE"]) ?></td>
                                        <td><?php echo htmlspecialchars($row["User_Role"]) ?></td>
                                        <td><?php echo htmlspecialchars($row["USER_LOGIN_ID"]) ?></td>
                                        <td class="password-cell"><?php echo htmlspecialchars($row["USER_PASS"]) ?></td>
                                        <td><span class="<?php echo $statusClass ?>"><?php echo htmlspecialchars($row["STATUS"]) ?></span></td>
                                        <td>
                                            <div class="dropdown action-dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-gear"></i> Actions
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="?page=add_newuser&LINE_ID=<?php echo $row["LINE_ID"] ?>" 
                                                           class="dropdown-item">
                                                            <i class="bi bi-pencil-square text-primary"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item text-danger btn_delete" 
                                                                data-id="<?php echo $row["LINE_ID"]?>">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>  
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap 5 Integration JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        // Initialize DataTable with export buttons
        var table = $('#userTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="bi bi-file-excel"></i> Excel',
                    className: 'btn btn-success btn-sm'
                },
                {
                    extend: 'pdf',
                    text: '<i class="bi bi-file-pdf"></i> PDF',
                    className: 'btn btn-danger btn-sm'
                },
                {
                    extend: 'copy',
                    text: '<i class="bi bi-files"></i> Copy',
                    className: 'btn btn-secondary btn-sm'
                }
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search users..."
            }
        });

        // Add new user button
        $("#btn_addnew").click(function() {
            location.href = "?page=add_newuser";
        });

        // Delete button handler
        $(".btn_delete").click(function() {
            $("#txt_id").val($(this).attr('data-id'));
            $("#deleteModal").modal("show");
        });

        // Confirm delete button
        $("#btn_confirm_delete").click(function() {
            $("#deleteModal").modal("hide");
            var ID = $("#txt_id").val();
            
            $.get("query/delete_user.php?LINE_ID="+ID, function(response) {
                showNotification("User Deleted", "The user has been successfully deleted.", "success");
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }).fail(function(xhr, status, error) {
                showNotification("Error", "Something went wrong: " + error, "danger");
            });
        });

        // Download/Export button
        $("#btn_download").click(function() {
            table.button('.buttons-excel').trigger();
        });

        // Notification function (you'll need to implement this based on your notification system)
        function showNotification(title, message, type) {
            // Implement your notification system here
            console.log(title + ": " + message);
            alert(title + ": " + message); // Temporary fallback
        }
    });
    </script>
</body>