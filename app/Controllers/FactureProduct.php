<?php

namespace App\Controllers;

use App\Models\FactureProductModel;
use App\Models\FactureModel;
use App\Models\ProductModel;

class FactureProduct extends BaseController
{
    private $factureProductModel;
    private $factureModel;
    private $productModel;
    private $validation;

    function __construct()
    {
        $this->factureProductModel = new FactureProductModel();
        $this->factureModel = new FactureModel();
        $this->productModel = new ProductModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('product'));
        }
        return view('login');
    }

    public function add($facture_id)
    {
        $data = [
            'title' => 'Tambah Faktur Produk',
            'facture_id' => $facture_id,
            'products' => $this->productModel->getReadyProducts(),
        ];

        if (!$this->factureModel->getFactureById($facture_id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/'));
        }

        echo view('layout/header', $data);
        echo view('pages/factureProduct/create', $data);
        echo view('layout/footer');
    }

    public function save()
    {
        $rules = [
            'facture_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Faktur harus diisi.'
                ]
            ],
            'product_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Produk harus diisi.'
                ]
            ],
            'jumlah_produk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah produk harus diisi.',
                    'numeric' => 'Jumlah produk harus berupa angka.'
                ]
            ],
        ];
        $data = [
            'facture_id' => $this->request->getPost('facture_id'),
            'product_id' => $this->request->getPost('product_id'),
            'jumlah_produk' => $this->request->getPost('jumlah_produk'),
        ];

        $factureProducts = $this->factureProductModel->getProductsByFactureId($data['facture_id']);
        $product = $this->productModel->getProductById($data['product_id']);



        if (!$this->validate($rules)) {
            return redirect()->to(base_url('/facture/' . $data['facture_id'] . '/product/add'))->withInput()->with('warning', $this->validation->getErrors());
        }

        // if (in_array($data['product_id'], array_column($factureProducts, 'product_id'))) {
        //     $searchFP = $factureProducts[array_search($data['product_id'], array_column($factureProducts, 'product_id'))];

        //     if ($searchFP['jumlah_produk'] > $data['jumlah_produk']) {
        //         $stokChange = $searchFP['jumlah_produk'] - $data['jumlah_produk'];
        //         $dataUp = [
        //             'stok' => $product['stok'] + $stokChange,
        //         ];
        //         $this->productModel->update($product['id'], $dataUp);
        //     } else {
        //         $stokChange = $data['jumlah_produk'] + $searchFP['jumlah_produk'];
        //         $dataUp = [
        //             'stok' => $product['stok'] - $stokChange,
        //         ];
        //         $this->productModel->update($product['id'], $dataUp);
        //     }

        //     $this->factureProductModel->update($searchFP['id'], $data);
        //     return redirect()->to(base_url('/facture/detail/' . $data['facture_id']))->with('success', 'Produk berhasil ditambahkan.');
        // } else {
        // }

        if (in_array($data['product_id'], array_column($factureProducts, 'product_id'))) {
            $err[] = 'Produk sudah ada.';
            return redirect()->to(base_url('/facture/' . $data['facture_id'] . '/product/add'))->withInput()->with('warning', $err);
        }
        $dataUp = [
            'stok' => $this->productModel->getProductById($data['product_id'])['stok'] - $data['jumlah_produk'],
        ];

        $this->productModel->update($product['id'], $dataUp);
        $this->factureProductModel->save($data);
        return redirect()->to(base_url('/facture/detail/' . $data['facture_id']))->with('success', 'Produk berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $dataFP = $this->factureProductModel->getFactureProductById($id);
        $product = $this->productModel->getProductById($dataFP['product_id']);
        $data = [
            'stok' => $product['stok'] + $dataFP['jumlah_produk'],
        ];
        $this->productModel->update($product['id'], $data);
        $this->factureProductModel->delete($id);
        return redirect()->to(base_url('/facture/detail/' . $dataFP['facture_id']))->with('success', 'Produk berhasil dihapus.');
    }
}
