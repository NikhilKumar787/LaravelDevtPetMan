<input type="hidden" value="{{ isset($custom_field_active) ? $custom_field_active : '' }}" id="count_active_customfield">
<input type="hidden" value="{{ isset($custom_field_inactive) ? $custom_field_inactive : '' }}" id="count_inactive_customfield">
@foreach($custom_fields as $data)
    <div class="cfm-label-bg">
        <div class="d-flex justify-content-between">
            <h6 id="custom_name_field" value="">{{ isset($data->custom_field_name) ? $data->custom_field_name : '' }}</h6>
            <div class="d-flex">
                <span id="edit_custom_field" edit_id="{{ isset($data->id) ? $data->id : '' }}"><i class="bi bi-pencil-fill edit" id="edit"></i>Edit</span>
                {{--<span id="remove_custom_field" remove_id="{{ isset($data->id) ? $data->id : '' }}"><i class="bi bi-trash remove" id="remove"></i>Delete</span>--}}
                <label class="switch2">    
                @if($data->active_status == 1)
                    <input type="checkbox" checked='' inactive_id="{{ isset($data->id) ? $data->id : '' }}" class="inactive_field">
                @else
                    <input type="checkbox" inactive_id="{{ isset($data->id) ? $data->id : '' }}" class="inactive_field">
                @endif    
                    <span class="slider_round"></span>
                </label><h6 class="print2">Active</h6>
            </div>
        </div>
        <p>{{ $data->is_printable == 1 ? "It is Printable on Invoice" : "It is not Printable on Invoice"}}</p>
        
    </div>
@endforeach
    
