
<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Jobs</div>
                <div class="d-flex align-items-center">
                    <a href="<?=href('jobs')?>" class="btn btn-primary btn-sm">All Jobs <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="card-body">

                <canvas id="kt_chartjs_3" class="mh-200px"></canvas>

            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Last 5 Jobs</div>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-middle gs-0 gy-3">
                        <thead>
                            <tr>
                                <th class="p-0 w-50px"></th>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-140px"></th>
                                <th class="p-0 min-w-120px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jobs as $i => $job): if ($i == 4) { break; } ?>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px me-2">
                                        <span class="symbol-label fw-boldest border border-danger">
                                            J-<?=$job['job_id']?>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?=href('job.php?i='.$job['job_id'], false)?>" class="text-dark fw-bolder text-hover-primary mb-1 fs-6"><?=$job['job_item_name']?></a>
                                    <span class="text-muted fw-bold d-block"><?=$job['job_description']?></span>
                                </td>
                                <td>
                                    <span class="text-muted fw-bold d-block fs-7"><?=$job['manufacturer_name']?></span>
                                    <span class="text-dark fw-bolder d-block fs-7"><?=$job['item_type_name']?></span>
                                </td>
                                <td class="text-end">
                                    <span class="text-danger fs-7 fw-bolder"><?=job_status_to_badge($job['job_status'])?></span>
                                </td>
                                <td class="text-end">
                                    <a href="<?=href('job.php?i='.$job['job_id'], false)?>" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>

    var ctx = document.getElementById('kt_chartjs_3');

    const labels = ['waiting for diagnostics', 'waiting for parts', 'cannot be repaired', 'repaired'];

    const data = {
        labels: labels,
            datasets: [{
                data: [<?=$job_stats['PINK']?>, <?=$job_stats['ORANGE']?>, <?=$job_stats['RED']?>, <?=$job_stats['GREEN']?>],
                backgroundColor: ['#ff8faa', '#ffc700', '#e70038', '#50cd89']
            }
        ]
    };


    document.addEventListener('DOMContentLoaded', function () {

        var fontFamily = KTUtil.getCssVariableValue('--bs-font-sans-serif');
        
        const config = {
            type: 'pie',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: false,
                    }
                },
                responsive: true,
            },
            defaults:{
                global: {
                    defaultFont: fontFamily
                }
            }
        };

        var myChart = new Chart(ctx, config);

    })


</script>
