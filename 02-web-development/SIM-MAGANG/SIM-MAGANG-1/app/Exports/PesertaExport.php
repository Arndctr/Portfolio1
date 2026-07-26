<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PesertaExport implements FromQuery, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $batch_id;
    private $rowNumber = 0;

    public function __construct($batch_id = null)
    {
        $this->batch_id = $batch_id;
    }

    public function query()
    {
        $query = Peserta::with(['batch', 'diterimaDi']);

        if ($this->batch_id && $this->batch_id !== 'all') {
            $query->where('batch_id', $this->batch_id);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Kampus',
            'Divisi Diterima',
            'Status',
            'Batch',
            'Tanggal Daftar',
        ];
    }

    public function map($peserta): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $this->nama_format($peserta->nama),
            $peserta->universitas,
            $peserta->diterimaDi->nama ?? '-',
            ucfirst($peserta->status),
            $peserta->batch->nama_batch ?? '-',
            $peserta->created_at->format('d-m-Y H:i'),
        ];
    }

    private function nama_format($nama)
    {
        return ucwords(strtolower($nama));
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'bottom' => ['borderStyle' => Border::BORDER_THICK],
                ],
            ],
            // Alignment center for No, Status, Batch, Tanggal
            'A' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'E' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'F' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'G' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
        ];
    }
}
