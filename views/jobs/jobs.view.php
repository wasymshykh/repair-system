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

<style>
    table.dataTable tfoot tr th {
        padding: 0;
        padding-right: 0.5rem;
    }
</style>

<div class="card card-flush">
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <input type="text" data-job-search="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Jobs" />
            </div>
        </div>

        <div class="card-toolbar">
            <div class="dropdown dropdown-inline">
                <button type="button" class="btn btn-secondary btn-sm font-weight-bold" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="la la-download"></i>Tools</button>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">Export Tools</li>
                        <li class="navi-item">
                            <a href="#" class="navi-link" id="export_print">
                                <span class="navi-icon">
                                    <i class="la la-print"></i>
                                </span>
                                <span class="navi-text">Print</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link" id="export_copy">
                                <span class="navi-icon">
                                    <i class="la la-copy"></i>
                                </span>
                                <span class="navi-text">Copy</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link" id="export_excel">
                                <span class="navi-icon">
                                    <i class="la la-file-excel-o"></i>
                                </span>
                                <span class="navi-text">Excel</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link" id="export_csv">
                                <span class="navi-icon">
                                    <i class="la la-file-text-o"></i>
                                </span>
                                <span class="navi-text">CSV</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link" id="export_pdf">
                                <span class="navi-icon">
                                    <i class="la la-file-pdf-o"></i>
                                </span>
                                <span class="navi-text">PDF</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="card-body pt-0">
        <table class="table align-middle table-row-dashed fs-8 gy-5" id="jobs_table">
            <thead>
                <tr class="table-search-input">
                    <td>ID</td>
                    <td>Manufacturer</td>
                    <td>Type</td>
                    <td>Item</td>
                    <td></td>
                    <td>Status</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>ID</th>
                    <th>Manufacturer</th>
                    <th>Type</th>
                    <th>Item</th>
                    <th>Recieving Date</th>
                    <th>Status</th>
                    <th>Last Update</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="fw-bold text-gray-600">
                <?php foreach ($jobs as $job): ?>
                <tr>
                    <td>J-<?=$job['job_id']?></td>
                    <td><?=$job['manufacturer_name']?></td>
                    <td><?=$job['item_type_name']?></td>
                    
                    <td>
                        <a href="<?=href('job.php?i='.$job['job_id'], false)?>" class="text-gray-800 text-hover-primary fs-8 fw-bolder mb-1"><?=$job['job_item_name']?></a>
                        <div class="text-muted fs-9 fw-bolder"><?=$job['job_description']?></div>
                    </td>

                    <td><?=normal_date($job['job_receiving_date'], 'M d, Y')?></td>

                    <td>
                        <?=job_status_to_badge($job['job_status'])?>
                    </td>
                    
                    <td><?=!empty($job['job_updated'])?normal_date($job['job_updated'], 'M d, Y'):'-'?></td>

                    <td class="text-end">
                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                            </svg>
                        </span></a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="<?=href('job.php?i='.$job['job_id'], false)?>" class="menu-link px-3">View</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="<?=href('job.php?d='.$job['item_type_id'], false)?>" class="menu-link px-3">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script>

    const url = "<?=URL?>";

    var table = document.querySelector('#jobs_table');
    var datatable;

    
    // Private functions
    var initDatatable = function () {

        $('#jobs_table thead tr.table-search-input td').each(function () {
            var title = $(this).text();
            if (title != "") {

                if (title.toLowerCase() == 'status') {

                    var html = $(`<div><select class="form-select form-select-sm form-select2" multiple>
                                    <option></option>
                                    <option value="waiting for diagnostics">waiting for diagnostics</option>
                                    <option value="waiting for parts">waiting for parts</option>
                                    <option value="repaired">repaired</option>
                                    <option value="cannot be repaired">cannot be repaired</option>
                                </select></div>`);
                    html.find('.form-select2').select2({placeholder: "Select Status"});
                    $(this).html(html);

                } else {
                    $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');
                }

            }
        });

        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
				{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
				{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
				{
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
				{ 
                    extend: 'pdfHtml5', 
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
            ],
            'columnDefs': [
                { orderable: false, targets: 7 }, // Disable ordering on column 7 (actions)
            ],
            initComplete: function () {
                // Apply the search
                this.api()
                    .columns()
                    .every(function () {
                        var that = this;

                        var input_field = $('input', $('#jobs_table thead tr.table-search-input td')[that[0][0]]);
                        if (input_field.length > 0) {
                            input_field.on('keyup change clear', function () {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        } else {

                            
                            var select_field = $('select', $('#jobs_table thead tr.table-search-input td')[that[0][0]]);
                            select_field.on('keyup change clear', function () {
                                
                                var tosearch = $(this).val().join("|");
                                if (that.search() !== tosearch) {
                                    that.search(tosearch, true, false).draw();
                                }
                            });

                        }
                        
                    });
            },
            
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function () {
            // handleDeleteRows();
        });
        
		$('#export_print').on('click', function(e) {
			e.preventDefault();
			datatable.button(0).trigger();
		});
		$('#export_copy').on('click', function(e) {
			e.preventDefault();
			datatable.button(1).trigger();
		});
		$('#export_excel').on('click', function(e) {
			e.preventDefault();
			datatable.button(2).trigger();
		});
		$('#export_csv').on('click', function(e) {
			e.preventDefault();
			datatable.button(3).trigger();
		});
		$('#export_pdf').on('click', function(e) {
			e.preventDefault();
			datatable.button(4).trigger();
		});

    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-job-search="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

</script>
