<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Product extends BaseController
{
    private $prouductModel;
    private $validation;

    function __construct()
    {
        $this->prouductModel = new ProductModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Produk',
            'products' => $this->prouductModel->getProducts()
        ];

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/'));
        }

        echo view('layout/header', $data);
        echo view('pages/product', $data);
        echo view('layout/footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Produk'
        ];

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/'));
        }

        echo view('layout/header', $data);
        echo view('pages/product/create');
        echo view('layout/footer');
    }

    public function save()
    {
        $rules = [
            'kode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode harus diisi',
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan harus diisi'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Stok harus diisi',
                    'numeric' => 'Stok harus berupa angka'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('warning', $this->validation->getErrors());
            return redirect()->to(base_url('/product/create'))->withInput();
        }

        $prod = $this->prouductModel->getProductByKode($this->request->getVar('kode'));

        if ($prod) {
            $err[] = 'Kode produk sudah ada';
            session()->setFlashdata('warning', $err);
            return redirect()->to(base_url('/product/create'))->withInput();
        }

        $data = [
            'kode' => $this->request->getVar('kode'),
            'nama' => $this->request->getVar('nama'),
            'satuan' => $this->request->getVar('satuan'),
            'stok' => $this->request->getVar('stok'),
            'harga' => $this->request->getVar('harga')
        ];

        $this->prouductModel->save($data);
        session()->setFlashdata('success', 'Produk berhasil ditambahkan');
        return redirect()->to(base_url('/product'));
    }

    public function edit($id)
    {
        $product = $this->prouductModel->getProductById($id);
        $data = [
            'title' => 'Edit Produk',
            'product' => $product
        ];

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/'));
        }

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        echo view('layout/header', $data);
        echo view('pages/product/edit');
        echo view('layout/footer');
    }

    public function update($id)
    {
        $rules = [
            'kode' => [
                'rules' => 'required|unique',
                'errors' => [
                    'required' => 'Kode harus diisi',
                    'required' => 'Kode harus unik'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan harus diisi'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Stok harus diisi',
                    'numeric' => 'Stok harus berupa angka'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('warning', $this->validation->getErrors());
            return redirect()->to(base_url('/product/edit/' . $id))->withInput();
        }

        $prodOld = $this->prouductModel->getProductById($id);

        if ($this->request->getVar('kode') != $prodOld['kode']) {
            $products = $this->prouductModel->getProducts();

            $productsNew = [];
            foreach ($products as $product) {
                if ($product['kode'] != $prodOld['kode']) {
                    $productsNew[] = $product;
                }
            }

            if (in_array($this->request->getVar('kode'), array_column($productsNew, 'kode'))) {
                $err[] = 'Kode produk sudah ada';
                session()->setFlashdata('warning', $err);
                return redirect()->to(base_url('/product/edit' . $id))->withInput();
            }
        }

        $data = [
            'kode' => $this->request->getVar('kode'),
            'nama' => $this->request->getVar('nama'),
            'satuan' => $this->request->getVar('satuan'),
            'stok' => $this->request->getVar('stok'),
            'harga' => $this->request->getVar('harga')
        ];

        $this->prouductModel->update($id, $data);
        session()->setFlashdata('success', 'Produk berhasil diupdate');
        return redirect()->to(base_url('/product'));
    }

    public function delete($id)
    {
        $this->prouductModel->delete($id);
        session()->setFlashdata('success', 'Produk berhasil dihapus');
        return redirect()->to(base_url('/product'));
    }
}
