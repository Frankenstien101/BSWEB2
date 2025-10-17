 <style>
.upload-card {
            background-color: #F6F6F9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #202241;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 1.5rem;
        }
        .card-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: #01ABE6;
            border-color: #01ABE6;
        }
        .btn-primary:hover {
            background-color: #007BAA;
            border-color: #007BAA;
        }
    </style>
<div class="container ">
        <div class="row ">
        <div class="col-lg-4">
                <div class="card upload-card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">PQR Top Doors</h6>
                    </div>
                    <form id="fileup">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="fileInput" class="form-label">Choose File</label>
                            <input type="file" class="form-control" name="import_file" id="import_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                        <div class="mb-3">
                            <div id="status"></div>
                            <progress id="progressBar" value="0" max="100"></progress>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="submit" name="submit" value="Upload"> Upload</button>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <p class="mb-0">Download Template</p>
                        <a href="query/download_template.php?file=files/PQR_INCENTIVE_TEMPLATE.xlsx" class="btn btn-link text-decoration-none">Download Now</a>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card upload-card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Covverage Master</h6>
                    </div>
                    <form id="fileup_covrage">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="fileInput" class="form-label">Choose File</label>
                            <input type="file" class="form-control" name="import_file_coverage" id="import_file_coverage" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                        <div class="mb-3">
                            <div id="status"></div>
                            <progress id="progressBar1" value="0" max="100"></progress>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="submit" name="submit1" value="Upload"> Upload</button>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <p class="mb-0">Download Template</p>
                        <a href="query/download_template.php?file=PQR_INCENTIVE_TEMPLATE" class="btn btn-link text-decoration-none">Download Now</a>
                    </div>
                    </form>
                </div>        
            </div>
            <div class="col-lg-4">
                <div class="card upload-card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Covverage Master</h6>
                    </div>

                    <div class="card-body">
                    <button id="startProcess">Start Process</button>
    <div id="progressBarSample"></div>
    <progress id="progressBarSample1" value="0" max="100"></progress>

                    </div>
                    <div class="card-footer text-muted text-center">
                        <p class="mb-0">
                        <a href="query/download_template.php?file=files/PQR_INCENTIVE_TEMPLATE.xlsx" class="btn btn-link text-decoration-none">Download Now</a>
                    </div>

                </div>        
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

function show_progress(){

var eventSource = new EventSource('query/upload_coverage_master.php');
eventSource.onmessage = function(event) {
    var data = event.data;
    if (data === 'complete') {
        eventSource.close();
        $("#progressBarSample").text("Progress: Complete");
    } else {
        var progress = parseInt(data);
        $("#progressBarSample").text("Progress: " + progress + "%");
    }
};
eventSource.onerror = function() {
    $("#progressBarSample").text("Error updating progress");
    eventSource.close();
};
}

function uploadFile(formData, progressHandler, successHandler, errorHandler,query_path) {
    $.ajax({
        url: "query/"+query_path+".php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    xhr.upload.addEventListener("progress", function(event) {
                        if (event.lengthComputable) {
                            var progress = (event.loaded / event.total) * 100;
                            progressHandler(progress);
                        }
                    }, false);
                }
                return xhr;
            },
        success: function(response) {
            alert(response)
            successHandler(response);
        },
        error: function() {
            errorHandler();
        }
    });
}


function progressHandler(progress) {
        $('#progressBar1').val(progress);
    }

    function successHandler(response) {
        alert('Upload completed: ' + response);
    }

    function errorHandler() {
        alert('Upload failed');
    }

    document.getElementById("fileup").addEventListener("submit", function(event) {
        event.preventDefault();
        var file = document.getElementById("import_file").files[0];
        if (!file) {
            alert("Please select a file.");
        } else {
            document.getElementById("submit").disabled = true;
            
            var formData = new FormData();
            formData.append("import_file", file);

            uploadFile(formData, progressHandler, successHandler, errorHandler,"upload_pqr_inc");

        }
    });
    document.getElementById("fileup_covrage").addEventListener("submit", function(event) {
        event.preventDefault();
        var file = document.getElementById("import_file_coverage").files[0];
        if (!file) {
            alert("Please select a file.");
        } else {
            var formData = new FormData();
            document.getElementById("submit").disabled = true;
            formData.append("import_file_coverage", file);
            uploadFile(formData, progressHandler, successHandler, errorHandler,"upload_coverage_master");
        }
    });

    $(document).ready(function() {

});

</script>