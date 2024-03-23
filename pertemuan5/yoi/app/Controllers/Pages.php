<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Unipdu ',
            'tes' => ['satu', 'dua', 'tiga']
        ];
        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Home | Unipdu ',
        ];
        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact | Unipdu ',
            'alamat' => [
                ['tipe' => 'Rumah', 'alamat' => 'Desa Tejo no 28', 'kota' => 'Jombang'],
                ['tipe' => 'Kantor', 'alamat' => 'klampisan Tejo Mojoagung', 'kota' => 'Jombang']
            ]
        ];
        return view('pages/contact', $data);
    }
}