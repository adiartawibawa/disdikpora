<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermohonanResource\Pages;
use App\Filament\Resources\PermohonanResource\RelationManagers;
use App\Models\Permohonan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PermohonanResource extends Resource
{
    protected static ?string $model = Permohonan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manajemen Layanan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('layanan_id')
                    ->relationship('layanan', 'nama')
                    ->required()
                    ->columnSpanFull(),
                Wizard::make([
                    Step::make('Prasyarat')
                        ->description('Prasyarat permohonan yang diajukan')
                        ->schema([
                            Forms\Components\Repeater::make('prasyarat')->schema(function (Get $get): array {
                                switch ($get('type')) {
                                    case 'string':
                                        $formField = TextInput::make('value');
                                        break;
                                    case 'text':
                                        $formField = Textarea::make('value');
                                        break;
                                    case 'image':
                                        $formField = SpatieMediaLibraryFileUpload::make('value')->getUploadedFiles();
                                        break;
                                    case 'file':
                                        $formField = FileUpload::make('value')->downloadable();
                                        break;
                                    case 'date':
                                        $formField = DatePicker::make('value')->displayFormat(function (): string {
                                            return 'd/m/Y';
                                        });
                                        break;
                                    default:
                                        $formField = TextInput::make('value');
                                }
                                return [
                                    $formField,
                                    Textarea::make('catatan'),
                                    Toggle::make('valid'),
                                ];
                            })->addable(false)
                                ->deletable(false)
                                ->reorderable(false)
                                ->reorderableWithDragAndDrop(false)
                                ->columnSpanFull(),
                        ]),
                    Step::make('Formulir')
                        ->description('Formulir permohonan yang diajukan')
                        ->schema([
                            Forms\Components\Repeater::make('formulir')->schema(function (Get $get): array {
                                switch ($get('type')) {
                                    case 'string':
                                        $formField = TextInput::make('value');
                                        break;
                                    case 'text':
                                        $formField = Textarea::make('value');
                                        break;
                                    case 'image':
                                        $formField = SpatieMediaLibraryFileUpload::make('value')->getUploadedFiles();
                                        break;
                                    case 'file':
                                        $formField = FileUpload::make('value')->downloadable();
                                        break;
                                    case 'date':
                                        $formField = DatePicker::make('value')->displayFormat(function (): string {
                                            return 'd/m/Y';
                                        });
                                        break;
                                    default:
                                        $formField = TextInput::make('value');
                                }
                                return [
                                    $formField,
                                    Textarea::make('catatan'),
                                    Toggle::make('valid'),
                                ];
                            })->addable(false)
                                ->deletable(false)
                                ->reorderable(false)
                                ->reorderableWithDragAndDrop(false)
                                ->columnSpanFull(),
                        ])
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Permohonan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('layanan.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                // ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePermohonans::route('/'),
        ];
    }
}
