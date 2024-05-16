<div class="m-3">
{{-- @dd($user) --}}

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.bills.user.create',$user ) }}">
            {{ trans('global.add') }} {{ trans('cruds.bill.title_singular') }}
        </a>
    </div>
</div>


    <div class="card">
        <div class="card-header">
            {{ trans('cruds.bill.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-sellerBills">
                    <thead>
                        <tr>
                            <th width="10"></th>
                            <th>{{ trans('cruds.bill.fields.id') }}</th>
                            <th>{{ trans('cruds.bill.fields.bill_number') }}</th>
                            <th>{{ trans('cruds.bill.fields.due_date') }}</th>
                            <th>{{ trans('cruds.bill.fields.value') }}</th>
                            <th>{{ trans('cruds.bill.fields.status') }}</th>
                            <th>{{ trans('global.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $key => $bill)
                            <tr data-entry-id="{{ $bill->id }}">
                                <td></td>
                                <td>{{ $bill->id ?? '' }}</td>
                                <td>{{ $bill->bill_number ?? '' }}</td>
                                <td>{{ $bill->due_date ?? '' }}</td>
                                <td>{{ $bill->value ?? '' }}</td>
                                <td>{{ $bill->status ?? '' }}</td>
                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bills.show', $bill->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.bills.edit', $bill->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ route('admin.bills.destroy', $bill->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(function () {
            // Initialize the DataTable for userBills
            let table = $('.datatable-sellerBills:not(.ajaxTable)').DataTable();
        });
    </script>
@endsection
