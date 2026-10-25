@if(isset($other_blocks) && count($other_blocks) > 0)
<section class="services-section py-5">
  <div class="container">
    <div class="row">
      @foreach($other_blocks as $block)
        <div class="col-md-6 mb-4">
          <h3>{{ $block->title }}</h3>
          <div>{!! $block->content !!}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif
