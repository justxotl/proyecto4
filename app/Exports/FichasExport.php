<?php

namespace App\Exports;

use App\Models\Ficha;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class FichasExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithEvents
{
    protected $fichas;

    public function __construct()
    {
        $this->fichas = Ficha::with(['autor', 'carrera'])->get(); // Relación corregida
    }

    public function collection()
    {
        return $this->fichas;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Título',
            'Carrera',
            'Cédulas de Autores',
            'Nombres de Autores',
            'Apellidos de Autores',
        ];
    }

    public function map($ficha): array
    {
        $cedulas = $ficha->autor->pluck('ci_autor')->implode("\n");
        $nombres = $ficha->autor->pluck('nombre_autor')->implode("\n");
        $apellidos = $ficha->autor->pluck('apellido_autor')->implode("\n");

        return [
            $ficha->id,
            $ficha->fecha,
            $ficha->titulo,
            $ficha->carrera->nombre ?? '',
            $cedulas,
            $nombres,
            $apellidos,
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

                // Insertar filas para encabezado
                $sheet->insertNewRowBefore(1, 4);

                $drawing = new Drawing();
                $drawing->setName('Logo');
                $drawing->setDescription('Logo Universidad de Oriente');
                $drawing->setPath(public_path('images/LogoUDO.png'));
                $drawing->setHeight(65);
                $drawing->setCoordinates('A1');
                $drawing->setOffsetX(0);
                $drawing->setOffsetY(0);
                $drawing->setWorksheet($sheet);

                $sheet->mergeCells('B1:G1')->setCellValue('B1', 'Universidad de Oriente — Núcleo Bolívar');
                $sheet->mergeCells('B2:G2')->setCellValue('B2', 'Ciudad Bolívar, Estado Bolívar, ' . date('d/m/Y'));
                $sheet->mergeCells('B3:G3')->setCellValue('B3', 'Listado de Fichas Bibliográficas');

                foreach ([1, 2, 3] as $row) {
                    $sheet->getStyle("B{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("B{$row}")->getFont()->setBold(true);
                }

                // Estilo del encabezado de la tabla
                $sheet->getStyle('A5:G5')->applyFromArray([
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

                // Bordes, alineación vertical y salto de línea
                $sheet->getStyle("A6:G{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_TOP,
                        'wrapText' => true,
                    ],
                ]);

                $sheet->setAutoFilter("A5:G5");

                for ($row = 6; $row <= $lastRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle("A{$row}:G{$row}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'cadae8'],
                            ],
                        ]);
                    }

                    $sheet->getRowDimension($row)->setRowHeight(-1);
                }

                $sheet->getColumnDimension('C')->setAutoSize(false);
                $sheet->getColumnDimension('C')->setWidth(60);

                $sheet->getStyle("C6:C{$lastRow}")->getAlignment()->setWrapText(true);
                $sheet->getStyle("B6:B{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("E6:E{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            }
        ];
    }
}
