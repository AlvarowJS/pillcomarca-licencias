<?php

namespace App\Exports;

use App\Models\Negocio;
use App\Models\Administrado;
use App\Models\Categoria;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Events\AfterSheet;

class NegociosExport implements FromArray, WithTitle, WithEvents
{
    protected $negocio;
    protected $administrado;
    protected $categoria;

    public function __construct($negocio)
    {
        $this->negocio = $negocio;
        $this->administrado = Administrado::find($negocio->administrado_id);
        $this->categoria = Categoria::find($negocio->actividad_economica_id);
    }

    public function array(): array
    {
        return [];
    }

    public function title(): string
    {
        return 'Datos del Negocio';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Configurar las celdas según los campos
                $sheet->setCellValue('D7', $this->negocio->ruc);
                $sheet->setCellValue('G7', $this->negocio->razonsocial);
                $sheet->setCellValue('V7', $this->negocio->ruc);
                $sheet->setCellValue('D12', $this->negocio->lugar);
                $sheet->setCellValue('G12', $this->negocio->direccion);
                $sheet->setCellValue('S12', $this->negocio->manzana);
                $sheet->setCellValue('U12', $this->negocio->lote);
                $sheet->setCellValue('W12', $this->administrado->numero);
                $sheet->setCellValue('D15', $this->negocio->nombrenegocio);
                $sheet->setCellValue('W15', $this->negocio->metroscuadrados);
                $sheet->setCellValue('D20', $this->negocio->actividad_economica->nombre);
                $sheet->setCellValue('J20', $this->categoria->nombrecategoria);

                // Asignar valores a las nuevas celdas
                $sheet->setCellValue('E23', $this->negocio->nExpediente);
                $sheet->setCellValue('E26', date('d', strtotime($this->negocio->fecha)));
                $sheet->setCellValue('F26', date('m', strtotime($this->negocio->fecha)));
                $sheet->setCellValue('G26', date('Y', strtotime($this->negocio->fecha)));

                $sheet->setCellValue('R23', date('d', strtotime($this->negocio->fecha)));
                $sheet->setCellValue('Z23', date('Y', strtotime($this->negocio->fecha)));

                $mesNumerico = date('m', strtotime($this->negocio->fecha));
                $meses = [
                    '01' => 'enero',
                    '02' => 'febrero',
                    '03' => 'marzo',
                    '04' => 'abril',
                    '05' => 'mayo',
                    '06' => 'junio',
                    '07' => 'julio',
                    '08' => 'agosto',
                    '09' => 'septiembre',
                    '10' => 'octubre',
                    '11' => 'noviembre',
                    '12' => 'diciembre',
                ];
                $nombreMes = $meses[$mesNumerico];

                // Asignar el nombre del mes en la celda T23
                $sheet->setCellValue('T23', $nombreMes);

                // Combinar las celdas según lo solicitado
                $sheet->mergeCells('E23:I25');

               
                $sheet->mergeCells('G26:I26');
                $sheet->mergeCells('T23:V23');
                $sheet->mergeCells('D7:F8');
                $sheet->mergeCells('G7:R8');
                $sheet->mergeCells('V7:Z8');
                $sheet->mergeCells('D12:F13');
                $sheet->mergeCells('G12:Q13');
                $sheet->mergeCells('S12:S13');
                $sheet->mergeCells('U12:U13');
                $sheet->mergeCells('W12:Z13');
                $sheet->mergeCells('D15:R17');
                $sheet->mergeCells('W15:Z17');
                $sheet->mergeCells('D20:F21');
                $sheet->mergeCells('J20:Q21');
                $sheet->mergeCells('C7:C27');
                

                // Establecer el tamaño de las columnas
                $sheet->mergeCells('D7:F8');
                $sheet->mergeCells('G7:R8');
                $sheet->mergeCells('V7:Z8');
                $sheet->mergeCells('D12:F13');
                $sheet->mergeCells('G12:Q13');
                $sheet->mergeCells('S12:S13');
                $sheet->mergeCells('U12:U13');
                $sheet->mergeCells('W12:Z13');
                $sheet->mergeCells('D15:R17');
                $sheet->mergeCells('W15:Z17');
                $sheet->mergeCells('D20:F21');
                $sheet->mergeCells('J20:Q21');
                $sheet->mergeCells('C7:C27');
               
                

                // Establecer el tamaño de las columnas
                $sheet->getColumnDimension('A')->setWidth(0.00);
                $sheet->getColumnDimension('B')->setWidth(0.00);
                $sheet->getColumnDimension('D')->setWidth(2.34);
                $sheet->getColumnDimension('C')->setWidth(0.00);
                $sheet->getColumnDimension('E')->setWidth(4.34);
                $sheet->getColumnDimension('F')->setWidth(5.34);
                $sheet->getColumnDimension('G')->setWidth(3.34);
                $sheet->getColumnDimension('H')->setWidth(0.00);
                $sheet->getColumnDimension('I')->setWidth(5.11);
                $sheet->getColumnDimension('J')->setWidth(6.10);
                $sheet->getColumnDimension('K')->setWidth(4.89);
                $sheet->getColumnDimension('L')->setWidth(4.34);
                $sheet->getColumnDimension('M')->setWidth(7.00);
                $sheet->getColumnDimension('N')->setWidth(4.34);
                $sheet->getColumnDimension('O')->setWidth(4.89);
                $sheet->getColumnDimension('P')->setWidth(4.67);
                $sheet->getColumnDimension('Q')->setWidth(2.00);
                $sheet->getColumnDimension('R')->setWidth(8.22); //7
                $sheet->getColumnDimension('S')->setWidth(6.00);
                $sheet->getColumnDimension('T')->setWidth(4.89);
                $sheet->getColumnDimension('U')->setWidth(4.00);
                $sheet->getColumnDimension('V')->setWidth(5.56);
                $sheet->getColumnDimension('W')->setWidth(3.67);
                $sheet->getColumnDimension('X')->setWidth(3.89);
                $sheet->getColumnDimension('Y')->setWidth(3.45);
                $sheet->getColumnDimension('Z')->setWidth(8.11);
                $sheet->getColumnDimension('AA')->setWidth(3.56);
                 // Establecer el tamaño de las filas según las indicaciones
                 $sheet->getRowDimension(2)->setRowHeight(15.00);
                 $sheet->getRowDimension(3)->setRowHeight(6.60);
                 $sheet->getRowDimension(4)->setRowHeight(6.66);
                 $sheet->getRowDimension(5)->setRowHeight(10.20);
                 $sheet->getRowDimension(6)->setRowHeight(27.00);
                 $sheet->getRowDimension(7)->setRowHeight(18.60);
                 $sheet->getRowDimension(8)->setRowHeight(13.20);
                 $sheet->getRowDimension(9)->setRowHeight(10.20);
                 $sheet->getRowDimension(10)->setRowHeight(9.00);
                 $sheet->getRowDimension(11)->setRowHeight(25.50);
                 $sheet->getRowDimension(12)->setRowHeight(14.40);
                 $sheet->getRowDimension(13)->setRowHeight(16.20);
                 $sheet->getRowDimension(14)->setRowHeight(22.60);
                 $sheet->getRowDimension(15)->setRowHeight(16.80);
                 $sheet->getRowDimension(16)->setRowHeight(12.60);
                 $sheet->getRowDimension(17)->setRowHeight(12.00);
                 $sheet->getRowDimension(18)->setRowHeight(19.80);
                 $sheet->getRowDimension(19)->setRowHeight(17.00);
                 $sheet->getRowDimension(20)->setRowHeight(10.20);
                 $sheet->getRowDimension(21)->setRowHeight(15.00);
                 $sheet->getRowDimension(22)->setRowHeight(40.80);
                 $sheet->getRowDimension(23)->setRowHeight(12.60);
                 $sheet->getRowDimension(24)->setRowHeight(3.00);
                 $sheet->getRowDimension(25)->setRowHeight(13.80);
                 $sheet->getRowDimension(26)->setRowHeight(16.80);    

                // Establecer el tamaño de las filas
                $sheet->getRowDimension(2)->setRowHeight(15.00);
                // (resto de dimensiones de filas...)

                // Estilos de fuente y alineación general
                $sheet->getStyle('B7:Z30')->applyFromArray([
                    'font' => [
                        'name' => 'Calibri',
                        'size' => 10,
                        'bold' => true,
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Estilo específico para la celda D15
                $sheet->getStyle('B15')->applyFromArray([
                    'font' => [
                        'name' => 'Engravers MT',
                        'size' => 9,
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Márgenes personalizados para la impresión
                $sheet->getPageMargins()->setTop(2);       // Parte superior
                $sheet->getPageMargins()->setHeader(0);      // Encabezado
                $sheet->getPageMargins()->setRight(0.2);     // Derecho
                $sheet->getPageMargins()->setFooter(0);      // Pie de página
                $sheet->getPageMargins()->setBottom(0);      // Inferior
                $sheet->getPageMargins()->setLeft(0.3);        // Izquierdo

                // Centrar horizontalmente la página al imprimir
                $sheet->getPageSetup()->setHorizontalCentered(true);

                $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LEGAL);
                $sheet->getStyle('W12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('V7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('S12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('U12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('G26')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('R23')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('T23')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('Z23')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            },
        ];
    }
}
