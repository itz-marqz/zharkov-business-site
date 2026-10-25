@extends('frontend.layout')

@php
    $media = static fn ($path) => blank($path) ? null : (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '//', '/']) ? $path : asset('storage/'.ltrim($path, '/')));
    $initials = static fn (?string $name): string => \Illuminate\Support\Str::of((string) $name)->trim()->explode(' ')->filter()->take(2)->map(fn ($word) => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($word, 0, 1)))->implode('');
@endphp

@section('title', 'Відгуки клієнтів — Сергій Жарков')
@section('main')
<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Досвід співпраці</span>
        <h1>Відгуки клієнтів</h1>
        <p>Враження людей і команд, з якими Сергій працював.</p>
    </div>
</section>
<section class="section pt-0">
    <div class="container">
        @if ($reviews->count())
            <div class="reviews reviews--archive">
                @foreach ($reviews as $review)
                    @php $avatar = $media($review->avatar); @endphp
                    <figure class="review-card">
                        <svg class="icon icon--fill icon--quote" aria-hidden="true"><use href="#i-quote"/></svg>
                        <blockquote class="review-card__text">{{ $review->content }}</blockquote>
                        <figcaption class="review-card__author">
                            <span class="avatar" aria-hidden="true">@if ($avatar)<img src="{{ $avatar }}" alt="">@else{{ $initials($review->author_name) }}@endif</span>
                            <span><strong>{{ $review->author_name }}</strong>@if (filled($review->author_title))<small>{{ $review->author_title }}</small>@endif</span>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
            <div class="mt-5">{{ $reviews->links() }}</div>
        @else
            <div class="empty-state">
                <h2>Відгуки з’являться тут</h2>
                <p>Розділ наповнюється відгуками клієнтів.</p>
                <a class="btn btn-ink" href="{{ route('contacts') }}">Обговорити співпрацю</a>
            </div>
        @endif
    </div>
</section>
@endsection
