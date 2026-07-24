<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationGroup = 'Site Pages';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->disabled(), // We disable this so they don't break the routing slug mappings
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('content.meta_title')
                            ->label('Meta Title')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('content.meta_description')
                            ->label('Meta Description')
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Home Page Fields
                Forms\Components\Section::make('Home Page Content')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('hero_image')
                            ->collection('hero_image')
                            ->image()
                            ->imageEditor()
                            ->helperText('Optional. If left empty, the founder\'s photo is shown instead, then a default illustration.')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('content.hero_eyebrow')
                            ->label('Hero — Eyebrow Text')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('content.hero_title_prefix')
                            ->label('Hero Title Prefix'),
                        Forms\Components\TagsInput::make('content.hero_animated_words')
                            ->label('Hero Animated Words'),
                        Forms\Components\Textarea::make('content.hero_description')
                            ->label('Hero Description')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Repeater::make('content.hero_badges')
                            ->label('Hero — Floating Badges')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->helperText('Heroicon name, e.g. calendar, ear, location.')
                                    ->required(),
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\TextInput::make('subtitle')->required(),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->addActionLabel('Add Badge')
                            ->reorderable(),

                        Forms\Components\Repeater::make('content.stats')
                            ->label('Stats Band')
                            ->helperText('A "Centres Across India" entry\'s number is auto-calculated from active centres and overrides whatever is entered here.')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->helperText('Heroicon name, e.g. ear-implant, award, location, cog, heart.')
                                    ->required(),
                                Forms\Components\TextInput::make('stat')
                                    ->label('Display text (e.g. "3500+")')
                                    ->required(),
                                Forms\Components\TextInput::make('number')
                                    ->numeric()
                                    ->helperText('Leave blank for non-numeric stats like "Advanced".'),
                                Forms\Components\TextInput::make('suffix')
                                    ->label('Suffix (e.g. "+")'),
                                Forms\Components\TextInput::make('label')->required(),
                            ])
                            ->columns(5)
                            ->columnSpanFull()
                            ->addActionLabel('Add Stat')
                            ->reorderable(),

                        Forms\Components\TextInput::make('content.centres_eyebrow')
                            ->label('Centres Section — Eyebrow'),
                        Forms\Components\TextInput::make('content.centres_title')
                            ->label('Centres Section — Title'),

                        Forms\Components\TextInput::make('content.specialties_eyebrow')
                            ->label('Specialities Section — Eyebrow'),
                        Forms\Components\TextInput::make('content.specialties_title')
                            ->label('Specialities Section — Title'),

                        Forms\Components\TextInput::make('content.why_choose_eyebrow')
                            ->label('Why Choose Us — Eyebrow'),
                        Forms\Components\TextInput::make('content.why_choose_title')
                            ->label('Why Choose Us Title'),
                        Forms\Components\Textarea::make('content.why_choose_description')
                            ->label('Why Choose Us Description')
                            ->rows(5)
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('content.why_choose_cards')
                            ->label('Why Choose Us — Feature List')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->helperText('Heroicon name, e.g. award, heart, shield, check-circle.')
                                    ->required(),
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\TextInput::make('description')->required(),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->addActionLabel('Add Feature')
                            ->reorderable(),

                        Forms\Components\TextInput::make('content.tech_eyebrow')
                            ->label('Technology Section — Eyebrow'),
                        Forms\Components\TextInput::make('content.tech_title')
                            ->label('Technology Section Title'),
                        Forms\Components\Repeater::make('content.tech_items')
                            ->label('Technology Grid')
                            ->schema([
                                Forms\Components\TextInput::make('image')
                                    ->label('Image slug')
                                    ->helperText('Filename (without .svg) in public/images/technology/, e.g. endoscopic-surgery.')
                                    ->required(),
                                Forms\Components\TextInput::make('name')->required(),
                            ])
                            ->columns(2)
                            ->columnSpanFull()
                            ->addActionLabel('Add Technology')
                            ->reorderable(),

                        Forms\Components\TextInput::make('content.specialists_eyebrow')
                            ->label('Specialists Section — Eyebrow'),
                        Forms\Components\TextInput::make('content.specialists_title')
                            ->label('Specialists Section — Title'),

                        Forms\Components\TextInput::make('content.testimonials_eyebrow')
                            ->label('Testimonials Section — Eyebrow'),
                        Forms\Components\TextInput::make('content.testimonials_title')
                            ->label('Testimonials Section — Title'),

                        Forms\Components\TextInput::make('content.cta_title')
                            ->label('Bottom CTA — Title'),
                        Forms\Components\Textarea::make('content.cta_subtitle')
                            ->label('Bottom CTA — Subtitle')
                            ->rows(2),
                    ])
                    ->columns(2)
                    ->visible(fn ($record) => $record?->slug === 'home'),

                // About Us Page Fields
                Forms\Components\Section::make('About Us Content')
                    ->schema([
                        Forms\Components\TextInput::make('content.hero_title')
                            ->label('Hero Title'),
                        Forms\Components\Textarea::make('content.hero_subtitle')
                            ->label('Hero Subtitle')
                            ->rows(3),
                        
                        Forms\Components\Textarea::make('content.mission_description')
                            ->label('Mission Statement'),
                        Forms\Components\Textarea::make('content.vision_description')
                            ->label('Vision Statement'),
                            
                        Forms\Components\Textarea::make('content.why_choose_description')
                            ->label('Why Choose Us Summary'),

                        Forms\Components\TagsInput::make('content.our_values')
                            ->label('Our Values — List')
                            ->columnSpanFull(),

                        Forms\Components\Repeater::make('content.why_choose_cards')
                            ->label('Why Choose Us — Feature Cards')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->helperText('Heroicon name, e.g. user-group, building, heart, shield.')
                                    ->required(),
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\Textarea::make('description')->rows(2)->required(),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->addActionLabel('Add Card')
                            ->reorderable(),

                        Forms\Components\Repeater::make('content.why_choose_stats')
                            ->label('Why Choose Us — Stat Strip')
                            ->helperText('A "Centres Across India" entry\'s number is auto-calculated from active centres and overrides whatever is entered here.')
                            ->schema([
                                Forms\Components\TextInput::make('stat')->required(),
                                Forms\Components\TextInput::make('label')->required(),
                            ])
                            ->columns(2)
                            ->columnSpanFull()
                            ->addActionLabel('Add Stat')
                            ->reorderable(),

                        Forms\Components\Repeater::make('content.impact_stats')
                            ->label('Impact Stats (Bottom Strip)')
                            ->helperText('A "Centres Across India" entry\'s number is auto-calculated from active centres and overrides whatever is entered here.')
                            ->schema([
                                Forms\Components\TextInput::make('stat')
                                    ->label('Display text (e.g. "50,000+")')
                                    ->required(),
                                Forms\Components\TextInput::make('number')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('suffix')
                                    ->label('Suffix (e.g. "+")'),
                                Forms\Components\TextInput::make('label')->required(),
                            ])
                            ->columns(4)
                            ->columnSpanFull()
                            ->addActionLabel('Add Stat')
                            ->reorderable(),

                        Forms\Components\TextInput::make('content.cta_title')
                            ->label('Bottom CTA — Title'),
                        Forms\Components\Textarea::make('content.cta_subtitle')
                            ->label('Bottom CTA — Subtitle')
                            ->rows(2),
                    ])
                    ->columns(2)
                    ->visible(fn ($record) => $record?->slug === 'about'),

                // Chairman's Desk Page Fields
                Forms\Components\Section::make('Chairman\'s Desk Content')
                    ->schema([
                        Forms\Components\TextInput::make('content.hero_title')
                            ->label('Hero Title'),
                        Forms\Components\Textarea::make('content.hero_subtitle')
                            ->label('Hero Subtitle')
                            ->rows(3),
                        
                        Forms\Components\TextInput::make('content.journey_title')
                            ->label('Journey Title'),

                        Forms\Components\TextInput::make('content.beliefs_title')
                            ->label('Beliefs Title'),
                        Forms\Components\TagsInput::make('content.beliefs')
                            ->label('Beliefs — List')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('content.milestones_eyebrow')
                            ->label('Milestones Section — Eyebrow'),
                        Forms\Components\TextInput::make('content.milestones_title')
                            ->label('Milestones Section — Title'),
                        Forms\Components\Repeater::make('content.milestones')
                            ->label('Milestones & Achievements — Cards')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->helperText('Heroicon name, e.g. award, ear-implant, clock, user-group.')
                                    ->required(),
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\Textarea::make('description')->rows(2)->required(),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->addActionLabel('Add Milestone')
                            ->reorderable(),

                        Forms\Components\Repeater::make('content.impact_stats')
                            ->label('Impact Stats (Bottom Strip)')
                            ->helperText('A "Centres Across India" entry\'s number is auto-calculated from active centres and overrides whatever is entered here.')
                            ->schema([
                                Forms\Components\TextInput::make('stat')
                                    ->label('Display text (e.g. "50,000+")')
                                    ->required(),
                                Forms\Components\TextInput::make('number')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('suffix')
                                    ->label('Suffix (e.g. "+")'),
                                Forms\Components\TextInput::make('label')->required(),
                            ])
                            ->columns(4)
                            ->columnSpanFull()
                            ->addActionLabel('Add Stat')
                            ->reorderable(),

                        Forms\Components\TextInput::make('content.cta_title')
                            ->label('Bottom CTA — Title'),
                        Forms\Components\Textarea::make('content.cta_subtitle')
                            ->label('Bottom CTA — Subtitle')
                            ->rows(2),
                    ])
                    ->columns(2)
                    ->visible(fn ($record) => $record?->slug === 'chairman'),

                // Contact Us Page Fields
                Forms\Components\Section::make('Contact Page Content')
                    ->schema([
                        Forms\Components\TextInput::make('content.hero_title')
                            ->label('Hero Title'),
                        Forms\Components\Textarea::make('content.hero_subtitle')
                            ->label('Hero Subtitle')
                            ->rows(3),

                        Forms\Components\TextInput::make('content.form_heading')
                            ->label('Form Section — Heading'),
                        Forms\Components\Textarea::make('content.form_subtitle')
                            ->label('Form Section — Subtitle')
                            ->rows(2),
                        Forms\Components\TagsInput::make('content.subjects')
                            ->label('Subject Dropdown — Options')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('content.urgent_box_title')
                            ->label('"Need Immediate Assistance" Box — Title'),
                        Forms\Components\Textarea::make('content.urgent_box_description')
                            ->label('"Need Immediate Assistance" Box — Description')
                            ->rows(2),

                        Forms\Components\TextInput::make('content.why_us_title')
                            ->label('Sidebar — "Why Us" Title'),
                        Forms\Components\TagsInput::make('content.why_us_list')
                            ->label('Sidebar — "Why Us" List')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('content.office_hours')
                            ->label('Sidebar — Office Hours Line')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('content.centres_eyebrow')
                            ->label('Centres Section — Eyebrow'),
                        Forms\Components\TextInput::make('content.centres_title')
                            ->label('Centres Section — Title'),
                    ])
                    ->columns(2)
                    ->visible(fn ($record) => $record?->slug === 'contact'),

                // Careers Page Fields
                Forms\Components\Section::make('Careers Page Content')
                    ->schema([
                        Forms\Components\TextInput::make('content.hero_title')
                            ->label('Hero Title'),
                        Forms\Components\Textarea::make('content.hero_subtitle')
                            ->label('Hero Subtitle')
                            ->rows(3),
                        Forms\Components\TagsInput::make('content.hero_stats')
                            ->label('Hero Highlight Pills')
                            ->columnSpanFull(),

                        Forms\Components\Repeater::make('content.stats_strip')
                            ->label('Stats Strip')
                            ->helperText('A "Centres Across India" entry\'s number is auto-calculated from active centres and overrides whatever is entered here.')
                            ->schema([
                                Forms\Components\TextInput::make('stat')->required(),
                                Forms\Components\TextInput::make('label')->required(),
                            ])
                            ->columns(2)
                            ->columnSpanFull()
                            ->addActionLabel('Add Stat')
                            ->reorderable(),

                        Forms\Components\TextInput::make('content.resume_box_title')
                            ->label('"No Role for You" Box — Title'),
                        Forms\Components\Textarea::make('content.resume_box_description')
                            ->label('"No Role for You" Box — Description')
                            ->rows(2),

                        Forms\Components\TagsInput::make('content.why_work_with_us')
                            ->label('Why Work With Us — Bullet Points')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('content.culture_eyebrow')
                            ->label('Culture Section — Eyebrow'),
                        Forms\Components\TextInput::make('content.culture_title')
                            ->label('Culture Section — Title'),
                        Forms\Components\Repeater::make('content.culture_cards')
                            ->label('Culture Cards')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->helperText('Heroicon name used elsewhere on the site, e.g. shield, award, user-group, heart.')
                                    ->required(),
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\Textarea::make('description')->rows(2)->required(),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->addActionLabel('Add Card')
                            ->reorderable(),

                        Forms\Components\TextInput::make('content.cta_title')
                            ->label('Bottom CTA — Title'),
                        Forms\Components\Textarea::make('content.cta_subtitle')
                            ->label('Bottom CTA — Subtitle')
                            ->rows(2),
                    ])
                    ->columns(2)
                    ->visible(fn ($record) => $record?->slug === 'careers'),

                // Specialists Page Fields
                Forms\Components\Section::make('Specialists Page Content')
                    ->schema([
                        Forms\Components\TextInput::make('content.hero_title')
                            ->label('Hero Title'),
                        Forms\Components\Textarea::make('content.hero_subtitle')
                            ->label('Hero Subtitle')
                            ->rows(3),

                        Forms\Components\Repeater::make('content.stats')
                            ->label('Additional Stats Band')
                            ->helperText('"Expert Specialists" and "Centres Across India" are calculated automatically and not editable here.')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->helperText('Heroicon name, e.g. heart, ear-implant.')
                                    ->required(),
                                Forms\Components\TextInput::make('stat')
                                    ->label('Display text (e.g. "3500+")')
                                    ->required(),
                                Forms\Components\TextInput::make('label')->required(),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->addActionLabel('Add Stat')
                            ->reorderable(),
                    ])
                    ->columns(2)
                    ->visible(fn ($record) => $record?->slug === 'specialists'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
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
                // Disable bulk delete for core pages
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
            'index' => Pages\ListPages::route('/'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
