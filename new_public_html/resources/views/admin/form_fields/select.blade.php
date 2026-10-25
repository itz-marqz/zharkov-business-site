<div class="form-group">
    <label>{{$edit_fld['title']}} {{(!empty($edit_fld['required'])) ? '*': ''}}</label>
    <select name="{{$edit_fld['field_name']}}" class="form-control {{ (!empty($edit_fld['class'])) ? $edit_fld['class'] : '' }} {{($errors->has($edit_fld['field_name'])) ? 'is-invalid' : '' }}" id="{{(!empty($edit_fld['id'])) ? $edit_fld['id'] : $edit_fld['field_name']}}" multiple="multiple">
        @if(!empty($edit_fld['options']))
            @foreach($edit_fld['options'] as $item)
                <option value="{{$item['value']}}" {{(!empty($data[$edit_fld['field_name']]) && $item['value'] == $data[$edit_fld['field_name']])?"selected":''}}>{{$item['label']}}</option>
            @endforeach
        @endif
    </select>
</div>