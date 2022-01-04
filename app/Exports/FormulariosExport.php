<?php

namespace App\Exports;

use App\Models\Formulario;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class FormulariosExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithStyles, ShouldAutoSize
{
    use Exportable;

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'T' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'NOMBRE OPERADOR TURÍSTICO',
            'DEPARTAMENTO',
            'CIUDAD',
            'AUTORIZACION IMAGEN',
            'TIPO ESTABLECIMIENTO',
            'DIRECCION',
            'PAGINA WEB',
            'TELÉFONO',
            'E-MAIL',
            'CATEGORIA',
            'CONOCE EL PROGRAMA',
            'NIT',
            'LOGO',
            'CAMARA DE COMERCIO',
            'RNT',
            'RUT',
            'DOCUMENTO DE IDENTIDAD REPRESENTANTE LEGAL',
            'DESCRIPCIÓN',
            'FECHA',
        ];
    }

    public function map($formulario): array
    {
        return [
            $formulario->id,
            $formulario->nombre,
            $formulario->ciudad->departamento->departamento,
            $formulario->ciudad->Nombre,
            $formulario->autorizacion->nombre,
            $formulario->establecimiento->nombre,
            $formulario->direccion,
            $formulario->pagina,
            $formulario->telefono,
            $formulario->email,
            $formulario->categoria->nombre,
            $formulario->programa->nombre,
            $formulario->nit,
            Storage::url($formulario->logo),
            Storage::url($formulario->registro_camara),
            Storage::url($formulario->registro_nacional_turismo),
            Storage::url($formulario->registro_unico_tributario),
            Storage::url($formulario->documento_identidad),
            $formulario->descripcion,
            Date::dateTimeToExcel($formulario->created_at),
        ];
    }

    public function query()
    {
        return Formulario::query();
    }
}
