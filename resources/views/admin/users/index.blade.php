@extends('layouts.admin')
@section('content')
{{--    @can('user_create')--}}
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.users.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
                </a>
            </div>
        </div>
{{--    @endcan--}}
    <div class="table-buttons"></div>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover
            ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th width="10"></th>
                    {{-- <th>{{ trans('cruds.user.fields.id') }}</th> --}}
                    <th>{{ trans('cruds.user.fields.name') }}</th>
                    <th>{{ trans('cruds.user.fields.email') }}</th>
                    <th>{{ trans('cruds.user.fields.phone') }}</th>
                    {{-- <th>{{ trans('cruds.user.fields.adress') }}</th> --}}
                    {{-- <th>{{ trans('cruds.user.fields.status') }}</th> --}}
                    <th>{{ trans('global.actions') }}</th>
                </tr>
                <tr>
                    <td></td>
                    {{-- <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td> --}}
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    {{-- <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td> --}}
                    {{-- <td>
                        <select id="statusFilter" class="search">
                            <option value>{{ trans('global.all') }}</option>
                            <option value="active">{{ trans('cruds.user.fields.active') }}</option>
                            <option value="inactive">{{ trans('cruds.user.fields.inactive') }}</option>
                        </select>
                    </td> --}}
                    <td></td>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

            @can('user_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.users.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            };
            dtButtons.push(deleteButton);
            @endcan

            let dtOverrideGlobals = {
                dom: 'lBfrtip',
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                ajax: {
                    url: "{{ route('admin.users.index') }}",
                    data: function (d) {
                        d.active = $('#statusFilter').val();
                    }
                },
                initComplete: function () {
                    $('#statusFilter').on('change', function () {
                        table.ajax.reload();
                    });
                    {{-- $('.datatable-User').on('click', '.block-user', function () {
                        var userId = $(this).data('id');
                        updateUserStatus(userId, 0); // Call the function to update the user status to 0 (blocked)
                    }); --}}

                    {{-- $('.datatable-User').on('click', '.approve-user', function () {
                        var userId = $(this).data('id');
                        updateUserStatus(userId, 1); // Call the function to update the user status to 1 (approved)
                    }); --}}

                    {{-- function updateUserStatus(userId, status) {
                        // Make an AJAX call to update the user status
                        $.ajax({
                            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            method: 'POST',
                            url: '{{ route("admin.users.updateStatus",
                                ["user" => ":user"]) }}'.replace(':user', userId),
                            data: {status: status},
                            success: function (response) {
                                // Handle the success response
                                console.log('User status updated successfully:', response);
                                // You can perform additional actions here, such as updating the UI or displaying a success message
                            },
                            error: function (xhr, status, error) {
                                // Handle the error response
                                console.error('Failed to update user status:', error);
                                // You can display an error message or perform other error handling tasks
                            }
                        });
                    } --}}
                },
                columns: [
                    { data: 'placeholder', name: 'placeholder', orderable: false, searchable: false },
                    {{-- { data: 'id', name: 'id' }, --}}
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    {{-- { data: 'adress', name: 'adress' }, --}}
                    {{-- {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            if (data === 'active') {
                                return '<button class="btn btn-danger block-user" data-id="' + row.id + '">Block</button>';
                            } else if (data === 'inactive') {
                                return '<button class="btn btn-success approve-user" data-id="' + row.id + '">Approve</button>';
                            } else {
                                return '';
                            }
                        }
                    }, --}}
                    { data: 'actions', name: '{{ trans('global.actions') }}', orderable: false, searchable: false }
                ],
                order: [[1, 'desc']],
                pageLength: 100,
                //Call Columns Visibility fix here
            };

            let table = $('.datatable-User').DataTable(dtOverrideGlobals);

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            let visibleColumnsIndexes = null;

            $('.datatable thead').on('input change', '.search', function () {
                let strict = $(this).attr('strict') || false;
                let value = strict && this.value ? '^' + this.value + '$' : this.value;

                let index = $(this).parent().index();
                if (visibleColumnsIndexes !== null) {
                    index = visibleColumnsIndexes[index];
                }

                table.column(index).search(value, strict).draw();
            });

            table.on('column-visibility.dt', function (e, settings, column, state) {
                visibleColumnsIndexes = [];
                table.columns(':visible').every(function (colIdx) {
                    visibleColumnsIndexes.push(colIdx);
                });
            });

            // Add the column visibility option
            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    'colvis'
                ],
            });

            table.buttons().container().appendTo('.card-header .table-buttons');
        });
    </script>
@endsection
