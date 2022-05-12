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

<form action="" class="form" method="POST">
    <div class="card mb-10">
        <div class="card-body">
            <div class="d-flex flex-column me-n7 pe-7">
            
                <div class="mb-10">
                    <label for="name" class="fs-5 fw-bolder form-label mb-2"><span class="required">Name</span></label>
                    <input type="text" class="form-control form-control-solid" placeholder="Enter user's name" id="name" name="name" value="<?=$name??''?>">
                </div>

                <div class="mb-10">
                    <label for="email" class="fs-5 fw-bolder form-label mb-2"><span class="required">Email</span></label>
                    <input type="email" class="form-control form-control-solid" placeholder="Enter a email address" id="email" name="email" value="<?=$email??''?>">
                </div>

                <div class="mb-10">
                    <label for="password" class="fs-5 fw-bolder form-label mb-2"><span class="required">Password</span></label>
                    <input type="text" class="form-control form-control-solid" placeholder="Enter a password" id="password" name="password" value="<?=$password??''?>">
                </div>

                <div class="mb-10">
                    <label for="role" class="fs-5 fw-bolder form-label mb-2"><span class="required">Select Role</span></label>
                    <select class="form-select form-select-solid mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="role" name="role">
                        <option></option>
                        <?php foreach ($roles as $r): ?>
                        <option value="<?=$r['role_id']?>" <?=isset($role) && $role == $r['role_id'] ?'selected':''?>><?=$r['role_name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-10">
                    <label for="phone" class="fs-5 fw-bolder form-label mb-2">Phone <i>optional</i></label>
                    <input type="text" class="form-control form-control-solid" placeholder="Enter a phone" id="phone" name="phone" value="<?=$phone??''?>">
                </div>
                
                <div class="mb-10">
                    <label for="status" class="fs-5 fw-bolder form-label mb-2"><span class="required">User status</span></label>
                    <select class="form-select form-select-solid mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="status" name="status">
                        <?php foreach ($statuses as $k => $v): ?>
                        <option value="<?=$k?>" <?=isset($status) && $status == $k ?'selected':''?>><?=$v?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="<?=href('users')?>" class="btn btn-light me-5">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>

</form>
