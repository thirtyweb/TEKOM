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
    protected static ?string $navigationGroup = 'Content'; 
    protected static ?string $modelLabel = 'User Question'; 
    protected static ?string $pluralModelLabel = 'User Questions'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Inquirer Information')
                    ->description('Details of the question submitted by the user.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name') 
                            ->required()
                            ->maxLength(255)
                            ->disabled(), 
                        Forms\Components\TextInput::make('email')
                            ->label('Email') 
                            ->email()
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\Textarea::make('question')
                            ->label('Question') 
                            ->required()
                            ->columnSpanFull()
                            ->disabled(),
                    ])->columns(2),
                
                Section::make('Admin Response') 
                    ->description('Enter the answer and change the status of this question.') 
                    ->schema([
                        Forms\Components\RichEditor::make('answer')
                            ->label('Your Answer') 
                            ->required()
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('status')
                            ->label('Status') // Translated
                            ->options([
                                'pending' => 'Pending', 
                                'answered' => 'Answered', 
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
                    ->label('Name') 
                    ->searchable(),
                Tables\Columns\TextColumn::make('question')
                    ->label('Question') 
                    ->limit(50) 
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status') 
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'answered',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date Submitted') 
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status') 
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