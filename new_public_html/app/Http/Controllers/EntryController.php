<?php

namespace App\Http\Controllers;

use App\Models\Entry;

class EntryController extends Controller
{
    public function index(?string $type = null)
    {
        $query = Entry::query();
        if ($type) {
            $query->where('type', $type);
        }
        if ($type === 'event') {
            $query->whereDate('published_at', '>=', now());
        }
        $entries = $query->orderByDesc('published_at')->orderByDesc('created_at')->paginate(12);

        return view('frontend.case_list', compact('entries', 'type'));
    }

    public function events()
    {
        return $this->index('event');
    }

    public function cases()
    {
        return $this->index('case');
    }

    public function show(string $slug)
    {
        $entry = Entry::where('slug', $slug)->firstOrFail();

        return view('frontend.case_page', compact('entry'));
    }

    public function showEvent(string $slug)
    {
        $entry = Entry::where('slug', $slug)->where('type', 'event')->firstOrFail();

        return view('frontend.case_page', compact('entry'));
    }

    public function showCase(string $slug)
    {
        $entry = Entry::where('slug', $slug)->where('type', 'case')->firstOrFail();

        return view('frontend.case_page', compact('entry'));
    }
}
