<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Контакти та посилання';
    protected static ?string $modelLabel = 'контакт';
    protected static ?string $pluralModelLabel = 'контакти та посилання';
    protected static ?string $navigationGroup = 'Контент сайту';

    private const KEYS = [
        'phone' => 'Телефон',
        'email' => 'Електронна пошта',
        'telegram' => 'Telegram',
        'whatsapp' => 'WhatsApp',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'linkedin' => 'LinkedIn',
        'youtube' => 'YouTube',
        'youtube_secondary' => 'YouTube (другий канал)',
    ];

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('key')->label('Контакт')->options(self::KEYS)->required()->native(false)->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('value')->label('Номер, email або посилання')->rows(2)->required()->columnSpanFull(),
            Forms\Components\TextInput::make('description')->label('Примітка для адміністратора')->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('key')->label('Контакт')->formatStateUsing(fn (string $state): string => self::KEYS[$state] ?? $state)->searchable(),
            Tables\Columns\TextColumn::make('value')->label('Значення')->limit(48),
            Tables\Columns\TextColumn::make('description')->label('Примітка'),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
