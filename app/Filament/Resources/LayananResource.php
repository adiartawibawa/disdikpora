<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananResource\Pages;
use App\Filament\Resources\LayananResource\RelationManagers;
use App\Models\Layanan;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class LayananResource extends Resource
{
    protected static ?string $model = Layanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manajemen Layanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Layanan')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama layanan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('estimasi')
                            ->label('Estimasi waktu')
                            ->required()
                            ->numeric()
                            ->suffix('Hari')
                            ->default(1),
                        Forms\Components\Textarea::make('desc')
                            ->label('Deskripsi')
                            ->maxLength(65535),
                        SpatieMediaLibraryFileUpload::make('ilustrasi')
                            ->collection('ilustrasi-layanan')
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                    ])->columnSpan(1)->collapsible(),
                Section::make('Panduan Layanan')
                    ->schema([
                        Repeater::make('panduan')
                            ->schema([
                                FileUpload::make('image_header')
                                    ->getUploadedFileNameForStorageUsing(
                                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                            ->prepend('sampul-'),
                                    )
                                    ->directory('panduan/sampuls/')
                                    ->image()
                                    ->label('Foto Sampul')
                                    ->required(fn (Page $livewire): bool => $livewire instanceof EditRecord),
                                TextInput::make('judul')
                                    ->label('Judul Panduan')
                                    ->required(fn (Page $livewire): bool => $livewire instanceof EditRecord),
                                RichEditor::make('konten')
                                    ->label('Panduan'),
                                FileUpload::make('file')
                                    ->getUploadedFileNameForStorageUsing(
                                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                            ->prepend('attachment-'),
                                    )
                                    ->directory('panduan/attachments/')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->label('File Attachment'),
                            ])
                            ->reorderableWithButtons(),
                    ])
                    ->columnSpan(1)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estimasi')
                    ->label('Estimasi Layanan')
                    ->suffix(' Hari')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Tersedia')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\Action::make('ketentuan')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->steps([
                        Step::make('Prasyarat')
                            ->schema([
                                Repeater::make('prasyarat')
                                    ->schema([
                                        TextInput::make('nama')->label('Prasyarat'),
                                        Textarea::make('desc')->label('Deskripsi'),
                                        Select::make('type')
                                            ->options([
                                                'string' => 'Jawaban Singkat',
                                                'text' => 'Paragraf',
                                                'image' => 'Image/Foto',
                                                'file' => 'Dokumen/pdf',
                                                'date' => 'Tanggal',
                                            ])->label('Tipe Prasyarat'),
                                        Toggle::make('required')
                                            ->default(true)->label('Wajib'),
                                    ])->columns(3),
                            ]),
                        Step::make('Formulir')
                            ->schema([
                                Repeater::make('formulir')
                                    ->schema([
                                        TextInput::make('nama')->label('Formulir'),
                                        Textarea::make('desc')->label('Deskripsi'),
                                        Select::make('type')
                                            ->options([
                                                'string' => 'Jawaban Singkat',
                                                'text' => 'Paragraf',
                                                'image' => 'Image/Foto',
                                                'file' => 'Dokumen/pdf',
                                                'date' => 'Tanggal',
                                            ])->label('Tipe Formulir'),
                                        Toggle::make('required')
                                            ->default(true)->label('Wajib'),
                                    ])->columns(3),
                            ]),
                    ])
                    ->fillForm(fn (Layanan $record): array => [
                        'prasyarat' => $record->prasyarat,
                        'formulir' => $record->formulir,
                    ])
                    ->action(function (array $data, Layanan $record): void {
                        $record->prasyarat = $data['prasyarat'];
                        $record->formulir = $data['formulir'];
                        $record->save();

                        Notification::make()
                            ->title('Saved successfully')
                            ->icon('heroicon-o-document-text')
                            ->iconColor('success')
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLayanans::route('/'),
            'create' => Pages\CreateLayanan::route('/create'),
            'edit' => Pages\EditLayanan::route('/{record}/edit'),
        ];
    }
}
