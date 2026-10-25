<section class="feedback" id="feedback">
  <div class="container">
    <div class="row align-content-center">
      <div class="col-12" data-aos="zoom-in-down" data-aos-duration="400">
        <h2>@lang('translate.feed_me.title')</h2>
      </div>
      <form action="/feedback" method="post" class="d-flex flex-wrap">
        {!! csrf_field() !!}
        <input type="hidden" name="return_to" value="{{Request::url()}}">
        <div class="col-sm-6">
          <input type="text" name="name" class="app-form" placeholder="@lang('translate.feed_me.place_name')" autocomplete="off" required data-aos="zoom-in-left" data-aos-duration="400">
          <input type="text" name="phone" class="app-form" placeholder="@lang('translate.feed_me.place_phone')" autocomplete="off" required data-aos="zoom-in-left" data-aos-duration="600">
          <input type="email" name="email" class="app-form" placeholder="@lang('translate.feed_me.place_email')" autocomplete="off" required data-aos="zoom-in-left" data-aos-duration="800">
        </div>
        <div class="col-sm-6">
          <textarea name="message" class="app-form" placeholder="@lang('translate.feed_me.place_message')" data-aos="zoom-in-right" data-aos-duration="1200"></textarea>
          @include('frontend.includes.turnstile')
          <button type="submit" class="app-form" data-aos="zoom-in-up" data-aos-duration="800">@lang('translate.feed_me.send')</button>
        </div>
      </form>
    </div>
  </div>
</section>
