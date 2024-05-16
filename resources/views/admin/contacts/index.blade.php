@extends('layouts.admin')
@section('content')
    <div class="table-buttons"></div>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.contact.title_plural') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Contact">
                <thead>
                <tr>
                    <th width="10"></th>
                    <th>#</th>
                    <th>{{ trans('global.name') }}</th>
                    <th>{{ trans('global.email') }}</th>
                    <th>{{ trans('global.subject') }}</th>
                    <th>{{ trans('global.created_at') }}</th>
                    <th>{{ trans('global.actions') }}</th>
                </tr>
                <tr>
                    <td></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td></td>
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

            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.contact.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}');

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

            let dtOverrideGlobals = {
                dom: 'lBfrtip',
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                ajax: {
                    url: "{{ route('admin.contact.index') }}",
                },
                columns: [
                    { data: 'placeholder', name: 'placeholder', orderable: false, searchable: false },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'subject', name: 'subject' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', name: '{{ trans('global.actions') }}', orderable: false, searchable: false }
                ],
                order: [[1, 'desc']],
                pageLength: 100,
            };

            let table = $('.datatable-Contact').DataTable(dtOverrideGlobals);

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $('.datatable thead').on('input change', '.search', function () {
                let strict = $(this).attr('strict') || false;
                let value = strict && this.value ? '^' + this.value + '$' : this.value;

                let index = $(this).parent().index();

                table.column(index).search(value, strict).draw();
            });

            table.on('column-visibility.dt', function (e, settings, column, state) {
                visibleColumnsIndexes = [];
                table.columns(':visible').every(function (colIdx) {
                    visibleColumnsIndexes.push(colIdx);
                });
            });

            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    'colvis'
                ],
            });

            table.buttons().container().appendTo('.card-header .table-buttons');
        });
    </script>
@endsection
