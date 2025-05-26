<?php


namespace App\Exports;

use App\Models\Prestamo;
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

class PrestamoExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithEvents
{
    protected $prestamos;

    public function __construct()
    {
        $this->prestamos = Prestamo::with('ficha')->get();
    }

    public function collection()
    {
        return $this->prestamos;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Ficha ID',
            'Título',
            'CI del Prestatario',
            'Nombre',
            'Apellido',
            'Teléfono',
            'Fecha de Préstamo',
            'Fecha de Devolución',
            'Fecha de Entrega',
            'Estado'
        ];
    }

    public function map($prestamo): array
    {
        return [
            $prestamo->id,
            $prestamo->ficha_id,
            $prestamo->ficha->titulo ?? 'N/A',
            $prestamo->ci_prestatario,
            $prestamo->nombre_prestatario,
            $prestamo->apellido_prestatario,
            $prestamo->tlf_prestatario,
            $prestamo->fecha_prestamo,
            $prestamo->fecha_devolucion,
            $prestamo->fecha_entrega ?? '—',
            ucfirst($prestamo->estado),
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

                $sheet->mergeCells('B1:K1')->setCellValue('B1', 'Universidad de Oriente — Núcleo Bolívar');
                $sheet->mergeCells('B2:K2')->setCellValue('B2', 'Ciudad Bolívar, Estado Bolívar, ' . date('d/m/Y'));
                $sheet->mergeCells('B3:K3')->setCellValue('B3', 'Listado de Préstamos');

                foreach ([1, 2, 3] as $row) {
                    $sheet->getStyle("B{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("B{$row}")->getFont()->setBold(true);
                }

                // Encabezado
                $sheet->getStyle('A5:K5')->applyFromArray([
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

                $sheet->getStyle("A6:K{$lastRow}")->applyFromArray([
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

                $sheet->setAutoFilter("A5:K5");

                for ($row = 6; $row <= $lastRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle("A{$row}:K{$row}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'cadae8'],
                            ],
                        ]);
                    }

                    $sheet->getRowDimension($row)->setRowHeight(-1);
                }

                
                $sheet->getColumnDimension('C')->setAutoSize(false);
                $sheet->getColumnDimension('C')->setWidth(50);
                
                $columnsToAutosize = ['D', 'E', 'F', 'G', 'H', 'I', 'J'];
                foreach ($columnsToAutosize as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
                
                $sheet->getStyle("B6:B{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("D6:J{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }
}
