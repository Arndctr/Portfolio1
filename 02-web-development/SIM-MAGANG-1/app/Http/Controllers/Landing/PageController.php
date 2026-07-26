<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function informasi()
    {
        return view('landing.informasi');
    }

    public function alur()
    {
        return view('landing.alur');
    }

    public function divisi()
    {
        return view('landing.divisi');
    }

    public function kontak()
    {
        return view('landing.kontak');
    }

    public function success()
    {
        return view('landing.success');
    }
}
