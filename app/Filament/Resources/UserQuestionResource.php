<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserQuestionResource\Pages;
use App\Models\Question;
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
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $modelLabel = 'Pertanyaan Pengguna';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Penanya')
                    ->description('Detail pertanyaan yang dikirim oleh pengguna.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255)
                            ->disabled(), // Dibuat disabled agar tidak bisa diubah admin
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\Textarea::make('question')
                            ->label('Pertanyaan')
                            ->required()
                            ->columnSpanFull()
                            ->disabled(),
                    ])->columns(2),
                
                Section::make('Jawaban Admin')
                    ->description('Isi jawaban dan ubah status pertanyaan ini.')
                    ->schema([
                        // Ini adalah field untuk admin menjawab
                        Forms\Components\RichEditor::make('answer')
                            ->label('Jawaban Anda')
                            ->required()
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('status')
                            ->label('Status')
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
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->limit(50) // Batasi teks agar tidak terlalu panjang
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'answered',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Masuk')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
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
