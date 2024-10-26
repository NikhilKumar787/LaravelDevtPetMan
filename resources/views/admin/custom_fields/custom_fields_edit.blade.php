<!-- Here we are listing Custom Fields -->
@foreach($custom_fields_with_values as $data)
@if($data->active_status == 1)
<div class="col-md-3" id="remove_{{$data->id}}">
    <div class="form-group">
        <label for="custom_field_id"
            id="custom_field_label">{{ isset($data->custom_field_name) ? $data->custom_field_name : '' }}</label>
        <br>
        @if($data->custom_field_values == '')
        <input type="text" class="form-control" id="custom_field_id"
            name="custom_field_id[{{ isset($data->id) ? $data->id : ''}}]">
        @else
        <input type="text" class="form-control" id="custom_field_id"
            value="{{ isset($data->custom_field_values->custom_field_value) ? $data->custom_field_values->custom_field_value : '' }}"
            name="custom_field_id[{{ isset($data->id) ? $data->id : '' }}]">
        @endif
    </div>
</div>
@endif
@endforeach
<!-- Here We are showing Custom-fields -->
<div id="show_of_edit_custom_fields" class="row">
    <input type="hidden" id="custom_id">

</div>