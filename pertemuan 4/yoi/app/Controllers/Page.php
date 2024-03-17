<?php namespace App\Controllers;
class Page extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Selamat datang | Mas F',
            'tes' => ['satu', 'dua'. 'tiga']
        ];
        echo view ('layout/header',$data);
        echo view ('pages/home');
        echo view ('layout/footer');
    }
    
    public function about()
    {
        $data = [
            'title' => 'Tentang kami | Anak si',
            'tes' => ['satu', 'dua'. 'tiga']
        ];
        echo view ('layout/header',$data);
        echo view ('pages/about');
        echo view ('layout/footer');
    }

}