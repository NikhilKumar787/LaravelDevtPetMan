@if(auth()->user()->is_admin)
<!-- Here we show all actions buttons all modules for Admin. -->
    @if($crudRoutePart == 'invoices')
    @can($approveGate)
      @if($row->invoice_request == 1 || $row->invoice_request == 2)
      <button type="button" class="btn btn-xs btn-warning accept_invoice_request"  id="accept_invoice_request" data="{{$row->id}}">{{ $row->invoice_request == 1 ? 'Approve' : 'Approved'}}</button>
      @endif
    @endcan
    @endif
   
    <!-- Here we show all actions buttons only for invoices modules. -->
    @if($crudRoutePart == 'invoices')
        <a class="btn btn-xs btn-dark" href="{{ route('admin.' . $crudRoutePart . '.pdf', ['invoice' => $row->id]) }}" target="_blank">
            {{ trans('global.print') }}
        </a>
        @can($viewGate)
        <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
            {{ trans('global.view') }}
        </a>
        @endcan 
        @if($row->posted == 1)
        @else
            <a class="btn btn-xs btn-warning" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}?type={{request()->get('type')}}">
            {{ trans('global.edit') }}
            </a>
        @endif
        @can($deleteGate)
        <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
        </form>
        @endcan  
    @endif

{{-- This is for AssignedTask Module --}}
@if($crudRoutePart == 'assigned-tasks')
    @if(isset($assignedTaskGate) && $assignedTaskGate)
    @can($assignedTaskGate)
        @if ($row->assignedTaskDetails)
            @foreach ($row->assignedTaskDetails as $assignedTaskDetail)
                @if ($assignedTaskDetail->user_id==auth()->user()->id && !$assignedTaskDetail->end_time)   
                    @php
                        $ifstart = true;
                    @endphp       
                    <a class="btn btn-xs btn-info project-tracker" href="javascript:void(0)" row_id="{{$row->id}}" tracker_id="{{$assignedTaskDetail->id}}">
                        stop
                    </a>    
                @endif
            @endforeach
            @if (!isset($ifstart) && $row->status_id != 4 )
                @if($assigned_tasks == null)
                    <a class="btn btn-xs btn-info project-tracker" href="javascript:void(0)" row_id="{{$row->id}}">
                        start
                    </a>
                @elseif($assigned_tasks == 4)
                    <a class="btn btn-xs btn-info project-tracker" href="javascript:void(0)" row_id="{{$row->id}}">
                        start
                    </a>
                @else
                    <a class="btn btn-xs btn-info task-disabled" href="javascript:void(0)" row_id="{{$row->id}}">
                        start
                    </a> 
                @endif                 
            @endif
        @endif
    @endcan
    @endif
@endif

{{-- @if($crudRoutePart == 'assigned-sub-tasks')
     This is for AssignedSubTask Module
    @if(isset($assignedSubTaskGate) && $assignedSubTaskGate)
        @can($assignedSubTaskGate)
            @if ($row->assignedSubTaskDetails && $row->status_id !=4)
                @foreach ($row->assignedSubTaskDetails as $assignedSubTaskDetail)
                    @if ($assignedSubTaskDetail->user_id==auth()->user()->id && !$assignedSubTaskDetail->end_time)   
                        @php
                            $ifstart = true;
                        @endphp        
                        <a class="btn btn-xs btn-info project-tracker" href="javascript:void(0)" row_id="{{$row->id}}" tracker_id="{{$assignedSubTaskDetail->id}}">
                            stop
                        </a>    
                    @endif
                @endforeach
                @if (!isset($ifstart))
                    <a class="btn btn-xs btn-info project-tracker" href="javascript:void(0)" row_id="{{$row->id}}">
                        start
                    </a>   
                @endif
            @endif
        @endcan
    @endif
@endif --}}

    <!-- Here we show all actions buttons only assigned-tasks modules. -->
    @if($crudRoutePart == 'assigned-tasks')
         {{-- For Single Steps Assigned Sub-task --}}
    @if($row->sub_task_id == null)
    @can($viewGate)
    @if($customer_details->is_employee_approved == 0)
    <a class="btn btn-xs btn-warning customer_approval" customer_id="{{$row->customer_id}}">
        {{ trans('global.customer_review') }}
    </a>
    @else
    @if($row->customer_request_status == 2)
    @if($invoice_details->id != '' && $invoice_details->is_employee_approved == 0)
    <a class="btn btn-xs btn-warning invoice_approval" href="{{ route('admin.invoices.edit', $invoice_details->id) }}?type=assigned_task">
        {{ trans('global.invoice_review') }}
    </a>
    @endif
    @endif
    @endif
    @endcan
    @else
        {{-- Here we add the code of Multiple-steps of Sub-tasks --}}
    @endif
    @foreach($row->assignedTaskDetails as $assignedTaskDetail)
        @if($row->status_id == 4 && $assignedTaskDetail->status_id == 4)
            <a class="btn btn-xs btn-dark" href="{{ route('admin.invoices.pdf', ['invoice' => $invoice_details->id]) }}" target="_blank">
                {{ trans('global.print') }}
            </a>
        @endif
    @endforeach
    @endif
    
    @if($crudRoutePart == 'tasks')
    <a class="btn btn-xs btn-success" href="{{ route('admin.sub-tasks.create-subtasks',['task_id' => $row->id]) }}">
        {{ trans('global.manage_subtasks') }}
    </a>
    @endif

    <!-- Here we show the all Buttons of Sub-Tasks. -->
    @if($crudRoutePart  == 'sub-tasks')
    @can($viewGate)
        <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show-subtasks', ['subtask_id'=>$row->id]) }}">
            {{ trans('global.view') }}
        </a>
    @endcan
    @can($editGate)
        <a class="btn btn-xs btn-warning" href="{{ route('admin.' . $crudRoutePart . '.edit-subtasks', ['subtask_id'=>$row->id]) }}">
            {{ trans('global.edit') }}
        </a>
    @endcan
    @can($deleteGate)
        <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
        </form>
    @endcan
    @endif

    <!-- Here we show all actions buttons not assigned-tasks all others modules. -->
    @if($crudRoutePart != 'assigned-tasks' && $crudRoutePart  != 'sub-tasks' && $crudRoutePart != 'invoices')
    @can($viewGate)
    <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
    @endcan
    @can($editGate)
    <a class="btn btn-xs btn-warning" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
    @endcan

    {{-- Here company deactivate and reactivate actions buttons  --}}
    @if($crudRoutePart == 'companies')
    @if($company->deleted_at == "")
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.deactivate') }}">
    </form>
    @else
    <form action="{{ route('admin.' . $crudRoutePart . '.restore', ['comp_id'=>$row->id]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="GET">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-light" value="{{ trans('global.reactivate') }}">
    </form>
    @endif
    @endif
    
    @can($deleteGate)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
    </form>
    @endcan
    @endif
    @if($crudRoutePart == 'companies')
    <a class="btn btn-xs btn-info" href="{{ route('admin.department-head.index',['company'=>$row->id]) }}">
        {{ trans('global.manage_department') }}
    </a>
    @endif
    @if($crudRoutePart == 'department-head')
    @if($department_heads->head_of_department_id == 0)
    @else
    <a class="btn btn-xs btn-info" href="{{ route('admin.manage-task.index',['department' => $row->id]) }}">
        {{ trans('global.manage_task') }}
    </a>
    @endif
    @endif

@else
<!-- Here we show all actions buttons only for invoices modules. -->
    @if($crudRoutePart == 'invoices')
        <a class="btn btn-xs btn-dark" href="{{ route('frontend.' . $crudRoutePart . '.pdf', ['invoice' => $row->id]) }}" target="_blank">
            {{ trans('global.print') }}
        </a>
    @endif
    <!-- Here we show all actions buttons all modules for Frontent. -->
    @can($viewGate)
        <a class="btn btn-xs btn-primary" href="{{ route('frontend.' . $crudRoutePart . '.show', $row->id) }}">
            {{ trans('global.view') }}
        </a>
    @endcan
    @can($editGate)
        <a class="btn btn-xs btn-info" href="{{ route('frontend.' . $crudRoutePart . '.edit', $row->id) }}">
            {{ trans('global.edit') }}
        </a>
    @endcan
    @can($deleteGate)
        <form action="{{ route('frontend.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
        </form>
    @endcan
@endif