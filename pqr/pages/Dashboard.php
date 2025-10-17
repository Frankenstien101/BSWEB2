
<style>
    body {
        background-color: #EEEEEE;

    }


    .card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .container {
        height: 100vh;

    }

    .table {
        border-radius: 10px;
        background-color: #F6F6F9;
    }

    .active_card {
        transform: translateY(-10px);
        /* Light blue background */
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        /* Enhanced shadow */
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card-icon {
        font-size: 4rem;
        color: #495057;
    }

    .bi {
        font-size: 30px;
        color: #EEEEEE;
    }

    .card-title {
        margin-top: 15px;
        font-weight: bold;
        color: #343a40;
    }

    .card-text {
        color: #6c757d;
    }

    .text-decoration-none:hover .card {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
</style>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4 ">
            <a href="#" class="text-decoration-none card-a">
                <div class="card text-center active_card" id="card_a" data-id="A">
                    <div class="card-body">
                        <i class="bi bi-star-fill text-primary"></i>
                        <h5 class="card-title">A (80%)</h5>
                        <p class="card-text">500 Doors | ₱ 1,000,000 AVG</p>

                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6  col-lg-3 mb-4">
            <a href="#" class="text-decoration-none card-b">
                <div class="card text-center" id="card_b" data-id="B">
                    <div class="card-body">
                        <i class="bi bi-patch-check-fill text-secondary"></i>
                        <h5 class="card-title">B (15%)</h5>
                        <p class="card-text">500 Doors | ₱ 1,000,000 AVG</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6  col-lg-3 mb-4">
            <a href="#" class="text-decoration-none card-c">
                <div class="card text-center" id="card_c" data-id="C">
                    <div class="card-body">
                        <i class="bi bi-info-circle-fill text-warning"></i>
                        <h5 class="card-title">C (5%)</h5>
                        <p class="card-text">500 Doors | ₱ 1,000,000 AVG</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6  col-lg-3 mb-4">
            <a href="#" class="text-decoration-none card-d">
                <div class="card text-center" id="card_d" data-id="D">
                    <div class="card-body">
                        <i class="bi bi-x-circle-fill text-danger"></i>
                        <h5 class="card-title">Non-Buying</h5>
                        <p class="card-text">500 Doors | ₱ 1,000,000 AVG</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="marquee-progress">
            <div class="marquee-progress-bar"></div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Channel</th>
                    <th>No. of Doors</th>
                    <th>Avg %</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="t-body">
                <tr>
                    <td colspan="4" style="text-align: center;">No data Found</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
<script>
    $(document).ready(function() {
        $(".marquee-progress").hide()
    })
    function show_details(ABC) {
        $.ajax({
            url: 'query/DETAILED_CHANNEL.php',
            method: 'POST',
            data: {
                ABC
            },
            success: function(data) {

                $("#t-body").html(data)
            },
            error: function(err) {
                alert(err)
            }
        })
    }
    $(".card").click(function() {
        $(".marquee-progress").show()
        $(".card").removeClass("active_card")
        $(this).addClass("active_card")
        var abc_ = $(this).attr("data-id")
        show_details(abc_)
        setTimeout(function() {
            $(".marquee-progress").hide();
        }, 1000);

    });
</script>