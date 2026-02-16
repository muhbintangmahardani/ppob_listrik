<style>
    /* --- STYLE CSS --- */
    .page-title { font-weight: 700; color: #111827; margin-bottom: 24px; font-size: 24px; }
    
    .nj-card {
        background: #ffffff; border-radius: 16px; border: 1px solid #eaeaea;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); padding: 24px; margin-bottom: 30px;
    }

    /* Badges */
    .nj-badge { padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; }
    .nj-badge-info { background: #eff6ff; color: #3b82f6; border: 1px solid #dbeafe; } 
    .nj-badge-success { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .nj-badge-warning { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
    .nj-badge-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

    /* Buttons */
    .nj-btn { display: inline-flex; align-items: center; justify-content: center; padding: 6px 12px; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s ease; border: 1px solid transparent; cursor: pointer; gap: 6px; text-decoration: none !important; color: white; }
    .nj-btn-primary { background: #0070f3; border-color: #0070f3; }
    .nj-btn-primary:hover { background: #0051a8; }
    .nj-btn-danger { background: #ef4444; border-color: #ef4444; }
    .nj-btn-danger:hover { background: #dc2626; }
    .nj-btn-secondary { background: #94a3b8; border-color: #94a3b8; cursor: default; }

    .table-modern { width: 100% !important; border-collapse: separate !important; border-spacing: 0 !important; }
    .table-modern thead th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 13px; text-transform: uppercase; padding: 16px; border-bottom: 1px solid #eaeaea; border-top: 1px solid #eaeaea; }
    .table-modern tbody td { padding: 16px; vertical-align: middle !important; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 14px; }
</style>

<h2 class="page-title"><?= $judul ?></h2>

<div class="row">
    <div class="col-md-12">
        <div class="nj-card">
            
            <div style="margin-bottom: 20px; padding: 15px; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                <h5 style="margin:0; font-size:15px; font-weight:600; color:#475569;">
                    <i class="fa fa-info-circle"></i> Informasi Transaksi
                </h5>
                <p style="margin:5px 0 0 0; font-size:13px; color:#64748b;">
                    Halaman ini menampilkan seluruh data dari tabel <b>pembayaran</b>.
                </p>
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-modern">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Tagihan</th>
                            <th>Total Bayar</th>
                            <th class="text-center">Metode / Bukti</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(empty($pembayaran)) {
                            echo '<tr><td colspan="8" class="text-center" style="padding: 40px; color:#94a3b8;">Belum ada data pembayaran masuk.</td></tr>';
                        }
                        
                        $no=1; foreach($pembayaran as $row): 
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td style="color: #64748b;">
                                <?= date('d/m/Y', strtotime($row->tanggal_pembayaran)) ?>
                                <br><small><?= date('H:i', strtotime($row->tanggal_pembayaran)) ?></small>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #0f172a;"><?= $row->nama_pelanggan ?? 'Data Pelanggan Kosong' ?></div>
                                <div style="font-size: 12px; color: #64748b;">ID: <?= $row->nomor_kwh ?? '-' ?></div>
                            </td>
                            <td>
                                <?= $row->bulan ?> <?= $row->tahun ?>
                            </td>
                            <td style="font-weight: 700; color: #111827;">
                                Rp <?= number_format($row->total_bayar, 0, ',', '.') ?>
                            </td>

                            <td class="text-center">
                                <?php if($row->bukti == 'MIDTRANS-OTOMATIS'): ?>
                                    <span class="nj-badge nj-badge-info">
                                        <i class="fa fa-bolt" style="margin-right: 4px;"></i> Midtrans
                                    </span>
                                <?php else: ?>
                                    <a href="<?= base_url('assets/bukti/'.$row->bukti) ?>" target="_blank" title="Lihat Bukti">
                                        <img src="<?= base_url('assets/bukti/'.$row->bukti) ?>" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                    </a>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <?php if($row->status_bayar == 'Lunas'): ?>
                                    <span class="nj-badge nj-badge-success">Lunas</span>
                                <?php elseif($row->status_bayar == 'Ditolak'): ?>
                                    <span class="nj-badge nj-badge-danger">Ditolak</span>
                                <?php else: ?>
                                    <span class="nj-badge nj-badge-warning">Perlu Cek</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <?php if($row->status_bayar == 'Lunas'): ?>
                                    <button class="nj-btn nj-btn-secondary" disabled title="Transaksi Selesai">
                                        <i class="fa fa-check-circle"></i> Selesai
                                    </button>
                                <?php elseif($row->status_bayar == 'Ditolak'): ?>
                                    <button class="nj-btn nj-btn-secondary" disabled>
                                        <i class="fa fa-times-circle"></i> Ditolak
                                    </button>
                                <?php else: ?>
                                    <div style="display: flex; gap: 4px; justify-content: center;">
                                        <a href="<?= base_url('admin/proses_konfirmasi/'.$row->id_pembayaran) ?>" class="nj-btn nj-btn-primary" onclick="return confirm('Konfirmasi pembayaran ini LUNAS?')">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        <a href="<?= base_url('admin/tolak_pembayaran/'.$row->id_pembayaran) ?>" class="nj-btn nj-btn-danger" onclick="return confirm('Tolak bukti pembayaran ini?')">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>