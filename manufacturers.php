<?php 

require_once 'app/start.php';

require_once DIR.'app/auth.php';

$Manufacturers = new Manufacturers ($db);

$manufacturers = $Manufacturers->get_all();
if ($manufacturers['status']) {
    $manufacturers = $manufacturers['data'];
} else {
    $manufacturers = [];
}

$page_title = "Manufacturers";
$page_type = "manufacturers";

$custom_head_css = ['assets/plugins/custom/datatables/datatables.bundle.css'];

$custom_footer_js = ['assets/plugins/custom/datatables/datatables.bundle.js'];

$custom_footer_script = '
<script>
    KTUtil.onDOMContentLoaded(function () {
        initDatatable();
        handleSearchDatatable();
        handleDeleteRows();
    });
</script>';

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/manufacturers.view.php';
require_once DIR.'views/layout/foot.view.php';
