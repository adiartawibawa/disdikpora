<?php

namespace App\Livewire\Users\Permohonan;

use App\Models\Layanan;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
                        $inputField = SpatieMediaLibraryFileUpload::make($field['nama'])
                            ->label($field['desc'])
                            ->collection($field['nama'])
                            ->required($field['required']);
                        break;

                    case 'file':
                        // Handle untuk tipe 'file' di sini
                        // Misalnya, Anda dapat menggunakan FileInput jika ada
                        $inputField = FileUpload::make($field['nama'])
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend('attachment-'),
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
                        $inputField = SpatieMediaLibraryFileUpload::make($field['nama'])
                            ->label($field['desc'])
                            ->collection($field['nama'])
                            ->required($field['required']);
                        break;

                    case 'file':
                        // Handle untuk tipe 'file' di sini
                        // Misalnya, Anda dapat menggunakan FileInput jika ada
                        $inputField = FileUpload::make($field['nama'])
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend('attachment-'),
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
                        ->schema($prasyaratFields),
                    Wizard\Step::make('Formulir')
                        ->description('Dokumen permohonan untuk dilengkapi')
                        ->schema($formFields),

                ]),
            ])
            ->statePath('data');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.users.permohonan.create', [
            'layanan' => $this->layanan
        ]);
    }
}
