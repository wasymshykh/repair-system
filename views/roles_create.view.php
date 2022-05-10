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

<div class="card">
    <div class="card-body">

        <form id="kt_modal_update_role_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="" method="POST">
            <div class="d-flex flex-column scroll-y me-n7 pe-7">
                
                <div class="fv-row mb-10 fv-plugins-icon-container">
                    <label class="fs-5 fw-bolder form-label mb-2" for="role_name">
                        <span class="required">Role name</span>
                    </label>
                    <input class="form-control form-control-solid" placeholder="Enter a role name" id="role_name" name="role_name" value="<?=$role_name??''?>">
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>

                <div class="fv-row">
                    <label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <tbody class="text-gray-600 fw-bold">
                                <tr>
                                    <td class="text-gray-800 w-200px">Administrator Access
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Allows a full access to the system" aria-label="Allows a full access to the system"></i></td>
                                    <td>
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                            <input class="form-check-input" type="checkbox" value="" name="permission_admin" id="kt_roles_select_all" <?=(isset($permission_admin) && $permission_admin === true)?'checked':''?>>
                                            <span class="form-check-label" for="kt_roles_select_all">All Permissions</span>
                                        </label>
                                    </td>
                                </tr>
                                
                                <?php foreach ($permissions as $permission): ?>
                                <tr class="permissions <?=(isset($permission_admin) && $permission_admin === true)?'d-none':''?>">
                                    <td class="text-gray-800"><?=$permission['text']?></td>
                                    <td>
                                        <div class="d-flex">
                                            <?php foreach ($permission['types'] as $permission_type): ?>
                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                <input class="form-check-input" type="checkbox" value="1" name="permissions[<?=$permission['name']?>][<?=$permission_type?>]" <?=(isset($role_permissions) && is_array($role_permissions) && array_key_exists($permission['name'], $role_permissions) && array_key_exists($permission_type, $role_permissions[$permission['name']]))?'checked':''?>>
                                                <span class="form-check-label"><?=$permission_type?></span>
                                            </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="text-center pt-15">
                <a href="<?=href('roles')?>" class="btn btn-light me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>

    </div>
</div>


<script>
    var form = document.querySelector('#kt_modal_update_role_form');

    const handleSelectAll = () => {
        // Define variables
        const selectAll = form.querySelector('#kt_roles_select_all');
        const allCheckboxes = form.querySelectorAll('[type="checkbox"]');

        // Handle check state
        selectAll.addEventListener('change', e => {
            if (e.target.checked) {
                $('.permissions').addClass('d-none')
            } else {
                $('.permissions').removeClass('d-none')
            }
        });


    }

</script>
