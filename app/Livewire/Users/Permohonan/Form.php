<?php

namespace App\Livewire\Users\Permohonan;

use App\Models\Permohonan;
use App\Models\PermohonanStatus;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form as FilamentForm;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\HtmlString;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Str;

class Form extends Component implements HasForms
{
    use InteractsWithForms;

    public $idLayanan;
    public $prasyarat;
    public $formulir;
    public ?array $data = [];

    public function mount($prasyarat, $formulir, $id): void
    {
        $this->prasyarat = $prasyarat;
        $this->formulir = $formulir;
        $this->idLayanan = $id;
        $this->form->fill();
    }

    public function form(FilamentForm $form): FilamentForm
    {
        $formPrasyarat = collect();
        $formFormulir = collect();

        // Cek apakah prasyarat tidak kosong sebelum melakukan iterasi
        if (!empty($this->prasyarat)) {
            foreach ($this->prasyarat as $prasyarat) {
                switch ($prasyarat['type']) {
                    case 'string':
                        $fields = [
                            TextInput::make(Str::slug($prasyarat['nama'] . ' value'))
                                ->label($prasyarat['desc'])
                                ->required($prasyarat['required']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' desc'))->default($prasyarat['desc']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' type'))->default($prasyarat['type']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' valid'))->default(false)
                        ];
                        break;

                    case 'text':
                        $fields = [
                            Textarea::make(Str::slug($prasyarat['nama'] . ' value'))
                                ->label($prasyarat['desc'])
                                ->required($prasyarat['required']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' desc'))->default($prasyarat['desc']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' type'))->default($prasyarat['type']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' valid'))->default(false)
                        ];
                        break;

                    case 'image':
                        $fields = [
                            FileUpload::make(Str::slug($prasyarat['nama'] . ' value'))
                                ->label($prasyarat['desc'])
                                ->getUploadedFileNameForStorageUsing(
                                    fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                        ->prepend(Str::slug('image ' . Date::now() . ' ' . auth()->user()->name . '-')),
                                )
                                ->directory('permohonan/images/')
                                ->required($prasyarat['required']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' desc'))->default($prasyarat['desc']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' type'))->default($prasyarat['type']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' valid'))->default(false)
                        ];
                        break;

                    case 'file':
                        $fields = [
                            FileUpload::make(Str::slug($prasyarat['nama'] . ' value'))
                                ->getUploadedFileNameForStorageUsing(
                                    fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                        ->prepend(Str::slug('attachment ' . Date::now() . ' ' . auth()->user()->name . '-')),
                                )
                                ->directory('permohonan/attachments/')
                                ->acceptedFileTypes(['application/pdf'])
                                ->label($prasyarat['desc'])
                                ->required($prasyarat['required']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' desc'))->default($prasyarat['desc']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' type'))->default($prasyarat['type']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' valid'))->default(false)
                        ];
                        break;

                    case 'date':
                        $fields = [
                            DatePicker::make(Str::slug($prasyarat['nama'] . ' value'))
                                ->label($prasyarat['desc'])
                                ->displayFormat(function (): string {
                                    return 'd/m/Y';
                                })
                                ->required($prasyarat['required']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' desc'))->default($prasyarat['desc']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' type'))->default($prasyarat['type']),
                            Hidden::make(Str::slug($prasyarat['nama'] . ' valid'))->default(false)
                        ];
                        break;

                    default:
                        continue 2;
                }
                $formPrasyarat->push($fields);
            }
        }

        // Cek apakah prasyarat tidak kosong sebelum melakukan iterasi
        if (!empty($this->formulir)) {
            foreach ($this->formulir as $formulir) {
                switch ($formulir['type']) {
                    case 'string':
                        $fields = [
                            TextInput::make(Str::slug($formulir['nama'] . ' value'))
                                ->label($formulir['desc'])
                                ->required($formulir['required']),
                            Hidden::make(Str::slug($formulir['nama'] . ' desc'))->default($formulir['desc']),
                            Hidden::make(Str::slug($formulir['nama'] . ' type'))->default($formulir['type']),
                            Hidden::make(Str::slug($formulir['nama'] . ' valid'))->default(false)
                        ];
                        break;

                    case 'text':
                        $fields = [
                            Textarea::make(Str::slug($formulir['nama'] . ' value'))
                                ->label($formulir['desc'])
                                ->required($formulir['required']),
                            Hidden::make(Str::slug($formulir['nama'] . ' desc'))->default($formulir['desc']),
                            Hidden::make(Str::slug($formulir['nama'] . ' type'))->default($formulir['type']),
                            Hidden::make(Str::slug($formulir['nama'] . ' valid'))->default(false)
                        ];
                        break;

                    case 'image':
                        $fields = [
                            FileUpload::make(Str::slug($formulir['nama'] . ' value'))
                                ->label($formulir['desc'])
                                ->getUploadedFileNameForStorageUsing(
                                    fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                        ->prepend(Str::slug('image ' . Date::now() . ' ' . auth()->user()->name . '-')),
                                )
                                ->directory('permohonan/images/')
                                ->required($formulir['required']),
                            Hidden::make(Str::slug($formulir['nama'] . ' desc'))->default($formulir['desc']),
                            Hidden::make(Str::slug($formulir['nama'] . ' type'))->default($formulir['type']),
                            Hidden::make(Str::slug($formulir['nama'] . ' valid'))->default(false)
                        ];
                        break;

                    case 'file':
                        $fields = [
                            FileUpload::make(Str::slug($formulir['nama'] . ' value'))
                                ->getUploadedFileNameForStorageUsing(
                                    fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                        ->prepend(Str::slug('attachment ' . Date::now() . ' ' . auth()->user()->name . '-')),
                                )
                                ->directory('permohonan/attachments/')
                                ->acceptedFileTypes(['application/pdf'])
                                ->label($formulir['desc'])
                                ->required($formulir['required']),
                            Hidden::make(Str::slug($formulir['nama'] . ' desc'))->default($formulir['desc']),
                            Hidden::make(Str::slug($formulir['nama'] . ' type'))->default($formulir['type']),
                            Hidden::make(Str::slug($formulir['nama'] . ' valid'))->default(false)
                        ];
                        break;

                    case 'date':
                        $fields = [
                            DatePicker::make(Str::slug($formulir['nama'] . ' value'))
                                ->label($formulir['desc'])
                                ->displayFormat(function (): string {
                                    return 'd/m/Y';
                                })
                                ->required($formulir['required']),
                            Hidden::make(Str::slug($formulir['nama'] . ' desc'))->default($formulir['desc']),
                            Hidden::make(Str::slug($formulir['nama'] . ' type'))->default($formulir['type']),
                            Hidden::make(Str::slug($formulir['nama'] . ' valid'))->default(false)
                        ];
                        break;

                    default:
                        continue 2;
                }
                $formFormulir->push($fields);
            }
        }

        return $form->schema([
            Wizard::make([
                Wizard\Step::make('Prasyarat')
                    ->description('Prasyarat permohonan untuk dilengkapi')
                    // ->schema($formPrasyarat->flatten(1)->toArray()),
                    ->schema([
                        Repeater::make('prasyarat')->schema(
                            $formPrasyarat->flatten(1)->toArray()
                        )
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->reorderableWithDragAndDrop(false)
                    ]),
                Wizard\Step::make('Formulir')
                    ->description('Dokumen permohonan untuk dilengkapi')
                    // ->schema($formFormulir->flatten(1)->toArray()),
                    ->schema([
                        Repeater::make('formulir')->schema(
                            $formFormulir->flatten(1)->toArray()
                        )
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->reorderableWithDragAndDrop(false)
                    ]),

            ])->submitAction(
                new HtmlString(
                    Blade::render(<<<BLADE
                        <x-filament::button
                        class="bg-red-800"
                            wire:click="create"
                            type="submit"
                            size="sm"
                        >
                            Submit
                        </x-filament::button>
                    BLADE)
                )
            )
                ->nextAction(fn (Action $action) => $action->extraAttributes([
                    'class' => 'bg-red-800',
                ]))
                ->previousAction(fn (Action $action) => $action->extraAttributes([
                    'class' => 'bg-red-800',
                ])),
        ])
            ->statePath('data');
    }

    public function create(): void
    {
        $form = $this->form->getState();

        $prasyarat = $this->convertForRepeater($form['prasyarat']);
        $formulir = $this->convertForRepeater($form['formulir']);

        $permohonan = Permohonan::create([
            'layanan_id' => $this->idLayanan,
            'prasyarat' => $prasyarat,
            'formulir' => $formulir
        ]);

        $status = $permohonan->status()->create([
            'status' => PermohonanStatus::DIBUAT,
            'note' => 'Permohonan baru saja dibuat.',
        ]);

        Notification::make()
            ->title('Saved successfully')
            ->body($status->note)
            ->icon('heroicon-o-document-text')
            ->iconColor('success')
            ->seconds(5)
            ->send();
    }

    public function render()
    {
        return view('livewire.users.permohonan.form');
    }

    private function convertForRepeater($data)
    {
        // Inisialisasi array kosong untuk menyimpan hasil konversi
        $rawData = [];
        // Looping melalui data yang diberikan
        foreach ($data[0] as $key => $value) {
            // Memisahkan nama field dan informasi tambahan
            $parts = explode('-', $key);

            // Mengambil bagian nama sebelum kata 'value', 'desc', 'type', 'valid'
            $groupName = '';
            foreach ($parts as $part) {
                if (in_array($part, ['value', 'desc', 'type', 'valid'])) {
                    break;
                }
                $groupName .= ($groupName ? '-' : '') . $part;
            }

            // Memastikan bahwa setiap kelompok data memiliki minimal 1 kunci dengan properti "value", "desc", "type", dan "valid"
            if (!isset($rawData[$groupName])) {
                $rawData[$groupName] = [];
            }

            // Menambahkan data ke dalam kelompok yang sesuai
            $property = end($parts);
            $rawData[$groupName][$property] = $value;
        }

        // Mengubah struktur array untuk menghasilkan array multidimensi
        $finalData = array_values($rawData);

        return $finalData;
    }
}
