@if(count($cases) > 0)
    <?            
        $i = 1;
        $duration = 400;
    ?>
	@foreach($cases as $item)
	<div class="col-sm-6">
	    <div class="case-item" style="background:url('/uploads/case/preview_image/{{$item->preview_image}}') no-repeat center center / cover;" data-aos="{{($i % 3 == 0 || $i % 4 == 0)?'zoom-in-right':'zoom-in-left'}}" data-aos-duration="{{$duration * $i}}">
	        <div class="caption">{{$item->preview_title}}</div>
	        <div class="body">
	            {!!$item->preview_body!!}
	        </div>
	        <a href="/cases/{{$item->url}}" class="read-more">@lang('translate.read_more')</a>
	    </div>            
	</div>
    <?
        $i+= 1;
    ?>    
	@endforeach
	@if($show_more)
		<a href="javascript:void(0)" class="more" data-page="{{$cases->perPage()}}">@lang('translate.more')</a>
	@endif
@endif