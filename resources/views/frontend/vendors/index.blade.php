@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('vendor_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.vendors.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.vendor.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Vendor', 'route' => 'admin.vendors.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.vendor.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Vendor">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.first_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.middle_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.last_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.company_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.gst_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.gstin') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.city') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.state') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.pin_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.mobile') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.pancard') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.other') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.website') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.payment_method') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.term') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.account_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.tax_reg_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.effective_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.apply_tds') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.entity') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.section') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.calculation_threshold') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vendor.fields.is_my_customer') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendors as $key => $vendor)
                                    <tr data-entry-id="{{ $vendor->id }}">
                                        <td>
                                            {{ $vendor->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Vendor::TITLE_SELECT[$vendor->title] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->middle_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->last_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->company_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Vendor::GST_TYPE_SELECT[$vendor->gst_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->gstin ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->city->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->state->state ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->pin_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->mobile ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->pancard ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->other ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->website ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->payment_method ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->term->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->account_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->tax_reg_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vendor->effective_date ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $vendor->apply_tds ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $vendor->apply_tds ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ App\Models\Vendor::ENTITY_SELECT[$vendor->entity] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Vendor::SECTION_SELECT[$vendor->section] ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $vendor->calculation_threshold ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $vendor->calculation_threshold ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $vendor->is_my_customer ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $vendor->is_my_customer ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('vendor_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.vendors.show', $vendor->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('vendor_edit')
                                                <a class="btn btn-link text-theme" href="{{ route('frontend.vendors.edit', $vendor->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('vendor_delete')
                                                <form action="{{ route('frontend.vendors.destroy', $vendor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('vendor_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.vendors.massDestroy') }}",
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
  let table = $('.datatable-Vendor:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection