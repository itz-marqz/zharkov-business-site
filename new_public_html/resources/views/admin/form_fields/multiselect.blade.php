<div class="form-group">
    <label for="select-multi">{{$edit_fld['title']}} {{(!empty($edit_fld['required'])) ? '*': ''}}</label>
    <select name="{{$edit_fld['field_name']}}" class="multi-select-area form-control {{ (!empty($edit_fld['class'])) ? $edit_fld['class'] : '' }} {{($errors->has($edit_fld['field_name'])) ? 'is-invalid' : '' }}" id="{{(!empty($edit_fld['id'])) ? $edit_fld['id'] : $edit_fld['field_name']}}" multiple="multiple">
        @if(!empty($edit_fld['relation']) && !empty($relation[$edit_fld['relation']]) && count($relation[$edit_fld['relation']]) > 0)
            @foreach($relation[$edit_fld['relation']] as $rel)
                <option value="{{$rel->id}}" {{ (!empty($data['with_' . $edit_fld['relation']]) && in_array($rel->id, $data['with_' . $edit_fld['relation']])) ? 'selected' : '' }}>{{$rel->name}}</option>
            @endforeach
        @else
            <option value="">-</option>
        @endif
    </select>
</div>