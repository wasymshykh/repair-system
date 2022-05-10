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

<form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row" method="POST">
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>Status</h2>
                </div>
                <div class="card-toolbar">
                    <div class="rounded-circle bg-success w-15px h-15px" id="status-show"></div>
                </div>
            </div>

            <div class="card-body pt-0">
                <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="status" name="status">
                    <option value="published" <?=(isset($status) && ($status == "published") ? 'selected' : '')?>>Published</option>
                    <option value="unpublished" <?=(isset($status) && ($status == "unpublished") ? 'selected' : '')?>>Unpublished</option>
                </select>
                <div class="text-muted fs-7">Set the manufacturer status.</div>
            </div>
        </div>
    </div>
    
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>General</h2>
                </div>
            </div>

            <div class="card-body pt-0">
                
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="name">Manufacturer Name</label>
                    <input type="text" name="name" id="name" class="form-control mb-2" placeholder="Manufacturer name..." value="<?=$name??''?>" />
                    <div class="text-muted fs-7">A manufacturer name is required and recommended to be unique.</div>
                </div>
                <div>
                    <label class="form-label" for="description">Description</label>
                    <textarea name="description" id="description" class="form-control min-h-200px mb-2" placeholder="Manufacturer description..."><?=$desc??''?></textarea>
                    <div class="text-muted fs-7">Set a description to the manufacturer for better understanding.</div>
                </div>
                
            </div>
        </div>
        
        <div class="d-flex justify-content-end">
            <a href="<?=href('manufacturers')?>" class="btn btn-light me-5">Cancel</a>
            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                <span class="indicator-label">Save Changes</span>
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </div>
</form>

<script>
    // Status handler
    const handleStatus = () => {
        const target = document.getElementById('status-show');
        const select = document.getElementById('status');
        const statusClasses = ['bg-success', 'bg-warning', 'bg-danger'];

        $(select).on('change', function (e) {
            const value = e.target.value;

            switch (value) {
                case "published": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-success');
                    break;
                }
                case "unpublished": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-danger');
                    break;
                }
                default:
                    break;
            }
        });

        $(select).change();
    }
</script>
