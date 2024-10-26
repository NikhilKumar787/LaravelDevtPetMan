@extends('layouts.customer')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.user.fields.assigned_team') }}
    </div>

    <div class="card-body">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input type="hidden" id="team_head_id" value="{{$user->id}}">
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="team_head_name" id="team_head_name" value="{{ old('name', $user->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>   
            <label for="team_members">Team Members List <span class="red">*</span></label>
                <div class="row form-group">
                    @foreach($team_members as $members)
                        <div style="margin-left: 20px;" class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                            <input class="form-check-input team_members" type="checkbox" name="team_members[]" value="1" user_id ="{{$members->id}}" {{in_array($members->id,$selected_team_members) ? 'checked' : ''}}>
                            <label class="form-check-label" for="team_members">{{$members->name}}</label>
                        </div>
                    @endforeach
                </div>
            <div class="form-group">
                <button class="btn btn-danger submit_btn" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
       
    });
    $(document).on('click', '.submit_btn', function(){
        var selected_user_id = [];
        var head_id = $('#team_head_id').val();
        $('.team_members').each(function(){
            if($(this).is(':checked')){
                selected_user_id.push($(this).attr('user_id'));
            }
        });
        if(selected_user_id.length > 0){ 
            $.ajax({
                url: "{{ route('customer.team-head.assigned-team-members') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    'team_head_id': head_id,
                    'assigned_teams_id': selected_user_id,
                },
                success: function(data) {
                    if(data.length != 0) {
                        console.log(data);
                        sweetAlert("Successfully Assigned!", "Team Members Assigned Successfully To Selected Team Head..", "success");
                    }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            });
        }else{
            alert("First Select any User then Click Save button!!");
        } 
    });

</script>
@endsection