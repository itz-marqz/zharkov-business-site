<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->first();

        if (! $page) {
            $fallbackPages = [
                'about-me' => ['Про мене', 'Сергій Жарков'],
                'corporate-trainings' => ['Корпоративні бізнес-тренінги', 'Для команд і компаній'],
                'open-trainings' => ['Відкриті тренінги', 'Навчальні програми'],
                'coaching' => ['Коучинг', 'Індивідуальна робота'],
                'counseling' => ['Управлінське консультування', 'Для керівників'],
            ];

            abort_unless(isset($fallbackPages[$slug]), 404);
            [$name, $caption] = $fallbackPages[$slug];
            $page = new Page(['name' => $name, 'caption' => $caption, 'body' => null]);
        }

        return view('frontend.page', compact('page'));
    }
}
