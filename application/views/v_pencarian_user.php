<style>
    /* Menggunakan tema Next.js Vercel yang sama */
    :root {
        --nj-primary: #006fee;
        --nj-primary-light: #e6f1fe;
        --nj-bg-main: #ffffff;
        --nj-bg-subtle: #fafafa;
        --nj-border: #eaeaea;
        --nj-text-main: #0a0a0a;
        --nj-text-muted: #555555;
        --nj-shadow-md: 0 4px 14px rgba(0,0,0,0.05);
        --nj-radius-lg: 16px;
        --nj-radius-md: 12px;
    }

    .nj-card { background: var(--nj-bg-main); border-radius: var(--nj-radius-lg); border: 1px solid var(--nj-border); box-shadow: var(--nj-shadow-md); padding: 32px; margin-bottom: 24px; }
    .nj-card-header { margin-bottom: 24px; border-bottom: 1px solid var(--nj-border); padding-bottom: 20px; }
    .nj-title { font-size: 1.8rem; font-weight: 700; color: var(--nj-text-main); margin: 0 0 10px 0; }
    .nj-subtitle { font-size: 1.15rem; color: var(--nj-text-muted); margin: 0; }
    
    .table-responsive { overflow-x: auto; width: 100%; }
    .nj-table { width: 100%; border-collapse: collapse; }
    .nj-table th { text-align: left; padding: 20px; border-bottom: 2px solid var(--nj-border); color: var(--nj-text-muted); font-weight: 600; font-size: 1.1rem; text-transform: uppercase; }
    .nj-table td { padding: 20px; border-bottom: 1px solid var(--nj-border); font-size: 1.15rem; color: var(--nj-text-main); vertical-align: middle; }
    .nj-table tbody tr:hover { background-color: var(--nj-bg-subtle); }
    
    .nj-btn-action { background-color: #ffffff; color: var(--nj-primary); border: 1px solid var(--nj-border); padding: 10px 20px; border-radius: var(--nj-radius-md); font-weight: 600; font-size: 1.1rem; display: inline-flex; align-items: center; gap: 10px; text-decoration: none !important; transition: all 0.2s ease; }
    .nj-btn-action:hover { border-color: var(--nj-primary); background-color: var(--nj-primary-light); transform: translateY(-2px); }

    /* Badge Status Tagihan */
    .nj-badge-success { background-color: #e6fced; color: #17c964; padding: 8px 16px; border-radius: var(--nj-radius-md); font-weight: 700; font-size: 1.1rem; display: inline-block; }
    .nj-badge-danger { background-color: #fee2e2; color: #f31260; padding: 8px 16px; border-radius: var(--nj-radius-md); font-weight: 700; font-size: 1.1rem; display: inline-block; }

    .nj-empty-state { text-align: center; padding: 80px 20px; }
    .nj-empty-icon { font-size: 64px; margin-bottom: 20px; color: #d1d5db; }
    .nj-btn-back { background-color: var(--nj-text-main); color: #ffffff; padding: 12px 28px; border-radius: 24px; text-decoration: none !important; font-weight: 600; font-size: 1.1rem; display: inline-block; margin-top: 24px; }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="nj-card">
            <div class="nj-card-header">
                <h3 class="nj-title">Pencarian Tagihan Saya 🔍</h3>
                <p class="nj-subtitle">Mencari bulan/tahun tagihan dengan kata kunci: <strong style="color: var(--nj-primary);">"<?= htmlspecialchars($keyword) ?>"</strong></p>
            </div>

            <div class="panel-body" style="padding: 0;">
                <?php if (!empty($hasil_tagihan)): ?>
                    <div class="table-responsive">
                        <table class="nj-table" id="tabelbiasa">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bulan & Tahun</th>
                                    <th>Jumlah Meter</th>
                                    <th>Status</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($hasil_tagihan as $t): ?>
                                <tr>
                                    <td style="color: var(--nj-text-muted);"><?= $no++ ?></td>
                                    <td style="font-weight: 700;"><?= htmlspecialchars($t->bulan) ?> <?= htmlspecialchars($t->tahun) ?></td>
                                    <td><?= htmlspecialchars($t->meter_awal) ?> - <?= htmlspecialchars($t->meter_akhir) ?></td>
                                    <td>
                                        <?php if(strtolower($t->status) == 'lunas'): ?>
                                            <span class="nj-badge-success">Lunas</span>
                                        <?php else: ?>
                                            <span class="nj-badge-danger">Belum Bayar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="<?= base_url('tagihan') ?>" class="nj-btn-action">
                                            <i class="fa fa-file-text-o"></i> Lihat Tagihan
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="nj-empty-state">
                        <div class="nj-empty-icon"><i class="fa fa-search-minus"></i></div>
                        <h4 style="font-size: 1.6rem; font-weight: 700; color: #111; margin-bottom: 12px;">Tagihan Tidak Ditemukan</h4>
                        <p style="color: #666; font-size: 1.15rem; max-width: 500px; margin: 0 auto;">Kami tidak menemukan tagihan Anda untuk pencarian <strong>"<?= htmlspecialchars($keyword) ?>"</strong>.</p>
                        <a href="<?= base_url('dashboard') ?>" class="nj-btn-back">Kembali ke Dashboard</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>