<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once('dashboard/database.php');
require_once('dashboard/library.php');
require_once('dashboard/funciones.php');

$styling = mysql_fetch_array(mysql_query("SELECT * FROM styles"));
$tracking = isset($_POST['shipping']) ? trim($_POST['shipping']) : '';
$trackingSql = mysql_real_escape_string($tracking);

function trackHtml($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$sql = "SELECT c.cid, c.tracking, c.cons_no, c.letra, c.book_mode, c.schedule,
    c.pick_time, c.invice_no, c.mode, c.type, c.weight, c.comments,
    c.ship_name, c.phone, c.correo, c.s_add, c.rev_name, c.r_phone, c.email,
    c.r_add, c.pick_date, c.book_date, c.ciudad, c.state, c.iso,
    c.paisdestino, c.city1, c.state1, c.iso1, c.user, s.color, c.status
    FROM courier c
    INNER JOIN service_mode s ON s.servicemode = c.status
    WHERE c.tracking = '$trackingSql'";

$result = dbQuery($sql);
$no = dbNumRows($result);

if ($no == 1) {
    $data = dbFetchAssoc($result);
    extract($data);
    $origin = trim($ciudad . (($state != '') ? ', ' . $state : '') . (($iso != '') ? ', ' . $iso : ''));
    $destination = trim($city1 . (($state1 != '') ? ', ' . $state1 : '') . (($paisdestino != '') ? ', ' . $paisdestino : ''));
    $mapLocation = $destination != '' ? $destination : $origin;
    $statusKey = strtolower(trim($status));
    $progress = 48;
    if (strpos($statusKey, 'deliver') !== false) $progress = 100;
    elseif (strpos($statusKey, 'transit') !== false || strpos($statusKey, 'ship') !== false) $progress = 62;
    elseif (strpos($statusKey, 'pick') !== false || strpos($statusKey, 'process') !== false) $progress = 30;

    $historyResult = mysql_query("SELECT * FROM courier_track WHERE cid = " . intval($cid) . " AND cons_no = '" . mysql_real_escape_string($cons_no) . "' ORDER BY bk_time DESC");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracking <?php echo trackHtml($tracking); ?> | Swift Trust Global</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet">
    <link href="deprixa_components/styles/track-order.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="">
    <link href="css/new-tracking-result.css" rel="stylesheet">
    <style><?php echo $styling['style']; ?></style>
</head>
<?php include_once 'menu.php'; ?>

<main class="new-tracking-page">
    <div class="tracking-actions">
        <button type="button" class="tracking-action print-action" onclick="window.print()">Print Shipping Invoice</button>
        <a class="tracking-action payment-action" href="contact.html">Make Payment</a>
    </div>

    <section class="tracking-map" aria-label="Shipment destination map">
        <div id="shipment-map" data-location="<?php echo trackHtml($mapLocation); ?>"></div>
        <div id="map-loading" class="map-loading">Locating <?php echo trackHtml($mapLocation); ?>...</div>
    </section>
    <div class="map-credit">Current shipment location: <strong><?php echo trackHtml($mapLocation); ?></strong> &middot; <a href="https://www.openstreetmap.org/search?query=<?php echo rawurlencode($mapLocation); ?>" target="_blank" rel="noopener">Open larger map</a></div>

    <section class="tracking-section">
        <h2>Receiver's Details</h2>
        <div class="tracking-table-wrap">
            <table class="tracking-table receiver-table">
                <thead><tr><th>Full Name</th><th>Address</th><th>Email Address</th><th>Phone Number</th></tr></thead>
                <tbody><tr><td><?php echo trackHtml($rev_name); ?></td><td><?php echo trackHtml($r_add); ?></td><td><?php echo trackHtml($email); ?></td><td><?php echo trackHtml($r_phone); ?></td></tr></tbody>
            </table>
        </div>
    </section>

    <section class="tracking-section">
        <h2>Sender's Details</h2>
        <div class="tracking-table-wrap">
            <table class="tracking-table sender-table">
                <thead><tr><th>Sender's Name</th><th>Address</th><th>Sender Email</th><th>Phone Number</th></tr></thead>
                <tbody><tr><td><?php echo trackHtml($ship_name); ?></td><td><?php echo trackHtml($s_add); ?></td><td><?php echo trackHtml($correo); ?></td><td><?php echo trackHtml($phone); ?></td></tr></tbody>
            </table>
        </div>
    </section>

    <section class="tracking-section">
        <h2>Consignment's Details</h2>
        <div class="tracking-table-wrap">
            <table class="tracking-table consignment-summary">
                <thead><tr><th>Consignment No</th><th>Package Weight</th><th>Tracking Number</th><th>Status</th><th>Service Type</th><th>Delivery Mode</th><th>Payment Mode</th></tr></thead>
                <tbody><tr><td><?php echo trackHtml($letra . $cons_no); ?></td><td><?php echo trackHtml($weight); ?>kg</td><td><?php echo trackHtml($tracking); ?></td><td><?php echo trackHtml($status); ?></td><td><?php echo trackHtml($type); ?></td><td><?php echo trackHtml($mode); ?></td><td><?php echo trackHtml($book_mode); ?></td></tr></tbody>
            </table>
        </div>
        <div class="tracking-table-wrap detail-table-wrap">
            <table class="tracking-table route-table">
                <thead><tr><th>Origin</th><th>Destination</th><th>Pickup Date/Time</th><th>Date of Departure</th><th>Shipment Description</th><th>Expected Delivery</th></tr></thead>
                <tbody><tr><td><?php echo trackHtml($origin); ?></td><td><?php echo trackHtml($destination); ?></td><td><?php echo trackHtml(trim($pick_date . ' ' . $pick_time)); ?></td><td><?php echo trackHtml($book_date); ?></td><td><?php echo trackHtml($comments); ?></td><td><?php echo trackHtml($schedule); ?></td></tr></tbody>
            </table>
        </div>
    </section>

    <section class="shipment-progress" aria-label="Shipment progress: <?php echo intval($progress); ?> percent">
        <div class="progress-track"><span class="progress-fill" style="width:<?php echo intval($progress); ?>%"></span><span class="progress-arrow" style="left:<?php echo intval($progress); ?>%"></span><strong style="left:<?php echo intval($progress); ?>%"><?php echo intval($progress); ?>%</strong></div>
    </section>

    <section class="tracking-history">
        <div class="tracking-table-wrap">
            <table class="tracking-table history-table">
                <thead><tr><th>Status</th><th>Current Location</th><th>Arrival Country</th><th>Arrival Date</th><th>Comments</th></tr></thead>
                <tbody>
                <?php if ($historyResult && mysql_num_rows($historyResult) > 0) { while ($row = mysql_fetch_array($historyResult)) { ?>
                    <tr><td><?php echo trackHtml($row['status']); ?></td><td><?php echo trackHtml($row['pick_time']); ?></td><td><?php echo trackHtml($row['pick_time']); ?></td><td><?php echo trackHtml($row['bk_time']); ?></td><td><?php echo trackHtml($row['comments']); ?></td></tr>
                <?php } } else { ?>
                    <tr><td><?php echo trackHtml($status); ?></td><td><?php echo trackHtml($mapLocation); ?></td><td><?php echo trackHtml($paisdestino); ?></td><td><?php echo trackHtml($book_date); ?></td><td><?php echo trackHtml($comments); ?></td></tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="history-label">Tracking Informations:</div>
    </section>

    <section class="tracking-notice">
        <div class="notice-heading">Comment</div>
        <p><strong>Notice:</strong> <?php echo trackHtml($comments != '' ? $comments : 'Your package is currently ' . $status . '.'); ?></p>
    </section>

    <div class="tracking-thanks">Thanks for patronising us. Feel free to track your package anytime.</div>
</main>

<?php include_once 'footer.php'; ?>
<script src="deprixa_components/bundles/jquery"></script>
<script src="deprixa_components/bundles/bootstrap"></script>
<script src="js/plugins/plugins.js"></script>
<script src="js/active.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script>
(function () {
    var element = document.getElementById('shipment-map');
    var loading = document.getElementById('map-loading');
    if (!element || typeof L === 'undefined') {
        if (loading) loading.textContent = 'Map unavailable. Use the larger map link below.';
        return;
    }
    var locationName = element.getAttribute('data-location');
    var map = L.map(element, {scrollWheelZoom: false}).setView([20, 0], 2);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {maxZoom: 19, attribution: '&copy; OpenStreetMap contributors'}).addTo(map);
    fetch('https://nominatim.openstreetmap.org/search?format=json&limit=1&q=' + encodeURIComponent(locationName), {headers: {'Accept': 'application/json'}})
        .then(function (response) { if (!response.ok) throw new Error(); return response.json(); })
        .then(function (places) {
            if (!places.length) throw new Error();
            var lat = parseFloat(places[0].lat), lon = parseFloat(places[0].lon);
            map.setView([lat, lon], 12);
            L.marker([lat, lon]).addTo(map).bindPopup('<strong>Shipment location</strong><br>' + locationName).openPopup();
            loading.style.display = 'none';
        })
        .catch(function () { loading.innerHTML = 'Could not pinpoint this address automatically.<br><strong>' + locationName + '</strong>'; });
}());
</script>
</body>
</html>
<?php
} else {
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracking Not Found | Swift Trust Global</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet">
    <link href="css/new-tracking-result.css" rel="stylesheet">
</head>
<?php include_once 'menu.php'; ?>
<main class="tracking-not-found">
    <img src="dashboard/img/no_courier.png" alt="No shipment found">
    <h1>Tracking number not found</h1>
    <p><strong><?php echo trackHtml($tracking); ?></strong> could not be found. Please check the number or contact us.</p>
    <a href="index.html">Back To Home</a>
</main>
<?php include_once 'footer.php'; ?>
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/plugins.js"></script>
<script src="js/active.js"></script>
</body>
</html>
<?php } ?>
