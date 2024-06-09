<?php

namespace App\Controllers;

use App\Models\BooksModel;

class Books extends BaseController
{
    protected $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new BooksModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Buku',
            'buku' => $this->bukuModel->getBuku()
        ];

        return view('books/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Buku',
            'buku' => $this->bukuModel->getBuku($slug)
        ];

        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku' . $slug . 'Tidak ditemukan');
        }

        return view('books/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Buku',
            'validation' => session()->getFlashdata('validation') ?? \config\Services::validation(),
        ];

        return view('books/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[books.judul]',
                'errors' => [
                    'required' => '{field} buku harus diisi',
                    'is_unique'=> '{field} buku sudah dimasukkan'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi',
                ]
            ],
            'sampul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi',
                ]
            ]

        ])
    ) {
        session()->setFlashdata('validation', \Config\Services::validation());
        return redirect()->to('/books/create')->withInput();
            //validation = \config/services::validation();
            //
    }

        
        // $this->request->getVar('judul');

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/books');
    }

    public function delete($id)
    {
        // // Periksa apakah buku dengan ID yang diberikan ada dalam database
        // $buku = $this->bukuModel->find($id);
        // if (!$buku) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku dengan ID ' . $id . ' tidak ditemukan');
        // }

        // Hapus buku dari database
        $this->bukuModel->delete($id);

        // pesan sukses
        session()->setFlashdata('pesan', 'Buku berhasil dihapus');

        // Redirect ke halaman daftar buku
        return redirect()->to('/books');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Data Buku',
            'validation' => \config\services::validation(),
            'buku' => $this->bukuModel->getBuku($slug)
        ];

        return view('books/edit', $data);
    }


    public function update($id)
    {
        //fungsi cek judul buku yang ada
       $bukuLama = $this->bukuModel->getBuku($this->request->getVar('slug'));
       if ($bukuLama['judul'] == $this->request->getVar('judul')){
        $rule_judul = 'required';
       } else {
            $rule_judul = 'required|is_unique[books.judul]';
       }
       //validasi input
       if (!$this->validate([
        'judul' => [
            'rules' => $rule_judul,
            'errors' => [
                'required' => '{field} buku harus di isi',
                'is_unique' => '{field} buku sudah di masukan'
            ]
        ]
       ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/books/edit' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
       }

       $slug = url_title($this->request->getVar('judul'), '-', true);
       $this->bukuModel->save([
        'id' => $id,
        'judul' => $this->request->getVar('judul'),
        'slug' => $slug,
        'penulis' => $this->request->getVar('penulis'),
        'penerbit' => $this->request->getVar('penerbit'),
        'sampul' => $this->request->getVar('sampul')

       ]);

       session()->setFlashdata('pesan', 'Data Berhasil Diubah');

       return redirect()->to('/books');

     
    }



    
}