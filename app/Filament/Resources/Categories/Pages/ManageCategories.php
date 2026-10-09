<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\Width;

class ManageCategories extends ManageRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Cadastrar categoria')
                ->icon('heroicon-o-plus')
                ->modalHeading('Cadastrar categoria')
                ->modalSubmitActionLabel('Cadastrar')
                ->modalWidth(Width::TwoExtraLarge)
                ->createAnother(false)
                ->successNotificationTitle('Categoria cadastrada com sucesso'),
        ];
    }
}