<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Batch;
use App\Models\Peserta;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class Daftar extends Component
{
    use WithFileUploads;

    private const CACHE_KEY = 'landing.daftar.batch-data';
    private const CACHE_TTL = 300;

    public $touched = [];

    public $activeBatch;
    public $currentBatch;
    public $upcomingBatch;
    public $expiredBatch;
    public $registrationStatus = 'closed';
    public $participantCount = 0;

    public $nama, $email, $whatsapp, $universitas, $prodi, $sosial_media, $usaha_bisnis;
    public $jenis_magang, $jenis_magang_lainnya;
    public $durasi_magang, $durasi_magang_lainnya;
    public $cv, $khs, $bukti_follow, $portfolio, $foto;
    public $fotoPreview, $buktiFollowPreview;
    public $periode_mulai, $periode_selesai;
    public $divisi1, $divisi2;

    public function mount()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            $today = Carbon::today();
            $currentBatch = Batch::with('divisi')->withCount('peserta')->active()->first();
            $activeBatch = $currentBatch && !$currentBatch->isQuotaFull()
                ? $currentBatch
                : null;
            $upcomingBatch = null;
            $expiredBatch = null;
            $registrationStatus = 'closed';

            if ($activeBatch) {
                $registrationStatus = 'open';
            } elseif ($currentBatch && $currentBatch->isQuotaFull()) {
                $registrationStatus = 'quota_full';
            } elseif (!$currentBatch) {
                $upcomingBatch = Batch::where('tanggal_mulai', '>', $today)
                    ->orderBy('tanggal_mulai', 'asc')
                    ->first();

                if ($upcomingBatch) {
                    $registrationStatus = 'upcoming';
                } else {
                    $expiredBatch = Batch::where('tanggal_selesai', '<', $today)
                        ->orderBy('tanggal_selesai', 'desc')
                        ->first();
                }
            }

            return [
                'activeBatch' => $activeBatch,
                'currentBatch' => $currentBatch,
                'upcomingBatch' => $upcomingBatch,
                'expiredBatch' => $expiredBatch,
                'registrationStatus' => $registrationStatus,
                'participantCount' => $currentBatch?->peserta_count ?? 0,
            ];
        });

        $this->activeBatch = $data['activeBatch'];
        $this->currentBatch = $data['currentBatch'];
        $this->upcomingBatch = $data['upcomingBatch'];
        $this->expiredBatch = $data['expiredBatch'];
        $this->registrationStatus = $data['registrationStatus'];
        $this->participantCount = $data['participantCount'];
    }

    
    public function updated($propertyName)
    {
        // Tandai field sudah disentuh
        $this->touched[$propertyName] = true;

        $fieldRules = [
            'nama'         => ['required', 'regex:/^[a-zA-Z\s]*$/', 'max:255'],
            'email'        => ['required', 'email:rfc,dns', 'max:255'],
            'whatsapp'     => ['required', 'numeric', 'digits_between:10,15'],
            'universitas'  => ['required', 'regex:/^[a-zA-Z\s]*$/', 'max:255'],
            'prodi'        => ['required', 'regex:/^[a-zA-Z\s]*$/', 'max:255'],
            'sosial_media' => ['required', 'string', 'max:255'],
            'usaha_bisnis' => ['nullable', 'string', 'max:255'],

            'jenis_magang' => ['required', 'string'],
            'jenis_magang_lainnya' => ['required_if:jenis_magang,Lainnya'],

            'durasi_magang' => ['required', 'string'],
            'durasi_magang_lainnya' => ['required_if:durasi_magang,Lainnya'],

            'periode_mulai'   => ['required', 'date'],
            'periode_selesai' => ['required', 'date', 'after_or_equal:periode_mulai'],

            'divisi1' => ['required', 'exists:divisi,id'],

            'portfolio' => ['nullable', 'url'],

            // REDESIGN RULES: Menggunakan mimes dan extensions untuk keamanan ganda
            'foto'         => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'cv'           => ['required', 'file',  'mimes:pdf', 'extensions:pdf', 'max:5120'],
            'khs'          => ['required', 'file',  'mimes:pdf', 'extensions:pdf', 'max:5120'],
            'bukti_follow' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];

        // Skip jika field tidak punya rules
        if (!array_key_exists($propertyName, $fieldRules)) {
            return;
        }

        // REDESIGN LOGIC: Bersihkan error bag sebelum validasi ulang
        $this->resetValidation($propertyName);

        // Khusus upload file: Pastikan objek adalah instance TemporaryUploadedFile sebelum divalidasi
        $fileFields = ['foto', 'cv', 'khs', 'bukti_follow'];
        if (in_array($propertyName, $fileFields)) {
            if ($this->$propertyName === null) {
                // Biarkan validasi required menangkap jika file dihapus/kosong
                $this->validateOnly($propertyName, [$propertyName => $fieldRules[$propertyName]], $this->validationMessages());
                return;
            }

            if (!($this->$propertyName instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)) {
                // Sedang dalam proses upload, jangan validasi dulu
                return;
            }
        }

        try {
            // Validasi hanya field yang berubah
            $this->validateOnly(
                $propertyName,
                [$propertyName => $fieldRules[$propertyName]],
                $this->validationMessages()
            );

            // GENERATE BASE64 PREVIEW
            if ($propertyName === 'foto' && $this->foto instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                try {
                    if (str_starts_with($this->foto->getMimeType(), 'image/')) {
                        $this->fotoPreview = 'data:' . $this->foto->getMimeType() . ';base64,' . base64_encode(file_get_contents($this->foto->getRealPath()));
                    } else {
                        $this->fotoPreview = null;
                    }
                } catch (\Throwable $e) {
                    $this->fotoPreview = null;
                }
            }

            if ($propertyName === 'bukti_follow' && $this->bukti_follow instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                try {
                    if (str_starts_with($this->bukti_follow->getMimeType(), 'image/')) {
                        $this->buktiFollowPreview = 'data:' . $this->bukti_follow->getMimeType() . ';base64,' . base64_encode(file_get_contents($this->bukti_follow->getRealPath()));
                    } else {
                        $this->buktiFollowPreview = null;
                    }
                } catch (\Throwable $e) {
                    $this->buktiFollowPreview = null;
                }
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Reset preview jika validasi gagal
            if ($propertyName === 'foto') $this->fotoPreview = null;
            if ($propertyName === 'bukti_follow') $this->buktiFollowPreview = null;
            
            // JANGAN null-kan properti. Biarkan objek "salah" tetap ada di state
            // agar input di browser tetap sinkron dan tidak blank.
            throw $e;
        } catch (\Throwable $e) {
            \Log::error('Realtime validation error: ' . $e->getMessage());
        }
    }

    // Pesan error terpusat — digunakan oleh updated() dan simpan()
    // agar pesan konsisten di kedua tempat.
    private function validationMessages(): array
    {
        return [
            'nama.required'        => 'Nama lengkap wajib diisi.',
            'nama.regex'           => 'Nama hanya boleh berisi huruf dan spasi.',
            'email.required'       => 'Email wajib diisi.',
            'email.email'          => 'Format email tidak valid (contoh: nama@domain.com).',
            'whatsapp.required'    => 'Nomor WhatsApp wajib diisi.',
            'whatsapp.numeric'     => 'Nomor WhatsApp hanya boleh berisi angka.',
            'whatsapp.digits_between' => 'Nomor WhatsApp harus antara 10 sampai 15 digit.',
            'universitas.required' => 'Nama perguruan tinggi wajib diisi.',
            'universitas.regex'    => 'Nama universitas hanya boleh berisi huruf dan spasi.',
            'prodi.required'       => 'Program studi wajib diisi.',
            'prodi.regex'          => 'Nama program studi hanya boleh berisi huruf dan spasi.',
            'sosial_media.required'=> 'Akun sosial media wajib diisi.',
            'jenis_magang.required'=> 'Program magang wajib dipilih.',
            'jenis_magang_lainnya.required_if' => 'Silakan sebutkan program magang Anda.',
            'durasi_magang.required'           => 'Durasi magang wajib dipilih.',
            'durasi_magang_lainnya.required_if'=> 'Silakan sebutkan durasi magang Anda.',
            'periode_mulai.required'  => 'Tanggal mulai wajib diisi.',
            'periode_mulai.date'      => 'Format tanggal mulai tidak valid.',
            'periode_selesai.required'=> 'Tanggal selesai wajib diisi.',
            'periode_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
            'divisi1.required'     => 'Pilihan divisi utama wajib dipilih.',
            'divisi1.exists'       => 'Divisi yang dipilih tidak valid.',
            'divisi2.different'    => 'Divisi 2 harus berbeda dari Divisi 1.',
            'portfolio.url'        => 'Link portofolio harus berupa URL valid (awali dengan https://).',

            // Pesan file upload — spesifik dan informatif
            'foto.required'        => 'Foto formal wajib diunggah.',
            'foto.image'           => 'File foto harus berupa gambar (bukan PDF atau dokumen).',
            'foto.mimes'           => 'Format foto tidak didukung. Gunakan JPG atau PNG.',
            'foto.max'             => 'Ukuran foto terlalu besar. Maksimal 2MB.',

            'cv.required'          => 'File CV wajib diunggah.',
            'cv.file'              => 'CV harus berupa file yang valid.',
            'cv.mimes'             => 'Format CV tidak didukung. Gunakan file PDF.',
            'cv.max'               => 'Ukuran file CV terlalu besar. Maksimal 5MB.',

            'khs.required'         => 'File KHS wajib diunggah.',
            'khs.file'             => 'KHS harus berupa file yang valid.',
            'khs.mimes'            => 'Format KHS tidak didukung. Gunakan file PDF.',
            'khs.max'              => 'Ukuran file KHS terlalu besar. Maksimal 5MB.',

            'bukti_follow.required'=> 'Screenshot bukti follow Instagram wajib diunggah.',
            'bukti_follow.image'   => 'Bukti follow harus berupa gambar (bukan PDF atau dokumen).',
            'bukti_follow.mimes'   => 'Format bukti follow tidak didukung. Gunakan JPG atau PNG.',
            'bukti_follow.max'     => 'Ukuran screenshot terlalu besar. Maksimal 2MB.',
        ];
    }

    
    public function simpan()
    {
        if (!$this->activeBatch) {
            if ($this->currentBatch && $this->currentBatch->isQuotaFull()) {
                session()->flash('error', 'Pendaftaran ditutup karena kuota penuh.');
            } else {
                session()->flash('error', 'Pendaftaran belum dibuka.');
            }
            return;
        }

        $this->validate([
            'nama'         => 'required|regex:/^[a-zA-Z\s]*$/|max:255',
            'email'        => 'required|email:rfc,dns|max:255',
            'whatsapp'     => 'required|numeric|digits_between:10,15',
            'universitas'  => 'required|regex:/^[a-zA-Z\s]*$/|max:255',
            'prodi'        => 'required|regex:/^[a-zA-Z\s]*$/|max:255',
            'sosial_media' => 'required|string|max:255',
            'usaha_bisnis' => 'nullable|string|max:255',
            'jenis_magang' => 'required|string',
            'jenis_magang_lainnya'  => 'required_if:jenis_magang,Lainnya',
            'durasi_magang'         => 'required|string',
            'durasi_magang_lainnya' => 'required_if:durasi_magang,Lainnya',
            'periode_mulai'   => 'required|date',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
            'divisi1'         => 'required|exists:divisi,id',
            'divisi2'         => 'nullable|exists:divisi,id|different:divisi1',
            'cv'              => 'required|file|mimes:pdf|max:5120',
            'khs'             => 'required|file|mimes:pdf|max:5120',
            'bukti_follow'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'portfolio'       => 'nullable|url',
            'foto'            => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], $this->validationMessages());

        $exists = Peserta::where('batch_id', $this->activeBatch->id)
            ->where('email', $this->email)
            ->where('nama', $this->nama)
            ->where('universitas', $this->universitas)
            ->exists();

        if ($exists) {
            $this->addError('pendaftaran_duplikat', 'Anda sudah terdaftar pada batch magang yang sedang berlangsung.');
            return;
        }

        try {
            $cvPath    = $this->cv->store('pendaftaran/cv', 'public');
            $khsPath   = $this->khs->store('pendaftaran/khs', 'public');
            $buktiPath = $this->bukti_follow->store('pendaftaran/bukti_follow', 'public');
            $fotoPath  = $this->foto->store('pendaftaran/foto', 'public');

            $finalJenisMagang  = $this->jenis_magang  === 'Lainnya' ? $this->jenis_magang_lainnya  : $this->jenis_magang;
            $finalDurasiMagang = $this->durasi_magang === 'Lainnya' ? $this->durasi_magang_lainnya : $this->durasi_magang;

            Peserta::create([
                'batch_id'      => $this->activeBatch->id,
                'nama'          => $this->nama,
                'email'         => $this->email,
                'whatsapp'      => $this->whatsapp,
                'universitas'   => $this->universitas,
                'prodi'         => $this->prodi,
                'sosial_media'  => $this->sosial_media,
                'usaha_bisnis'  => $this->usaha_bisnis,
                'jenis_magang'  => $finalJenisMagang,
                'durasi_magang' => $finalDurasiMagang,
                'cv'            => $cvPath,
                'khs'           => $khsPath,
                'bukti_follow'  => $buktiPath,
                'foto'          => $fotoPath,
                'portfolio'     => $this->portfolio,
                'periode_mulai'   => $this->periode_mulai,
                'periode_selesai' => $this->periode_selesai,
                'divisi1'       => $this->divisi1,
                'divisi2'       => $this->divisi2,
                'status'        => 'menunggu',
            ]);

            Cache::forget(self::CACHE_KEY);
            Cache::forget('landing.home.batch-data');
            Cache::forget('landing.active-batch');

            session()->flash('success', 'Pendaftaran Anda berhasil dikirim!');
            $this->reset([
                'nama', 'email', 'whatsapp', 'universitas', 'prodi',
                'sosial_media', 'usaha_bisnis',
                'jenis_magang', 'jenis_magang_lainnya',
                'durasi_magang', 'durasi_magang_lainnya',
                'cv', 'khs', 'bukti_follow', 'portfolio', 'foto',
                'fotoPreview', 'buktiFollowPreview',
                'periode_mulai', 'periode_selesai', 'divisi1', 'divisi2',
            ]);
            return redirect()->route('daftar.success');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.landing.daftar', [
            'divisiList'         => $this->activeBatch ? $this->activeBatch->divisi : collect(),
            'currentBatch'       => $this->currentBatch,
            'activeBatch'        => $this->activeBatch,
            'registrationStatus' => $this->registrationStatus,
            'participantCount'   => $this->participantCount,
            // FIX: tambahkan kedua variabel ini agar blade tidak
            // throw "Undefined variable" saat status upcoming/closed
            'upcomingBatch'      => $this->upcomingBatch,
            'expiredBatch'       => $this->expiredBatch,
        ])->layout('layouts.landing');
    }
}
