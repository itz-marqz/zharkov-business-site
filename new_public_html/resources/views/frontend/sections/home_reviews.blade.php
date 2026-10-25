@if(isset($reviews) && count($reviews) > 0)
<section class="reviews-section py-5 bg-light">
  <div class="container">
    <h2 class="mb-4 text-center">Відгуки</h2>
    <div class="row">
      @foreach($reviews as $review)
        <div class="col-md-4 mb-3">
          <div class="card p-3 h-100 shadow-sm">
            <p class="card-text">"{{ $review->content }}"</p>
            <div class="mt-auto fw-bold">{{ $review->author_name }}</div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif
