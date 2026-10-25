{{--
    resources/views/frontend/includes/turnstile.blade.php

    Вставляется ВНУТРИ <form action="/feedback" ...>, перед кнопкой отправки:

        @include('frontend.includes.turnstile')

    Нужно в трёх шаблонах (везде, где есть action="/feedback"):
        resources/views/frontend/sections/home_feedme.blade.php
        resources/views/frontend/contacts.blade.php
        resources/views/frontend/events.blade.php   (форма в модальном окне "Записатися")

    На странице должна быть ОДНА такая форма: скрипт api.js подключается отсюда.
--}}

{{-- Honeypot: за экраном, а не display:none (часть ботов display:none пропускает).
     Человек поле не видит и не заполняет, бот заполняет. Сервер молча
     выбрасывает такие заявки. --}}
<div style="position:absolute; left:-10000px; top:auto; width:1px; height:1px; overflow:hidden;" aria-hidden="true">
    <label>Залиште це поле порожнім
        <input type="text" name="website" value="" tabindex="-1" autocomplete="off">
    </label>
</div>

@if (filled(config('services.turnstile.site_key')) && filled(config('services.turnstile.secret_key')))
    <div class="cf-turnstile"
         data-sitekey="{{ config('services.turnstile.site_key') }}"
         data-appearance="interaction-only"
         data-theme="light"></div>

    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <script>
(function () {
    // Находим форму, внутри которой стоит этот скрипт
    var form = document.currentScript.parentNode;
    while (form && form.tagName !== 'FORM') { form = form.parentNode; }
    if (!form) { return; }

    // Виджет сам кладёт токен в скрытое поле cf-turnstile-response.
    // Если токена ещё нет (обычно хватает 1-2 секунд), не даём отправить
    // форму "вхолостую": на сервере такая заявка всё равно была бы отклонена.
    form.addEventListener('submit', function (e) {
        var field = form.querySelector('[name="cf-turnstile-response"]');
        if (!field || !field.value) {
            e.preventDefault();
            alert('Перевірка безпеки ще виконується. Зачекайте секунду і натисніть кнопку ще раз.');
        }
    });
})();
    </script>
@endif
