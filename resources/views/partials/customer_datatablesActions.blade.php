{{-- customer team management --}}
@if($crudRoutePart == 'team')
   @can($viewGate)
       <a class="btn btn-link text-theme green" href="{{ route('customer.' . $crudRoutePart . '.show', $row->id) }}">
           {{ trans('global.view') }}
       </a>
   @endcan
   @can($editGate)
     <a class="btn btn-link text-theme blue" href="{{ route('customer.' . $crudRoutePart . '.edit', $row->id) }}">
       {{ trans('global.edit') }}
     </a>
   @endcan
   @can($deleteGate)
   <form action="{{ route('customer.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
       <input type="hidden" name="_method" value="DELETE">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <input type="submit" class="btn btn-link text-theme red" value="{{ trans('global.delete') }}">
   </form>
@endcan 
@endif
{{-- Customer Team Head --}}
@if($crudRoutePart == 'team-head')   
   @can($viewGate)
       <a class="btn btn-link text-theme green" href="{{ route('customer.' . $crudRoutePart . '.show', $row->id) }}">
           {{ trans('global.view') }}
       </a>
   @endcan
   @can($editGate)
     <a class="btn btn-link text-theme blue" href="{{ route('customer.' . $crudRoutePart . '.edit', $row->id) }}">
       {{ trans('global.edit') }}
     </a>
   @endcan
   @can($deleteGate)
   <form action="{{ route('customer.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
       <input type="hidden" name="_method" value="DELETE">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <input type="submit" class="btn btn-link text-theme red" value="{{ trans('global.delete') }}">
   </form>
    @endcan 
    <a class="btn btn-link text-theme blue" href="{{ route('customer.team-head.get-teams', ['team_head_id' => $row->id]) }}">
        Assigned Team
    </a>
@endif
<!-- Customer Panel Actions Buttons -->
@can($approveGate)
      @if($row->invoice_request == 1 || $row->invoice_request == 2)
      <button type="button" class="btn btn-xs btn-warning accept_invoice_request"  id="accept_invoice_request" data="{{$row->id}}">{{ $row->invoice_request == 1 ? 'Approve' : 'Approved'}}</button>
      @endif
@endcan

<!-- Here We are add the all actions button in customers index file -->
@if($crudRoutePart == 'subcustomers')
@can($viewGate)
    <a class="btn btn-link text-theme green" href="{{ route('customer.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
@endcan
{{-- @can($editGate)
    <a class="btn btn-link text-theme" href="{{ route('customer.' . $crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
@endcan --}}
{{-- @can($deleteGate)
    <form action="{{ route('customer.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-link text-theme" value="{{ trans('global.delete') }}">
    </form>
@endcan --}}
@endif
@if($crudRoutePart == 'invoices')
<input type="hidden" value="{{$read_id}}" class="{{$read_id == 0 ? 'hidden_invoice_unread' : 'hidden_invoice_read'}}">
@endif
<!-- Here We are add the all actions button in products index file -->
@if($crudRoutePart == 'products')
@can($viewGate)
    <a class="btn btn-link text-theme green" href="{{ route('customer.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
@endcan
{{--@can($editGate)
    <a class="btn btn-link text-theme" href="{{ route('customer.' . $crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
@endcan
@can($deleteGate)
    <form action="{{ route('customer.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-link text-theme" value="{{ trans('global.delete') }}">
    </form>
@endcan--}}
@endif

@if($crudRoutePart == 'invoices')
 @if($invoice_status == 4)
    @if($row->posted == 0)
    <a class="btn btn-link text-theme blue" id="do_posted" href="{{ route('customer.invoices.invoice-posted', ['invoice' => $row->id,'invoice_posted' => '1']) }}">
        Do Posted
    </a>
    @else
    <a class="btn btn-link text-theme red" href="{{ route('customer.invoices.invoice-posted', ['invoice' => $row->id,'invoice_posted' => '0']) }}">
        Cancel Posted
    </a>
    @endif
    @if($row->remaining_payable_amount == 0)
    <a class="btn btn-link text-theme blue" href="{{ route('customer.payments.create', ['invoice' => $row->id]) }}">
        Manage Payment
    </a>
    @endif
    @if($row->remaining_payable_amount == 0.00)
    <a class="btn btn-link text-theme dark" href="{{ route('customer.' . $crudRoutePart . '.pdf', ['invoice' => $row->id]) }}" target="_blank">
        Print
    </a>
    @else
    <a class="btn btn-link text-theme green" href="{{ route('customer.payments.create', ['invoice' => $row->id]) }}">
        Receive Payment
    </a>
    <a class="btn btn-link text-theme dark" href="{{ route('customer.' . $crudRoutePart . '.pdf', ['invoice' => $row->id]) }}" target="_blank">
        Print
    </a>
@endif
@endif    
@endif
@if($crudRoutePart == 'invoices' && $invoice_status == '')
    {{-- @if($request_type == 'paid')
        @can($viewGate)
            <a class="btn btn-link text-theme" href="{{ route('customer.' . $crudRoutePart . '.show', $row->id) }}">
                {{ trans('global.view') }}
            </a>
        @endcan
    @endif
    @if($request_type == 'unpaid')
    @can($viewGate)
        <a class="btn btn-link text-theme" href="{{ route('customer.' . $crudRoutePart . '.show', $row->id) }}">
            {{ trans('global.view') }}
        </a>
    @endcan
    @can($editGate)
        <a class="btn btn-xs btn-primary" href="{{ route('customer.' . $crudRoutePart . '.edit', $row->id) }}">
            {{ trans('global.edit') }}
        </a>
    @endcan
    @endif --}}
    <a class="btn btn-link text-theme dark" href="{{ route('customer.' . $crudRoutePart . '.pdf', ['invoice' => $row->id]) }}" target="_blank">
        Print
    </a>
@endif

