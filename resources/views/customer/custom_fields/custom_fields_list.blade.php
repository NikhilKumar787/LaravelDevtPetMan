@foreach($custom_fields as $data)
    <div class="cfm-label-bg">
        <div class="d-flex justify-content-between">
            <h6 id="custom_name_field" value="">{{ isset($data->custom_field_name) ? $data->custom_field_name : '' }}</h6>
            <div class="d-flex">
                <span id="edit_custom_field" edit_id="{{ isset($data->id) ? $data->id : '' }}"><i class="bi bi-pencil-fill edit" id="edit"></i>Edit</span>
                <span id="remove_custom_field" remove_id="{{ isset($data->id) ? $data->id : '' }}"><i class="bi bi-trash remove" id="remove"></i>Delete</span>
            </div>
        </div>
        <p>{{ $data->is_printable == 1 ? "It is Printable on Invoice" : "It is not Printable on Invoice"}}</p>
        
    </div>
@endforeach