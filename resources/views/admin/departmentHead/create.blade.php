@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.department.fields.department_head') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.department-head.store") }}" enctype="multipart/form-data">
            @csrf
             <div class="row company-department-div mt-3 align-items-end bg-light p-2">
                <input type="hidden" value="{{$company_id}}" name="company_id">
                   <div class="col-md-5">
                        <label for="">Department</label>
                        <select class="form-control select2 company_department {{ $errors->has('company_department_id') ? 'is-invalid' : '' }}"
                            name="company_department[]" id="company_department">
                            @foreach ($departmentTypes as $id => $entry)
                            <option value="{{ $id }}" {{ old('company_department_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="">Department head</label>
                        <select class="form-control select2 head_id {{ $errors->has('head_id') ? 'is-invalid' : '' }}"
                            name="head_id[]" id="head_id">
                            @foreach ($departmentHead as $id => $entry)
                            <option value="{{ $id }}" {{ old('head_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-2 clone-department-div">
                        <button class="btn btn-success clone-department-btn" type="button">Add+</button>
                    </div>

                </div>
            <div class="form-group mt-3">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
$('.clone-department-btn').click(function(){
    $('.company_department').select2('destroy');
    $('.head_id').select2('destroy');
    let clone = $('.company-department-div').eq(0).clone();
    let length = $('.company-department-div').length;
    clone.find('#company_department').attr('id','company_department_'+length);
    clone.find('#head_id').attr('id','head_id_'+length);
    clone.find('.clone-department-div').html('<button type="button" class="btn btn-danger remove-department-btn">Remove</button>');
    
    $('.company-department-div').last().after(clone);
    $('.company_department').select2();
    $('.head_id').select2();
})

$(document).on('click','.remove-department-btn',function(){
    $(this).closest('.row').remove();
})
</script>
@endsection