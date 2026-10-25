<div class="form-group">
    <h6 class="mb-1">{{$edit_fld['title']}} {{(!empty($edit_fld['required'])) ? '*': ''}}</h6>
    <textarea  name="{{$edit_fld['field_name']}}" id="{{(!empty($edit_fld['id'])) ? $edit_fld['id'] : $edit_fld['field_name']}}" data-provide="summernote" data-toolbar="full" rows="6">@if(!empty(old($edit_fld['field_name'])))
            {!! trim($data[$edit_fld['field_name']]) !!}
        @else
            @if(!empty($data[$edit_fld['field_name']]))
                {!! trim($data[$edit_fld['field_name']]) !!}
            @endif
        @endif</textarea>
</div>