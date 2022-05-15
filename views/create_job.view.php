<form action="" method="post">

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

    <div class="card">
        <div class="card-header min-h-50px"><div class="card-title">Customer Details</div></div>
        <div class="card-body">
            <div class="mb-5">
                <label for="customer_name" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Customer Name</span>
                </label>
                <input type="text" name="customer_name" id="customer_name" class="form-control form-control-sm form-control-solid" placeholder="Customer name" value="<?=$_POST['customer_name']??''?>">
                <?php if (isset($error_field['customer_name'])): ?><div class="form-text text-danger"><?=$error_field['customer_name']?></div><?php endif; ?>
            </div>
            <div class="mb-5">
                <label for="customer_email" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Customer Email</span>
                </label>
                <input type="text" name="customer_email" id="customer_email" class="form-control form-control-sm form-control-solid" placeholder="Customer email" value="<?=$_POST['customer_email']??''?>">
                <?php if (isset($error_field['customer_email'])): ?><div class="form-text text-danger"><?=$error_field['customer_email']?></div><?php endif; ?>
            </div>
            <div>
                <label for="customer_phone" class="fs-7 fw-bolder form-label mb-1">Customer Phone</label>
                <input type="text" name="customer_phone" id="customer_phone" class="form-control form-control-sm form-control-solid" placeholder="Customer phone" value="<?=$_POST['customer_phone']??''?>">
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
                        <option value="<?=$manufacturer['manufacturer_id']?>" <?=isset($_POST['item_manufacturer'])&&$_POST['item_manufacturer']==$manufacturer['manufacturer_id']?'selected':''?>><?=$manufacturer['manufacturer_name']?></option>
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
                        <option value="<?=$item_type['item_type_id']?>" <?=isset($_POST['item_type'])&&$_POST['item_type']==$item_type['item_type_id']?'selected':''?>><?=$item_type['item_type_name']?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($error_field['item_type'])): ?><div class="form-text text-danger"><?=$error_field['item_type']?></div><?php endif; ?>
            </div>

            <div>
                <label for="item_name" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Item Name</span>
                </label>
                <input type="text" name="item_name" id="item_name" class="form-control form-control-sm form-control-solid" placeholder="Item name" value="<?=$_POST['item_name']??''?>">
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
                <input type="text" name="receiving_date" id="receiving_date" class="form-control form-control-sm form-control-solid" placeholder="Select a date" value="<?=$_POST['receiving_date']??''?>">
                <?php if (isset($error_field['receiving_date'])): ?><div class="form-text text-danger"><?=$error_field['receiving_date']?></div><?php endif; ?>
            </div>
            
            <div class="mb-5">
                <label for="job_description" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Job Description</span>
                </label>
                <textarea name="job_description" id="job_description" placeholder="Job Description" class="form-control form-control-sm form-control-solid"><?=$_POST['job_description']??''?></textarea>
                <?php if (isset($error_field['job_description'])): ?><div class="form-text text-danger"><?=$error_field['job_description']?></div><?php endif; ?>
            </div>

            <div>
                <label for="assign_roles" class="fs-7 fw-bolder form-label mb-1">
                    <span class="required">Assign to Roles</span>
                </label>
                <select name="assign_roles[]" id="assign_roles" class="form-select form-select-sm form-select-solid" data-control="select2" multiple>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?=$role['role_id']?>" <?=isset($_POST['assign_roles'])&&in_array($role['role_id'], $_POST['assign_roles'])?'selected':''?>><?=$role['role_name']?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($error_field['assign_roles'])): ?><div class="form-text text-danger"><?=$error_field['assign_roles']?></div><?php endif; ?>
            </div>

        </div>
    </div>

    <div class="d-flex justify-content-center mt-6">
        <button type="submit" name="create" class="btn btn-primary">Create Job</button>
    </div>

</form>

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

        $('#receiving_date').flatpickr({altInput:!0,altFormat:"d F, Y",dateFormat:"Y-m-d"})
    });

</script>
