<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $label = 'noticia';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort = 10;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('Título')->columnSpanFull(),
                RichEditor::make('description')->label('Contenido')->columnSpanFull(),
                Toggle::make('active')->label('Habilitado')->columnSpanFull(),
                FileUpload::make('photo')->label('Foto')->columnSpanFull(),
                // Select::make('writer_id')->label('Escritor')->
                //     relationship('writer', 'name')
                //     ->columnSpanFull()->preload()->native(false),
                // Select::make('blog_category_id')->label('Categoría')->
                //     relationship('blogCategory', 'name')
                //     ->columnSpanFull()->preload()->native(false),
                Hidden::make('user_id')->default(auth()->id()),
            // Dentro de form(), después de los campos existentes:
            Forms\Components\Section::make('Optimización SEO')
                ->icon('heroicon-o-globe-alt')
                ->schema([
                    Tabs::make('SEO Tabs')
                        ->tabs([
                            Tabs\Tab::make('Español')->schema([
                                TextInput::make('meta_title_es')->label('Meta Title (ES)')->maxLength(60),
                                Textarea::make('meta_description_es')->label('Meta Description (ES)')->maxLength(160)->rows(2),
                                Textarea::make('meta_keywords_es')->label('Meta Keywords (ES)')->helperText('Separadas por comas'),
                                TextInput::make('og_title_es')->label('OG Title (ES)'),
                                Textarea::make('og_description_es')->label('OG Description (ES)')->rows(2),
                            ]),
                            Tabs\Tab::make('English')->schema([
                                TextInput::make('meta_title_en')->label('Meta Title (EN)')->maxLength(60),
                                Textarea::make('meta_description_en')->label('Meta Description (EN)')->maxLength(160)->rows(2),
                                Textarea::make('meta_keywords_en')->label('Meta Keywords (EN)'),
                                TextInput::make('og_title_en')->label('OG Title (EN)'),
                                Textarea::make('og_description_en')->label('OG Description (EN)')->rows(2),
                            ]),
                            Tabs\Tab::make('Français')->schema([
                                TextInput::make('meta_title_fr')->label('Meta Title (FR)')->maxLength(60),
                                Textarea::make('meta_description_fr')->label('Meta Description (FR)')->maxLength(160)->rows(2),
                                Textarea::make('meta_keywords_fr')->label('Meta Keywords (FR)'),
                                TextInput::make('og_title_fr')->label('OG Title (FR)'),
                                Textarea::make('og_description_fr')->label('OG Description (FR)')->rows(2),
                            ]),
                        ]),
                    FileUpload::make('og_image')
                        ->label('OG Image (Imagen para redes sociales)')
                        ->image()
                        ->disk('public')
                        ->directory('seo/og-images')
                        ->visibility('public')
                        ->helperText('Recomendado: 1200x630px'),
                ])
                ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->label('Foto')->circular(),
                TextColumn::make('title')->label('Título'),
                TextColumn::make('user.name')->label('Usuario'),
                // TextColumn::make('writer.name')->label('Escritor'),
                // TextColumn::make('blogCategory.name')->label('Categoría'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'view' => Pages\ViewBlog::route('/{record}'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
