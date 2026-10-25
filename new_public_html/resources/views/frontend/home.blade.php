@extends('frontend.layout')

@section('title', 'Сергій Жарков — бізнес-тренер, коуч, консультант')

@use('Illuminate\Support\Carbon')
@use('Illuminate\Support\Str')

@section('main')
@php
    $media = static fn (?string $path): ?string => blank($path) ? null
        : (Str::startsWith($path, ['http://', 'https://', '//', '/']) ? $path : asset('storage/'.ltrim($path, '/')));
    $eventUrl = static fn ($event): string => url('events/'.$event->slug);
    $caseUrl  = static fn ($case): string => url('cases/'.$case->slug);
    $entryImage = static fn ($entry): ?string => $media(collect($entry->images ?? [])->first());

    $plain = static fn (?string $html, int $limit = 150): string => Str::limit(
        trim(preg_replace('/[\s\x{00A0}]+/u', ' ', html_entity_decode(strip_tags((string) $html), ENT_QUOTES | ENT_HTML5, 'UTF-8'))),
        $limit
    );

    $initials = static fn (?string $name): string => Str::of((string) $name)->trim()->explode(' ')->filter()->take(2)
        ->map(fn ($word) => Str::upper(Str::substr($word, 0, 1)))->implode('');

    $clients = [
        ['roshen', 'Рошен'],            ['obolon', 'Оболонь'],        ['myronivsky', 'Миронівський'],
        ['rud', 'Рудь'],                ['tre-vedmedi', 'Три ведмеді'], ['allo', 'Алло'],
        ['farmak', 'Фармак'],           ['otpbank', 'ОТП Банк'],      ['ukrtelecom', 'Укртелеком'],
        ['novi-produlty', 'Нові продукти'], ['ukrland', 'Укрленд'],   ['metinvest', 'Метінвест'],
        ['krymskaya', 'Krymskaya'],     ['cottonclub', 'Cotton Club'], ['raiz', 'Raiz'],
        ['sgroup', 'S Group'],          ['tas', 'TAS'],               ['ugps', 'UGPS'],
    ];
@endphp

<section class="hero" aria-label="Головна">
    <div class="hero__mesh" aria-hidden="true"></div>
    <div class="container">
        @if (count($sliders) > 0)
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="8000">
                <div class="carousel-inner">
                    @foreach ($sliders as $slide)
                        @php
                            $slideImage = $media($slide->image ?? null);
                            $tag = $loop->first ? 'h1' : 'h2';
                        @endphp
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <div class="row align-items-center g-5">
                                <div class="col-lg-6 order-2 order-lg-1">
                                    <span class="pill"><span class="pill__dot"></span>Бізнес-тренер · Коуч · Консультант</span>
                                    <{{ $tag }} class="hero__title">{{ $slide->title }}</{{ $tag }}>
                                    @if (filled($slide->subtitle ?? null))
                                        <p class="hero__text">{{ $slide->subtitle }}</p>
                                    @endif
                                    <div class="hero__actions">
                                        <a class="btn btn-ink btn-lg" href="{{ filled($slide->link ?? null) ? $slide->link : url('contacts') }}">{{ filled($slide->link ?? null) ? 'Дізнатися більше' : 'Обговорити співпрацю' }}</a>
                                        @if (count($events) > 0)
                                            <a class="btn btn-soft btn-lg" href="#events">Найближчі заходи</a>
                                        @else
                                            <a class="btn btn-soft btn-lg" href="{{ url('contacts') }}">Запитати про тренінг</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 order-1 order-lg-2">
                                    @if ($slideImage)
                                        <div class="hero__media">
                                            <img src="{{ $slideImage }}" alt="{{ $slide->title }}" @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif>
                                        </div>
                                    @else
                                        <div class="hero__media hero__media--brand" aria-hidden="true">
                                            <img src="{{ asset('frontend/img/logo-light.png') }}" alt="">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if (count($sliders) > 1)
                    <div class="hero__controls">
                        <div class="carousel-indicators hero__dots">
                            @foreach ($sliders as $slide)
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $loop->index }}" @class(['active' => $loop->first])></button>
                            @endforeach
                        </div>
                        <div class="hero__arrows">
                            <button type="button" class="hero__arrow" data-bs-target="#heroCarousel" data-bs-slide="prev"><svg class="icon"><use href="#i-chevron-left"/></svg></button>
                            <button type="button" class="hero__arrow" data-bs-target="#heroCarousel" data-bs-slide="next"><svg class="icon"><use href="#i-chevron-right"/></svg></button>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="pill"><span class="pill__dot"></span>Бізнес-тренер · Коуч · Консультант</span>
                    <h1 class="hero__title">Сергій Жарков</h1>
                    <p class="hero__text">Корпоративні та відкриті тренінги, коучинг і управлінське консультування для команд і керівників.</p>
                    <div class="hero__actions">
                        <a class="btn btn-ink btn-lg" href="{{ url('contacts') }}">Зв’язатися</a>
                        <a class="btn btn-soft btn-lg" href="#events">Найближчі заходи</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-stack">
                        <a class="service-chip" href="{{ url('corporate-trainings') }}"><span>Корпоративні бізнес-тренінги<small>Для команд і компаній</small></span><svg class="icon"><use href="#i-arrow"/></svg></a>
                        <a class="service-chip" href="{{ url('coaching') }}"><span>Коучинг<small>Індивідуальна робота</small></span><svg class="icon"><use href="#i-arrow"/></svg></a>
                        <a class="service-chip" href="{{ url('counseling') }}"><span>Управлінське консультування<small>Для керівників</small></span><svg class="icon"><use href="#i-arrow"/></svg></a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@include('frontend.sections.home_info')

@if (count($events) > 0)
    <section class="section" id="events">
        <div class="container">
            <div class="section-head reveal">
                <div><span class="eyebrow">Календар</span><h2>Найближчі заходи</h2></div>
                <a class="link-arrow" href="{{ url('events') }}">Усі заходи <svg class="icon"><use href="#i-arrow"/></svg></a>
            </div>
            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                @foreach ($events as $event)
                    @php $when = filled($event->published_at ?? null) ? Carbon::parse($event->published_at)->locale('uk') : null; $cover = $entryImage($event); @endphp
                    <div class="col reveal" style="--d: {{ $loop->index * 80 }}ms">
                        <a class="event-card" href="{{ $eventUrl($event) }}">
                            <div class="event-card__media">
                                @if ($cover) <img src="{{ $cover }}" alt="" loading="lazy"> @endif
                                @if ($when) <span class="date-chip" aria-hidden="true"><span class="date-chip__day">{{ $when->isoFormat('D') }}</span><span class="date-chip__mon">{{ $when->isoFormat('MMM') }}</span></span> @endif
                            </div>
                            <div class="event-card__body">
                                @if ($when) <time class="event-card__time" datetime="{{ $when->toDateString() }}">{{ $when->isoFormat('D MMMM YYYY') }}</time> @endif
                                <h3 class="event-card__title">{{ $event->title }}</h3>
                                @if (filled($event->preview_body ?? null)) <p class="event-card__text clamp-3">{{ $plain($event->preview_body, 160) }}</p> @endif
                                <span class="event-card__foot link-arrow">Детальніше <svg class="icon"><use href="#i-arrow"/></svg></span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if (count($cases) > 0)
    <section class="section section--soft" id="cases">
        <div class="container">
            <div class="section-head reveal">
                <div><span class="eyebrow">Кейси</span><h2>Результати, які можна показати</h2></div>
                <a class="link-arrow" href="{{ url('cases') }}">Усі кейси <svg class="icon"><use href="#i-arrow"/></svg></a>
            </div>
            <div class="case-grid">
                @foreach ($cases as $case)
                    @php $cover = $entryImage($case); @endphp
                    <a class="case-card reveal @unless ($cover) case-card--plain @endunless" style="--d: {{ ($loop->index % 2) * 90 }}ms" href="{{ $caseUrl($case) }}">
                        @if ($cover) <img class="case-card__img" src="{{ $cover }}" alt="" loading="lazy"> @endif
                        <span class="case-card__go" aria-hidden="true"><svg class="icon"><use href="#i-arrow"/></svg></span>
                        <div class="case-card__body">
                            <h3 class="case-card__title">{{ $case->title }}</h3>
                            @if (filled($case->preview_body ?? null)) <p class="case-card__text clamp-2">{{ $plain($case->preview_body, 170) }}</p> @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if (count($reviews) > 0)
    <section class="section" id="reviews">
        <div class="container">
            <div class="section-head reveal">
                <div><span class="eyebrow">Відгуки</span><h2>Що кажуть клієнти</h2></div>
                <a class="link-arrow" href="{{ url('reviews') }}">Усі відгуки <svg class="icon"><use href="#i-arrow"/></svg></a>
            </div>
            <div class="reviews" tabindex="0">
                @foreach ($reviews as $review)
                    @php $avatar = $media($review->avatar ?? null); @endphp
                    <figure class="review-card reveal" style="--d: {{ $loop->index * 90 }}ms">
                        <svg class="icon icon--fill icon--quote" aria-hidden="true"><use href="#i-quote"/></svg>
                        <blockquote class="review-card__text clamp-7">{{ $plain($review->content ?? '', 380) }}</blockquote>
                        <figcaption class="review-card__author">
                            <span class="avatar" aria-hidden="true">@if ($avatar)<img src="{{ $avatar }}" alt="">@else{{ $initials($review->author_name ?? '') }}@endif</span>
                            <span><strong>{{ $review->author_name }}</strong>@if (filled($review->author_title ?? null))<small>{{ $review->author_title }}</small>@endif</span>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
@endif

<section class="section section--white" id="clients">
    <div class="container">
        <div class="section-head reveal justify-content-center text-center">
            <div><span class="eyebrow">Клієнти</span><h2>Нам довіряють</h2></div>
        </div>
        <ul class="clients__grid reveal list-unstyled mb-0">
            @foreach ($clients as [$file, $name])
                <li class="client-logo"><img src="{{ asset('frontend/img/clients/'.$file.'.png') }}" alt="{{ $name }}" loading="lazy"></li>
            @endforeach
        </ul>
    </div>
</section>

@if (isset($other_blocks) && count($other_blocks) > 0)
    <section class="section section--soft" id="approach">
        <div class="container">
            <div class="bento">
                @foreach ($other_blocks as $block)
                    <article class="block-card reveal" style="--d: {{ ($loop->index % 2) * 90 }}ms">
                        <h3>{{ $block->title }}</h3>
                        <div class="rich">{!! $block->body !!}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

<section class="section">
    <div class="container">
        <div class="cta reveal">
            <h2>Обговоримо завдання вашої команди?</h2>
            <p>Розкажіть про ситуацію, і ми разом підберемо формат: тренінг, коучинг або консультування.</p>
            <div class="d-flex flex-wrap gap-3">
                <a class="btn btn-white btn-lg" href="{{ url('contacts') }}">Залишити заявку</a>
                <a class="btn btn-ghost-light btn-lg" href="{{ url('corporate-trainings') }}">Корпоративні тренінги</a>
            </div>
        </div>
    </div>
</section>
@endsection
