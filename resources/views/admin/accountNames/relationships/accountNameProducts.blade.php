<div class="m-3">
    @can('product_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.products.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-accountNameProducts">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.product.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.hsn') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.unit') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.sales_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.tax_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.gst') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.cess') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.cess_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.purchase_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.price_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.item_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.wholesale_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.item_code') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.income_account_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.account_group') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.account_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.account_name') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product)
                            <tr data-entry-id="{{ $product->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $product->id ?? '' }}
                                </td>
                                <td>
                                    {{ $product->name ?? '' }}
                                </td>
                                <td>
                                    {{ $product->description ?? '' }}
                                </td>
                                <td>
                                    {{ $product->hsn ?? '' }}
                                </td>
                                <td>
                                    {{ $product->unit ?? '' }}
                                </td>
                                <td>
                                    {{ $product->sales_price ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Product::TAX_TYPE_RADIO[$product->tax_type] ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Product::GST_SELECT[$product->gst] ?? '' }}
                                </td>
                                <td>
                                    {{ $product->cess ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Product::CESS_TYPE_SELECT[$product->cess_type] ?? '' }}
                                </td>
                                <td>
                                    {{ $product->purchase_price ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Product::PRICE_TYPE_SELECT[$product->price_type] ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Product::ITEM_TYPE_RADIO[$product->item_type] ?? '' }}
                                </td>
                                <td>
                                    {{ $product->wholesale_price ?? '' }}
                                </td>
                                <td>
                                    {{ $product->item_code ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Product::INCOME_ACCOUNT_TYPE_SELECT[$product->income_account_type] ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Product::ACCOUNT_GROUP_SELECT[$product->account_group] ?? '' }}
                                </td>
                                <td>
                                    {{ $product->account_type->type ?? '' }}
                                </td>
                                <td>
                                    {{ $product->account_name->name ?? '' }}
                                </td>
                                <td>
                                    @can('product_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.products.show', $product->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('product_edit')
                                        <a class="btn btn-xs btn-warning" href="{{ route('admin.products.edit', $product->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('product_delete')
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products.massDestroy') }}",
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
  let table = $('.datatable-accountNameProducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection