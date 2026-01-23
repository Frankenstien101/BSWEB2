<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Device</title>

<!-- Bootstrap 4 & Font Awesome -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
  body { background:#f4f6f9; }
  .card { border-radius:10px; }
  label { font-size:12px; font-weight:600; }
</style>
</head>
<body>

<div class="container mt-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="fas fa-tablet-alt"></i> Device Management</h4>
    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addDeviceModal">
      <i class="fas fa-plus"></i> Add Device
    </button>
  </div>

  <div class="card shadow-sm">
    <div class="card-body text-center text-muted">
      Device list goes here…
    </div>
  </div>

</div>

<!-- ADD DEVICE MODAL -->
<div class="modal fade" id="addDeviceModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow">

      <div class="modal-header bg-primary text-white">
        <h6 class="modal-title"><i class="fas fa-plus-circle"></i> Add New Device</h6>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form id="addDeviceForm">
          <div class="form-row">
            <div class="form-group col-md-4"><label>Site *</label><input type="text" class="form-control" id="SITE_ID" required></div>
            <div class="form-group col-md-4"><label>Department</label><input type="text" class="form-control" id="DEPARTMENT"></div>
            <div class="form-group col-md-4"><label>Principal</label><input type="text" class="form-control" id="PRINCIPAL"></div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4"><label>Position</label><input type="text" class="form-control" id="POSITION"></div>
            <div class="form-group col-md-4"><label>Brand</label><input type="text" class="form-control" id="BRAND"></div>
            <div class="form-group col-md-4"><label>Model</label><input type="text" class="form-control" id="MODEL"></div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4"><label>IMEI</label><input type="text" class="form-control" id="IMEI"></div>
            <div class="form-group col-md-4"><label>Serial</label><input type="text" class="form-control" id="SERIAL"></div>
            <div class="form-group col-md-4"><label>Date Deployed</label><input type="date" class="form-control" id="DATE_DEPLOYED"></div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4"><label>User</label><input type="text" class="form-control" id="PERSON_USING"></div>
            <div class="form-group col-md-4"><label>Mobile Number</label><input type="text" class="form-control" id="NUMBER"></div>
            <div class="form-group col-md-4"><label>Initial Balance (GB)</label><input type="number" class="form-control" id="BALANCE" min="0"></div>
          </div>
          <div class="form-group"><label>Remarks</label><textarea class="form-control" id="REMARKS" rows="2"></textarea></div>
        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary btn-sm" id="btnSaveDevice"><i class="fas fa-save"></i> Save Device</button>
      </div>

    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('btnSaveDevice').addEventListener('click', () => {

  const data = {
    SITE_ID: SITE_ID.value.trim(),
    DEPARTMENT: DEPARTMENT.value.trim(),
    PRINCIPAL: PRINCIPAL.value.trim(),
    POSITION: POSITION.value.trim(),
    BRAND: BRAND.value.trim(),
    MODEL: MODEL.value.trim(),
    IMEI: IMEI.value.trim(),
    SERIAL: SERIAL.value.trim(),
    DATE_DEPLOYED: DATE_DEPLOYED.value,
    PERSON_USING: PERSON_USING.value.trim(),
    NUMBER: NUMBER.value.trim(),
    BALANCE: BALANCE.value || 0,
    REMARKS: REMARKS.value.trim()
  };

  if (!data.SITE_ID) {
    alert('Site is required');
    return;
  }

  if (!data.DATE_DEPLOYED) {
    alert('Date Deployed is required');
    return;
  }

  if (!data.BALANCE) {
    alert('Initial Balance is required');
    return;
  }

  fetch('/LM/datafetcher/adddevice.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(r => r.json())
  .then(res => {
    if (res.success) {
      alert('Device added successfully');
      // Hide the modal properly
      $('#addDeviceModal').modal('hide');
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
      document.getElementById('addDeviceForm').reset();
    } else {
      alert(res.message || 'Save failed');
    }
  })
  .catch(err => {
    console.error(err);
    alert('Server error');
  });

}); // <-- this closes addEventListener

</script>

</body>
</html>
