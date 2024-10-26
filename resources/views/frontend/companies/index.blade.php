@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('company_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.companies.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.company.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Company', 'route' => 'admin.companies.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.company.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Company">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.copy_of_pan_tan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.gst_certificate') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.vat_certficate') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_pan_tan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_pan_tan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_gst_vat_icegate_dgft') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_gst_vat_icegate_dgft') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_e_way_e_invoicing') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_e_way_e_invoicing') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_traces') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_traces') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_pf_esi_and_other_labour_law') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_pf_esi_and_other_labour_law') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_reporting_portal') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_reporting_portal') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.msme_registration_certificate') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.shop_establishment_certificate') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.address_proof') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.company_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.gstin') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.address_line_1') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.address_line_2') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.city') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.state') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $key => $company)
                                    <tr data-entry-id="{{ $company->id }}">
                                        <td>
                                            {{ $company->id ?? '' }}
                                        </td>
                                        <td>
                                            @if($company->copy_of_pan_tan)
                                                <a href="{{ $company->copy_of_pan_tan->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $company->copy_of_pan_tan->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($company->gst_certificate)
                                                <a href="{{ $company->gst_certificate->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $company->gst_certificate->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($company->vat_certficate)
                                                <a href="{{ $company->vat_certficate->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $company->vat_certficate->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $company->username_for_pan_tan ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->password_for_pan_tan ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->username_for_gst_vat_icegate_dgft ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->password_for_gst_vat_icegate_dgft ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->username_for_e_way_e_invoicing ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->password_for_e_way_e_invoicing ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->username_for_traces ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->password_for_traces ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->username_for_pf_esi_and_other_labour_law ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->password_for_pf_esi_and_other_labour_law ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->username_for_reporting_portal ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->password_for_reporting_portal ?? '' }}
                                        </td>
                                        <td>
                                            @if($company->msme_registration_certificate)
                                                <a href="{{ $company->msme_registration_certificate->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $company->msme_registration_certificate->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($company->shop_establishment_certificate)
                                                <a href="{{ $company->shop_establishment_certificate->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $company->shop_establishment_certificate->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($company->address_proof)
                                                <a href="{{ $company->address_proof->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $company->address_proof->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $company->company_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->gstin ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->address_line_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->address_line_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->city->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->state->state ?? '' }}
                                        </td>
                                        <td>
                                            @can('company_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.companies.show', $company->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('company_edit')
                                                <a class="btn btn-link text-theme" href="{{ route('frontend.companies.edit', $company->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('company_delete')
                                                <form action="{{ route('frontend.companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('company_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.companies.massDestroy') }}",
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
  let table = $('.datatable-Company:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection