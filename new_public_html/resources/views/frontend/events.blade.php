@extends('frontend.layout')

@section('main')
<div class="event-cover page-height">
  <ul class="breadchrumbs transparent">
    <li><a href="/"><img src="/frontend/img/icons/home-black.png" alt="home"></a></li>
    <li>{{$page->name}}</li>
  </ul>
  <h1 style="text-align: center;">Заходи</h1>
  <div class="event-list container">
    @if(count($events) > 0)
    <div class="row">
      <?
        $i = 1;
        $duration = 400;
      ?>
      @foreach($events as $item)
      <div class="col-md-4 col-sm-6">
        <div class="line-card" data-aos="{{($i % 3 == 0 || $i % 4 == 0)?'zoom-in-right':'zoom-in-left'}}" data-aos-duration="{{$duration * $i}}">
        <div class="info-panel d-flex align-items-center">
          <div>
            @if(!empty($item['name']))<p class="caption">{{$item['name']}}</p>@endif
            @if(!empty($item['date']))<p class="timestamps">
              <span class="icon"><img src="/frontend/img/icons/calendar.png" alt=""></span>
              {!!$item['date'] !!}
            @endif
            <div class="helper-text">
            @if(!empty($item['preview_body'])){!! $item['preview_body'] !!}@endif
            </div>
            <a href="javascript:void(0)" class="more-btn" @if(strlen($item['body']) > 0) data-preview="true" data-preview-id="{{$item['id']}}" @endif>@lang('translate.read_more')</a>
          </div>
        </div>
        <button data-message="{{$item['name']}}"  data-toggle="modal" data-target="#sign_up">@lang('translate.sign_up')</button>
      </div>
      </div>
      <?
        $i+= 1;
      ?>
      @endforeach
    </div>
    @endif
  </div>
</div>
@endsection

@section('modals')
<!-- Modal -->
<div class="modal fade" id="sign_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">@lang('translate.your_contacts')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="/feedback" method="post" class="d-flex flex-wrap">
            {!! csrf_field() !!}
            <input type="hidden" name="return_to" value="{{Request::url()}}">
            <div class="col-12">
                <input type="hidden" name="message" value="">
                <input type="text" name="name" class="app-form" placeholder="@lang('translate.feed_me.place_name')" autocomplete="off" required>
                <input type="text" name="phone" class="app-form" placeholder="@lang('translate.feed_me.place_phone')" autocomplete="off" required>
                <input type="email" name="email" class="app-form" placeholder="@lang('translate.feed_me.place_email')" autocomplete="off" required>
            </div>
            @include('frontend.includes.turnstile')
            <button type="submit" class="app-form">@lang('translate.sign_up')</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
