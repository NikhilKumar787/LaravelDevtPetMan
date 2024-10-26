@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('account_type_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.account-types.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.accountType.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.accountType.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AccountType">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.accountType.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accountType.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accountType.fields.account_group') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accountType.fields.name') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accountTypes as $key => $accountType)
                                    <tr data-entry-id="{{ $accountType->id }}">
                                        <td>
                                            {{ $accountType->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AccountType::TYPE_SELECT[$accountType->type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AccountType::ACCOUNT_GROUP_SELECT[$accountType->account_group] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accountType->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('account_type_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.account-types.show', $accountType->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('account_type_edit')
                                                <a class="btn btn-link text-theme" href="{{ route('frontend.account-types.edit', $accountType->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('account_type_delete')
                                                <form action="{{ route('frontend.account-types.destroy', $accountType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('account_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.account-types.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-AccountType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection