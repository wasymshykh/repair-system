<?php if (!empty($success)): ?>
<div class="alert alert-dismissible bg-light-success border border-success d-flex flex-column flex-sm-row px-5 py-2 mb-10">                    
    <div class="d-flex flex-column justify-content-center pe-0 pe-sm-10">
        <?php foreach ($success as $succes): ?>
        <li><?=$succes?></li>
        <?php endforeach; ?>
    </div>

    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
        <i class="bi bi-x fs-1 text-success"></i>
    </button>
</div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
<div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row px-5 py-2 mb-10">                    
    <div class="d-flex flex-column justify-content-center pe-0 pe-sm-10">
        <?php foreach ($errors as $error): ?>
        <li><?=$error?></li>
        <?php endforeach; ?>
    </div>

    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
        <i class="bi bi-x fs-1 text-danger"></i>
    </button>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-xl-6">
        
        <div class="card">
            <div class="card-header">
                <div class="card-title">Receipt Settings</div>
            </div>
            <div class="card-body">
        
                <form action="" method="POST" enctype="multipart/form-data">
        
                    <div class="row mb-8">
                        <label class="col-xl-3" for="company_name">
                            <div class="fs-6 fw-bold mt-2 mb-3">Company Name</div>
                        </label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control form-control-solid" name="company_name" id="company_name" placeholder="company name" value="<?=$_POST['company_name']??$Settings->fetch('invoice_company_name')?>">
                            <?php if (isset($error_field['company_name'])): ?><div class="form-text text-danger"><?=$error_field['company_name']?></div><?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-8">
                        <label for="address_1" class="col-xl-3">
                            <div class="fs-6 fw-bold mt-2 mb-3">Address Line 1</div>
                        </label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control form-control-solid" name="address_1" id="address_1" placeholder="address line 1" value="<?=$_POST['address_1']??$Settings->fetch('invoice_address_1')?>">
                            <?php if (isset($error_field['address_1'])): ?><div class="form-text text-danger"><?=$error_field['address_1']?></div><?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-8">
                        <label for="address_2" class="col-xl-3">
                            <div class="fs-6 fw-bold mt-2 mb-3">Address Line 2</div>
                        </label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control form-control-solid" name="address_2" id="address_2" placeholder="address line 2" value="<?=$_POST['address_2']??$Settings->fetch('invoice_address_2')?>">
                            <?php if (isset($error_field['address_2'])): ?><div class="form-text text-danger"><?=$error_field['address_2']?></div><?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <div class="fs-6 fw-bold mt-2 mb-3">Company Logo</div>
                        </div>
                        <div class="col-lg-8">
                            <div class="image-input image-input-outline <?=empty($company_logo)?'image-input-empty':''?>" data-kt-image-input="true" style="background-image: url('<?=URL?>/assets/media/uploads/logo/blank.svg')">

                                <?php if (!empty($company_logo)): ?>
                                    <div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('<?=URL?>/assets/media/uploads/logo/<?=$company_logo?>')"></div>
                                <?php else: ?>
                                    <div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: none;"></div>
                                <?php endif; ?>

                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change logo">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="company_logo" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="remove_logo" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                            </div>
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            
                            <?php if (isset($error_field['company_logo'])): ?><div class="form-text text-danger"><?=$error_field['company_logo']?></div><?php endif; ?>
                        </div>
                    </div>

                    <div class="row mt-10">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary" name="receipt">Update</button>
                        </div>
                    </div>
        
                </form>
        
            </div>
        </div>
        
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Overall Settings</div>
            </div>
            <div class="card-body">

                <form action="" method="POST">
                    
                    <div class="row mb-8">
                        <label class="col-xl-3" for="site_currency">
                            <div class="fs-6 fw-bold mt-2 mb-3">Currency</div>
                        </label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control form-control-solid" name="site_currency" id="site_currency" placeholder="Currency" value="<?=$_POST['site_currency']??$Settings->fetch('site_currency')?>">
                            <?php if (isset($error_field['site_currency'])): ?><div class="form-text text-danger"><?=$error_field['site_currency']?></div><?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-8">
                        <label class="col-xl-3" for="invoice_vat_value">
                            <div class="fs-6 fw-bold mt-2 mb-3">VAT</div>
                        </label>
                        <div class="col-xl-5">
                            <input type="text" class="form-control form-control-solid" name="invoice_vat_value" id="invoice_vat_value" placeholder="VAT Value" value="<?=$_POST['invoice_vat_value']??$Settings->fetch('invoice_vat_value')?>">
                            <?php if (isset($error_field['invoice_vat_value'])): ?><div class="form-text text-danger"><?=$error_field['invoice_vat_value']?></div><?php endif; ?>
                        </div>
                        <div class="col-xl-4">
                            <select name="invoice_vat_type" class="form-select form-select-solid">
                                <option value="percentage" <?=$Settings->fetch('invoice_vat_type')=='percentage'?'selected':''?>>%</option>
                                <option value="fixed" <?=$Settings->fetch('invoice_vat_type')=='fixed'?'selected':''?>>fixed</option>
                            </select>
                            <?php if (isset($error_field['invoice_vat_type'])): ?><div class="form-text text-danger"><?=$error_field['invoice_vat_type']?></div><?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="row mt-10">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary" name="overall">Update</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
