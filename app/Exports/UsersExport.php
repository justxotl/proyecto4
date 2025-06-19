<?php

namespace App\Exports;

use App\Models\User;
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

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithEvents
{
    private $contador = 1;

    public function collection()
    {
        return User::with(['infoper', 'roles'])->get();
    }

    public function headings(): array
    {
        return [

            '#',
            'Nombre de Usuario',
            'Cédula',
            'Nombre',
            'Apellido',
            'Correo Electrónico',
            'Rol',
        ];
    }

    public function map($user): array
    {
        return [
            $this->contador++,
            $user->name,
            $user->infoper->ci_us,
            $user->infoper->nombre,
            $user->infoper->apellido,
            $user->email,
            $user->roles->pluck('name')->implode(', '),
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
                $drawing->setCoordinates('A1'); // Ahora sí, A1 está disponible
                $drawing->setOffsetX(0);
                $drawing->setOffsetY(0);
                $drawing->setWorksheet($sheet); // Este paso es importante
                
                $sheet->mergeCells('B1:G1')->setCellValue('B1', 'Universidad de Oriente — Núcleo Bolívar');
                $sheet->mergeCells('B2:G2')->setCellValue('B2', 'Ciudad Bolívar, Estado Bolívar, ' . date('d/m/Y'));
                $sheet->mergeCells('B3:G3')->setCellValue('B3', 'Listado de Usuarios Registrados');
                
                foreach ([1, 2, 3] as $row) {
                    $sheet->getStyle("B{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("B{$row}")->getFont()->setBold(true);
                }
                
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
                
                $sheet->getStyle("A6:G{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']],
                    ],
                ]);

                $sheet->setAutoFilter("A5:G5");

                for ($row = 6; $row <= $lastRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle("A{$row}:G{$row}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'cadae8'], // azul claro suave
                            ],
                        ]);
                    }
                }
            },
        ];
    }
}
