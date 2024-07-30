<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
{
    protected $startDate;
    protected $endDate;
    protected $search;

    public function __construct($startDate, $endDate, $search)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->search = $search;
    }

    public function collection()
    {
        $query = Order::with('menu');

        if ($this->startDate && $this->endDate) {
            $endDate = $this->endDate . ' 23:59:59';
            $query->whereBetween('created_at', [$this->startDate, $endDate]);
        }

        if ($this->search) {
            $query->whereHas('menu', function($q) {
                $q->where('nama_menu', 'like', "%{$this->search}%");
            });
        }

        $orders = $query->get();

        $totalQuantity = $orders->sum('jumlah_pesanan');
        $totalRevenue = $orders->sum(function($order) {
            return $order->jumlah_pesanan * $order->menu->harga_menu;
        });

        $data = $orders->map(function($order) {
            $totalHarga = $order->jumlah_pesanan * $order->menu->harga_menu; // Hitung total harga

            return [
                $order->id,
                $order->menu->nama_menu,
                $order->jumlah_pesanan,
                number_format($order->menu->harga_menu, 0, '.', ','), // Format harga satuan
                number_format($totalHarga, 0, '.', ','), // Format total harga
                $order->created_at->format('d-m-Y H:i:s'),
                $order->catatan_pesanan,
            ];
        })->toArray();

        // Menambahkan baris total di akhir data
        $data[] = [
            'TOTAL',
            '',
            $totalQuantity,
            '',
            number_format($totalRevenue, 0, '.', ','), // Format total revenue
            '',
            ''
        ];

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Menu',
            'Jumlah Pesanan',
            'Harga Satuan',
            'Total Harga',
            'Tanggal Pesanan',
            'Catatan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $sheet->getStyle('A:G')->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ]);

        // Set automatic column width
        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Style baris total
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A{$lastRow}:G{$lastRow}")->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'D' => '#,##0', // Format harga satuan dengan ribuan pemisah
            'E' => '#,##0', // Format total harga dengan ribuan pemisah
            'F' => 'dd-mm-yyyy hh:mm:ss', // Format tanggal
        ];
    }
}

