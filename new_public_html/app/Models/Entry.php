<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    // Снимаем блокировку массового заполнения (Filament сам валидирует данные)
    protected $guarded = [];

    // Указываем правильные типы данных для базы
    protected $casts = [
        'on_main' => 'boolean',
        'images' => 'array',
        'published_at' => 'datetime',
    ];
}
