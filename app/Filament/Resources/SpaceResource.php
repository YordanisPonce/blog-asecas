<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpaceResource\Pages;
use App\Filament\Resources\SpaceResource\RelationManagers;
use App\Models\Space;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class SpaceResource extends Resource
{
    protected static ?string $model = Space::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Espacios';
    protected static ?string $navigationGroup = 'Catálogo';
    protected static ?int $navigationSort = 32;

    public static function getModelLabel(): string
    {
        return 'espacio';
    }

    public static function getPluralModelLabel(): string
    {
        return 'espacios';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Contenido')->schema([
                Forms\Components\Tabs::make('i18n')->tabs([
                    Forms\Components\Tabs\Tab::make('ES')->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título (ES)')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                // Autogenera slug ES si está vacío
                                if (!$get('slug') && $state) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug (ES)')
                            ->required()
                            ->maxLength(255)
                              ->unique(ignoreRecord: true),

                        Forms\Components\Textarea::make('description')
                            ->label('Descripción (ES)')
                            ->rows(6),
                    ]),

                    Forms\Components\Tabs\Tab::make('EN')->schema([
                        Forms\Components\TextInput::make('title_en')
                            ->label('Title (EN)')
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if (!$get('slug_en') && $state) {
                                    $set('slug_en', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('slug_en')
                            ->label('Slug (EN)')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Textarea::make('description_en')
                            ->label('Description (EN)')
                            ->rows(6),
                    ]),

                    Forms\Components\Tabs\Tab::make('FR')->schema([
                        Forms\Components\TextInput::make('title_fr')
                            ->label('Titre (FR)')
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if (!$get('slug_fr') && $state) {
                                    $set('slug_fr', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('slug_fr')
                            ->label('Slug (FR)')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Textarea::make('description_fr')
                            ->label('Description (FR)')
                            ->rows(6),
                    ]),
                ]),
            ])->columns(1),

            Forms\Components\Section::make('Imagen')->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Imagen')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('220')
                    ->directory('spaces/images')
                    ->disk('public')
                    ->visibility('public')
                    ->downloadable()
                    ->openable()
                    ->required(fn(string $operation) => $operation === 'create'),

                Forms\Components\Tabs::make('image_meta')->tabs([
                    Forms\Components\Tabs\Tab::make('ES')->schema([
                        Forms\Components\TextInput::make('image_title.es')
                            ->label('Image title (ES)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('image_alt.es')
                            ->label('Image alt (ES)')
                            ->maxLength(255),
                    ]),
                    Forms\Components\Tabs\Tab::make('EN')->schema([
                        Forms\Components\TextInput::make('image_title.en')
                            ->label('Image title (EN)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('image_alt.en')
                            ->label('Image alt (EN)')
                            ->maxLength(255),
                    ]),
                    Forms\Components\Tabs\Tab::make('FR')->schema([
                        Forms\Components\TextInput::make('image_title.fr')
                            ->label('Image title (FR)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('image_alt.fr')
                            ->label('Image alt (FR)')
                            ->maxLength(255),
                    ]),
                ]),
            ])->columns(1),

            Forms\Components\Section::make('SEO (opcional)')->schema([
                Forms\Components\Tabs::make('seo')->tabs([
                    Forms\Components\Tabs\Tab::make('ES')->schema([
                        Forms\Components\TextInput::make('seo_title.es')
                            ->label('SEO title (ES)')
                            ->maxLength(70),
                        Forms\Components\Textarea::make('seo_description.es')
                            ->label('SEO description (ES)')
                            ->rows(3)
                            ->maxLength(300),
                    ]),
                    Forms\Components\Tabs\Tab::make('EN')->schema([
                        Forms\Components\TextInput::make('seo_title.en')
                            ->label('SEO title (EN)')
                            ->maxLength(70),
                        Forms\Components\Textarea::make('seo_description.en')
                            ->label('SEO description (EN)')
                            ->rows(3)
                            ->maxLength(300),
                    ]),
                    Forms\Components\Tabs\Tab::make('FR')->schema([
                        Forms\Components\TextInput::make('seo_title.fr')
                            ->label('SEO title (FR)')
                            ->maxLength(70),
                        Forms\Components\Textarea::make('seo_description.fr')
                            ->label('SEO description (FR)')
                            ->rows(3)
                            ->maxLength(300),
                    ]),
                ]),
            ])->columns(1),

            Forms\Components\Section::make('Orden y estado')->schema([
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make('order')
                        ->label('Orden')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Activo')
                        ->default(true),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->defaultSort('order')
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->height(60)
                    ->width(90),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título (ES)')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug (ES)')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(30),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Orden')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Solo activos')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\DeleteAction::make()->label('Eliminar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Eliminar seleccionados'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ApplicationLinksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpaces::route('/'),
            'create' => Pages\CreateSpace::route('/crear'),
            'edit' => Pages\EditSpace::route('/{record}/editar'),
        ];
    }
}
