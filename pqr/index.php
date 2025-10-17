<?php
session_start();
include 'query/user_login.php';
$page_main = isset($_SESSION['page_main']) ? $_SESSION['page_main'] : '';
if (!isset($_SESSION['user_id'])) {
    header('Location:../' . $page_main . 'pqr/pages/login_form.php');
}
$selected_comp = isset($_SESSION['comp_id']) ? $_SESSION['comp_id'] : '';
$selected_site = isset($_SESSION['ses_site']) ? $_SESSION['ses_site'] : '';
$selected_guideline = isset($_SESSION['guideline_id']) ? $_SESSION['guideline_id'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">

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
    <title>PQR</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style type="text/css">
        .marquee-progress {
            position: relative;
            height: 5px;
            overflow: hidden;
            background-color: #f1f1f1;
            border-radius: .25rem;
        }

        .marquee-progress-bar {
            position: absolute;
            height: 100%;
            width: 100%;
            background-color: #0d6efd;
            animation: marquee 5s linear infinite;
            border-radius: .25rem;
        }

        @keyframes marquee {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .bg-prm {
            background-color: #F6F6F9;
        }

        .bg-sec {
            background-color: #EEEEEE;
        }

        .spinner-wrapper {
            background-color: black;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;

        }
    </style>
</head>


<body>
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Logout Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to log out now?
                </div>
                <div class="modal-footer">
                    <a href="query/logout.php" class="btn btn-primary" id="btn_logout">Yes</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="show_pqr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ05bxwoEsPiT82cFLqqg3aa_sqZaAcacrSbHxqG5OkZVtcgf7xfiytoKmgRbgK&s=10" alt="">
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <img style="height:90vh; width:100vh;border-radius: 10px; margin-left: 100px;" src="" id="imd_prev">
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="modal_report" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-body">
                <div class="card">
                </div>
            </div>
        </div>
    </div>
    <div class="position-fixed top-0 end-0 p-5" style="z-index: 9999">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img id="img_toast" src="https://img.icons8.com/?size=48&id=63312&format=png" class="rounded me-2" alt="...">
                <strong class="me-auto" id="Title">Bootstrap</strong>
                <small>Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
    <div class="sidebar">
        <a href="#" class="logo">
            <i> <img src="images/pqr_icon.png" style="width: 60px; height: 50px"> </i>
            <div class="logo-name"><span>PQR</span>Incentive</div>
        </a>
        <ul class="side-menu">
            <li id="Dashboard" class="side_menu"><a href="index.php?page=Dashboard"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li id="PREVIEW_PQR" class="side_menu"><a href="index.php?page=PREVIEW_PQR"><i class='bx bxs-dashboard'></i>PQR View</a></li>
            <li id="PQR_VALIDATOR" class="side_menu"><a href="index.php?page=PQR_VALIDATOR"><i class='bx bxs-dashboard'></i>PQR Validator</a></li>

            <li id="PQR_CAS_VALIDATOR" class="side_menu"><a href="index.php?page=PQR_CAS_VALIDATOR"><i class='bx bxs-dashboard'></i>PQR CAS</a></li>            
        <li id="Users"><a href="index.php?page=Users"><i class='bx bx-group'></i>Users</a></li>
            <li id="Operation"><a href="index.php?page=Operation"><i class='bx bxs-objects-vertical-bottom'></i>Operation</a></li>
         <li id="REPORT"><a href="index.php?page=REPORT"><i class='bx bxs-objects-vertical-bottom'></i>Reports</a></li>
            <!-- <li id="Settings"><a href="index.php?page=Settings"><i class='bx bx-cog'></i>Settings</a></li> -->
        
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content" style="overflow: hidden;">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <input type="date" id="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : date('Y-m-d') ?>" style="width:140px" class="form-control float-right form-control-sm bg-light border-white" name="">
            <select class="form-select SEL" style="width:100px" id="sel_comp">
                <option>Select Company</option>
                <?php
                $query = "select ID,CODE,NAME from [dbo].[Aquila_COMPANY] where STATUS='ACTIVE'";
                foreach ($conn->query($query) as $row) {
                ?>
                    <option value="<?php echo $row['ID'] ?>" <?php echo isset($selected_comp) && $selected_comp == $row['ID'] ? 'selected' : '' ?>><?php echo $row["CODE"] ?></option>
                <?php
                }
                ?>
            </select>
            <select class="form-select SEL sel-site" style="width:100px" id="SELECT_SITE" <?php echo ($selected_site == '') ? 'disabled' : '' ?>>
                <option>Select Site</option>
                <?php
                $query = "SELECT SITEID, SITE_CODE FROM [dbo].[Aquila_Sites] WHERE COMPANY_ID ='$selected_comp'";
                foreach ($conn->query($query) as $row) {
                ?>
                    <option value="<?php echo $row['SITEID'] ?>" <?php echo isset($selected_site) && $selected_site == $row['SITEID'] ? 'selected' : '' ?>><?php echo $row["SITE_CODE"] ?></option>
                <?php
                }
                ?>
            </select>
            <select class="form-select sel-pqrid hidden" style="width:180px;" id="SELECT_pqrid" <?php echo ($selected_guideline == '') ? 'disabled' : '' ?>>
                <option>Select Guidelines</option>
                <?php
                $query = "select GUIDELINES_ID,DESCRIPTION from [dbo].[SNAP_GUIDELINE_SETUP_TRANSACTION] where COMPANY_ID ='$selected_comp'";
                foreach ($conn->query($query) as $row) {
                ?>
                    <option value="<?php echo $row['GUIDELINES_ID'] ?>" <?php echo isset($selected_guideline) && $selected_guideline == $row['GUIDELINES_ID'] ? 'selected' : '' ?>><?php echo $row["GUIDELINES_ID"]." | ".$row["DESCRIPTION"] ?></option>
                <?php
                }
                ?>
            </select>
        </nav>
        <main>
            <?php
            $page = isset($_GET["page"]) ? $_GET["page"] . ".php" : "Dashboard.php";
            include "pages/" . $page;
            ?>
        </main>
    </div>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="index.js">

    </script>
    <script type="text/javascript">
        $("#sel_comp").change(function() {
            $(".sel-site").attr('disabled', true)
            var comp_id = $(this).val()
            $.ajax({
                url: 'query/select_comp.php',
                method: 'POST',
                data: {
                    comp: comp_id
                },
                success: function(data) {
                    
                    $(".sel-site").attr('disabled', false)
                    $(".sel-site").html(data)
                    $(".sel-site").attr('disabled', false)

                },
                error: function(er) {}
            })
        })

        $("#SELECT_SITE").change(function() {
            var site_id = $(this).val()
            $.ajax({
                url: 'query/select_site.php',
                method: 'POST',
                data: {
                    site: site_id
                },
                success: function(data) {
                    $(".sel-pqrid").attr('disabled', false)
                    $(".sel-pqrid").html(data)
                    $(".sel-pqrid").attr('disabled', false)   
                },
                error: function(er) {}
            })
          //  location.reload();
        })

        $("#SELECT_pqrid").change(function() {
            var site_id = $(this).val()
            $.ajax({
                url: 'query/select_guidelin.php',
                method: 'POST',
                data: {
                    site: site_id
                },
                success: function(data) {


                },
                error: function(er) {}
            })
          //  location.reload();
        })

        $("#btn_logout").click(function() {})

        function showNotification(title, message) {
            $("#Title").html(title);
            $(".toast-body").html(message);
            $('#liveToast').toast('show');
        }

        $(document).ready(function() {

            $(".SEL").select2();
            $(".hidden").css("display", "none");
            $("#date").change(function() {
                var selectedDate = $(this).val();
                $(this).val(selectedDate)
                var currentURL = "index.php?page=" + "<?php echo isset($_GET["page"]) ? $_GET["page"] : '' ?>";
                var user_id = "<?php echo isset($_GET["USER_ID"]) ? $_GET["USER_ID"] : '' ?>"
                // Append the new parameter
                var newURL = currentURL + "&date=" + selectedDate + "&USER_ID=" + user_id;
                // Redirect to the modified URL
                window.location.href = newURL;

            });
            $("#site").change(function() {});

            var a = "<?php echo isset($_GET["page"]) ? $_GET["page"] : '' ?>";

            $("li").removeClass("active");
            $("#" + a).addClass("active");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

</body>

</html>