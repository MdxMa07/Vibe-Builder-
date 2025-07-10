<?php
require_once 'api.php';
$api = new Api();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order = $api->order([
        'service' => $_POST['service'],
        'target' => $_POST['target'],
        'quantity' => $_POST['quantity'],
    ]);
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Pesanan Anda - Vibe Builder</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #121212;
                color: #ffffff;
                font-family: 'Segoe UI', sans-serif;
            }
            .btn-primary {
                background-color: #c62828;
                border: none;
            }
            .alert {
                margin-top: 50px;
            }
        </style>
    </head>
    <body class="p-4">
        <div class="container text-center">
            <?php if ($order['status']): ?>
                <div class="alert alert-success">
                    ✅ <strong>Pesanan berhasil dibuat!</strong><br>ID Pesanan Anda: <strong>#<?= $order['order'] ?></strong>
                    <p class="mt-3">Silakan lakukan pembayaran ke:<br>
                        <strong>DANA / GoPay: 082252179691<br>a.n. Mufid Maulana</strong></p>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">
                    ❌ <strong>Gagal:</strong> <?= $order['msg'] ?>
                </div>
            <?php endif; ?>
            <a href="index.php" class="btn btn-primary mt-3">← Kembali ke Daftar Layanan</a>
        </div>
    </body>
    </html>
    <?php
}
?>
