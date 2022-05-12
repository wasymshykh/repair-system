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

<div class="card mb-5 mb-lg-10">
    <div class="card-header">
        <div class="card-title">
            <h3>User Logs</h3>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                    <tr>
                        <th class="min-w-250px">Type</th>
                        <th class="min-w-150px">Information</th>
                        <th class="min-w-200px">Dated</th>
                    </tr>
                </thead>
                <tbody class="fw-6 fw-bold text-gray-600">
                    <?php if (!empty($logs)): ?>
                    <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?=$log['ulog_type']?></td>
                        <td><?=$log['ulog_text']?></td>
                        <td><?=normal_date($log['ulog_created'])?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr><td colspan="3">No logs available</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
