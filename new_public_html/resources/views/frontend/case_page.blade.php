@extends('frontend.layout')

@php
    $isEvent = $entry->type === 'event';
    $coverPath = collect($entry->images ?? [])->first();
    $cover = blank($coverPath) ? null : (\Illuminate\Support\Str::startsWith($coverPath, ['http://', 'https://', '//', '/']) ? $coverPath : asset('storage/'.ltrim($coverPath, '/')));
    $date = $entry->published_at?->locale('uk');
    $backUrl = $isEvent ? route('events.index') : route('cases.index');
@endphp

@section('title', $entry->title.' — Сергій Жарков')
@section('main')
<article class="article-page">
    <div class="container article-page__container">
        <a href="{{ $backUrl }}" class="article-back">← {{ $isEvent ? 'До заходів' : 'До кейсів' }}</a>
        <header class="article-header">
            <span class="eyebrow">{{ $isEvent ? 'Захід' : 'Кейс' }}</span>
            <h1>{{ $entry->title }}</h1>
            @if ($date)<time datetime="{{ $date->toDateString() }}">{{ $date->isoFormat('D MMMM YYYY') }}</time>@endif
        </header>
        @if ($cover)<img class="article-cover" src="{{ $cover }}" alt="{{ $entry->title }}">@endif
        @if (filled($entry->preview_body))<p class="article-lead">{{ strip_tags($entry->preview_body) }}</p>@endif
        @if (filled($entry->body))<div class="article-content rich">{!! $entry->body !!}</div>@endif
        <div class="article-cta">
            <h2>{{ $isEvent ? 'Хочете долучитися?' : 'Потрібне рішення для вашої команди?' }}</h2>
            <p>Розкажіть про свій запит — обговоримо можливі формати співпраці.</p>
            <a class="btn btn-ink" href="{{ route('contacts') }}">Зв’язатися</a>
        </div>
    </div>
</article>
@endsection
