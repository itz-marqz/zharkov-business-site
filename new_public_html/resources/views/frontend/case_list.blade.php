@extends('frontend.layout')

@php
    $isEvents = $type === 'event';
    $heading = $isEvents ? 'Найближчі заходи' : 'Практичні кейси';
    $media = static fn ($path) => blank($path) ? null : (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '//', '/']) ? $path : asset('storage/'.ltrim($path, '/')));
@endphp

@section('title', $heading.' — Сергій Жарков')
@section('main')
<section class="page-hero">
    <div class="container">
        <span class="eyebrow">{{ $isEvents ? 'Календар' : 'Досвід' }}</span>
        <h1>{{ $heading }}</h1>
        <p>{{ $isEvents ? 'Відкриті події, зустрічі та навчальні програми.' : 'Приклади роботи з командами та організаціями.' }}</p>
    </div>
</section>

<section class="section pt-0">
    <div class="container">
        @if ($entries->count())
            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                @foreach ($entries as $entry)
                    @php
                        $cover = $media(collect($entry->images ?? [])->first());
                        $date = $entry->published_at?->locale('uk');
                        $url = $isEvents ? route('events.show', $entry->slug) : route('cases.show', $entry->slug);
                    @endphp
                    <div class="col">
                        <a class="event-card" href="{{ $url }}">
                            <div class="event-card__media">
                                @if ($cover)<img src="{{ $cover }}" alt="" loading="lazy">@endif
                                @if ($date)<span class="date-chip" aria-hidden="true"><span class="date-chip__day">{{ $date->isoFormat('D') }}</span><span class="date-chip__mon">{{ $date->isoFormat('MMM') }}</span></span>@endif
                            </div>
                            <div class="event-card__body">
                                @if ($date)<time class="event-card__time" datetime="{{ $date->toDateString() }}">{{ $date->isoFormat('D MMMM YYYY') }}</time>@endif
                                <h2 class="event-card__title">{{ $entry->title }}</h2>
                                @if (filled($entry->preview_body))<p class="event-card__text clamp-3">{{ \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/u', ' ', strip_tags($entry->preview_body))), 180) }}</p>@endif
                                <span class="event-card__foot link-arrow">Детальніше <svg class="icon"><use href="#i-arrow"/></svg></span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-5">{{ $entries->links() }}</div>
        @else
            <div class="empty-state">
                <span class="eyebrow">{{ $isEvents ? 'Календар' : 'Досвід' }}</span>
                <h2>{{ $isEvents ? 'Нові заходи готуються' : 'Кейси скоро з’являться' }}</h2>
                <p>{{ $isEvents ? 'Поки немає опублікованих дат. Залиште заявку, щоб дізнатися про майбутні події.' : 'Розділ наповнюється прикладами роботи з командами.' }}</p>
                <a class="btn btn-ink" href="{{ route('contacts') }}">{{ $isEvents ? 'Запитати про заходи' : 'Обговорити співпрацю' }}</a>
            </div>
        @endif
    </div>
</section>
@endsection
