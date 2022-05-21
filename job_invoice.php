<?php 

require_once 'app/start.php';
require_once DIR.'app/auth.php';

$Jobs = new Jobs($db);

if (isset($_GET['j']) && !empty($_GET['j']) && is_numeric($_GET['j'])) {
    $job_id = normal_text($_GET['j']);

    $job = $Jobs->get_detailed_by('job_id', $job_id);
    if (!$job['status']) {
        message_move('error', 'Job does not exists', 'jobs.php');
    }
    $job = $job['data'];
} else {
    message_move('error', 'Job does not exists', 'jobs.php');
}

$job_price = $job['job_price'];
if (empty($job_price) || !is_numeric($job_price)) {
    $job_price = "0";
}

$job_price_number = (float)$job_price;

$setting_vat_type = $Settings->fetch('invoice_vat_type');
$setting_vat_value = $Settings->fetch('invoice_vat_value');

$vat = "";
$vat_amount = 0;
if ($setting_vat_type == 'percentage') {
    $vat_amount = $job_price_number * ($setting_vat_value / 100);
    $job_price_number = $job_price_number + $vat_amount;
    $vat = $setting_vat_value.'%';
} else {
    $vat_amount = $setting_vat_value;
    $job_price_number = $job_price_number + $vat_amount;
    $vat = $setting_vat_value.' CHK';
}

$invoice = [
    'job' => [
        'id' => $job_id,
        'received' => normal_date($job['job_receiving_date'], 'M d, Y'),
        'created' => normal_date($job['job_created'], 'M d, Y'),
        'item_name' => $job['job_item_name'],
        'description' => $job['job_description']
    ],
    'customer' => [
        'name' => $job['job_customer_name'],
        'email' => $job['job_customer_email'],
        'phone' => $job['job_customer_phone'],
    ],
    'manufacturer' => [
        'name' => $job['manufacturer_name'],
        'description' => $job['manufacturer_desc']
    ],
    'type' => [
        'name' => $job['item_type_name'],
        'description' => $job['item_type_description']
    ],
    'status' => [
        'name' => job_status_to_text($job['job_status']),
        'color' => $job['job_status']
    ],
    'company' => [
        'name' => $Settings->fetch('invoice_company_name'),
        'address_1' => $Settings->fetch('invoice_address_1'),
        'address_2' => $Settings->fetch('invoice_address_2'),
        'logo_url' => URL.'/assets/media/uploads/logo/'.$Settings->fetch('invoice_logo'),
    ],
    'invoice' => [
        'sub_total' => $job_price,
        'vat' => $vat,
        'vat_amount' => $vat_amount,
        'total' => $job_price_number
    ],
    'repair' => [
        'date' => !empty($job['job_repair_date'])?normal_date($job['job_repair_date'], 'M d, Y'):'-',
        'note' => $job['job_repair_description']
    ]
];

$print_class = true;

$page_title = "Job Invoice";
$page_type = "jobs";

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/jobs/job_invoice.view.php';
require_once DIR.'views/layout/foot.view.php';
