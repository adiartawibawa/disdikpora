<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

class ManageGeneralSetting extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Manajemen Aplikasi';

    protected static ?string $navigationLabel = 'General Settings';

    protected static ?int $navigationSort = 2;

    protected static string $settings = GeneralSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('app_name')
                    ->label('Application Name')
                    ->required(),
                Textarea::make('app_desc')
                    ->label('Application Description')
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('app_phone')
                    ->label('Contact phone')
                    ->required(),
                TextInput::make('app_mail')
                    ->label('Contact e-Mail')
                    ->required(),
                TimezoneSelect::make('app_timezone')
                    ->label('Application Timezone')
                    ->timezoneType('UTC')
                    ->searchable()
                    ->required(),
                Select::make('app_locale')
                    ->label('Application Locale')
                    ->options([
                        'id' => 'ID - Indonesia',
                        'en' => 'EN - English(US)',
                    ])
                    ->required(),
                FileUpload::make('app_favicon')
                    ->directory('settings/general')
                    ->label('Application Favicon'),
                FileUpload::make('app_logo')
                    ->directory('settings/general')
                    ->label('Application Logo'),
                Toggle::make('app_active')
                    ->label('is active')
                    ->onIcon('heroicon-m-bolt')
                    ->offIcon('heroicon-m-bolt-slash')
                    ->default(true),
            ]);
    }
}
