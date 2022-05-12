<?php 

require_once 'app/start.php';
require_once DIR.'app/auth.php';

$users = $Users->get_all(true);
if ($users['status']) {
    $users = $users['data'];
} else {
    $users = [];
}

$page_title = "Users";
$page_type = "users";

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
require_once DIR.'views/users/users.view.php';
require_once DIR.'views/layout/foot.view.php';
