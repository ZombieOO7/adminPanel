// This function is used to initialize the data table.
(function($) {
    var data = [];
    var response = null;
    var adminTheme = function() {
        c._initialize();
        c._deleteRecord();
        c._changeStatus();
        c._bulkAction();
    }
    var c = adminTheme.prototype;
    c._initialize = function() {
        // This function is used for applying csrf token in ajax.
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': token }
        });

        $(document).ajaxStart(function() {
            if ($('.indicator-progress').length > 0) {
                $('.indicator-progress').show();
                $('.indicator-label').hide();
            }
            $('.main_loader').show(); //ajax request went so show the loading image
        }).ajaxStop(function() {
            if ($('.indicator-progress').length > 0) {
                $('.indicator-progress').hide();
                $('.indicator-label').show();
            }
            $('.main_loader').hide(); //got response so hide the loading image
        });
    };

    //Generate data table
    c._generateDataTable = function(element_id_name, ajax_URL, field_coloumns, order_coloumns, data, dom) {
        var bSearching = true;
        if (field_coloumns === undefined) {
            field_coloumns = [];
        }
        if (order_coloumns === undefined) {
            order_coloumns = [
                [1, "desc"]
            ];
        }

        var intial_url = 'http://';
        var intial_url2 = 'https://';
        var final_ajax_url = '';
        if (ajax_URL.indexOf(intial_url) != -1) {
            final_ajax_url = ajax_URL;
        } else if (ajax_URL.indexOf(intial_url2) != -1) {
            final_ajax_url = ajax_URL;
        } else {
            final_ajax_url = base_url + ajax_URL;
        }
        var doms = 'trilp',
            button = [];
        if (dom != undefined) {
            doms = dom;
            button = [{
                extend: 'csvHtml5',
                // title: 'Data List',
                text: 'Export',
                extension: '.csv',
                exportOptions: {
                    columns: "thead th:not(.noExport)"
                }
            }]
        }
        table = $('#' + element_id_name).DataTable({
            stateSave: true,
            searchDelay: 500,
            // responsive: true,
            processing: true,
            order: order_coloumns,
            oLanguage: {
                sProcessing: '<img src="' + base_url + '/public/images/loader.gif" width="40">',
                sEmptyTable: "No Record Found",
            },
            lengthMenu: [1, 2, 5, 10, 25, 50, 75, 100],
            serverSide: true,
            bInfo: true,
            autoWidth: true,
            searching: bSearching,
            orderCellsTop: true,
            columns: field_coloumns,
            bPaginate: true,
            // dom: 'ltr',
            buttons: button,
            initComplete: function() {
                if (data != undefined) {
                    if (data['type'] == 'user') {
                        this.api().columns([5]).visible(false);
                    }
                }
            },
            ajax: {
                url: final_ajax_url,
                type: "get", // method  , by default get
                global: false,
                data: function(d) {
                    $.extend(d, data);
                    d.status = $('.statusFilter').val();
                },
                error: function() {
                    // window.location.reload();
                }
            }
        });
        c.table = table;
        if (bSearching) {
            c._tableSearchInput(element_id_name);
        }
        c._tableResetFilter();
        return table;
    };

    //Event added for table search
    c._tableSearchInput = function(element_id_name) {
        var r = $('#' + element_id_name + ' tfoot tr');
        $('#' + element_id_name + ' thead').append(r);
        var table = c.table;
        table.columns().every(function(colindex) {
            var column = this;
            column.search('');
            $('.tbl-filter-column').val('');
            var tColumn = $('#' + element_id_name + ' thead th').eq(this.index());
            $('input', this.footer()).keyup(delay(function(e) {
                column.search($.trim($(this).val()), false, false, true).draw();
            }, 500));
            $('select', this.footer()).on('change', function() {
                table.draw();
            });
        });
    };

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    //Event added for record per page
    c._tableResetFilter = function() {
        $(document).on('click', '#clr_filter', function(event) {
            c._tableResetFilterDraw();
            $('input:checkbox').prop("checked", false);
        });
    };

    //Table Draw after reset table
    c._tableResetFilterDraw = function() {
        $('.tbl-filter-column').val('');
        var columns = c.table.columns();
        c.table.search('').columns().search('').draw();
        c.table.clear().draw();
    };

    // Delete Record
    c._deleteRecord = function() {
        $(document).on('click', '.delete', function() {
            var id = $(this).attr('id');
            var url = $(this).attr('data-url');
            var tableName = $(this).attr('data-table_name');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this',
                icon: "warning",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': token }
                    });
                    $.ajax({
                        url: url,
                        method: "delete",
                        data: { id: id },
                        success: function(response) {
                            if (response['msg'] != 'error') {
                                swal(response['msg'], {
                                    icon: response['icon'],
                                    closeOnClickOutside: false,
                                });
                                $('#' + tableName).DataTable().ajax.reload(null, false);
                            }
                        }
                    })
                }
            });
        });
    };

    // Change Status (Active/Inactive)
    c._changeStatus = function() {
        $(document).on('click', '.active_inactive', function() {
            var id = $(this).attr('id');
            var url = $(this).attr('data-url');
            var tableName = $(this).attr('data-table_name');
            var status = $(this).attr('data-status');
            swal({
                title: 'Are you sure?',
                text: 'You want to change status!',
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false,
            }).then((isConfirm) => {
                if (isConfirm) {
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: { id: id, status: status },
                        success: function(response) {
                            swal(response['msg'], {
                                icon: response['icon'],
                                closeOnClickOutside: false,
                            });
                            $('#' + tableName).DataTable().ajax.reload(null, false);
                        }
                    })
                }
            });
        });
    };

    // Bulk Action Active/Inactive/Delete
    c._bulkAction = function() {
        // This function is used for un checking all checkbox.
        $("body").on('change', '.checkbox', function() {
            if ($(this).is(':unchecked')) {
                $(".allCheckbox").prop("checked", false);
            }
        });

        /*Mutiple checkbox checked or unchecked*/
        $(document).on('click', '.allCheckbox', function() {
            if ($(this).is(':checked')) {
                $('.checkbox').prop("checked", true);
            } else {
                $('.checkbox').prop("checked", false);
            }
        });

        $('body').on('click', '#action_submit', function(e) {
            var url = $(this).attr('data-url');
            var tableName = $(this).attr('data-table_name');
            var id = [],
                msg;
            $('.checkbox:checked').each(function() {
                id.push($(this).val());
            });
            var action = $("#action option:selected").val();
            if (action != "" && id.length > 0) {
                if (action == 'print') {
                    $.ajax({
                        url: url,
                        method: "POST",
                        global: true,
                        data: { ids: id, action: action },
                        success: function(response) {
                            var anchor = document.createElement('a');
                            anchor.href = response.path;
                            anchor.target = '_blank';
                            anchor.download = 'Machine-QR-Code.pdf';
                            anchor.click();
                        }
                    });
                    return;
                }
                if (action == 'active' || action == 'inactive' || action == 'Active' || action == 'Inactive') {
                    msg = 'You want to change status!';
                }

                swal({
                    title: 'Are you sure?',
                    text: msg,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: url,
                            method: "POST",
                            data: { ids: id, action: action },
                            success: function(response) {
                                swal(response['msg'], {
                                    icon: response['icon'],
                                    closeOnClickOutside: false,
                                });
                                $('#' + tableName).DataTable().ajax.reload(null, false);
                                $(".allCheckbox").prop("checked", false);
                            }
                        });
                    }
                });
            } else {
                var msgTxt;
                if (id.length <= 0) {
                    msgTxt = "Please select at least one checkbox";
                } else {
                    msgTxt = "Please select one option";
                }
                swal(msgTxt, {
                    icon: "info",
                });
            }
        });
    };
    window.adminTheme = new adminTheme();
})(jQuery);
// This function is used of doing trim on sentence.
function trim(el) {
    el.value = el.value.
    replace(/(^\s*)|(\s*$)/gi, ""). // removes leading and trailing spaces
    replace(/[ ]{2,}/gi, " "). // replaces multiple spaces with one space
    replace(/\n +/, "\n"); // Removes spaces after newlines
    return;
}

function responseAlert(response) {
    if (response != null) {
        var message = response.message;
        if (response.icon == 'info') {
            message = '';
            var count = 0;
            $.each(response.message, function(key, value) {
                if (count > 0) {
                    message += '<br/>';
                }
                message += value;
                count++;
            })
        }
        Swal.fire({
            html: message,
            icon: response.icon,
            buttonsStyling: !1,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        }).then((function(e) {
            if (response.url != '') {
                window.location.href = response.url;
            }
        }))
    }
}