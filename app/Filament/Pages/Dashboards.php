<?php

namespace App\Filament\Pages;

use App\Filament\Resources\GuruTendikKebutuhanResource\Widgets\StatusKebutuhanOverview;
use App\Filament\Resources\GuruTendikResource\Widgets\PtkChartOverview;
use App\Filament\Resources\SekolahResource\Widgets\PetaSekolahOverview;
use App\Filament\Widgets\TenancyInfoWidget;
use App\Models\SekolahBentuk;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    public function getHeaderWidgetsColumns(): int|string|array
    {
        return 2;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
            TenancyInfoWidget::class,
            StatusKebutuhanOverview::class,
            PetaSekolahOverview::class,
            PtkChartOverview::class,
        ];
    }
}
