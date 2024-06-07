<?php 
namespace App\Controllers;
class page extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Selamat datang | Unipdu Press',
            'tes' => ['Satu, dua, tiga']
        ];

        return view ('page/home', $data);
        
    }
    
    public function about()
    {
        $data= [
            'title' => 'Tentang kami | Unipdu Press',
        ];
        
        return view ('page/about', $data);
        
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact | Unipdu Press',
            'alamat' => [
                ['tipe' => 'Rumah', 
                'alamat' => 'Desa Klampisan no 28', 
                'kota' => 'Jombang'],
                ['tipe' => 'Kantor', 
                'alamat' => 'Desa Klampisan Tejo Mojoagung', 
                'kota' => 'Jombang']
            ]
        ];
        return view('page/contact', $data);
    }
}