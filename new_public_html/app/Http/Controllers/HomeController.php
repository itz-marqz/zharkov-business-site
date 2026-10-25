<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Entry;
use App\Models\Review;
use App\Models\ContentBlock;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        
        // Выводим только будущие мероприятия, сортируем по дате проведения
        $events = Entry::where('type', 'event')
            ->where('on_main', true)
            ->whereDate('published_at', '>=', now())
            ->orderBy('published_at', 'asc')
            ->take(3)
            ->get();
            
        $cases = Entry::where('type', 'case')->where('on_main', true)->latest()->get();
        $reviews = Review::where('is_published', true)->take(6)->get();
        $other_blocks = ContentBlock::all();
        
        return view('frontend.home', compact('sliders', 'events', 'cases', 'reviews', 'other_blocks'));
    }
}
