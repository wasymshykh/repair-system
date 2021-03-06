<link href="<?=URL?>/assets/fileinput/css/fileinput.min.css" rel="stylesheet">
<style>
    .file-preview {
        border-radius: 8px;
        border: 1px solid #e0e6eb;
        padding: 10px;
        margin-bottom: 10px;
    }
    .file-drop-zone {
        border: 1px dashed #e0e6eb;
        min-height: 80px;
        border-radius: 6px;
        margin: 20px 20px 0px 0px;
        padding: 10px;
    }
    .file-drop-zone.clickable:hover {
        border: 1px dashed #999;
    }
    .file-preview .fileinput-remove {
        top: 5px;
        right: 5px;
        line-height: 12px;
        opacity: 0.2;
        border: 1px solid #000;
        border-radius: 50%;
        padding: 0.4rem;
    }
    .file-drop-zone-title {
        font-size: 1em;
        padding: 12px 10px;
    }
</style>

<form action="" method="post" enctype="multipart/form-data">

    <div class="card mb-5">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <a href="<?=href('job.php?i='.$job['job_id'], false)?>" class="btn btn-light-primary">Back to Job Details</a>
                <a href="<?=href('job.php?i='.$job['job_id'], false)?>" class="btn btn-light-primary">Back to all Jobs</a>
            </div>
        </div>
    </div>

    <?php if (!empty($errors)): ?>
    <div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row px-5 py-2 mb-10">                    
        <div class="d-flex flex-column justify-content-center pe-0 pe-sm-10">
            <?php foreach ($errors as $error): ?>
            <li><?=$error?></li>
            <?php endforeach; ?>
        </div>
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert"><i class="bi bi-x fs-1 text-danger"></i></button>
    </div>
    <?php endif; ?>
    
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


    <div class="card">
        <div class="card-header min-h-50px"><div class="card-title">Customer Details</div></div>
        <div class="card-body">
            <div class="mb-5">
                <label for="customer_name" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Customer Name</span>
                </label>
                <input type="text" name="customer_name" id="customer_name" class="form-control form-control-sm form-control-solid" placeholder="Customer name" value="<?=$customer_name?>">
                <?php if (isset($error_field['customer_name'])): ?><div class="form-text text-danger"><?=$error_field['customer_name']?></div><?php endif; ?>
            </div>
            <div class="mb-5">
                <label for="customer_email" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Customer Email</span>
                </label>
                <input type="text" name="customer_email" id="customer_email" class="form-control form-control-sm form-control-solid" placeholder="Customer email" value="<?=$customer_email?>">
                <?php if (isset($error_field['customer_email'])): ?><div class="form-text text-danger"><?=$error_field['customer_email']?></div><?php endif; ?>
            </div>
            <div>
                <label for="customer_phone" class="fs-7 fw-bolder form-label mb-1">Customer Phone</label>
                <input type="text" name="customer_phone" id="customer_phone" class="form-control form-control-sm form-control-solid" placeholder="Customer phone" value="<?=$customer_phone?>">
                <?php if (isset($error_field['customer_phone'])): ?><div class="form-text text-danger"><?=$error_field['customer_phone']?></div><?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header min-h-50px"><div class="card-title">Item Details</div></div>
        <div class="card-body">

            <div class="mb-5">
                <label for="item_manufacturer" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Item Manufacturer</span>
                </label>
                <select name="item_manufacturer" id="item_manufacturer" class="form-select form-select-sm form-select-solid" data-placeholder="Select or create manufacturer">
                    <option></option>
                    <?php foreach ($ms as $manufacturer): ?>
                        <option value="<?=$manufacturer['manufacturer_id']?>" <?=isset($manufacturer_id)&&$manufacturer_id==$manufacturer['manufacturer_id']?'selected':''?>><?=$manufacturer['manufacturer_name']?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($error_field['item_manufacturer'])): ?><div class="form-text text-danger"><?=$error_field['item_manufacturer']?></div><?php endif; ?>
            </div>

            <div class="mb-5">
                <label for="item_type" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Item Type</span>
                </label>
                <select name="item_type" id="item_type" class="form-select form-select-sm form-select-solid" data-placeholder="Select or create type">
                    <option></option>
                    <?php foreach ($types as $item_type): ?>
                        <option value="<?=$item_type['item_type_id']?>" <?=isset($item_type_id)&&$item_type_id==$item_type['item_type_id']?'selected':''?>><?=$item_type['item_type_name']?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($error_field['item_type'])): ?><div class="form-text text-danger"><?=$error_field['item_type']?></div><?php endif; ?>
            </div>

            <div>
                <label for="item_name" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Item Name</span>
                </label>
                <input type="text" name="item_name" id="item_name" class="form-control form-control-sm form-control-solid" placeholder="Item name" value="<?=$item_name?>">
                <?php if (isset($error_field['item_name'])): ?><div class="form-text text-danger"><?=$error_field['item_name']?></div><?php endif; ?>
            </div>

        </div>
    </div>
    
    <div class="card mt-4">
        <div class="card-header min-h-50px"><div class="card-title">Job Details</div></div>
        <div class="card-body">

            <div class="mb-5">
                <label for="receiving_date" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Receiving Date</span>
                </label>
                <input type="text" name="receiving_date" id="receiving_date" class="form-control form-control-sm form-control-solid" placeholder="Select a date" value="<?=normal_date($job_receiving_date, 'Y-m-d')?>">
                <?php if (isset($error_field['receiving_date'])): ?><div class="form-text text-danger"><?=$error_field['receiving_date']?></div><?php endif; ?>
            </div>
            
            <div class="mb-5">
                <label for="job_description" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Job Description</span>
                </label>
                <textarea name="job_description" id="job_description" placeholder="Job Description" class="form-control form-control-sm form-control-solid"><?=$job_description?></textarea>
                <?php if (isset($error_field['job_description'])): ?><div class="form-text text-danger"><?=$error_field['job_description']?></div><?php endif; ?>
            </div>

            <div>
                <label for="assign_roles" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Assign to Roles</span>
                </label>
                <select name="assign_roles[]" id="assign_roles" class="form-select form-select-sm form-select-solid" data-control="select2" multiple>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?=$role['role_id']?>" <?=isset($assign_roles)&&in_array($role['role_id'], $assign_roles)?'selected':''?>><?=$role['role_name']?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($error_field['assign_roles'])): ?><div class="form-text text-danger"><?=$error_field['assign_roles']?></div><?php endif; ?>
            </div>

        </div>
    </div>

    
    <div class="card mt-4">
        <div class="card-header">
            <div class="card-title">Pictures</div>
        </div>
        <div class="card-body">

            <div class="form-group">
                <input id="file-pictures" type="file" name="pictures[]" multiple>
            </div>

            <?php foreach($pictures as $p): ?>
                <input type="hidden" name="pictures[]" value="<?=$p?>">
            <?php endforeach; ?>

        </div>
    </div>


    <div class="d-flex justify-content-center mt-6">
        <button type="submit" name="save" class="btn btn-lg btn-primary">Save Job</button>
    </div>

</form>

<?php 
    $custom_footer_script = '<script src="'.href("assets/fileinput/js/plugins/sortable.min.js", false).'"></script>';
    $custom_footer_script .= '<script src="'.href("assets/fileinput/js/fileinput.min.js", false).'"></script>'; 
?>

<script>
    const url = "<?=URL?>";

    function sendAddRequest (req_type, val, cb) {
        $.ajax({
            method: "POST",
            url: url+'/api/'+req_type+'/add.php',
            data: { name: val }
        }).done(function(msg) {
            cb(true, msg);
        }).fail(function(request) {
            var failure = "Unable to add type";
            if (request.responseJSON != undefined && request.responseJSON.message != undefined) {
                failure = request.responseJSON.message;
            }
            cb(false, failure);
        });
    }

    function errorSwal (text) {
        Swal.fire({
            text: text,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn fw-bold btn-primary",
            }
        });
    }

    function addType (e) {
        var select = $('#item_type');
        var field = select.data("select2").dropdown.$search;
        var searched_value = field.val();
        
        if (searched_value == "") { return; }
        field.attr('disabled', 'true');

        sendAddRequest ('types', searched_value, function (status, msg) {
            field.removeAttr('disabled');
            if (status) {
                var option = new Option(msg.message.item_type_name, msg.message.item_type_id, true, true);
                select.append(option).trigger('change');
                select.select2("close");
            } else {
                errorSwal (msg);
            }
        });
    }

    function addManuf (e) {
        var select = $('#item_manufacturer');
        var field = select.data("select2").dropdown.$search;
        var searched_value = field.val();
        
        if (searched_value == "") { return; }
        field.attr('disabled', 'true');

        sendAddRequest ('manufacturers', searched_value, function (status, msg) {
            field.removeAttr('disabled');
            if (status) {
                var option = new Option(msg.message.manufacturer_name, msg.message.manufacturer_id, true, true);
                select.append(option).trigger('change');
                select.select2("close");
            } else {
                errorSwal (msg);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function ()  {
        $('#item_manufacturer').select2({
            language: {
                noResults: function () { return "No Results Found. <button type='button' class='btn btn-sm btn-danger' onclick='addManuf(event)'>add new</button>"; }
            },
            escapeMarkup: function (markup) { return markup; }
        })

        $('#item_type').select2({
            language: {
                noResults: function () { return "No Results Found. <button type='button' class='btn btn-sm btn-danger' onclick='addType(event)'>add new</button>"; }
            },
            escapeMarkup: function (markup) { return markup; }
        });

        $('#receiving_date').flatpickr({altInput:!0,altFormat:"d F, Y",dateFormat:"Y-m-d"});
        
        $("#file-pictures").fileinput({
            initialPreview: [<?php foreach($pictures as $p) { echo '"'.href('assets/media/uploads/pictures/'.$p, false).'", '; } ?>],
            initialPreviewAsData: true,
            
            initialPreviewConfig: [<?php foreach($pictures as $p) { echo '{ key: "'.$p.'" }, '; } ?>],

            deleteUrl: url+'/api/pictures/delete_edit.php',
            overwriteInitial: false,
            browseOnZoneClick: true,
            previewClass: "bg-light",
            allowedFileExtensions: ["jpg", "png", "jpeg"],
            encodeUrl:true
        });

        $('#file-pictures').on('filedeleted', function(event, key, jqXHR, data) {
            $('input[type="hidden"][value="'+key+'"]').remove();
        });

    });

</script>
