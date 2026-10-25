<div class="form-group">
    <label class="switch switch-sm">
        <input type="checkbox" name="{{$edit_fld['field_name']}}" value="{{$edit_fld['value']}}" {{ (!empty($data[$edit_fld['field_name']]) && $data[$edit_fld['field_name']] == $edit_fld['value']) ? 'checked' : ''  }}>
        <span class="switch-indicator"></span>
        <span class="switch-description">{{$edit_fld['title']}}</span>
    </label>
</div>