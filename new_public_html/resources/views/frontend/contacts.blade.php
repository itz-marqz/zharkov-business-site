@extends('frontend.layout')

@section('title', 'Контакти — Сергій Жарков')
@section('meta_description', 'Зв’яжіться із Сергієм Жарковим, щоб обговорити тренінг, коучинг або управлінське консультування.')

@section('main')
<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Контакти</span>
        <h1>Обговорімо ваше завдання</h1>
        <p>Напишіть кілька слів про команду чи запит — Сергій допоможе підібрати відповідний формат роботи.</p>
    </div>
</section>

<section class="section pt-0">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success rounded-4" role="status">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger rounded-4" role="alert">Перевірте, будь ласка, заповнені поля.</div>
        @endif

        <div class="contact-layout">
            <aside class="contact-panel">
                <h2>Як зв’язатися</h2>
                <p>Залиште заявку або скористайтеся контактами нижче.</p>
                <div class="contact-methods">
                    @if (filled($settings->phone ?? null))
                        <a href="tel:{{ preg_replace('/[^\d+]/', '', $settings->phone) }}"><span>Телефон</span><strong>{{ $settings->phone }}</strong></a>
                    @endif
                    @if (filled($settings->email ?? null))
                        <a href="mailto:{{ $settings->email }}"><span>Електронна пошта</span><strong>{{ $settings->email }}</strong></a>
                    @endif
                    @foreach (['telegram' => 'Telegram', 'whatsapp' => 'WhatsApp', 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'linkedin' => 'LinkedIn', 'youtube' => 'YouTube'] as $key => $label)
                        @if (filled($settings->{$key} ?? null))
                            <a href="{{ $settings->{$key} }}" target="_blank" rel="noopener noreferrer"><span>{{ $label }}</span><strong>Відкрити профіль ↗</strong></a>
                        @endif
                    @endforeach
                    @if (filled($settings->youtube_secondary ?? null))
                        <a href="{{ $settings->youtube_secondary }}" target="_blank" rel="noopener noreferrer"><span>YouTube · майстерська досягнень</span><strong>Відкрити канал ↗</strong></a>
                    @endif
                </div>
            </aside>

            <div class="contact-form-card">
                <h2>Залишити заявку</h2>
                <p>Поля з позначкою * обов’язкові.</p>
                <form action="{{ route('feedback.store') }}" method="post" class="contact-form">
                    @csrf
                    <input type="hidden" name="return_to" value="{{ url()->current() }}">
                    <label>Ваше ім’я *<input type="text" name="name" value="{{ old('name') }}" autocomplete="name" required maxlength="255"></label>
                    <div class="contact-form__row">
                        <label>Телефон *<input type="tel" name="phone" value="{{ old('phone') }}" autocomplete="tel" required maxlength="50"></label>
                        <label>Email *<input type="email" name="email" value="{{ old('email') }}" autocomplete="email" required maxlength="255"></label>
                    </div>
                    <label>Що хотіли б обговорити? *<textarea name="message" rows="5" required>{{ old('message') }}</textarea></label>
                    @include('frontend.includes.turnstile')
                    <button class="btn btn-ink btn-lg" type="submit">Надіслати заявку <span aria-hidden="true">→</span></button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
