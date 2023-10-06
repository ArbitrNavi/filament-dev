<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $breadcrumb = 'Товары';

    protected static ?string $label = 'Товары ';

    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image_path')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Активность'),
                Forms\Components\TextInput::make('priority')
                    ->label('Приоритет')
                    ->integer()
                    ->required()
                    ->default(0),
                Forms\Components\Select::make('category_id')
                    ->label('Категория')
                    ->options(Category::all()->pluck('title', 'id'))
                    ->preload()
                    ->searchable(),
                Forms\Components\TextInput::make('price')
                    ->prefix('₽')
                    ->label('Стоимость')
                    ->integer()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Название'),
                Tables\Columns\TextColumn::make('price')
                    ->money('RUB')
                    ->label('Стоимость'),
                Tables\Columns\TextColumn::make('category.title')
                    ->sortable()
                    ->label('Категория')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Изображение')
                    ->width(150)
                    ->height(150),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Активность'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Категория')
                    ->preload()
                    ->options(Category::query()->where('is_active', 1)->pluck('title', 'id')),
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

        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }    
}
