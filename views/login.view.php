<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication-->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">

                <!--begin::Form-->
                <form class="form w-100" action="" method="POST">
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-0">Authentication</h1>
                        <div class="text-gray-400 fw-bold fs-4">start here.</div>
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
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0" for="password">Password</label>
                            <a href="<?=href("reset_password")?>" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                        </div>
                        <input class="form-control form-control-lg form-control-solid" type="password" id="password" name="password" value="<?=$password??''?>" tabindex="2" required />
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">Continue</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication-->
</div>
<!--end::Root-->
<!--end::Main-->
