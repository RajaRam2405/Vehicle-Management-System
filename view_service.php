<?php 
require_once('config.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger'>Service ID is missing.</div>";
    exit;
}

$id = $_GET['id'];
$qry = $conn->query("SELECT * FROM `service_list` WHERE id = '{$id}'");
if ($qry && $qry->num_rows > 0) {
    $row = $qry->fetch_assoc();
    $service = $row['service'] ?? '';
    $description = $row['description'] ?? '';
} else {
    echo "<div class='alert alert-warning'>Service not found.</div>";
    exit;
}
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
</style>
<div class="container-fluid">
    <dl>
        <dt><?php echo htmlspecialchars($service) ?></dt>
        <dd><?php echo html_entity_decode(stripslashes($description)) ?></dd>
    </dl>
    <div class="w-100 d-flex justify-content-end mx-2">
        <div class="col-auto">
            <button class="btn btn-dark btn-sm rounded-0" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
