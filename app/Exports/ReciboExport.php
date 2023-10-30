<?php

namespace App\Exports;

use App\Models\recibos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReciboExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('administrador.estadisticas.exportRecibos',[
            'recibos' => recibos::all()
        ]);
    }
}
