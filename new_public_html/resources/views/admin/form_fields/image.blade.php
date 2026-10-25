<div class="file-group">
    <h6 class="mb-1">{{$edit_fld['title']}} {{(!empty($edit_fld['required'])) ? '*': ''}}</h6>
    <button class="btn btn-block btn-primary file-browser" type="button">Upload you files from computer</button>
    <input type="file" name="{{$edit_fld['field_name']}}{{!empty($edit_fld['multiple'])?"[]":""}}" accept=".jpg, .jpeg, .png" @if($edit_fld['multiple']) multiple @endif>
    <br>
    @if(!empty($edit_fld['multiple']) && !empty($data[$edit_fld['field_name']]) && Request::segment(2) != 'reviews' && Request::segment(2) != 'cases')
	    <div class="row">
		    @foreach(json_decode($data[$edit_fld['field_name']]) as $item)
				<div class="col-md-4">
					<img class="img-fluid" src="/{{$edit_fld['path']}}/{{$item}}" alt="...">	
				</div>
		    @endforeach
		</div>
    @else
	    @if(!empty($data[$edit_fld['field_name']]) && !empty($edit_fld['path']))
	        <img class="img-fluid" src="/{{$edit_fld['path']}}/{{$data[$edit_fld['field_name']]}}" alt="...">
	    @else
	        <img class="img-fluid" src="/admin/assets/img/gallery/1.jpg" alt="...">
	    @endif
    @endif	
</div>