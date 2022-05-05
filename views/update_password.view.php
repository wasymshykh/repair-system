<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication-->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">

                <?php if (isset($_GET['done'])): ?>
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-0"><span class="text-primary">Success!</span> Code sent!</h1>
                        <div class="text-gray-400 fw-bold fs-4">open your mail inbox..</div>
                    </div>
                    <!--begin::Heading-->

                    
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

                    <!--begin::Actions-->
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <a href="<?=href('update_password')?>" class="btn btn-lg btn-primary fw-bolder me-4">Continue</a>
                        <a href="<?=href('login')?>" class="btn btn-lg btn-light-primary fw-bolder">Cancel</a>
                    </div>
                    <!--end::Actions-->


                <?php else: ?>
                <!--begin::Form-->
                <form class="form w-100" action="" method="POST">
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-0">Reset Password</h1>
                        <div class="text-gray-400 fw-bold fs-4">reset your password..</div>
                    </div>
                    <!--begin::Heading-->

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

                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark" for="code">Reset Code</label>
                        
                        <?php if (isset($_GET['c'])): ?>
                            <div class="input-group">
                                <span class="input-group-text border-0"><i class="bi bi-lock"></i></span>
                                <input class="form-control form-control-lg form-control-solid ps-0" type="text" id="code" name="code" value="<?=$_GET['c']??''?>" tabindex="1" required readonly />
                            </div>
                        <?php else: ?>
                            <input class="form-control form-control-lg form-control-solid" type="text" id="code" name="code" value="<?=$_POST['code']??''?>" tabindex="1" required />
                        <?php endif; ?>
                    </div>
                    <!--end::Input group-->

                    
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6" for="password">Password</label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-lg form-control-solid" type="password" placeholder="Write password..." id="password" name="password" value="<?=$_POST['password']??''?>" autocomplete="off" tabindex="2" required />
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                            </div>
                            <!--end::Input wrapper-->
                            <!--begin::Meter-->
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                            <!--end::Meter-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Hint-->
                        <div class="text-muted"><strong class="text-danger">Recommended:</strong> Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-dark fs-6" for="cpassword">Confirm Password</label>
                        <input class="form-control form-control-lg form-control-solid" type="password" id="cpassword" placeholder="Confirm password..." name="cpassword" value="<?=$_POST['cpassword']??''?>" autocomplete="off" tabindex="3" required />
                    </div>
                    <!--end::Input group=-->

                    <!--begin::Actions-->
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <button type="submit" class="btn btn-lg btn-primary fw-bolder me-4">Update Password</button>
                        <a href="<?=href('login')?>" class="btn btn-lg btn-light-primary fw-bolder">Cancel</a>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
                <?php endif; ?>

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication-->
</div>
<!--end::Root-->
<!--end::Main-->
