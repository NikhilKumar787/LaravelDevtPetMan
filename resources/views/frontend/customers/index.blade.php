@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('customer_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.customers.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.customer.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Customer', 'route' => 'admin.customers.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.customer.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Customer">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.customer.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.first_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.middle_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.last_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.gstin') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.gst_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.gst_customer_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.mobile') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.city') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.state') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.country') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.pin_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.company') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.other') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.website') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.term') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.pan_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.tan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.payment_method') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.delivery_method') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.attachment') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.optional_data_1') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.optional_data_2') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.is_my_vendor') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $key => $customer)
                                    <tr data-entry-id="{{ $customer->id }}">
                                        <td>
                                            {{ $customer->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Customer::TITLE_SELECT[$customer->title] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->middle_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->last_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->gstin ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Customer::GST_TYPE_SELECT[$customer->gst_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->gst_customer_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->mobile ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->city->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->state->state ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->country->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->pin_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->company ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->other ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->website ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->term->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->pan_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->tan ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Customer::PAYMENT_METHOD_SELECT[$customer->payment_method] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Customer::DELIVERY_METHOD_SELECT[$customer->delivery_method] ?? '' }}
                                        </td>
                                        <td>
                                            @if($customer->attachment)
                                                <a href="{{ $customer->attachment->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $customer->optional_data_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->optional_data_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $customer->email ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $customer->is_my_vendor ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $customer->is_my_vendor ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('customer_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.customers.show', $customer->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('customer_edit')
                                                <a class="btn btn-link text-theme" href="{{ route('frontend.customers.edit', $customer->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('customer_delete')
                                                <form action="{{ route('frontend.customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('customer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.customers.massDestroy') }}",
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
  let table = $('.datatable-Customer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection