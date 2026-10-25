<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VideoResource\Pages;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;
    protected static ?string $navigationIcon = 'heroicon-o-play-circle';
    protected static ?string $navigationLabel = 'Відео';
    protected static ?string $modelLabel = 'відео';
    protected static ?string $pluralModelLabel = 'відео';
    protected static ?string $navigationGroup = 'Контент сайту';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->label('Назва')->required()->maxLength(255),
            Forms\Components\TextInput::make('youtube_url')->label('Посилання YouTube')->url()->required()->maxLength(255)
                ->helperText('Вставте звичайне посилання на відео з YouTube.'),
            Forms\Components\Textarea::make('description')->label('Опис')->rows(4)->columnSpanFull(),
            Forms\Components\Toggle::make('is_active')->label('Показувати на сайті')->default(true)->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Назва')->searchable(),
            Tables\Columns\TextColumn::make('youtube_url')->label('Посилання')->limit(36),
            Tables\Columns\IconColumn::make('is_active')->label('Опубліковано')->boolean(),
            Tables\Columns\TextColumn::make('updated_at')->label('Оновлено')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
