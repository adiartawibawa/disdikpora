<?php

namespace App\Livewire\Users\Permohonan;

use App\Models\Layanan;
use App\Models\Permohonan;
use App\Models\PermohonanStatus;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Str;

class CreatePermohonan extends Component implements HasForms
{
    use InteractsWithForms;

    public $layanan;
    public ?array $data = [];

    public function mount($slug)
    {
        $this->layanan = Layanan::whereSlug($slug)->firstOrFail();
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $prasyarat = $this->layanan->prasyarat;
        $prasyaratFields = [];
        // Cek apakah prasyarat tidak kosong sebelum melakukan iterasi
        if (!empty($prasyarat)) {
            foreach ($prasyarat as $field) {
                switch ($field['type']) {
                    case 'string':
                        $inputField = TextInput::make($field['nama'])
                            ->label($field['desc'])
                            ->required($field['required']);
                        break;

                    case 'text':
                        $inputField = Textarea::make($field['nama'])
                            ->label($field['desc'])
                            ->required($field['required']);
                        break;

                    case 'image':
                        // Handle untuk tipe 'image' di sini
                        // Misalnya, Anda dapat menggunakan ImageInput jika ada
                        $inputField = FileUpload::make($field['nama'])
                            ->label($field['desc'])
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend(Str::slug('image ' . Date::now() . ' ' . auth()->user()->name . '-')),
                            )
                            ->directory('permohonan/images/')
                            ->required($field['required']);
                        break;

                    case 'file':
                        // Handle untuk tipe 'file' di sini
                        // Misalnya, Anda dapat menggunakan FileInput jika ada
                        $inputField = FileUpload::make($field['nama'])
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend(Str::slug('attachment ' . Date::now() . ' ' . auth()->user()->name . '-')),
                            )
                            ->directory('permohonan/attachments/')
                            ->acceptedFileTypes(['application/pdf'])
                            ->label($field['desc'])
                            ->required($field['required']);
                        break;

                    case 'date':
                        // Handle untuk tipe 'date' di sini
                        // Misalnya, Anda dapat menggunakan DateInput jika ada
                        $inputField = DatePicker::make($field['nama'])
                            ->label($field['desc'])
                            ->required($field['required']);
                        break;

                    default:
                        // Tipe yang tidak dikenali, mungkin ada penanganan khusus yang diperlukan
                        // Di sini, kita hanya melewatinya
                        continue 2;
                }
                $prasyaratFields[] = $inputField;
            }
        }

        $formulir = $this->layanan->formulir;
        $formFields = [];
        // Cek apakah prasyarat tidak kosong sebelum melakukan iterasi
        if (!empty($formulir)) {
            foreach ($formulir as $field) {
                switch ($field['type']) {
                    case 'string':
                        $inputField = TextInput::make($field['nama'])
                            ->label($field['desc'])
                            ->required($field['required']);
                        break;

                    case 'text':
                        $inputField = Textarea::make($field['nama'])
                            ->label($field['desc'])
                            ->required($field['required']);
                        break;

                    case 'image':
                        // Handle untuk tipe 'image' di sini
                        // Misalnya, Anda dapat menggunakan ImageInput jika ada
                        $inputField = FileUpload::make($field['nama'])
                            ->label($field['desc'])
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend(Str::slug('image ' . Date::now() . ' ' . auth()->user()->name . '-')),
                            )
                            ->directory('permohonan/images/')
                            ->required($field['required']);
                        break;

                    case 'file':
                        // Handle untuk tipe 'file' di sini
                        // Misalnya, Anda dapat menggunakan FileInput jika ada
                        $inputField = FileUpload::make($field['nama'])
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend(Str::slug('attachment ' . Date::now() . ' ' . auth()->user()->name . '-')),
                            )
                            ->directory('permohonan/attachments/')
                            ->acceptedFileTypes(['application/pdf'])
                            ->label($field['desc'])
                            ->required($field['required']);
                        break;

                    case 'date':
                        // Handle untuk tipe 'date' di sini
                        // Misalnya, Anda dapat menggunakan DateInput jika ada
                        $inputField = DatePicker::make($field['nama'])
                            ->label($field['desc'])
                            ->required($field['required']);
                        break;

                    default:
                        // Tipe yang tidak dikenali, mungkin ada penanganan khusus yang diperlukan
                        // Di sini, kita hanya melewatinya
                        continue 2;
                }
                $formFields[] = $inputField;
            }
        }

        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Prasyarat')
                        ->description('Prasyarat permohonan untuk dilengkapi')
                        ->schema([
                            Repeater::make('prasyarat')
                                ->schema($prasyaratFields)
                                ->addable(false)
                                ->deletable(false)
                                ->reorderable(false)
                                ->reorderableWithDragAndDrop(false)
                        ]),
                    Wizard\Step::make('Formulir')
                        ->description('Dokumen permohonan untuk dilengkapi')
                        ->schema([
                            Repeater::make('formulir')
                                ->schema($formFields)
                                ->addable(false)
                                ->deletable(false)
                                ->reorderable(false)
                                ->reorderableWithDragAndDrop(false)
                        ]),

                ])->submitAction(
                    new HtmlString(
                        Blade::render(<<<BLADE
                            <x-filament::button
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

    public function create()
    {
        $form = $this->form->getState();

        $permohonan = Permohonan::create([
            'layanan_id' => $this->layanan->id,
            'prasyarat' => $form['prasyarat'],
            'formulir' => $form['formulir']
        ]);

        $status = $permohonan->status()->create([
            'status' => PermohonanStatus::DIKIRIM,
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

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.users.permohonan.create', [
            'layanan' => $this->layanan
        ]);
    }
}
