<?php
require_once 'api.php';
$api = new Api();
$response = $api->services();
$services = $response['services'] ?? [];

$grouped = [];
foreach ($services as $service) {
    $grouped[$service['category']][] = $service;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Vibe Builder - Panel Sosial Media</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #c62828;
            padding: 0.75rem 1.5rem;
        }
        .navbar-brand {
            font-size: 1.6rem;
            font-weight: bold;
            color: #fff;
            letter-spacing: 1px;
        }
        .card {
            background-color: #1e1e1e;
            border: 1px solid #c62828;
        }
        .card-header {
            background-color: #c62828;
            color: #fff;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .form-control {
            background-color: #2c2c2c;
            color: #fff;
            border: 1px solid #444;
        }
        .form-control::placeholder {
            color: #aaa;
        }
        .btn-success {
            background-color: #43a047;
            border: none;
        }
        .btn-success:hover {
            background-color: #388e3c;
        }
        .table th, .table td {
            vertical-align: middle;
            color: #fff;
        }
        .footer {
            margin-top: 80px;
            padding: 30px 0;
            background-color: #1a1a1a;
            text-align: center;
            color: #888;
            font-size: 0.9rem;
        }
        .payment-info {
            background-color: #1e1e1e;
            border-left: 5px solid #c62828;
            padding: 1rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <span class="navbar-brand">Vibe Builder</span>
</nav>

<div class="container mt-4">

    <div class="payment-info">
        <h5 class="text-danger">💰 Pembayaran</h5>
        <p>Silakan transfer pembayaran ke salah satu metode berikut:</p>
        <ul>
            <li><strong>DANA / GoPay:</strong> 082252179691</li>
            <li><strong>Nama:</strong> Mufid Maulana</li>
        </ul>
        <p>Setelah transfer, pesanan akan diproses otomatis.</p>
        <p>Butuh bantuan? Hubungi admin di <a href="https://t.me/gumwg" class="text-info">@gumwg</a></p>
    </div>

    <h2 class="mb-4 text-center">🛍️ Daftar Layanan</h2>

    <?php foreach ($grouped as $category => $items): ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-header"><?= htmlspecialchars($category) ?></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Layanan</th>
                                <th>Harga/1K</th>
                                <th>Min</th>
                                <th>Max</th>
                                <th>Deskripsi</th>
                                <th>Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($items as $srv): ?>
                            <tr>
                                <td><?= htmlspecialchars($srv['name']) ?></td>
                                <td>Rp<?= number_format($srv['price']) ?></td>
                                <td><?= $srv['min'] ?></td>
                                <td><?= $srv['max'] ?></td>
                                <td><?= htmlspecialchars($srv['description']) ?></td>
                                <td style="min-width: 250px;">
                                    <form action="order.php" method="post" class="d-flex flex-column gap-1">
                                        <input type="hidden" name="service" value="<?= $srv['id'] ?>">
                                        <input type="text" name="target" class="form-control form-control-sm" placeholder="Username / Link" required>
                                        <input type="number" name="quantity" class="form-control form-control-sm" placeholder="Jumlah (<?= $srv['min'] ?> - <?= $srv['max'] ?>)" min="<?= $srv['min'] ?>" max="<?= $srv['max'] ?>" required>
                                        <button type="submit" class="btn btn-success btn-sm">Pesan</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="footer">
    &copy; <?= date('Y') ?> Vibe Builder • All rights reserved.
</div>

</body>
</html>
