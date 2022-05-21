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

$receipt = [
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
    ]
];

$print_class = true;

$page_title = "Job Receipt";
$page_type = "jobs";

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/jobs/job_receipt.view.php';
require_once DIR.'views/layout/foot.view.php';
