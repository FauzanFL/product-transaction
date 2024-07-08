<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.css') ?>" type="text/css">
    <title> <?= $title; ?> | Product Transaction</title>

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <header class="bg-light shadow-sm sticky-top d-flex justify-content-between align-items-center no-print">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg no-print">
            <div class="container-fluid">
                <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarExample01">
                    <div class="fw-bolder fs-3 me-3"><?= session()->get('username') ?></div>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/product') ?>">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/facture') ?>">Faktur</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="m-2">
            <form method="post" action="<?= base_url('/logout') ?>">
                <button type="submit" class="btn-danger rounded no-print">Logout</button>
            </form>
        </div>
    </header>