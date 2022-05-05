<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-0 pb-0">
        <!--begin::Navs-->
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 <?=$page_type=='user_settings'?'active':''?>" href="<?=href('user_settings')?>">Settings</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 <?=$page_type=='user_logs'?'active':''?>" href="<?=href('user_logs')?>">User Logs</a>
            </li>
            <!--end::Nav item-->
        </ul>
        <!--begin::Navs-->
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
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#user-settings-collapse" aria-expanded="true" aria-controls="user-settings-collapse">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Profile Details</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div id="user-settings-collapse" class="collapse show">
        <!--begin::Form-->
        <form class="form" method="POST">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6" for="user_name">Full Name</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <input type="text" name="user_name" id="user_name" class="form-control form-control-lg form-control-solid" placeholder="Your full name" value="<?=$_POST['user_name']??$logged_user['user_name']?>">
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6" for="user_phone">Contact Phone</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <input type="tel" name="user_phone" id="user_phone" class="form-control form-control-lg form-control-solid" placeholder="Your phone number" value="<?=$_POST['user_phone']??$logged_user['user_phone']?>">
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary" name="save_profile">Save Changes</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>

<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#email-settings-collapse" aria-expanded="true" aria-controls="email-settings-collapse">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Email Settings</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div id="email-settings-collapse" class="collapse show">
        <!--begin::Form-->
        <form class="form" method="POST">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                
                
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6" for="user_email">Email Address</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <input type="email" name="user_email" id="user_email" class="form-control form-control-lg form-control-solid" placeholder="Write email address" value="<?=$_POST['user_email']??$logged_user['user_email']?>">
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary" name="save_email">Update Email</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>


<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#password-settings-collapse" aria-expanded="true" aria-controls="password-settings-collapse">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Password Settings</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div id="password-settings-collapse" class="collapse show">
        <!--begin::Form-->
        <form class="form" method="POST">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold required fs-6" for="user_password">New Password</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <input type="password" name="user_password" id="user_password" class="form-control form-control-lg form-control-solid" placeholder="Write new password" value="<?=$_POST['user_password']??''?>">
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold required fs-6" for="user_cpassword">Password Confirm</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <input type="password" name="user_cpassword" id="user_cpassword" class="form-control form-control-lg form-control-solid" placeholder="Repeat new password" value="<?=$_POST['user_password']??''?>">
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-danger" name="save_password">Update Password</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>

