<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EntryResource\Pages;
use App\Filament\Admin\Resources\EntryResource\RelationManagers;
use App\Models\Entry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Forms\Get;

class EntryResource extends Resource
{
    protected static ?string $model = Entry::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Тип матеріалу')
                    ->options(['event' => 'Захід', 'case' => 'Кейс'])
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('Назва')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? '')))
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->label('Адреса сторінки')
                    ->helperText('Латиницею, без пробілів. Заповнюється з назви автоматично.')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Textarea::make('preview_body')
                    ->label('Короткий опис')
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('body')
                    ->label('Повний матеріал')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('on_main')
                    ->label('Показувати на головній')
                    ->required(),
                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Дата заходу / публікації')
                    ->required(fn (Get $get): bool => $get('type') === 'event'),
                Forms\Components\FileUpload::make('images')
                    ->label('Фотографії')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->appendFiles()
                    ->disk('public')
                    ->directory('entries')
                    ->imageEditor()
                    ->helperText('Перше фото використовується як обкладинка.')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->formatStateUsing(fn (string $state): string => $state === 'event' ? 'Захід' : 'Кейс')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Назва')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('on_main')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEntries::route('/'),
            'create' => Pages\CreateEntry::route('/create'),
            'edit' => Pages\EditEntry::route('/{record}/edit'),
        ];
    }
}
