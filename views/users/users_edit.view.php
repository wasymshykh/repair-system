<div class="card mb-5 mb-xl-10">
    <div class="card-body d-flex justify-content-between pt-0 pb-0">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 <?=$page_type_sub=='users_edit'?'active':''?>" href="<?=href('users_edit.php?i='.$user_id, false)?>">Settings</a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 <?=$page_type_sub=='users_logs'?'active':''?>" href="<?=href('users_logs.php?i='.$user_id, false)?>">User Logs</a>
            </li>
        </ul>

        <div class="d-flex align-items-center">
            <a href="<?=href('users')?>" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Go back</a>
        </div>
    </div>
</div>

<?php if (!empty($success)): ?>
<!--begin::Alert-->
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
<!--end::Alert-->
<?php endif; ?>

<?php if (!empty($errors)): ?>
<!--begin::Alert-->
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
<!--end::Alert-->
<?php endif; ?>

<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#user-settings-collapse" aria-expanded="true" aria-controls="user-settings-collapse">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Profile Details</h3>
        </div>
    </div>
    <div id="user-settings-collapse" class="collapse show">
        <form class="form" method="POST">
            <div class="card-body border-top p-9">
                
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6" for="user_name">Full Name</label>
                    <div class="col-lg-8">
                        <input type="text" name="user_name" id="user_name" class="form-control form-control-lg form-control-solid" placeholder="Your full name" value="<?=$_POST['user_name']??$user['user_name']?>">
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6" for="user_role">Role</label>
                    <div class="col-lg-8">
                        <select class="form-select form-control-lg form-select-solid mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="user_role" name="user_role">
                            <option></option>
                            <?php foreach ($roles as $r): ?>
                            <option value="<?=$r['role_id']?>" <?=isset($role) && $role == $r['role_id'] ?'selected':''?>><?=$r['role_name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6" for="user_status">User status</label>
                    <div class="col-lg-8">
                        <select class="form-select form-select-solid mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="user_status" name="user_status">
                            <?php foreach ($statuses as $k => $v): ?>
                            <option value="<?=$k?>" <?=isset($status) && $status == $k ?'selected':''?>><?=$v?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6" for="user_phone">Contact Phone</label>
                    <div class="col-lg-8">
                        <input type="tel" name="user_phone" id="user_phone" class="form-control form-control-lg form-control-solid" placeholder="Your phone number" value="<?=$_POST['user_phone']??$user['user_phone']?>">
                    </div>
                </div>
                
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary" name="save_profile">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#email-settings-collapse" aria-expanded="true" aria-controls="email-settings-collapse">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Email Settings</h3>
        </div>
    </div>
    <div id="email-settings-collapse" class="collapse show">
        <form class="form" method="POST">
            <div class="card-body border-top p-9">
                
                
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6" for="user_email">Email Address</label>
                    <div class="col-lg-8">
                        <input type="email" name="user_email" id="user_email" class="form-control form-control-lg form-control-solid" placeholder="Write email address" value="<?=$_POST['user_email']??$user['user_email']?>">
                    </div>
                </div>
                
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary" name="save_email">Update Email</button>
            </div>
        </form>
    </div>
</div>


<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#password-settings-collapse" aria-expanded="true" aria-controls="password-settings-collapse">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Password Settings</h3>
        </div>
    </div>
    <div id="password-settings-collapse" class="collapse show">
        <form class="form" method="POST">
            <div class="card-body border-top p-9">
                
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold required fs-6" for="user_password">New Password</label>
                    <div class="col-lg-8">
                        <input type="password" name="user_password" id="user_password" class="form-control form-control-lg form-control-solid" placeholder="Write new password" value="<?=$_POST['user_password']??''?>">
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold required fs-6" for="user_cpassword">Password Confirm</label>
                    <div class="col-lg-8">
                        <input type="password" name="user_cpassword" id="user_cpassword" class="form-control form-control-lg form-control-solid" placeholder="Repeat new password" value="<?=$_POST['user_password']??''?>">
                    </div>
                </div>
                
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-danger" name="save_password">Update Password</button>
            </div>
        </form>
    </div>
</div>

