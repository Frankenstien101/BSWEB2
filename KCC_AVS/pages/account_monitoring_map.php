<style>
    body {
        margin: 0;
        padding: 0;
        background: #f5f7fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .container-fluid {
        width: 100%;
        margin: 0;
        padding: 0;
        position: relative;
    }

    /* Header Section */
    .header-section {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
        padding: 15px;
        background: white;
        border-bottom: 1px solid #ddd;
    }

    .back-btn {
        padding: 12px 16px;
        border-radius: var(--border-radius);
        border: 1px solid #e1e5e9;
        background: white;
        cursor: pointer;
    }

    .info-box {
        background: white;
        padding: 12px 18px;
        border-radius: var(--border-radius);
        border: 1px solid #e1e5e9;
        flex: 1;
        min-width: 250px;
    }

    .time-display {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        padding: 12px 20px;
        border-radius: var(--border-radius);
        color: white;
        font-weight: 700;
    }

    .map-container {
        position: relative;
        width: 100%;
        height: calc(100vh - 120px);
    }

    #map {
        width: 100%;
        height: 100%;
    }

    /* ✅ Transparent Glass Slider Box */
    .slider-overlay {
        position: absolute;
        top: 12px;
        left: 12px;
        right: 12px;
        border-radius: var(--border-radius);
        padding: 15px;
        backdrop-filter: blur(15px);
        background: rgba(255, 255, 255, 0.10);
        /* ✅ transparent */
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: var(--shadow-md);
        z-index: 1000;
    }

    /* ✅ SLIDER 100% WIDTH */
    .time-slider {
        width: 100%;
        height: 6px;
        appearance: none;
        border-radius: 8px;
        background: #e1e5e9;
        margin-top: 10px;
    }

    .time-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--primary-color);
        cursor: pointer;
        transition: 0.2s;
    }

    /* ================================
   FLOATING TIME BUBBLE UNDER SLIDER
================================ */
    .slider-bubble {
        position: absolute;
        top: 100px;
        /* BELOW the slider */
        background: var(--primary-color);
        color: white;
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 8px;
        transform: translateX(-50%);
        white-space: nowrap;
        pointer-events: none;
        display: none;
    }

    .slider-bubble::after {
        content: "";
        position: absolute;
        top: -6px;
        /* arrow points UP now */
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 6px solid var(--primary-color);
    }


    .progress-container {
        width: 100%;
        height: 4px;
        background: #e1e5e9;
        border-radius: 2px;
        margin-top: 10px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        width: 0%;
        transition: width 0.3s ease;
    }

    .time-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .current-time {
        background: var(--primary-color);
        color: white;
        padding: 4px 10px;
        border-radius: 10px;
    }

    .spinner-wrapper {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1002;
        background: white;
        padding: 25px;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        text-align: center;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #ddd;
        border-top: 4px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: auto;
    }


    /* ✅ Mobile responsive adjustments */
    @media (max-width: 480px) {
        .customer-avatar {
            width: 90px;
            height: 90px;
        }

        #customerName {
            font-size: 1.1rem;
        }

        #customerId {
            font-size: 0.9rem;
        }

        .customer-info-grid {
            flex-direction: column;
            text-align: center;
        }

        .btn {
            width: 100%;
        }
    }

    /* ===========================
   ACCOUNT MODAL STYLING
   =========================== */

    #customerModal .modal-content {
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
    }

    /* ---------- HEADER ---------- */
    #customerModal .modal-header {
        padding: 1rem 1.25rem;
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        border-bottom: none;
    }

    #customerModal .modal-title {
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    #customerModal #accountType {
        font-size: 0.75rem;
        padding: 0.35em 0.6em;
        border-radius: 12px;
    }

    /* ---------- BODY ---------- */
    #customerModal .modal-body {
        padding: 1.25rem;
    }

    #customerModal strong {
        font-size: 0.85rem;
        color: #495057;
    }

    /* ---------- IMAGE PREVIEW ---------- */
    #customerModal img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 12px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        cursor: pointer;
    }

    #customerModal img:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    /* ---------- INFO TEXT ---------- */
    #customerModal .text-muted {
        font-size: 0.9rem;
    }

    /* ---------- STATUS BADGE ---------- */
    #customerModal #accountStatus {
        font-size: 0.75rem;
        padding: 0.4em 0.7em;
        border-radius: 12px;
        font-weight: 500;
    }

    /* ---------- ADDRESS ---------- */
    #customerModal #accountAddress {
        background: #f8f9fa;
        padding: 0.75rem;
        border-radius: 10px;
        font-size: 0.9rem;
    }

    /* ---------- FOOTER ---------- */
    #customerModal .modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 0.75rem 1.25rem;
    }

    #customerModal .btn {
        border-radius: 10px;
        padding: 0.4rem 1.1rem;
        font-size: 0.85rem;
    }

    /* ---------- MOBILE ---------- */
    @media (max-width: 576px) {
        #customerModal img {
            height: 180px;
        }

        #customerModal .modal-title {
            font-size: 1rem;
        }

        #customerModal .btn {
            width: 100%;
        }
    }
</style>


<div class="container-fluid">
    <div class="header-section d-flex align-items-center justify-content-between">

        <!-- LEFT: Back button -->
        <button id="btn-back" class="back-btn d-flex align-items-center gap-2">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </button>

        <!-- RIGHT: Filters -->
        <div class="d-flex align-items-end gap-3">

            <div class="d-flex flex-column">
                <label for="filter_account_type" class="form-label mb-1 small text-muted">
                    Account Type
                </label>
                <select class="form-select form-select-sm" style="width:180px;" id="filter_account_type">
                    <option value="">All</option>
                    <?php
                    $account_types = $conn->query("
                    SELECT DISTINCT ACCOUNT_TYPE
                    FROM [dbo].[KAVS_ACCOUNTS]
                    WHERE COMPANY_ID = {$_SESSION['selected_comp']}
                    AND SITE_ID = {$_SESSION['selected_site']}
                    AND STATUS = 1
                ");
                    foreach ($account_types as $type) {
                    ?>
                        <option value="<?= $type['ACCOUNT_TYPE'] ?>">
                            <?= $type['ACCOUNT_TYPE'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

        </div>

    </div>


</div>


<div class="map-container">
    <div id="map"></div>


    <div class="spinner-wrapper" id="loadingSpinner">
        <div class="spinner"></div>
        <p>Loading trip data…</p>
    </div>
</div>
</div>
<script>
    let map;
    let markerData = [];
    let mapMarkers = []; // ✅ store active markers

    $(document).ready(async function() {
        await loadData(); // ✅ load markers first
        initMap(); // ✅ then load map
    });

    async function loadData() {
        markerData = await $.getJSON('query/get_marker.php');
    }

    function initMap() {
        $.getScript(
            "https://maps.googleapis.com/maps/api/js?key=AIzaSyDZH6zrXo-8_OzoeL5au1hplE7tjxeMUAI",
            function() {

                let defaultCenter = {
                    lat: 6.481333,
                    lng: 124.864305
                };
                if (markerData.length > 0) {
                    defaultCenter = {
                        lat: parseFloat(markerData[0].LATITUDE),
                        lng: parseFloat(markerData[0].LONGITUDE)
                    };
                    createMap(defaultCenter);
                    return;
                }

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            defaultCenter = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            createMap(defaultCenter);
                        },
                        function() {
                            createMap(defaultCenter);
                        }
                    );
                } else {
                    createMap(defaultCenter);
                }
            }
        );
    }

    function createMap(centerCoords) {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 8,
            center: centerCoords,
            scrollwheel: true
        });

        addMarkersToMap(map, markerData);

        google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
            $("#loadingSpinner").fadeOut(300);
        });
    }

    function addMarkersToMap(map, markers) {
        clearMarkers(); // ✅ clear existing markers

        markers.forEach((marker) => {
            const mapMarker = new google.maps.Marker({
                position: {
                    lat: parseFloat(marker.LATITUDE),
                    lng: parseFloat(marker.LONGITUDE)
                },
                map: map,
                title: marker.NAME,
                icon: getStatusIcon(marker.ACCOUNT_STATUS)
            });

            mapMarker.addListener('click', () => {
                showCustomerModal(marker);
            });

            mapMarkers.push(mapMarker); // ✅ store marker
        });
    }

    function clearMarkers() {
        mapMarkers.forEach(marker => marker.setMap(null));
        mapMarkers = [];
    }
    $('#filter_account_type').on('change', function() {
        const selectedType = $(this).val();

        let filteredData = markerData;

        if (selectedType && selectedType !== 'Account Type') {
            filteredData = markerData.filter(item =>
                item.ACCOUNT_TYPE === selectedType
            );
        }

        addMarkersToMap(map, filteredData);
    });


    function showCustomerModal(marker) {

        // Text fields
        $('#customerName').text(marker.NAME);
        $('#customerId').text(marker.ACCOUNT_ID || '');
        $('#accountType').text(marker.ACCOUNT_TYPE);
        $('#adsType').text(marker.ADS_TYPE);
        $('#adsSpecific').text(marker.ADS_SPECIFIC);
        $('#accountCategory').text(marker.STORE_CATEGORY);
        $('#accountAddress').text(marker.ADDRESS + " " + marker.LANDMARK);
        $('#accountStatus').text(marker.ACCOUNT_STATUS);

        // Images (fallback if empty)
        $('#img1').attr('src', marker.IMG1 || 'assets/no-image.png');
        $('#img2').attr('src', marker.IMG2 || 'assets/no-image.png');
        $("#img1").attr('data-img', marker.IMG1 || 'assets/no-image.png');
        $("#img2").attr('data-img', marker.IMG2 || 'assets/no-image.png');
        // Avatar (use first image)
        $('#customerAvatar').attr('src', marker.IMG1 || 'assets/no-image.png');

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('customerModal'));
        modal.show();
    }

    function getStatusIcon(status) {
        const baseUrl = "https://maps.google.com/mapfiles/ms/icons/";

        switch (status) {
            case "ACTIVE":
                return {
                    url: baseUrl + "green-dot.png",
                        scaledSize: new google.maps.Size(32, 32)
                };
            case "INACTIVE":
                return {
                    url: baseUrl + "red-dot.png",
                        scaledSize: new google.maps.Size(32, 32)
                };
            case "NEW":
                return {
                    url: baseUrl + "yellow-dot.png",
                        scaledSize: new google.maps.Size(32, 32)
                };
            case "FOR GEOTAGGING":
                return {
                    url: baseUrl + "orange-dot.png",
                        scaledSize: new google.maps.Size(32, 32)
                };
            case "GEOTAGGED":
                return {
                    url: baseUrl + "blue-dot.png",
                        scaledSize: new google.maps.Size(32, 32)
                };
            default:
                return {
                    url: baseUrl + "red-dot.png",
                        scaledSize: new google.maps.Size(32, 32)
                };
        }
    }
    $("#btn-back").on('click', function() {
        window.history.back();
    });
    $(document).on('click', '.img-thumb', function() {
        const imgSrc = $(this).data('img');
        $('#modalImage').attr('src', imgSrc);
    });
</script>