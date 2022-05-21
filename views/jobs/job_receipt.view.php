<div class="card mb-10 d-print-none">
    <div class="card-body">
        <div class="d-flex">
            <div>
                <a href="<?=href('job.php?i='.$receipt['job']['id'], false)?>" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Job Details</a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body py-20">
        <div class="mw-lg-950px mx-auto w-100">
            <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                <h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">RECEIPT</h4>
                <div class="text-sm-end">
                    <a href="<?=URL?>" class="d-block mw-150px ms-sm-auto">
                        <img alt="Logo" src="<?=$receipt['company']['logo_url']?>" class="w-100">
                    </a>
                    <div class="text-sm-end fw-bold fs-4 text-muted mt-7">
                        <div><?=$receipt['company']['address_1']?></div>
                        <div><?=$receipt['company']['address_2']?></div>
                    </div>
                </div>
            </div>
            <div class="pb-12">
                <div class="d-flex flex-column gap-7 gap-md-10">
                    <div class="fw-bolder fs-2">Dear <?=$receipt['customer']['name']?>,
                    <br>
                    <span class="text-muted fs-5">Here are your receipt details. We thank you for your order.</span></div>
                    <div class="separator"></div>
                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">Job ID</span>
                            <span class="fs-5">#J-<?=$receipt['job']['id']?></span>
                        </div>
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">Date Received</span>
                            <span class="fs-5"><?=$receipt['job']['received']?></span>
                        </div>
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">Invoice ID</span>
                            <span class="fs-5">#INV-<?=$receipt['job']['id']?></span>
                        </div>
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">Job Status</span>
                            <span class="fs-5"><?=$receipt['status']['name']?></span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between flex-column">
                        <div class="table-responsive border-bottom mb-9">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                <thead>
                                    <tr class="border-bottom fs-6 fw-bolder text-muted">
                                        <th class="min-w-70px pb-2">Manufacturer</th>
                                        <th class="min-w-80px pb-2">Type</th>
                                        <th class="min-w-175px pb-2">Item</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    <tr>
                                        <td><?=$receipt['type']['name']?></td>
                                        <td><?=$receipt['manufacturer']['name']?></td>
                                        <td>
                                            <div>
                                                <div class="fw-bolder"><?=$receipt['job']['item_name']?></div>
                                                <div class="fs-7 text-muted"><?=$receipt['job']['description']?></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13 d-print-none">
                <div class="my-1 me-5">
                    <button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print Receipt</button>
                </div>
            </div>
        </div>
    </div>
</div>
