@foreach($custom_fields_data as $data)
    <div class="col-md-3" id="remove_{{ isset($data->id) ? $data->id : '' }}">
        <div class="form-group">
            <label for="custom_field_id" id="custom_field_label">{{ isset($data->custom_field_name) ? $data->custom_field_name : '' }}</label>
            <br>
            <input type="text" class="form-control" id="custom_field_id" name="custom_field_id[{{ isset($data->id) ? $data->id : '' }}]">
        </div>
    </div>
@endforeach

<!-- Here We are showing Custom-fields -->
<div id="show_custom_fields" class="row">
    <input type="hidden" id="custom_id">

</div>