<?php

namespace App\Livewire\Pages\Sekolah;

use App\Models\GuruTendikKebutuhan;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Attributes\Layout;
use Livewire\Component;

class KebutuhanGuru extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(GuruTendikKebutuhan::where('active', true)
                ->where('jml_kurang', '>', 0))
            ->columns([
                TextColumn::make('organisation.name')
                    ->label('Sekolah')
                    ->searchable(),
                TextColumn::make('jenisPtk.name')
                    ->label('Jenis PTK')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('jml_kurang')
                    ->label('Jumlah Kebutuhan')
                    ->numeric(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('lihat')
                    ->action(function (GuruTendikKebutuhan $record) {
                        $this->openModal($record);
                    }),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function openModal($record)
    {
        $this->record = $record;

        $this->dispatch('open-modal', id: 'modals');
    }

    public function closeModal()
    {
        $this->dispatch('close-modal', id: 'modals');
    }

    #[Layout('layouts.front')]
    public function render()
    {
        return view('livewire.pages.sekolah.kebutuhan-guru');
    }
}
