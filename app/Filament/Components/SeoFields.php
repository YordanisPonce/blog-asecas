<?php
// app/Filament/Components/SeoFields.php

namespace App\Filament\Components;

use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;

class SeoFields
{
    /**
     * Retorna un Tab completo con todos los campos SEO
     */
    public static function make(): Tab
    {
        return Tab::make('SEO y Redes Sociales')
            ->icon('heroicon-o-globe-alt')
            ->schema([

                // ===== META TAGS BÁSICOS (los que pidió el cliente) =====
                Section::make('Meta Tags Básicos')
                    ->description('Configuración para buscadores (Google, Bing, etc.)')
                    ->schema([

                        // Meta Title
                        Fieldset::make('Título (Title)')
                            ->schema([
                                TextInput::make('seo.meta_title_es')
                                    ->label('Español')
                                    ->maxLength(60)
                                    ->helperText('Máximo 60 caracteres. Se mostrará en la pestaña del navegador.'),
                                TextInput::make('seo.meta_title_en')
                                    ->label('English')
                                    ->maxLength(60),
                                TextInput::make('seo.meta_title_fr')
                                    ->label('Français')
                                    ->maxLength(60),
                            ])->columns(3),

                        // Meta Description
                        Fieldset::make('Descripción (Meta Description)')
                            ->schema([
                                Textarea::make('seo.meta_description_es')
                                    ->label('Español')
                                    ->maxLength(160)
                                    ->rows(2)
                                    ->helperText('Máximo 160 caracteres. Aparece en los resultados de búsqueda.'),
                                Textarea::make('seo.meta_description_en')
                                    ->label('English')
                                    ->maxLength(160)
                                    ->rows(2),
                                Textarea::make('seo.meta_description_fr')
                                    ->label('Français')
                                    ->maxLength(160)
                                    ->rows(2),
                            ])->columns(3),

                        // Meta Keywords
                        Fieldset::make('Palabras clave (Keywords)')
                            ->schema([
                                Textarea::make('seo.meta_keywords_es')
                                    ->label('Español')
                                    ->helperText('Separadas por comas. Ej: diseño web, desarrollo, seo')
                                    ->rows(2),
                                Textarea::make('seo.meta_keywords_en')
                                    ->label('English')
                                    ->helperText('Separated by commas. Ej: web design, development, seo')
                                    ->rows(2),
                                Textarea::make('seo.meta_keywords_fr')
                                    ->label('Français')
                                    ->helperText('Séparés par des virgules. Ej: conception web, développement, seo')
                                    ->rows(2),
                            ])->columns(3),

                        // Configuración adicional SEO
                        Grid::make(3)
                            ->schema([
                                TextInput::make('seo.meta_robots')
                                    ->label('Meta Robots')
                                    ->default('index, follow')
                                    ->helperText('index/follow o noindex/nofollow'),

                                TextInput::make('seo.meta_author')
                                    ->label('Author')
                                    ->default('CuriosaWebsite'),

                                TextInput::make('seo.meta_publisher')
                                    ->label('Publisher')
                                    ->default('CuriosaWebsite'),

                                TextInput::make('seo.canonical_url')
                                    ->label('URL Canónica')
                                    ->url()
                                    ->helperText('URL principal para evitar contenido duplicado'),
                            ]),

                        // Nota sobre generator y language
                        Placeholder::make('generator_note')
                            ->label('Nota')
                            ->content('⚡ El meta "generator" se añade automáticamente en el frontend. El idioma se gestiona por URL.'),
                    ]),

                // ===== OPEN GRAPH (Facebook, LinkedIn, WhatsApp) =====
                Section::make('Open Graph (Redes Sociales)')
                    ->description('Cómo se verá al compartir en Facebook, LinkedIn, WhatsApp')
                    ->schema([

                        Fieldset::make('Título para redes')
                            ->schema([
                                TextInput::make('seo.og_title_es')
                                    ->label('Español')
                                    ->helperText('Si se deja vacío, usará el Meta Title'),
                                TextInput::make('seo.og_title_en')
                                    ->label('English'),
                                TextInput::make('seo.og_title_fr')
                                    ->label('Français'),
                            ])->columns(3),

                        Fieldset::make('Descripción para redes')
                            ->schema([
                                Textarea::make('seo.og_description_es')
                                    ->label('Español')
                                    ->rows(2)
                                    ->helperText('Si se deja vacío, usará la Meta Description'),
                                Textarea::make('seo.og_description_en')
                                    ->label('English')
                                    ->rows(2),
                                Textarea::make('seo.og_description_fr')
                                    ->label('Français')
                                    ->rows(2),
                            ])->columns(3),

                        Grid::make(2)
                            ->schema([
                                FileUpload::make('seo.og_image')
                                    ->label('Imagen para redes (OG Image)')
                                    ->image()
                                    ->disk('public')
                                    ->directory('seo/og-images')
                                    ->visibility('public')
                                    ->preserveFilenames()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '1.91:1', // 1200x630 recomendado
                                        '1:1',
                                    ])
                                    ->helperText('Recomendado: 1200x630px'),

                                Select::make('seo.og_type')
                                    ->label('Tipo de contenido')
                                    ->options([
                                        'website' => 'Sitio web',
                                        'article' => 'Artículo',
                                        'profile' => 'Perfil',
                                    ])
                                    ->default('website'),
                            ]),
                    ]),

                // ===== TWITTER CARDS =====
                Section::make('Twitter Cards')
                    ->description('Configuración específica para Twitter')
                    ->schema([

                        Select::make('seo.twitter_card')
                            ->label('Tipo de tarjeta')
                            ->options([
                                'summary' => 'Summary Card',
                                'summary_large_image' => 'Summary Card with Large Image',
                            ])
                            ->default('summary_large_image'),

                        Fieldset::make('Título para Twitter')
                            ->schema([
                                TextInput::make('seo.twitter_title_es')
                                    ->label('Español')
                                    ->helperText('Si se deja vacío, usará el OG Title'),
                                TextInput::make('seo.twitter_title_en')
                                    ->label('English'),
                                TextInput::make('seo.twitter_title_fr')
                                    ->label('Français'),
                            ])->columns(3),

                        Fieldset::make('Descripción para Twitter')
                            ->schema([
                                Textarea::make('seo.twitter_description_es')
                                    ->label('Español')
                                    ->rows(2)
                                    ->helperText('Si se deja vacío, usará la OG Description'),
                                Textarea::make('seo.twitter_description_en')
                                    ->label('English')
                                    ->rows(2),
                                Textarea::make('seo.twitter_description_fr')
                                    ->label('Français')
                                    ->rows(2),
                            ])->columns(3),

                        FileUpload::make('seo.twitter_image')
                            ->label('Imagen para Twitter')
                            ->image()
                            ->disk('public')
                            ->directory('seo/twitter-images')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->helperText('Si se deja vacío, usará la OG Image'),
                    ]),

                // ===== AYUDA Y CONSEJOS =====
                Section::make('Consejos SEO')
                    ->description('Recomendaciones para mejorar tu posicionamiento')
                    ->schema([
                        Placeholder::make('seo_tips')
                            ->content(function () {
                                return view('filament.components.seo-tips');
                            }),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
