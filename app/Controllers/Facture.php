<?php

namespace App\Controllers;

use App\Models\FactureModel;
use App\Models\FactureProductModel;

class Facture extends BaseController
{
    private $factureModel;
    private $factureProductModel;
    private $validation;

    function __construct()
    {
        $this->factureModel = new FactureModel();
        $this->factureProductModel = new FactureProductModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Produk',
            'factures' => $this->factureModel->getFactures()
        ];

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/'));
        }

        echo view('layout/header', $data);
        echo view('pages/facture', $data);
        echo view('layout/footer');
    }

    public function detail($id)
    {
        $facture = $this->factureModel->getFactureById($id);
        $facture['products'] = $this->factureProductModel->getProductsByFactureId($id);
        $data = [
            'title' => 'Detail Faktur',
            'facture' => $facture
        ];

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/'));
        }

        if (!$facture) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        echo view('layout/header', $data);
        echo view('pages/facture/detail', $data);
        echo view('layout/footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Buat Faktur'
        ];

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/'));
        }

        echo view('layout/header', $data);
        echo view('pages/facture/create');
        echo view('layout/footer');
    }

    public function save()
    {
        $rules = [
            'no_faktur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor faktur harus diisi'
                ]
            ],
            'tujuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tujuan harus diisi'
                ]
            ],
            'penerima' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penerima harus diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi'
                ]
            ],
            'tempat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat harus diisi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Harga harus diisi',
                    'valid_date' => 'Tanggal tidak valid'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('warning', $this->validation->getErrors());
            return redirect()->to(base_url('/facture/create'))->withInput();
        }

        $facture = $this->factureModel->getFactureByNoFaktur($this->request->getVar('no_faktur'));

        if ($facture) {
            $err[] = 'Nomor faktur sudah ada';
            session()->setFlashdata('warning', $err);
            return redirect()->to(base_url('/facture/create'))->withInput();
        }

        $userId = (int) session()->get('id');

        $data = [
            'no_faktur' => $this->request->getVar('no_faktur'),
            'tujuan' => $this->request->getVar('tujuan'),
            'user_id' => $userId,
            'penerima' => $this->request->getVar('penerima'),
            'alamat' => $this->request->getVar('alamat'),
            'tempat' => $this->request->getVar('tempat'),
            'tanggal' => $this->request->getVar('tanggal')
        ];

        $this->factureModel->save($data);
        session()->setFlashdata('success', 'Faktur berhasil dibuat');
        return redirect()->to(base_url('/facture'));
    }

    public function edit($id)
    {
        $facture = $this->factureModel->getFactureById($id);
        $data = [
            'title' => 'Edit Faktur',
            'facture' => $facture
        ];

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/'));
        }

        if (!$facture) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        echo view('layout/header', $data);
        echo view('pages/facture/edit', $data);
        echo view('layout/footer');
    }

    public function update($id)
    {
        $rules = [
            'no_faktur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor faktur harus diisi'
                ]
            ],
            'tujuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tujuan harus diisi'
                ]
            ],
            'penerima' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penerima harus diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi'
                ]
            ],
            'tempat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat harus diisi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Harga harus diisi',
                    'valid_date' => 'Tanggal tidak valid'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('warning', $this->validation->getErrors());
            return redirect()->to(base_url('/facture/edit/' . $id))->withInput();
        }

        $factureOld = $this->factureModel->getFactureById($id);

        if ($this->request->getVar('no_faktur') != $factureOld['no_faktur']) {
            $factures = $this->factureModel->getFactures();

            $facturesNew = [];
            foreach ($factures as $facture) {
                if ($facture['no_faktur'] != $factureOld['no_faktur']) {
                    $facturesNew[] = $facture;
                }
            }

            if (in_array($this->request->getVar('no_faktur'), array_column($facturesNew, 'no_faktur'))) {
                $err[] = 'Nomor faktur sudah ada';
                session()->setFlashdata('warning', $err);
                return redirect()->to(base_url('/facture/edit/' . $id))->withInput();
            }
        }

        $userId = (int) session()->get('id');

        $data = [
            'no_faktur' => $this->request->getVar('no_faktur'),
            'tujuan' => $this->request->getVar('tujuan'),
            'user_id' => $userId,
            'penerima' => $this->request->getVar('penerima'),
            'alamat' => $this->request->getVar('alamat'),
            'tempat' => $this->request->getVar('tempat'),
            'tanggal' => $this->request->getVar('tanggal')
        ];

        $this->factureModel->update($id, $data);
        session()->setFlashdata('success', 'Faktur berhasil diupdate');
        return redirect()->to(base_url('/facture'));
    }

    public function delete($id)
    {
        $this->factureModel->delete($id);
        session()->setFlashdata('success', 'Faktur berhasil dihapus');
        return redirect()->to(base_url('/facture'));
    }
}
