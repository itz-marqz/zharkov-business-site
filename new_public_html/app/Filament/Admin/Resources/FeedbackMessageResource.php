<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FeedbackMessageResource\Pages;
use App\Models\FeedbackMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FeedbackMessageResource extends Resource
{
    protected static ?string $model = FeedbackMessage::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Заявки';
    protected static ?string $modelLabel = 'заявка';
    protected static ?string $pluralModelLabel = 'заявки';
    protected static ?string $navigationGroup = 'Контент сайту';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Ім’я')->disabled()->dehydrated(false),
            Forms\Components\TextInput::make('phone')->label('Телефон')->tel()->disabled()->dehydrated(false),
            Forms\Components\TextInput::make('email')->label('Email')->email()->disabled()->dehydrated(false),
            Forms\Components\Textarea::make('message')->label('Повідомлення')->rows(6)->disabled()->dehydrated(false)->columnSpanFull(),
            Forms\Components\TextInput::make('ip')->label('IP')->disabled()->dehydrated(false),
            Forms\Components\Select::make('status')
                ->label('Статус')
                ->options(['new' => 'Нова', 'in_progress' => 'У роботі', 'closed' => 'Закрита'])
                ->default('new')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->label('Отримано')->dateTime('d.m.Y H:i')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Ім’я')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Телефон')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('message')->label('Повідомлення')->limit(60),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Статус')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'in_progress' => 'У роботі',
                        'closed' => 'Закрита',
                        default => 'Нова',
                    })
                    ->colors(['warning' => 'new', 'primary' => 'in_progress', 'success' => 'closed']),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([Tables\Actions\EditAction::make()->label('Відкрити')]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedbackMessages::route('/'),
            'edit' => Pages\EditFeedbackMessage::route('/{record}/edit'),
        ];
    }
}
