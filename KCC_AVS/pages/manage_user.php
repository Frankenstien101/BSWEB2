<?php
include 'db_connection.php';

?>

=
<div class="container-fluid">
    <div class="card">
        <div class="card card-header">
            <div class="row">
                <button class="btn btn-sm btn-secondary col-1 back-button">
                    <i class='bx bx-left-arrow-alt'></i>
                </button>
            </div>
        </div>
        <div class="card card-body">
            <div class="row">
                <form id="form-data" method="POST" name="frm_upload">
                    <input type="hidden" name="ID" value="<?= $USER['ID'] ?? '0' ?>">

                    <div class="row mb-3">
                        <!-- Principal Dropdown -->
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="COMPANY_ID">Principal</label>
                            <select name="COMPANY_ID[]" id="COMPANY_ID" required class="form-control SEL" multiple>
                                <?php
                                $query = "SELECT ID, CODE FROM [dbo].[Aquila_COMPANY] WHERE STATUS = 'ACTIVE' GROUP BY ID, CODE";
                                foreach ($conn->query($query) as $row) {
                                    $selected = in_array($row['ID'], $mapped_companies) ? 'selected' : '';
                                    echo "<option value='{$row['ID']}' $selected>{$row['CODE']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Site Dropdown -->
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="SITE_ID">Site</label>
                            <select name="SITE_ID[]" id="SITE_ID" multiple required class="form-control SEL" <?= empty($mapped_companies) ? 'disabled' : '' ?>>
                                <?php
                                if (!empty($mapped_companies)) {

                                    $in = str_repeat('?,', count($mapped_companies) - 1) . '?';
                                    $site_q = $conn->prepare("
                                        SELECT SITEID, SITE_CODE 
                                        FROM [dbo].[Aquila_Sites]
                                        WHERE COMPANY_ID IN ($in)
                                        GROUP BY SITEID, SITE_CODE
                                    ");
                                    $site_q->execute($mapped_companies);

                                    foreach ($site_q->fetchAll(PDO::FETCH_ASSOC) as $srow) {
                                        $sel = in_array($srow['SITEID'], $mapped_sites) ? 'selected' : '';
                                        echo "<option value='{$srow['SITEID']}' $sel>{$srow['SITE_CODE']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Role -->
                        <div class="form-group col-md-6 col-sm-12 mb-3">
                            <label>Role</label>
                            <select name="ROLE" class="form-control">
                                <option value="0">Select Role</option>
                                <option value="Admin" <?= ($USER['ROLE'] ?? '') == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="GSM" <?= ($USER['ROLE'] ?? '') == 'GSM' ? 'selected' : '' ?>>GSM</option>
                                <option value="OM" <?= ($USER['ROLE'] ?? '') == 'OM' ? 'selected' : '' ?>>OM</option>
                                <option value="DSS" <?= ($USER['ROLE'] ?? '') == 'DSS' ? 'selected' : '' ?>>DSS</option>
                            </select>
                        </div>

                        <!-- Fullname -->
                        <div class="form-group col-md-6 col-sm-12 mb-3">
                            <label>Fullname</label>
                            <input type="text" name="FULLNAME" required class="form-control form-control-lg"
                                value="<?= htmlspecialchars($USER['FULLNAME'] ?? '') ?>" placeholder="Fullname">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Username -->
                        <div class="form-group mb-3 col-md-6 col-sm-12">
                            <label>Username</label>
                            <input name="USERNAME" type="text" required class="form-control form-control-lg"
                                value="<?= htmlspecialchars($USER['USERNAME'] ?? '') ?>" placeholder="User Login">
                        </div>

                        <!-- Password -->
                        <div class="form-group col-md-6 col-sm-12 mb-3">
                            <label>User Password</label>
                            <input name="PASSWORD" type="text" required class="form-control form-control-lg"
                                value="<?= htmlspecialchars($USER['PASSWORD'] ?? '') ?>" placeholder="User Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" style="float:right;" id="btn_submit" name="btn_submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>