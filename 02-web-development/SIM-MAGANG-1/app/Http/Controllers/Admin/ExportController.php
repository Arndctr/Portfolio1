<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Batch;
use App\Exports\PesertaExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportExcel(Request $request)
    {
        $batch_id = $request->query('batch_id');
        $filename = "data_peserta_magang";

        if ($batch_id && $batch_id !== 'all') {
            $batch = Batch::find($batch_id);
            if ($batch) {
                $filename .= "_" . str_replace(' ', '_', strtolower($batch->nama_batch));
            }
        } else {
            $filename .= "_semua_batch";
        }

        $filename .= "_" . date('d_m_Y_Hi') . ".xlsx";

        return Excel::download(new PesertaExport($batch_id), $filename);
    }
}
