<?php

namespace App\Filament\Resources\UserQuestionResource\Pages;

use App\Filament\Resources\UserQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserQuestions extends ListRecords
{
    protected static string $resource = UserQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
