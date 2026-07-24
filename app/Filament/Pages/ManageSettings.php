<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $title = 'Site Settings';

    protected static string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Setting::current()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Details')
                    ->description('Used across the header, footer, floating buttons, WhatsApp links and CTA sections site-wide.')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone (for tel: links)')
                            ->helperText('Include country code, e.g. +919811703926')
                            ->tel()
                            ->required(),
                        Forms\Components\TextInput::make('whatsapp_number')
                            ->label('WhatsApp Number')
                            ->helperText('Digits only with country code, no + or spaces, e.g. 919811703926')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Social Media Links')
                    ->schema([
                        Forms\Components\TextInput::make('facebook_url')->url()->prefixIcon('heroicon-o-link'),
                        Forms\Components\TextInput::make('instagram_url')->url()->prefixIcon('heroicon-o-link'),
                        Forms\Components\TextInput::make('youtube_url')->url()->prefixIcon('heroicon-o-link'),
                        Forms\Components\TextInput::make('linkedin_url')->url()->prefixIcon('heroicon-o-link'),
                        Forms\Components\TextInput::make('x_url')->label('X (Twitter) URL')->url()->prefixIcon('heroicon-o-link'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Legal Links')
                    ->description('Shown in the footer. Leave blank to hide a link.')
                    ->schema([
                        Forms\Components\TextInput::make('privacy_policy_url')->url(),
                        Forms\Components\TextInput::make('terms_url')->label('Terms & Conditions URL')->url(),
                        Forms\Components\TextInput::make('refund_policy_url')->url(),
                    ])
                    ->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Setting::current()->update($data);

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }
}
