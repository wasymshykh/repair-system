<?php if (!empty($success)): ?>
<div class="alert alert-dismissible bg-light-success border border-success d-flex flex-column flex-sm-row px-5 py-2 mb-10">                    
    <div class="d-flex flex-column justify-content-center pe-0 pe-sm-10">
        <?php foreach ($success as $succes): ?>
        <li><?=$succes?></li>
        <?php endforeach; ?>
    </div>

    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert"><i class="bi bi-x fs-1 text-success"></i></button>
</div>
<?php endif; ?>

<div class="card mb-10 d-print-none">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <a href="<?=href('jobs')?>" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Jobs</a>
            </div>

            <div>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modallogs">Job Logs</button>
            </div>
        </div>
    </div>
</div>

<div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
    <div class="card card-flush py-4 flex-row-fluid">
        <div class="card-header">
            <div class="card-title">
                <h2>Job Details (J-<?=$job['job_id']?>)</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                    <tbody class="fw-bold text-gray-600">
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                <span class="svg-icon svg-icon-2 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                        <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="black"></path>
                                        <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="black"></path>
                                    </svg>
                                </span>Date Received</div>
                            </td>
                            <td class="fw-bolder text-end"><?=normal_date($job['job_receiving_date'], 'M d, Y')?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                <span class="svg-icon svg-icon-2 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="black"></path>
                                        <path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="black"></path>
                                    </svg>
                                </span>Job Status</div>
                            </td>
                            <td class="fw-bolder text-end"><?=job_status_to_badge($job['job_status'])?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                <span class="svg-icon svg-icon-2 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                        <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="black"></path>
                                        <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="black"></path>
                                    </svg>
                                </span>Last Updated</div>
                            </td>
                            <td class="fw-bolder text-end"><?=!empty($job['job_updated'])?normal_date($job['job_updated'], 'M d, Y'):'-'?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card card-flush py-4 flex-row-fluid">
        <div class="card-header">
            <div class="card-title">
                <h2>Customer Details</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                    <tbody class="fw-bold text-gray-600">
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                <span class="svg-icon svg-icon-2 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"></path>
                                        <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"></path>
                                    </svg>
                                </span>Customer</div>
                            </td>
                            <td class="fw-bolder text-end"><?=$job['job_customer_name']?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                <span class="svg-icon svg-icon-2 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black"></path>
                                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black"></path>
                                    </svg>
                                </span>Email</div>
                            </td>
                            <td class="fw-bolder text-end"><?=!empty($job['job_customer_email'])?$job['job_customer_email']:'-'?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                <span class="svg-icon svg-icon-2 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="black"></path>
                                        <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="black"></path>
                                    </svg>
                                </span>Phone</div>
                            </td>
                            <td class="fw-bolder text-end"><?=!empty($job['job_customer_phone'])?$job['job_customer_phone']:'-'?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card card-flush py-4 flex-row-fluid">
        <div class="card-header">
            <div class="card-title">
                <h2>Documents</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                    <tbody class="fw-bold text-gray-600">
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                <span class="svg-icon svg-icon-2 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black"></path>
                                        <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black"></path>
                                        <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black"></path>
                                    </svg>
                                </span>Receipt
                                </div>
                            </td>
                            <td class="fw-bolder text-end">
                                <a href="<?=href('job_receipt.php?j='.$job['job_id'], false)?>" class="text-gray-600 text-hover-primary me-2">#J-<?=$job['job_id']?></a>
                                <a href="<?=href('job_receipt.php?j='.$job['job_id'].'&print', false)?>" class="btn btn-sm btn-success py-1 px-2">print <i class="bi bi-arrow-right"></i></a>
                            </td>
                        </tr>

                        <?php if ($job['job_status'] == 'GREEN' || $job['job_status'] == 'RED'): ?>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                <span class="svg-icon svg-icon-2 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black"></path>
                                        <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black"></path>
                                        <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black"></path>
                                    </svg>
                                </span>Invoice
                                </div>
                            </td>
                            <td class="fw-bolder text-end">
                                <a href="<?=href('job_invoice.php?j='.$job['job_id'], false)?>" class="text-gray-600 text-hover-primary me-2">#INV-<?=$job['job_id']?></a>
                                <a href="<?=href('job_invoice.php?j='.$job['job_id'].'&print', false)?>" class="btn btn-sm btn-success py-1 px-2">print <i class="bi bi-arrow-right"></i></a>
                            </td>
                        </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="d-flex flex-column gap-7 gap-lg-10 mt-8">
    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>Job Item</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                        <tbody class="fw-bold text-gray-600">
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                    <span class="svg-icon svg-icon-2 me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                            <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="black"></path>
                                            <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="black"></path>
                                        </svg>
                                    </span>Item Name</div>
                                </td>
                                <td class="fw-bolder text-end"><?=$job['job_item_name']?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil012.svg-->
                                    <span class="svg-icon svg-icon-2 me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"/>
                                            <path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor"/>
                                        </svg>
                                    </span>Item Type</div>
                                </td>
                                <td class="fw-bolder text-end"><?=$job['item_type_name']?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                    <!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil012.svg-->
                                    <span class="svg-icon svg-icon-2 me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"/>
                                            <path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor"/>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>Manufacturer</div>
                                </td>
                                <td class="fw-bolder text-end"><?=$job['manufacturer_name']?></td>
                            </tr>

                            <?php if ($job['job_status'] == 'GREEN' || $job['job_status'] == 'RED'): ?>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                        <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="black"></path>
                                                <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="black"></path>
                                            </svg>
                                        </span>Repaire Date</div>
                                    </td>
                                    <td class="fw-bolder text-end"><?=!empty($job['job_repair_date'])?normal_date($job['job_repair_date'], 'M d, Y'):'-'?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="fw-bolder">Repair Note</div>
                                        <div class="fs-7 text-muted"><?=$job['job_repair_description']?></div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-flush py-4 flex-row-fluid flex-grow-1">
            <div class="card-header">
                <div class="card-title">
                    <h2>Job Description</h2>
                </div>
            </div>
            <div class="card-body pt-0"><?=nl2br($job['job_description'])?></div>
        </div>
    </div>

    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
        <div class="card card-flush py-4 flex-row-fluid">
            <div class="card-body">
                
                <div class="d-flex justify-content-around">
                    <?php if ($job['job_status'] != 'ORANGE'): ?>
                        <button class="btn btn-warning change-status" data-type="parts">mark awaiting parts</button>
                    <?php endif; ?>

                    <?php if ($job['job_status'] != 'GREEN'): ?>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalrepaired">mark repaired</button>
                    <?php endif; ?>

                    <?php if ($job['job_status'] != 'PINK'): ?>
                        <button class="btn btn-light-danger change-status" data-type="awaiting">mark awaiting for diagnostic</button>
                    <?php endif; ?>

                    <?php if ($job['job_status'] != 'RED'): ?>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalnotrepaired">mark cannot be repaired</button>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<?php if ($job['job_status'] != 'GREEN'): ?>
    <div class="modal fade" tabindex="-1" id="modalrepaired" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <form method="POST" action="" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mark as <span class="text-success">Repaired</span></h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body">

                    <?php if (isset($error_field['repaired'])): ?><div class="alert alert-danger"><?=$error_field['repaired']?></div><?php endif; ?>
                    
                    <div class="mb-5">
                        <label for="repair_date" class="fs-7 fw-bolder form-label mb-1">
                            <span class="required">Repair Date</span>
                        </label>
                        <input type="text" name="repair_date" id="repair_date" class="form-control form-control-solid" placeholder="Select a date" value="<?=$repair_date??current_date('Y-m-d')?>">
                        <?php if (isset($error_field['repair_date'])): ?><div class="form-text text-danger"><?=$error_field['repair_date']?></div><?php endif; ?>
                    </div>

                    <div class="mb-5">
                        <label for="repair_cost" class="required form-label">Repair Cost</label>
                        <div class="input-group input-group-solid">
                            <span class="input-group-text" id="repair_cost-addon">CHK</span>
                            <input type="number" step="any" min="0" name="repair_cost" id="repair_cost" class="form-control" placeholder="Repair Cost.." value="<?=$repair_cost??''?>" required />
                        </div>
                        <?php if (isset($error_field['repair_cost'])): ?><div class="form-text text-danger"><?=$error_field['repair_cost']?></div><?php endif; ?>
                    </div>
                    
                    <div class="mb-5">
                        <label for="repair_description" class="required form-label">Repair Description</label>
                        <textarea name="repair_description" id="repair_description" class="form-control form-control-solid" placeholder="Repair description..." required><?=$repair_description??''?></textarea>
                        <?php if (isset($error_field['repair_description'])): ?><div class="form-text text-danger"><?=$error_field['repair_description']?></div><?php endif; ?>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="repaired" class="btn btn-success">Mark Repaired</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#repair_date').flatpickr({altInput:!0,altFormat:"d F, Y",dateFormat:"Y-m-d"});
            <?php if ($modal_open == 'repaired'): ?>
                $(document).ready(function () {
                    $('#modalrepaired').modal('show');
                });
            <?php endif; ?>
        });
    </script>
<?php endif; ?>

<?php if ($job['job_status'] != 'RED'): ?>
    <div class="modal fade" tabindex="-1" id="modalnotrepaired" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <form method="POST" action="" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mark as <span class="text-danger">Not Repaired</span></h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body">

                    <?php if (isset($error_field['notrepaired'])): ?><div class="alert alert-danger"><?=$error_field['notrepaired']?></div><?php endif; ?>
                    
                    <div class="mb-5">
                        <label for="diagnose_date" class="fs-7 fw-bolder form-label mb-1">
                            <span class="required">Diagnose Date</span>
                        </label>
                        <input type="text" name="diagnose_date" id="diagnose_date" class="form-control form-control-solid" placeholder="Select a date" value="<?=$diagnose_date??current_date('Y-m-d')?>">
                        <?php if (isset($error_field['diagnose_date'])): ?><div class="form-text text-danger"><?=$error_field['diagnose_date']?></div><?php endif; ?>
                    </div>

                    <div class="mb-5">
                        <label for="diagnose_cost" class="form-label">Diagnose Cost</label>
                        <div class="input-group input-group-solid">
                            <span class="input-group-text" id="diagnose_cost-addon">CHK</span>
                            <input type="number" step="any" min="0" name="diagnose_cost" id="diagnose_cost" class="form-control" placeholder="Repair Cost.." value="<?=$diagnose_cost??'0'?>" />
                        </div>
                        <?php if (isset($error_field['diagnose_cost'])): ?><div class="form-text text-danger"><?=$error_field['diagnose_cost']?></div><?php endif; ?>
                    </div>
                    
                    <div class="mb-5">
                        <label for="diagnose_description" class="required form-label">Diagnose Description</label>
                        <textarea name="diagnose_description" id="diagnose_description" class="form-control form-control-solid" placeholder="Diagnose description..." required><?=$diagnose_description??''?></textarea>
                        <?php if (isset($error_field['diagnose_description'])): ?><div class="form-text text-danger"><?=$error_field['diagnose_description']?></div><?php endif; ?>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="notrepaired" class="btn btn-danger">Mark Not Repaired</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#diagnose_date').flatpickr({altInput:!0,altFormat:"d F, Y",dateFormat:"Y-m-d"});
            <?php if ($modal_open == 'notrepaired'): ?>
                $(document).ready(function () {
                    $('#modalnotrepaired').modal('show');
                });
            <?php endif; ?>
        });
    </script>
<?php endif; ?>

<div class="modal fade" tabindex="-1" id="modalconfirm" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <form method="POST" action="" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure?</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">                
                <p>You are changing job status to <span class="badge job-status-badge"></span></p>
                <input type="hidden" name="change_status_type" id="change_status_type" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="change_status" class="btn btn-danger">Yes, confirm</button>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="modallogs" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Job Logs</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        $(document).ready(function () {

            $('.change-status').click (function (e) {
                var to_value = e.target.getAttribute('data-type');
                
                if (to_value == 'awaiting') {
                    $('.job-status-badge').removeClass('badge-light-warning').addClass('badge-light-pink').text('waiting for diagnostics');
                } else if (to_value == 'parts') {
                    $('.job-status-badge').removeClass('badge-light-pink').addClass('badge-light-warning').text('waiting parts');
                } else {
                    return;
                }

                $('#modalconfirm #change_status_type').val(to_value);

                $('#modalconfirm').modal('show');

            });

        });

    });
</script>
