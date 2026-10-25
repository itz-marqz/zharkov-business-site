@extends('frontend.layout')

@section('title', ($page->name ?: $page->caption).' — Сергій Жарков')
@section('meta_description', \Illuminate\Support\Str::limit(trim(strip_tags($page->body ?? '')), 155))

@section('main')
<article class="article-page">
    <div class="container article-page__container">
        <a href="{{ route('home') }}" class="article-back">← На головну</a>
        <header class="article-header">
            <span class="eyebrow">{{ $page->caption ?: 'Сергій Жарков' }}</span>
            <h1>{{ $page->name }}</h1>
        </header>
        @if (filled($page->body))
            <div class="article-content rich">{!! $page->body !!}</div>
        @else
            <div class="empty-state">
                <h2>Сторінка готується</h2>
                <p>Зв’яжіться із Сергієм, щоб дізнатися більше про цей напрям.</p>
                <a class="btn btn-ink" href="{{ route('contacts') }}">Зв’язатися</a>
            </div>
        @endif
        <div class="article-cta">
            <h2>Потрібно обговорити ваш запит?</h2>
            <p>Підберемо формат роботи для вашої команди чи організації.</p>
            <a class="btn btn-ink" href="{{ route('contacts') }}">Зв’язатися</a>
        </div>
    </div>
</article>
@endsection
