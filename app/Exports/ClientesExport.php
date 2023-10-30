<?php

namespace App\Exports;

use App\Models\clientes;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// class ClientesExport implements FromCollection
class ClientesExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return clientes::all();
    // }
    public function view(): View
    {
        return view('administrador.estadisticas.exportClientes',[
            'clientes' => Clientes::all()
        ]);
    }
}
