<!DOCTYPE html>
<html lang="en">
<head>
    <!-- same head as before -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders List - Modern Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/css/tempus-dominus.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .card-shadow { box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
        .table thead { background-color: #0d6efd; color: white; }
        .btn-view { padding: 0.25rem 0.5rem; font-size: 0.875rem; }
        .item-table th { background-color: #f1f3f5; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card card-shadow border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-cart4 me-2"></i>Orders List</h4>
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" class="row g-3 mb-4">
                    <!-- same as before -->
                    <div class="col-md-4">
                        <label class="form-label">Start Date</label>
                        <div class="input-group" id="start-datepicker">
                            <input type="text" class="form-control" name="start_date" value="<?php echo isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : ''; ?>" placeholder="yyyy-mm-dd">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Date</label>
                        <div class="input-group" id="end-datepicker">
                            <input type="text" class="form-control" name="end_date" value="<?php echo isset($_GET['end_date']) ? htmlspecialchars($_GET['end_date']) : ''; ?>" placeholder="yyyy-mm-dd">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2"><i class="bi bi-funnel"></i> Filter</button>
                        <a href="?" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i> Reset</a>
                    </div>
                </form>

                <?php
                include '../../DB/dbcon.php';

                $start_date = $_GET['start_date'] ?? '';
                $end_date = $_GET['end_date'] ?? '';

                try {
                    $sql = "SELECT ORDER_ID, CUSTOMER_NAME, ORDER_DATE, TOTAL_AMOUNT, STATUS FROM OK_Store_Order_Transaction";
                    $where = []; $params = [];

                    if (!empty($start_date)) { $where[] = "ORDER_DATE >= :start_date"; $params[':start_date'] = $start_date; }
                    if (!empty($end_date)) { $where[] = "ORDER_DATE <= :end_date"; $params[':end_date'] = $end_date; }

                    if (!empty($where)) $sql .= " WHERE " . implode(" AND ", $where);
                    $sql .= " ORDER BY ORDER_DATE DESC";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute($params);
                    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Pre-fetch all items to avoid query inside loop later if needed
                    $all_items = [];
                    if (count($orders) > 0) {
                        $ids = array_column($orders, 'ORDER_ID');
                        $in  = str_repeat('?,', count($ids) - 1) . '?';
                        $item_sql = "SELECT ORDER_ID, BARCODE, DESCRIPTION, QTY, PRICE, AMOUNT 
                                     FROM OK_Store_Order_Details 
                                     WHERE ORDER_ID IN ($in) 
                                     ORDER BY ORDER_ID, LINEID";
                        $item_stmt = $conn->prepare($item_sql);
                        $item_stmt->execute($ids);
                        while ($item = $item_stmt->fetch(PDO::FETCH_ASSOC)) {
                            $all_items[$item['ORDER_ID']][] = $item;
                        }
                    }
                ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Order Date</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($orders) > 0): ?>
                                    <?php foreach ($orders as $row): 
                                        $status = strtoupper(trim($row['STATUS']));
                                        $badge_class = $status == 'COMPLETED' ? 'success' : ($status == 'PENDING' ? 'warning' : ($status == 'CANCELLED' ? 'danger' : 'secondary'));
                                        $items = $all_items[$row['ORDER_ID']] ?? [];
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['ORDER_ID']); ?></td>
                                            <td><?php echo htmlspecialchars($row['CUSTOMER_NAME']); ?></td>
                                            <td><?php echo htmlspecialchars($row['ORDER_DATE']); ?></td>
                                            <td><strong><?php echo number_format($row['TOTAL_AMOUNT'], 2); ?></strong></td>
                                            <td><span class="badge bg-<?php echo $badge_class; ?>"><?php echo htmlspecialchars($row['STATUS']); ?></span></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm btn-view" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#orderModal<?php echo $row['ORDER_ID']; ?>">
                                                    <i class="bi bi-eye"></i> View Details
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">No orders found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- All Modals Moved Here (Outside Table) -->
    <?php if (count($orders) > 0): ?>
        <?php foreach ($orders as $row): 
            $items = $all_items[$row['ORDER_ID']] ?? [];
            $status = strtoupper(trim($row['STATUS']));
            $badge_class = $status == 'COMPLETED' ? 'success' : ($status == 'PENDING' ? 'warning' : ($status == 'CANCELLED' ? 'danger' : 'secondary'));
        ?>
            <div class="modal fade" id="orderModal<?php echo $row['ORDER_ID']; ?>" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title"><i class="bi bi-receipt me-2"></i>Order Details - #<?php echo htmlspecialchars($row['ORDER_ID']); ?></h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <!-- same modal content as before -->
                            <div class="row g-4 mb-4">
                                <!-- Customer & Info cards -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm"><div class="card-body">
                                        <h6 class="card-title text-primary"><i class="bi bi-person"></i> Customer</h6>
                                        <p class="mb-0 ml-2"><strong> Name:</strong> <?php echo htmlspecialchars($row['CUSTOMER_NAME']); ?></p>
                                    </div></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm"><div class="card-body">
                                        <h6 class="card-title text-primary"><i class="bi bi-calendar3"></i> Order Info</h6>
                                        <p class="mb-0"><strong>Date:</strong> <?php echo htmlspecialchars($row['ORDER_DATE']); ?></p>
                                        <p class="mb-0"><strong>Status:</strong> <span class="badge bg-<?php echo $badge_class; ?>"><?php echo htmlspecialchars($row['STATUS']); ?></span></p>
                                    </div></div>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="card border-0 shadow-sm"><div class="card-body py-4">
                                        <h3 class="text-primary mb-0"><?php echo number_format($row['TOTAL_AMOUNT'], 2); ?></h3>
                                        <p class="text-muted fw-bold mb-0">Total Amount</p>
                                    </div></div>
                                </div>
                            </div>

                            <h5 class="text-primary mb-3"><i class="bi bi-basket2"></i> Order Items</h5>
                            <?php if (count($items) > 0): ?>
                                <div class="table-responsive">
                                    <table class="table table-striped item-table">
                                        <thead>
                                            <tr>
                                                <th>#</th><th>Barcode</th><th>Description</th><th>Quantity</th><th>Price</th><th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($items as $i => $item): ?>
                                                <tr>
                                                    <td><?php echo $i + 1; ?></td>
                                                    <td><?php echo htmlspecialchars($item['BARCODE'] ?? ''); ?></td>
                                                    <td><?php echo htmlspecialchars($item['DESCRIPTION'] ?? ''); ?></td>
                                                    <td><?php echo htmlspecialchars($item['QTY'] ?? 0); ?></td>
                                                    <td><?php echo number_format($item['PRICE'] ?? 0, 2); ?></td>
                                                    <td><?php echo number_format($item['AMOUNT'] ?? 0, 2); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-primary fw-bold">
                                                <th colspan="5" class="text-end">Total:</th>
                                                <th><?php echo number_format($row['TOTAL_AMOUNT'], 2); ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">No items found.</div>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Print Order</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Scripts at the end -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/js/tempus-dominus.min.js"></script>
    <script>
        new tempusDominus.TempusDominus(document.getElementById('start-datepicker'), { localization: { format: 'yyyy-MM-dd' }, display: { components: { clock: false } } });
        new tempusDominus.TempusDominus(document.getElementById('end-datepicker'), { localization: { format: 'yyyy-MM-dd' }, display: { components: { clock: false } } });
    </script>
</body>
</html>