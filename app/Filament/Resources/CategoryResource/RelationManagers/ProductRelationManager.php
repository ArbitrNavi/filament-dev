<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ProductRelationManager extends RelationManager
{
    protected static ?string $label = 'Товар';

    protected static ?string $title = 'Товары';
    protected static string $relationship = 'products';

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Название'),
                Tables\Columns\TextColumn::make('price')
                    ->money('RUB')
                    ->label('Стоимость'),
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Изображение')
                    ->width(150)
                    ->height(150),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Активность')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
