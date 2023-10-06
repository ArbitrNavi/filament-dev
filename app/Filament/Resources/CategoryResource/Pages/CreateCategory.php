<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static ?string $breadcrumb = 'Создать';

    protected static ?string $title = 'Создать категорию';

    protected static string $resource = CategoryResource::class;
}
