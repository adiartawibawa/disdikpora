<?php

namespace App\Livewire\Components\Stats;

use App\Models\Sekolah;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;

class GrafikSekolah extends Component
{

    public $types = ['paud', 'tk', 'sd', 'smp'];
    public $colors = [
        'paud' => '#f6ad55',
        'tk' => '#fc8181',
        'sd' => '#90cdf4',
        'smp' => '#66DA26'
    ];

    public $firstRun = true;

    public $showDataLabels = false;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
        'onBlockClick' => 'handleOnBlockClick',
    ];

    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }

    public function handleOnColumnClick($column)
    {
        dd($column);
    }

    public function handleOnBlockClick($block)
    {
        dd($block);
    }

    public function render()
    {
        $sekolah = Sekolah::whereIn('jenjang', $this->types)->get();

        $pieChartModel = $sekolah->groupBy('jenjang')
            ->reduce(
                function ($pieChartModel, $data) {
                    $type = $data->first()->jenjang;
                    $value = $data->count();

                    return $pieChartModel->addSlice(\Str::upper($type), $value, $this->colors[$type]);
                },
                LivewireCharts::pieChartModel()
                    //->setTitle('Expenses by Type')
                    ->setAnimated($this->firstRun)
                    ->setType('donut')
                    ->withOnSliceClickEvent('onSliceClick')
                    //->withoutLegend()
                    ->legendPositionBottom()
                    ->legendHorizontallyAlignedCenter()
                    ->setDataLabelsEnabled($this->showDataLabels)
                    ->setColors($this->colors)
            );

        $this->firstRun = false;

        return view('livewire.components.stats.grafik-sekolah')->with([
            'pieChartModel' => $pieChartModel
        ]);
    }
}
