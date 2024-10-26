@extends('layouts.customer')
@section('content')
@can('customer_team_head_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <input type="hidden" id="team_member_limit" value="{{ isset($team->team_limit) ? $team->team_limit : '' }}">
            @if($user == $team->team_limit)
                <button class="btn btn-success" onclick="alertShow()">Add Team</button>
            @else
            <a class="btn btn-success" href="{{ route('customer.team-head.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.customer.fields.team_head') }}
            </a>
            @endif
            {{-- <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button> --}}
            @include('csvImport.modal', ['model' => 'User', 'route' => 'admin.users.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.customer.fields.team_head') }} {{ trans('global.list') }} (Total User: {{$team->team_limit}}/Remaining User: {{$team->team_limit - $user}})
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.user.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email_verified_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.approved') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.verified') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.roles') }}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.user.fields.identity_proof') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.address_proof') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.passport_size_photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.department') }}
                    </th> --}}
                    {{-- <th>
                        Login Time
                    </th>
                    <th>
                        Logout Time
                    </th> --}}
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

        var url = "{{ route('customer.team-head.index') }}";
        @if(request()->query('type'))
            var type = "{{request()->query('type')}}";
            var url = url+'?'+'type='+type;
        @endif
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('customer_team_head_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
    ajax: url,
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'email', name: 'email' },
{ data: 'email_verified_at', name: 'email_verified_at' },
{ data: 'approved', name: 'approved' },
{ data: 'verified', name: 'verified' },
{ data: 'roles', name: 'roles.title' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-User').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
<script>
    function alertShow(){
        var team_members_limit = $("#team_member_limit").val();
        sweetAlert('Alert!','Limit is Over Now, You can not Add the Team Heads/Members More Than '+team_members_limit,'error');
    }
</script>
@endsection