<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserQuestionResource\Pages;
use App\Models\Question; // Assuming your model is named 'Question' for user questions
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Section;

class UserQuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationGroup = 'Content'; // Translated from 'Konten'
    protected static ?string $modelLabel = 'User Question'; // Translated from 'Pertanyaan Pengguna'
    protected static ?string $pluralModelLabel = 'User Questions'; // Added plural for clarity in navigation

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Inquirer Information') // Translated
                    ->description('Details of the question submitted by the user.') // Translated
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name') // Translated
                            ->required()
                            ->maxLength(255)
                            ->disabled(), // Kept disabled for admin to not modify
                        Forms\Components\TextInput::make('email')
                            ->label('Email') // Translated
                            ->email()
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\Textarea::make('question')
                            ->label('Question') // Translated
                            ->required()
                            ->columnSpanFull()
                            ->disabled(),
                    ])->columns(2),
                
                Section::make('Admin Response') // Translated
                    ->description('Enter the answer and change the status of this question.') // Translated
                    ->schema([
                        // This is the field for admin to answer
                        Forms\Components\RichEditor::make('answer')
                            ->label('Your Answer') // Translated
                            ->required()
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('status')
                            ->label('Status') // Translated
                            ->options([
                                'pending' => 'Pending', // Already English
                                'answered' => 'Answered', // Already English
                            ])
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name') // Translated
                    ->searchable(),
                Tables\Columns\TextColumn::make('question')
                    ->label('Question') // Translated
                    ->limit(50) // Limit text for better table view
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status') // Already English
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'answered',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date Submitted') // Translated
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status') // Translated for filter
                    ->options([
                        'pending' => 'Pending',
                        'answered' => 'Answered',
                    ])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserQuestions::route('/'),
            'edit' => Pages\EditUserQuestion::route('/{record}/edit'),
        ];
    }
}