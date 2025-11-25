<style>
    :root {
        --primary-color: #4361ee;
        --accent-color: #4cc9f0;
        --shadow-md: 0 4px 12px rgba(0,0,0,0.15);
        --border-radius: 12px;
    }

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
        background: rgba(255,255,255,0.10);  /* ✅ transparent */
        border: 1px solid rgba(255,255,255,0.25);
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
    top: 100px;               /* BELOW the slider */
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
    top: -6px; /* arrow points UP now */
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
        transform: translate(-50%,-50%);
        z-index: 1002;
        background: white;
        padding: 25px;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        text-align: center;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
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
/* =======================
   ✅ RESPONSIVE CUSTOMER MODAL
=========================== */
.customer-modal .modal-dialog {
    max-width: 420px;
    width: 95%;
}

.customer-modal .modal-content {
    border-radius: 18px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    background: white;
    border: none;
    position: relative;
}

.gradient-header {
    height: 110px;
    width: 100%;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
}

.customer-avatar {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid white;
}

.card-body {
    padding: 25px 18px;
}

#customerName {
    font-size: 1.25rem;
}

#customerId {
    font-size: 0.95rem;
}

/* Grid for Entry / Exit / Spent – responsive */
.customer-info-grid {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.customer-info-grid .col {
    flex: 1;
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

</style>

<?php
$DELIVERY_DATE = $_GET['DELIVERY_DATE'] ?? '';
$AGENT_ID = $_GET['AGENT_ID'] ?? '';
$BATCH_ID = $_GET['BATCH_ID'] ?? '';
?>
<div class="modal fade customer-modal" id="customerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="gradient-header"></div>

            <div class="text-center" style="position:relative;">
                <img id="customerAvatar" src="" class="customer-avatar shadow position-absolute top-0 start-50 translate-middle" alt="Store Avatar">
            </div>

            <div class="card-body text-center mt-4 pt-4">
                <h4 id="customerName" class="font-weight-bold mb-1">Store Name</h4>
                <h5 id="customerId" class="text-muted mb-3">STORE123</h5>

                <hr class="mx-auto" style="width: 80%">

                <div class="customer-info-grid">
                    <div class="col">
                        <p class="text-muted mb-1"><i class="fas fa-sign-in-alt me-2"></i>Entry</p>
                        <p id="storeEntry" class="h5 fw-bold">--:-- --</p>
                    </div>
                    <div class="col">
                        <p class="text-muted mb-1"><i class="fas fa-sign-out-alt me-2"></i>Exit</p>
                        <p id="storeExit" class="h5 fw-bold">--:-- --</p>
                    </div>
                    <div class="col">
                        <p class="text-muted mb-1"><i class="fas fa-clock me-2"></i>Spent</p>
                        <p id="timeSpent" class="h5 fw-bold">--</p>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="button" class="btn btn-primary px-4 rounded-pill" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Close
                    </button>
                    <button type="button" class="btn btn-secondary px-4 rounded-pill btn-navigate" >
                        <i class="fas fa-map me-2"></i>Navigate
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="header-section">
        <button class="back-btn" onclick="history.back()">⬅ Back</button>
        <div class="info-box" id="driverInfo">Loading...</div>
        <div class="time-display" id="txt_time">Loading...</div>
    </div>

    <div class="map-container">
        <div id="map"></div>

        <div class="slider-overlay">
            <div class="time-indicator">
                <span id="startTime">--:--</span>
                <!-- <span class="current-time" id="currentTime">--:--</span> -->
                <span id="endTime">--:--</span>
            </div>
              <div class="slider-bubble" id="sliderBubble">--:--</div>
            <input type="range" class="time-slider" id="get_slide" min="0" max="100" value="0">
             
            <div class="progress-container">
                <div class="progress-bar" id="progressBar"></div>
            </div>
        </div>

        <div class="spinner-wrapper" id="loadingSpinner">
            <div class="spinner"></div>
            <p>Loading trip data…</p>
        </div>
    </div>
</div>
<script>
let map, polyline, tripData = [], markerData = [];
let panelMarker = null; // 🚚 marker that moves along the route

$(document).ready(async function(){
    await loadData();
    initMap();
    fillDriverInfo();
    $("#loadingSpinner").fadeOut(300);
});

async function loadData(){
    tripData = await $.getJSON('query/get_trip.php?DELIVERY_DATE=<?=$DELIVERY_DATE?>&AGENT_ID=<?=$AGENT_ID?>');
    markerData = await $.getJSON('query/get_marker.php?BATCH_ID=<?=$BATCH_ID?>');
}

function fillDriverInfo(){
    let da = markerData[0]?.AGENT || "Unknown";
    let plate = markerData[0]?.VEHICLE_ID || "Unknown";
    $("#driverInfo").html(`<b>DA:</b> ${da}<br><b>Plate:</b> ${plate}`);
}

async function initMap(){
    await $.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyDZH6zrXo-8_OzoeL5au1hplE7tjxeMUAI");

    const coords = tripData.map(x => ({
        lat: parseFloat(x.LAT_CAPTURED),
        lng: parseFloat(x.LONG_CAPTURED),
        bat_percentage: x.BATTERY_PERCENTAGE,
        time: x.TIME_MINUTES
    }));

    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
           scrollwheel: true,  
        center: coords[0]
    });

    polyline = new google.maps.Polyline({
        map,
        strokeColor: '#0A0A0A',
        strokeWeight: 2
    });

    // add store markers
    addMarkersToMap(map, markerData);

    // initialize slider + panel icon
    setupSlider(coords);

    // add final icon at end of trip
    addPanelIcon(map, coords);
}

function addMarkersToMap(map, markers) {
    markers.forEach((marker, index) => {
        const mapMarker = new google.maps.Marker({
            position: {lat: parseFloat(marker.LATITUDE), lng: parseFloat(marker.LONGITUDE)},
            map: map,
            title: marker.CUSTOMER_NAME,
            icon: getStatusIcon(marker.VISIT_STATUS)
        });
        
        mapMarker.addListener('click', () => {
            showCustomerModal(marker);
        });
    });
}

function getStatusIcon(status) {
    const baseUrl = "https://maps.google.com/mapfiles/ms/icons/";
    switch(status) {
        case "VISITED":
            return {
                url: baseUrl + "green-dot.png",
                scaledSize: new google.maps.Size(32, 32)
            };
        case "PASSED BY":
            return {
                url: baseUrl + "yellow-dot.png",
                scaledSize: new google.maps.Size(32, 32)
            };
        default:
            return {
                url: baseUrl + "red-dot.png",
                scaledSize: new google.maps.Size(32, 32)
            };
    }
}

function showCustomerModal(customer) {
    $('#customerName').text(customer.CUSTOMER_NAME);
    $('#customerId').text(customer.CUSTOMER_ID);
    $('#customerAvatar').attr('src', customer.IMAGE1 || 'https://images.stackbox.xyz/qe1p4ipfjg13bs5mssak6fdpsizjz5.jpeg');
    $('#storeEntry').text(customer.STORE_ENTRY || '--:-- --');
    $('#storeExit').text(customer.STORE_EXIT || '--:-- --');
    $('#timeSpent').text(customer.STORE_TIME_SPENT || '--');

    const modal = new bootstrap.Modal(document.getElementById('customerModal'));
    modal.show();

    $('.btn-navigate').off('click').on('click', function() {
        const lat = customer.LATITUDE;
        const lng = customer.LONGITUDE;
        const url = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
        window.open(url, '_blank');
    });
}

// 🚚 Panel icon function (adds last icon)
function addPanelIcon(map, coords) {
    if (!coords || coords.length === 0) return;

    const lastCoord = coords[coords.length - 1];

    const panelIcon = {
        url: "https://img.icons8.com/plasticine/50/truck--v1.png", // truck/panel icon
        scaledSize: new google.maps.Size(40, 40),
        anchor: new google.maps.Point(20, 40)
    };

    panelMarker = new google.maps.Marker({
        position: lastCoord,
        map: map,
        icon: panelIcon,
        title: "Final Destination"
    });
}
function setupSlider(coords){
    let minT = toMin(coords[0].time);
    let maxT = toMin(coords.at(-1).time);

    $("#get_slide").attr("min", minT).attr("max", maxT).val(minT);
    $("#startTime").text(coords[0].time);
    $("#endTime").text(coords.at(-1).time);
    $("#txt_time").text(coords[0].time);
    $("#currentTime").text(coords[0].time);

    const slider = document.getElementById("get_slide");
    const bubble = document.getElementById("sliderBubble");

    $("#get_slide").on("input", function(){
        let currentValue = parseInt($(this).val());
        let filtered = coords.filter(c => toMin(c.time) <= currentValue);
        polyline.setPath(filtered);

        let t = formatMinutes(currentValue);
        $("#currentTime").text(t);
        $("#txt_time").text(t);
        $("#progressBar").css("width", ((currentValue-minT)/(maxT-minT))*100 + "%");

        // =======================
        // FLOATING BUBBLE BELOW
        // =======================
        bubble.style.display = "block";

        const sliderRect = slider.getBoundingClientRect();
        const sliderWidth = sliderRect.width;
        const min = parseInt(slider.min);
        const max = parseInt(slider.max);

        const percent = (currentValue - min) / (max - min);
        const bubbleX = percent * sliderWidth;

        bubble.style.left = bubbleX + "px";
        bubble.textContent = t;

        // ==========================
        // MOVE VEHICLE MARKER
        // ==========================
        if(filtered.length > 0){
            const last = filtered.at(-1);
            map.setCenter(last);

            if (panelMarker) panelMarker.setMap(null);
            panelMarker = new google.maps.Marker({
                position: last,
                map: map,
                icon: {
                    url: "https://img.icons8.com/plasticine/50/truck--v1.png",
                    scaledSize: new google.maps.Size(40, 40),
                    anchor: new google.maps.Point(20, 40)
                }
            });
        }
    });
}



// Utility functions
function toMin(t){ let [h,m] = t.split(":").map(Number); return h*60+m; }
function formatMinutes(m){ let h=Math.floor(m/60), mm=m%60; return `${String(h).padStart(2,"0")}:${String(mm).padStart(2,"0")}`; }
</script>
