@extends('frontend.layout')

@php
    $youtubeEmbed = static function (?string $url): ?string {
        $host = strtolower(parse_url((string) $url, PHP_URL_HOST) ?: '');
        $path = trim((string) parse_url((string) $url, PHP_URL_PATH), '/');
        $id = null;
        if (in_array($host, ['youtu.be', 'www.youtu.be'], true)) {
            $id = explode('/', $path)[0] ?? null;
        } elseif (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com', 'youtube-nocookie.com', 'www.youtube-nocookie.com'], true)) {
            parse_str((string) parse_url((string) $url, PHP_URL_QUERY), $query);
            $id = $query['v'] ?? (str_starts_with($path, 'embed/') ? substr($path, 6) : null);
        }
        return $id && preg_match('/^[A-Za-z0-9_-]{11}$/', $id) ? 'https://www.youtube-nocookie.com/embed/'.$id : null;
    };
@endphp

@section('title', 'Відео — Сергій Жарков')
@section('main')
<section class="page-hero">
    <div class="container"><span class="eyebrow">Медіа</span><h1>Відео</h1><p>Виступи, розмови та практичні матеріали.</p></div>
</section>
<section class="section pt-0">
    <div class="container">
        @if ($videos->count())
            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                @foreach ($videos as $video)
                    @php $embed = $youtubeEmbed($video->youtube_url); @endphp
                    <article class="col">
                        <div class="video-card">
                            @if ($embed)
                                <div class="video-card__frame"><iframe src="{{ $embed }}" title="{{ $video->title }}" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>
                            @else
                                <a class="video-card__fallback" href="{{ $video->youtube_url }}" target="_blank" rel="noopener noreferrer">Відкрити відео на YouTube ↗</a>
                            @endif
                            <div class="video-card__body"><h2>{{ $video->title }}</h2>@if (filled($video->description))<p>{{ $video->description }}</p>@endif</div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-5">{{ $videos->links() }}</div>
        @else
            <div class="empty-state"><h2>Відео скоро з’являться</h2><p>Розділ наповнюється матеріалами.</p></div>
        @endif
    </div>
</section>
@endsection
