<?php

namespace App\Livewire\Admin\Anggota;

use Livewire\Component;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    public $anggota;

    public $anggotaId;
    public $isEdit = false;
    public $showModal = false;

    public $search = '';
    public $roleFilter = null;

    public $nama, $status = '', $role = '', $kelas = '';
    public $jenis_kelamin = '';
    public $alamat, $no_telp, $email;
    public $nis, $nip;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function mount()
    {
        if (request()->routeIs('anggota.siswa')) {
            $this->roleFilter = 'siswa';
        } elseif (request()->routeIs('anggota.guru')) {
            $this->roleFilter = 'guru';
        }
    }

    public function render()
    {
        $query = Anggota::query()
            ->when($this->roleFilter, fn($q) => $q->where('role', $this->roleFilter))
            ->where(function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nis_nip', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });

        $this->anggota = $query->get();

        return view('livewire.admin.anggota.index')->layout('layouts.app');
    }

    protected function rules()
    {
        $rules = [
            'nama'           => 'required|string|max:255',
            'status'         => 'required|in:active,inactive',
            'role'           => 'required|in:siswa,guru',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'required|string|max:255',
        ];

        $uniqueNisRule = 'unique:members,nis_nip';
        if ($this->anggotaId) {
            $uniqueNisRule .= ',' . $this->anggotaId;
        }

        if ($this->role === 'siswa') {
            $rules['nis']   = ['required', 'numeric', $uniqueNisRule];
            $rules['kelas'] = 'required|in:7,8,9';
        }

        if ($this->role === 'guru') {
            $rules['nip'] = ['required', 'numeric', $uniqueNisRule];
        }

        return $rules;
    }

    public function store()
    {
        $this->validate();
        $plainPassword = Str::random(8);
        $nis_nip = $this->role === 'siswa' ? $this->nis : $this->nip;

        DB::transaction(function () use ($plainPassword, $nis_nip) {
            Anggota::create([
                'nama'           => $this->nama,
                'status'         => $this->status,
                'role'           => $this->role,
                'nis_nip'        => $nis_nip,
                'kelas'          => $this->role === 'siswa' ? $this->kelas : null,
                'jenis_kelamin'  => $this->jenis_kelamin,
                'alamat'         => $this->alamat,
                'no_telp'        => $this->no_telp,
                'email'          => $this->email,
                'plain_password' => $plainPassword,
            ]);

            $user = User::create([
                'name'               => $this->nama,
                'nis_nip'            => $nis_nip,
                'email'              => $this->email,
                'password'           => Hash::make($plainPassword),
                'is_default_password'=> true,
                'no_telp'            => $this->no_telp,
            ]);

            $user->assignRole($this->role);
        });

        session()->flash('message', 'Anggota berhasil ditambahkan!');
        $this->resetForm();
        $this->closeModal();
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        $this->anggotaId      = $anggota->id;
        $this->nama           = $anggota->nama;
        $this->status         = $anggota->status;
        $this->role           = $anggota->role;
        $this->nis            = $anggota->role === 'siswa' ? $anggota->nis_nip : '';
        $this->nip            = $anggota->role === 'guru' ? $anggota->nis_nip : '';
        $this->kelas          = $anggota->kelas;
        $this->jenis_kelamin  = $anggota->jenis_kelamin;
        $this->alamat         = $anggota->alamat;
        $this->no_telp        = $anggota->no_telp;
        $this->email          = $anggota->email;

        $this->isEdit         = true;
        $this->showModal      = true;
    }

    public function update()
    {
        $this->validate();

        $anggota = Anggota::findOrFail($this->anggotaId);
        $nis_nip = $this->role === 'siswa' ? $this->nis : $this->nip;

        $anggota->update([
            'nama'          => $this->nama,
            'status'        => $this->status,
            'role'          => $this->role,
            'nis_nip'       => $nis_nip,
            'kelas'         => $this->role === 'siswa' ? $this->kelas : null,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat'        => $this->alamat,
            'no_telp'       => $this->no_telp,
            'email'         => $this->email,
        ]);

        session()->flash('message', 'Anggota berhasil diperbarui!');
        $this->resetForm();
        $this->closeModal();

        $this->emit('anggotaUpdated');
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

    public function resetForm()
    {
        $this->anggotaId      = null;
        $this->isEdit         = false;

        $this->nama           = '';
        $this->status         = '';
        $this->role           = '';
        $this->kelas          = '';
        $this->nis            = '';
        $this->nip            = '';
        $this->jenis_kelamin  = '';
        $this->alamat         = '';
        $this->no_telp        = '';
        $this->email          = '';
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
