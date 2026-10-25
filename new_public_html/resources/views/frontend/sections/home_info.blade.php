<section class="section section--white infographic-section" id="about">
	@php($imageVersion = filemtime(public_path('frontend/img/infograf.png')) ?: 1)
	<div class="container">
		<div class="section-head reveal justify-content-center text-center">
			<div><span class="eyebrow">Досвід і результати</span><h2>Сергій Жарков у цифрах</h2></div>
		</div>
		<div class="infographic-frame reveal">
			<picture>
				<source srcset="{{ asset('frontend/img/infograf.webp') }}?v={{ $imageVersion }}" type="image/webp">
				<img src="{{ asset('frontend/img/infograf.png') }}?v={{ $imageVersion }}" alt="Інфографіка про Сергія Жаркова: понад 25 років досвіду, 937 бізнес-тренінгів, 1 700 годин коучингу, 16 200 учасників, 69 відсотків повторних звернень, економія клієнтів 978 тисяч гривень, зростання продажів у 2,5 раза та психологічна освіта." loading="lazy" width="1280" height="576">
			</picture>
		</div>
	</div>
</section>
