@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('invoice_detail_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.invoice-details.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.invoiceDetail.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'InvoiceDetail', 'route' => 'admin.invoice-details.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.invoiceDetail.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-InvoiceDetail">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoiceDetail.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoiceDetail.fields.invoice') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoiceDetail.fields.product') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoiceDetail.fields.qty') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoiceDetail.fields.rate') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoiceDetail.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoiceDetail.fields.tax') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoiceDetails as $key => $invoiceDetail)
                                    <tr data-entry-id="{{ $invoiceDetail->id }}">
                                        <td>
                                            {{ $invoiceDetail->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoiceDetail->invoice->type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoiceDetail->product->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoiceDetail->qty ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoiceDetail->rate ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoiceDetail->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\InvoiceDetail::TAX_SELECT[$invoiceDetail->tax] ?? '' }}
                                        </td>
                                        <td>
                                            @can('invoice_detail_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.invoice-details.show', $invoiceDetail->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('invoice_detail_edit')
                                                <a class="btn btn-link text-theme" href="{{ route('frontend.invoice-details.edit', $invoiceDetail->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('invoice_detail_delete')
                                                <form action="{{ route('frontend.invoice-details.destroy', $invoiceDetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('invoice_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.invoice-details.massDestroy') }}",
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
  let table = $('.datatable-InvoiceDetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection