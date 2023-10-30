<?php

namespace App\Exports;

use App\Models\tours;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ToursExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('administrador.estadisticas.exportTours',[
            'tours' => Tours::all()
        ]);
    }
}
