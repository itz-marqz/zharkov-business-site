<div class="form-group">
    <label for="{{$edit_fld['field_name']}}">{{$edit_fld['title']}} {{(!empty($edit_fld['required'])) ? '*': ''}}</label>
    <input type="text" name="{{$edit_fld['field_name']}}" class="form-control {{ (!empty($edit_fld['class'])) ? $edit_fld['class'] : '' }} {{($errors->has($edit_fld['field_name'])) ? 'is-invalid' : '' }}" id="{{(!empty($edit_fld['id'])) ? $edit_fld['id'] : $edit_fld['field_name']}}"
        @if(!empty(old($edit_fld['field_name'])))
            value="{{trim($data[$edit_fld['field_name']])}}"
        @else
           @if(!empty($data[$edit_fld['field_name']]))
               value="{{trim($data[$edit_fld['field_name']])}}"
           @endif
        @endif
        @if(!empty($edit_fld['maxlength']))
            maxlength="{{$edit_fld['maxlength']}}"
        @endif
        @if(!empty($edit_fld['required']))
            required="required"
        @endif
    >
    @if($errors->has($edit_fld['field_name']))
        <div class="invalid-feedback">{{$errors->first($edit_fld['field_name'])}}</div>
    @endif
</div>