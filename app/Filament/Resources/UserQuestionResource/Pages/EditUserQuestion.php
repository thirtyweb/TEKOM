<?php

namespace App\Filament\Resources\UserQuestionResource\Pages;

use App\Filament\Resources\UserQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserQuestion extends EditRecord
{
    protected static string $resource = UserQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
