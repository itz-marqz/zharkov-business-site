@extends('frontend.layout')

@section('title', 'Сторінку не знайдено — Сергій Жарков')
@section('main')
<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Помилка 404</span>
        <h1>Сторінку не знайдено</h1>
        <p>Можливо, адресу змінено або сторінка більше не доступна. Перейдіть до потрібного розділу.</p>
        <div class="hero__actions mt-4">
            <a class="btn btn-ink btn-lg" href="{{ route('home') }}">На головну</a>
            <a class="btn btn-soft btn-lg" href="{{ route('contacts') }}">Контакти</a>
        </div>
    </div>
</section>
<section class="section pt-0">
    <div class="container d-flex flex-wrap gap-3">
        <a class="link-arrow" href="{{ route('events.index') }}">Найближчі заходи</a>
        <a class="link-arrow" href="{{ route('cases.index') }}">Кейси</a>
        <a class="link-arrow" href="{{ route('reviews.index') }}">Відгуки</a>
        <a class="link-arrow" href="{{ route('video.index') }}">Відео</a>
    </div>
</section>
@endsection
