<div class="m-3">
    @can('user_address_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.user-addresses.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.userAddress.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.userAddress.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userUserAddresses">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.phone_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.addressline_1') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.addressline_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.city') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.zip_code') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.state') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.customer') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.uuid') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.type') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.same_as') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAddress.fields.default_address') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userAddresses as $key => $userAddress)
                            <tr data-entry-id="{{ $userAddress->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $userAddress->id ?? '' }}
                                </td>
                                <td>
                                    {{ $userAddress->name ?? '' }}
                                </td>
                                <td>
                                    {{ $userAddress->phone_no ?? '' }}
                                </td>
                                <td>
                                    {{ $userAddress->addressline_1 ?? '' }}
                                </td>
                                <td>
                                    {{ $userAddress->addressline_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $userAddress->city ?? '' }}
                                </td>
                                <td>
                                    {{ $userAddress->zip_code ?? '' }}
                                </td>
                                <td>
                                    {{ $userAddress->state ?? '' }}
                                </td>
                                <td>
                                    {{ $userAddress->customer->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $userAddress->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $userAddress->uuid ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\UserAddress::TYPE_SELECT[$userAddress->type] ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $userAddress->same_as ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $userAddress->same_as ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $userAddress->default_address ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $userAddress->default_address ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('user_address_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.user-addresses.show', $userAddress->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('user_address_edit')
                                        <a class="btn btn-link text-theme" href="{{ route('admin.user-addresses.edit', $userAddress->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('user_address_delete')
                                        <form action="{{ route('admin.user-addresses.destroy', $userAddress->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_address_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-addresses.massDestroy') }}",
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
  let table = $('.datatable-userUserAddresses:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection