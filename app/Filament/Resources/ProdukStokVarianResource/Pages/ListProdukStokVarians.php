<?php

namespace App\Filament\Resources\ProdukStokVarianResource\Pages;

use App\Filament\Resources\ProdukStokVarianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProdukStokVarians extends ListRecords
{
    protected static string $resource = ProdukStokVarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
