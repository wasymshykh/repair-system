
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
    <?php foreach ($roles as $role): ?>

        <div class="col-md-4">
            <div class="card card-flush h-md-100">
                <div class="card-header">
                    <div class="card-title">
                        <h2><?=$role['role_name']?></h2>
                    </div>
                </div>
                <div class="card-footer flex-wrap pt-0">
                    <a href="<?=href('roles_edit.php?i='.$role['role_id'], false)?>" class="btn btn-light btn-active-light-primary my-1">Edit Role</a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

    <div class="ol-md-4">
        <div class="card h-md-100">
            <div class="card-body d-flex flex-center">
                <a href="<?=href('roles_create')?>" class="btn btn-clear d-flex flex-column flex-center">
                    <img src="<?=href('assets/media/illustrations/role-new.png', false)?>" alt="" class="mw-100 mh-150px mb-7">
                    <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">Add New Role</div>
                </a>
            </div>
        </div>
    </div>
</div>