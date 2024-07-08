<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.css') ?>" type="text/css">
    <title>Login</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center" style="height:100vh">
        <div class="container">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <?php
                    $session = \Config\Services::session();

                    if ($session->getFlashdata('warning')) {
                    ?>
                        <div class="alert alert-warning">
                            <ul>
                                <?php foreach ($session->getFlashdata('warning') as $key => $value) { ?>
                                    <li><?php echo $value; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                    <form method="POST" action="<?= base_url() ?>">
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" name="username" value="<?php if ($session->getFlashdata('username')) echo $session->getFlashdata('username') ?>" class="form-control" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" value="<?php if ($session->getFlashdata('password')) echo $session->getFlashdata('password') ?>" name="password" class="form-control" />
                        </div>

                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/js/bootstrap.js') ?>"></script>
</body>

</html>