<?php 

require_once 'app/start.php';

require_once 'app/auth.php';


$Types = new Types($db);

$types = $Types->get_all();
if ($types['status']) {
    $types = $types['data'];
} else {
    $types = [];
}

$page_title = "Types";
$page_type = "types";

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
require_once DIR.'views/types.view.php';
require_once DIR.'views/layout/foot.view.php';
