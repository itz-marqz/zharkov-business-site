@if(isset($cases) && count($cases) > 0)
<section class="cases-section py-5">
  <div class="container">
    <h2 class="mb-4">Наші кейси</h2>
    <div class="row">
      @foreach($cases as $case)
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">{{ $case->title }}</h5>
              <p class="card-text">{!! Str::limit($case->preview_body, 100) !!}</p>
              <a href="{{ route('entries.show', $case->slug) }}" class="btn btn-outline-primary btn-sm">Докладніше</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif
