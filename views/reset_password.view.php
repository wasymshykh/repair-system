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
                        <label class="form-label fs-6 fw-bolder text-dark" for="email">Email</label>
                        <input class="form-control form-control-lg form-control-solid" type="email" id="email" name="email" value="<?=$email??''?>" tabindex="1" required />
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <button type="submit" class="btn btn-lg btn-primary fw-bolder me-4">Continue</button>
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
