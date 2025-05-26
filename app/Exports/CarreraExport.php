<?php

namespace App\Exports;

use App\Models\Carrera;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class CarreraExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    public function collection()
    {
        return Carrera::select(['id', 'nombre'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre de la Carrera',
        ];
    }

    public function map($carrera): array
    {
        return [
            $carrera->id,
            $carrera->nombre,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Calibri')->setSize(12);
        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Insertar espacio para el encabezado
                $sheet->insertNewRowBefore(1, 4);

                // Logo
                $drawing = new Drawing();
                $drawing->setName('Logo');
                $drawing->setDescription('Logo Universidad de Oriente');
                $drawing->setPath(public_path('images/LogoUDO.png'));
                $drawing->setHeight(65);
                $drawing->setCoordinates('A1');
                $drawing->setOffsetX(0);
                $drawing->setOffsetY(0);
                $drawing->setWorksheet($sheet);

                // Encabezados institucionales
                $sheet->mergeCells('B1:C1')->setCellValue('B1', 'Universidad de Oriente — Núcleo Bolívar');
                $sheet->mergeCells('B2:C2')->setCellValue('B2', 'Ciudad Bolívar, Estado Bolívar, ' . date('d/m/Y'));
                $sheet->mergeCells('B3:C3')->setCellValue('B3', 'Listado de Carreras Registradas');

                foreach ([1, 2, 3] as $row) {
                    $sheet->getStyle("B{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("B{$row}")->getFont()->setBold(true);
                }

                // Encabezado de la tabla
                $sheet->mergeCells('B5:C5');
                $sheet->getStyle('A5:C5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '5084b4'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                $lastRow = $sheet->getHighestRow();

                // Filas de datos
                for ($row = 6; $row <= $lastRow; $row++) {
                    $sheet->mergeCells("B{$row}:C{$row}");

                    // Bordes
                    $sheet->getStyle("A{$row}:C{$row}")->applyFromArray([
                        'borders' => [
                            'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']],
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                    ]);

                    // Estilo
                    if ($row % 2 == 0) {
                        $sheet->getStyle("A{$row}:C{$row}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'cadae8'],
                            ],
                        ]);
                    }
                }

                // Autofiltro
                $sheet->setAutoFilter("A5:B5");

                // Anchos de columnas
                $sheet->getColumnDimension('A')->setWidth(10);
                $sheet->getColumnDimension('B')->setWidth(50);
                $sheet->getColumnDimension('C')->setWidth(10);
            },
        ];
    }
}
