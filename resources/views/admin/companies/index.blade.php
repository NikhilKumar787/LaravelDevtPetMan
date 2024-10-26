@extends('layouts.admin')
@section('content')
@can('company_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.companies.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Company">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.company.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.business_logo') }}
                    </th>
                   {{--<th>
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
                    </th>--}}
                    <th>
                        {{ trans('cruds.company.fields.business_entity') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.gstin') }}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.company.fields.address_line_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.address_line_2') }}
                    </th> --}}
                    <th>
                        {{ trans('cruds.company.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.state') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.actions') }}
                    </th>
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
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('company_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.companies.massDestroy') }}",
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
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.companies.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'company_logo', name: 'company_logo', sortable: false, searchable:false },
// { data: 'copy_of_pan_tan', name: 'copy_of_pan_tan', sortable: false, searchable: false },
// { data: 'gst_certificate', name: 'gst_certificate', sortable: false, searchable: false },
// { data: 'vat_certficate', name: 'vat_certficate', sortable: false, searchable: false },
// { data: 'username_for_pan_tan', name: 'username_for_pan_tan' },
// { data: 'password_for_pan_tan', name: 'password_for_pan_tan' },
// { data: 'username_for_gst_vat_icegate_dgft', name: 'username_for_gst_vat_icegate_dgft' },
// { data: 'password_for_gst_vat_icegate_dgft', name: 'password_for_gst_vat_icegate_dgft' },
// { data: 'username_for_e_way_e_invoicing', name: 'username_for_e_way_e_invoicing' },
// { data: 'password_for_e_way_e_invoicing', name: 'password_for_e_way_e_invoicing' },
// { data: 'username_for_traces', name: 'username_for_traces' },
// { data: 'password_for_traces', name: 'password_for_traces' },
// { data: 'username_for_pf_esi_and_other_labour_law', name: 'username_for_pf_esi_and_other_labour_law' },
// { data: 'password_for_pf_esi_and_other_labour_law', name: 'password_for_pf_esi_and_other_labour_law' },
// { data: 'username_for_reporting_portal', name: 'username_for_reporting_portal' },
// { data: 'password_for_reporting_portal', name: 'password_for_reporting_portal' },
// { data: 'msme_registration_certificate', name: 'msme_registration_certificate', sortable: false, searchable: false },
// { data: 'shop_establishment_certificate', name: 'shop_establishment_certificate', sortable: false, searchable: false },
// { data: 'address_proof', name: 'address_proof', sortable: false, searchable: false },
{ data: 'company_name', name: 'company_name' },
{ data: 'gstin', name: 'gstin' },
// { data: 'address_line_1', name: 'address_line_1' },
// { data: 'address_line_2', name: 'address_line_2' },
{ data: 'city_name', name: 'city.name' },
{ data: 'state_state', name: 'state.state' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Company').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
<script>
    $(document).ready( function(){
        @if ($message = Session::get('success'))  
        sweetAlert("Thanks", "Company successfully created!", "success");
        @endif 
    })
</script>
@endsection