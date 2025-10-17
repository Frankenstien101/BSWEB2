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
<style>
    .card-title {
        margin-top: 15px;
        font-weight: bold;
        color: #343a40;
    }

    .card-text {
        color: #6c757d;
    }

    .card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
        margin: 4px;
    }

    .bi {
        font-size: 30px;
        color: #EEEEEE;
    }

    .table {
        overflow-x: scroll;
        border-radius: 15px;
        background-color: #F6F6F9;
    }
</style>
<div class="spinner-wrapper visually-hidden">
    <div style="position:fixed; top:0; right:0;margin:10px">
        <button class="btn btn_close"><i class="bi bi-x-circle-fill" style="color: #6c757d;"></i></button>
    </div>
    <div id="carouselExampleCaptions" style="width: 80%;" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card bg-dark">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <table class="table table-dark" style="width:100%;height: 70vh;">
                            <thead>
                                <tr>
                                    <th>SITE: <span style="font-weight: lighter;"> KOR</span></th>
                                    <th>RANK: <span style="font-weight: lighter;"> 1</span></th>
                                </tr>
                                <tr>
                                    <th>NAME: <span style="font-weight: lighter;"> KOR</span></th>
                                    <th>SKU's COUNT: <span style="font-weight: lighter;"> 1</span></th>
                                </tr>
                                <tr>
                                    <th>CU_ID: <span style="font-weight: lighter;"> KOR</span></th>
                                    <th>TOTAL SALES: <span style="font-weight: lighter;"> 1</span></th>
                                </tr>
                                <tr>
                                    <th>DATE INVOICE: <span style="font-weight: lighter;"> KOR</span></th>
                                    <th>TOTAL SKU QTY: <span style="font-weight: lighter;"> 1</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img style="height: 50vh; width:100%;" src="https://firebasestorage.googleapis.com/v0/b/aquila-mobile.appspot.com/o/images%2FBEFORENEW%20STORE-MATILAC-2023092307.jpg?alt=media&token=c7f2e33b-b8c5-4c3b-a842-9233ec6cc69d" alt=""></td>
                                    <td><img style="height: 50vh; width:100%" src="https://firebasestorage.googleapis.com/v0/b/aquila-mobile.appspot.com/o/images%2FAFTERNEW%20STORE-MATILAC-2023092307.jpg?alt=media&token=fe439513-4274-4910-bf79-3d2d8053afc1" alt=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="carousel-item">
                <div class="card bg-dark">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <table class="table table-dark" style="height: 70vh;">
                            <thead>
                                <tr style="font-size: px;">
                                    <th>SITE: <span style="font-weight: lighter;"> KOR</span></th>
                                    <th>RANK: <span style="font-weight: lighter;"> 1</span></th>
                                </tr>
                                <tr>
                                    <th>NAME: <span style="font-weight: lighter;"> KOR</span></th>
                                    <th>SKU's COUNT: <span style="font-weight: lighter;"> 1</span></th>
                                </tr>
                                <tr>
                                    <th>CU_ID: <span style="font-weight: lighter;"> KOR</span></th>
                                    <th>TOTAL SALES: <span style="font-weight: lighter;"> 1</span></th>
                                </tr>
                                <tr>
                                    <th>DATE INVOICE: <span style="font-weight: lighter;"> KOR</span></th>
                                    <th>TOTAL SKU QTY: <span style="font-weight: lighter;"> 1</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img style="height: 50vh; width:100%;" src="https://firebasestorage.googleapis.com/v0/b/aquila-mobile.appspot.com/o/images%2FBEFORENEW%20STORE-MATILAC-2023092307.jpg?alt=media&token=c7f2e33b-b8c5-4c3b-a842-9233ec6cc69d" alt=""></td>
                                    <td><img style="height: 50vh; width:100%" src="https://firebasestorage.googleapis.com/v0/b/aquila-mobile.appspot.com/o/images%2FAFTERNEW%20STORE-MATILAC-2023092307.jpg?alt=media&token=fe439513-4274-4910-bf79-3d2d8053afc1" alt=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<div class="container-fliud">
    <div class="row  mb-2">
        <div class="col-md-1  col-sm-12  d-flex align-items-center">
            <button class="btn btn-sm btn-secondary back-button ">
                <i class="bi bi-arrow-left"></i>
            </button>
        </div>

        <div class="card text-center col-md-4 col-lg-2  col-sm-12 active_card" id="card_a">
            <div class="card-body">
                <i class="bi bi-star-fill text-primary"></i>
                <h5 class="card-title">A (80%)</h5>
            </div>
        </div>
        <div class="card text-center  col-md-4 col-lg-2 col-sm-12  active_card" id="card_a">
            <div class="card-body">
                <h5 class="card-title">HFS</h5>
                <p class="text-muted">Door Type</p>
            </div>
        </div>
    </div>
    <table class="table table1 table-hover table-responsive">
        <thead>
            <tr>
                <th>ACTION</th>
                <th>SITE</th>
                <th>STORE ID</th>
                <th>STORE NAME</th>
                <th>CHANNEL</th>
                <th>SUB CHANNEL</th>
                <th>AVG FY2324</th>
                <th>SIZE</th>
                <th>RIT</th>
                <th>ABC</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td><button class="btn btn_show_slide">
                        <span class="spinner-grow text-primary spinner-grow-sm visually-hidden" role="status" aria-hidden="true"></span><i class="bi bi-three-dots text-primary" style="font-size: 20px;"></i></a>
                    </button></td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>

            </tr>
        </tbody>
    </table>

</div>
<script>
    $(".btn_show_slide").click(function() {
        $(".spinner-wrapper").removeClass("visually-hidden")
    });
    $(".btn_close").click(function() {
        $(".spinner-wrapper").addClass("visually-hidden")
    });
    $(".back-button").click(function(event) {
        event.preventDefault(); // Prevent the default anchor link behavior
        window.history.back();
    });
    $(document).ready(function() {
        $('.table1').DataTable();

    });
</script>