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
                Select::make('writer_id')->label('Escritor')->
                    relationship('writer', 'name')
                    ->columnSpanFull()->preload()->native(false),
                Select::make('blog_category_id')->label('Categoría')->
                    relationship('blogCategory', 'name')
                    ->columnSpanFull()->preload()->native(false),
                Hidden::make('user_id')->default(auth()->id())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->label('Foto')->circular(),
                TextColumn::make('title')->label('Título'),
                TextColumn::make('user.name')->label('Usuario'),
                TextColumn::make('writer.name')->label('Escritor'),
                TextColumn::make('blogCategory.name')->label('Categoría'),
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
