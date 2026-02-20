<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            color: #333;
            background: #fff;
            margin: 0;
            padding: 20px;
        }
        .struk-container {
            max-width: 400px;
            margin: 0 auto;
            border: 1px dashed #333;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 1px dashed #333;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header h3 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0 0; font-size: 12px; }
        
        .content { font-size: 14px; line-height: 1.6; }
        .row-item { display: flex; justify-content: space-between; margin-bottom: 5px; }
        
        .total-section {
            border-top: 1px dashed #333;
            margin-top: 15px;
            padding-top: 10px;
            font-weight: bold;
            font-size: 16px;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            border-top: 1px dashed #333;
            padding-top: 10px;
        }
        
        /* Hilangkan tombol saat dicetak */
        @media print {
            .btn-print { display: none; }
            .struk-container { border: none; }
        }
        
        .btn-print {
            display: block;
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            padding: 10px;
            background: #0070f3;
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="struk-container">
        <div class="header">
            <h3>STRUK PEMBAYARAN LISTRIK</h3>
            <p>Bukti Pembayaran Sah PPOB</p>
        </div>
        
        <div class="content">
            <div class="row-item">
                <span>No. Tagihan</span>
                <span>: #<?= $detail->id_tagihan ?></span>
            </div>
            <div class="row-item">
                <span>Nama Pelanggan</span>
                <span>: <?= $this->session->userdata('nama_pelanggan'); ?></span>
            </div>
            <div class="row-item">
                <span>Periode</span>
                <span>: <?= $detail->bulan ?> <?= $detail->tahun ?></span>
            </div>
            <div class="row-item">
                <span>Meteran Terpakai</span>
                <span>: <?= $detail->jumlah_meter ?> kWh</span>
            </div>
            
            <div style="margin: 15px 0; border-top: 1px dotted #ccc;"></div>
            
            <div class="row-item">
                <span>Status</span>
                <span>: <?= $detail->status ?></span>
            </div>
            
            <?php if(isset($pembayaran)): ?>
            <div class="row-item">
                <span>Tgl Bayar</span>
                <span>: <?= date('d M Y H:i', strtotime($pembayaran->tanggal_pembayaran)) ?></span>
            </div>
            
            <div class="row-item total-section">
                <span>TOTAL BAYAR</span>
                <span>Rp <?= number_format($pembayaran->total_bayar, 0, ',', '.') ?></span>
            </div>
            <?php else: ?>
            <div class="row-item total-section">
                <span>TOTAL (Estimasi)</span>
                <span>Rp <?= number_format(($detail->jumlah_meter * $detail->terperkwh) + 2500, 0, ',', '.') ?></span>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="footer">
            <p>Terima kasih telah melakukan pembayaran tepat waktu.</p>
            <p>Struk ini dicetak otomatis pada <?= date('d/m/Y H:i') ?></p>
        </div>
    </div>

    <button class="btn-print" onclick="window.print()">🖨️ Cetak Struk Sekarang</button>

    <script>
        // Opsional: Otomatis memunculkan dialog print saat halaman dibuka
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>