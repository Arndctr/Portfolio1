<?php

namespace App\Livewire\Admin\Anggota;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Livewire\Admin\Anggota\Export;

class Guru extends Component
{
    public $search = '';
    public $showModal = false;
    public $isEdit = false;

    public $nama, $status = 'active', $role = 'guru', $nip, $jenis_kelamin, $alamat, $no_telp, $email, $selectedId;
    public $filterStatus = 'semua';
    public $sortField = 'nama';
    public $sortDirection = 'asc';
    public $old_nip;

    protected $rules = [
        'nama'           => 'required',
        'status'         => 'required',
        'nip'            => 'required|numeric',
        'jenis_kelamin'  => 'required',
        'alamat'         => 'required',
    ];

    public function render()
    {
        $anggota = Anggota::where('role', 'guru')
            ->when($this->filterStatus !== 'semua', fn ($q) => $q->where('status', $this->filterStatus))
            ->when($this->search, fn ($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        return view('livewire.admin.anggota.guru', compact('anggota'));
    }

    public function openModal()
    {
        $this->resetInput();
        $this->showModal = true;
        $this->isEdit = false;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate(array_merge($this->rules, [
            'nip' => 'required|numeric|unique:members,nis_nip',
            'email' => 'nullable|email|unique:users,email',
            'no_telp' => 'nullable|numeric|digits_between:10,15',
        ]));

        $plainPassword = Str::random(8);
        $email = $this->email ?: null;

        DB::transaction(function () use ($plainPassword, $email) {
            Anggota::create([
                'nama'           => $this->nama,
                'status'         => $this->status,
                'role'           => $this->role,
                'nis_nip'        => $this->nip,
                'jenis_kelamin'  => $this->jenis_kelamin,
                'alamat'         => $this->alamat,
                'no_telp'        => $this->no_telp,
                'email'          => $email,
                'plain_password' => $plainPassword,
            ]);

            User::create([
                'name'                => $this->nama,
                'nis_nip'             => $this->nip,
                'email'               => $email,
                'password'            => Hash::make($plainPassword),
                'is_default_password' => true,
                'no_telp'             => $this->no_telp,
                'status'              => $this->status,
            ])->assignRole($this->role);
        });

        $this->closeModal();
        $this->dispatch('anggotaUpdated');
    }

    public function edit($id)
    {
        $data = Anggota::findOrFail($id);

        $this->selectedId      = $id;
        $this->nama            = $data->nama;
        $this->status          = $data->status;
        $this->role            = $data->role;
        $this->nip             = $data->nis_nip;
        $this->old_nip         = $data->nis_nip;
        $this->jenis_kelamin   = $data->jenis_kelamin;
        $this->alamat          = $data->alamat;
        $this->no_telp         = $data->no_telp;
        $this->email           = $data->email;
        $this->isEdit          = true;
        $this->showModal       = true;
    }

    public function update()
    {
        $this->validate(array_merge($this->rules, [
            'nip' => 'required|numeric|unique:anggota,nis_nip,' . $this->selectedId,
            'email' => 'nullable|email|unique:users,email,' . optional(User::where('nis_nip', $this->old_nip)->first())->id,
        ]));

        $email = $this->email ?: null;

        if ($this->selectedId) {
            $anggota = Anggota::findOrFail($this->selectedId);
            $anggota->update([
                'nama'          => $this->nama,
                'status'        => $this->status,
                'role'          => $this->role,
                'nis_nip'       => $this->nip,
                'jenis_kelamin' => $this->jenis_kelamin,
                'alamat'        => $this->alamat,
                'no_telp'       => $this->no_telp,
                'email'         => $email,
            ]);

            $user = User::where('nis_nip', $this->old_nip)->first();
            if ($user) {
                $user->update([
                    'name'     => $this->nama,
                    'email'    => $email,
                    'no_telp'  => $this->no_telp,
                    'status'   => $this->status,
                    'nis_nip'  => $this->nip,
                ]);
            }
        }

        $this->closeModal();
        $this->dispatch('anggota-updated');
    }


    public function delete($id)
    {
        $anggota = Anggota::findOrFail($id);

        DB::transaction(function () use ($anggota) {
            $user = User::where('nis_nip', $anggota->nis_nip)->first();
            if ($user) {
                $user->delete();
            }

            $anggota->delete();
        });

        session()->flash('message', 'Anggota dan akun user berhasil dihapus!');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
            $this->sortField = $field;
        }
    }

    public function updatedStatus($value)
    {
        if (!$this->isEdit) return;

        $user = User::where('nis_nip', $this->old_nip)->first();
        if ($user) {
            $user->status = $value;
            $user->save();
        }
    }

    public function exportGuru()
    {
        return Excel::download(
            new Export('guru', $this->filterStatus, null, $this->search),
            'data-guru-terfilter.xlsx'
        );
    }

    private function resetInput()
    {
        $this->nama           = '';
        $this->status         = 'active';
        $this->nip            = '';
        $this->jenis_kelamin  = '';
        $this->alamat         = '';
        $this->no_telp        = '';
        $this->email          = '';
        $this->selectedId     = null;
        $this->role           = 'guru';
    }
}
