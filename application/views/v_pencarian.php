<style>
    /* --- VERCEL / NEXT.JS THEME BASE --- */
    :root {
        --nj-primary: #006fee;
        --nj-primary-dark: #004493;
        --nj-primary-light: #e6f1fe;
        --nj-bg-main: #ffffff;
        --nj-bg-subtle: #fafafa;
        --nj-border: #eaeaea;
        --nj-text-main: #0a0a0a;
        --nj-text-muted: #555555;
        --nj-shadow-sm: 0 2px 4px rgba(0,0,0,0.02);
        --nj-shadow-md: 0 4px 14px rgba(0,0,0,0.05);
        --nj-radius-lg: 16px;
        --nj-radius-md: 12px;
        --nj-transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .nj-card {
        background: var(--nj-bg-main);
        border-radius: var(--nj-radius-lg);
        border: 1px solid var(--nj-border);
        box-shadow: var(--nj-shadow-md);
        padding: 32px;
        margin-bottom: 24px;
    }

    .nj-card-header {
        margin-bottom: 24px;
        border-bottom: 1px solid var(--nj-border);
        padding-bottom: 20px;
    }

    /* Font judul diperbesar */
    .nj-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--nj-text-main);
        margin: 0 0 10px 0;
        letter-spacing: -0.3px;
    }

    .nj-subtitle {
        font-size: 1.15rem;
        color: var(--nj-text-muted);
        margin: 0;
        line-height: 1.6;
    }

    /* --- STYLING TABEL BESAR & LEGA --- */
    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }
    .nj-table {
        width: 100%;
        border-collapse: collapse;
    }
    .nj-table th {
        text-align: left;
        padding: 20px;
        border-bottom: 2px solid var(--nj-border);
        color: var(--nj-text-muted);
        font-weight: 600;
        font-size: 1.1rem; /* Font header lebih besar */
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .nj-table td {
        padding: 20px;
        border-bottom: 1px solid var(--nj-border);
        vertical-align: middle;
        font-size: 1.15rem; /* Font data jauh lebih besar */
        color: var(--nj-text-main);
    }
    .nj-table tbody tr {
        transition: var(--nj-transition);
    }
    .nj-table tbody tr:hover {
        background-color: var(--nj-bg-subtle);
    }

    /* --- BADGE & TOMBOL --- */
    .nj-badge {
        background-color: var(--nj-primary-light);
        color: var(--nj-primary);
        padding: 8px 16px;
        border-radius: var(--nj-radius-md);
        font-weight: 700;
        font-size: 1.1rem; /* Font badge membesar */
        display: inline-block;
    }
    .nj-btn-action {
        background-color: #ffffff;
        color: var(--nj-primary);
        border: 1px solid var(--nj-border);
        padding: 10px 20px;
        border-radius: var(--nj-radius-md);
        text-decoration: none !important;
        font-weight: 600;
        font-size: 1.1rem; /* Teks tombol lebih jelas */
        transition: var(--nj-transition);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: var(--nj-shadow-sm);
    }
    .nj-btn-action:hover {
        border-color: var(--nj-primary);
        background-color: var(--nj-primary-light);
        transform: translateY(-2px);
    }

    /* --- EMPTY STATE BESAR --- */
    .nj-empty-state {
        text-align: center;
        padding: 80px 20px;
    }
    .nj-empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
        color: #d1d5db;
    }
    .nj-btn-back {
        background-color: var(--nj-text-main);
        color: #ffffff;
        padding: 12px 28px;
        border-radius: 24px;
        text-decoration: none !important;
        font-weight: 600;
        font-size: 1.1rem;
        display: inline-block;
        margin-top: 24px;
        transition: var(--nj-transition);
    }
    .nj-btn-back:hover {
        background-color: var(--nj-primary);
        color: #ffffff;
        transform: translateY(-2px);
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="nj-card">
            
            <div class="nj-card-header">
                <h3 class="nj-title">Hasil Pencarian 🔍</h3>
                <p class="nj-subtitle">Menampilkan hasil untuk kata kunci: <strong style="color: var(--nj-primary);">"<?= htmlspecialchars($keyword) ?>"</strong></p>
            </div>

            <div class="panel-body" style="padding: 0;">
                <?php if (!empty($hasil_pelanggan)): ?>
                    <div class="table-responsive">
                        <table class="nj-table" id="tabelbiasa">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 25%;">Nama Pelanggan</th>
                                    <th style="width: 25%;">Nomor KWH</th>
                                    <th style="width: 25%;">Alamat</th>
                                    <th style="width: 20%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($hasil_pelanggan as $p): ?>
                                <tr>
                                    <td style="color: var(--nj-text-muted);"><?= $no++ ?></td>
                                    <td style="font-weight: 700; color: #111;"><?= htmlspecialchars($p->nama_pelanggan) ?></td>
                                    <td><span class="nj-badge"><?= htmlspecialchars($p->nomor_kwh) ?></span></td>
                                    <td style="color: #555;"><?= htmlspecialchars($p->alamat) ?></td>
                                    <td style="text-align: center;">
                                        
                                        <a href="<?= base_url('riwayat') ?>" class="nj-btn-action">
                                            <i class="fa fa-history"></i> Cek Riwayat
                                        </a>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="nj-empty-state">
                        <div class="nj-empty-icon"><i class="fa fa-folder-open-o"></i></div>
                        <h4 style="font-size: 1.6rem; font-weight: 700; color: #111; margin-bottom: 12px;">Data Tidak Ditemukan</h4>
                        <p style="color: #666; font-size: 1.15rem; max-width: 500px; margin: 0 auto;">Kami tidak dapat menemukan pelanggan dengan kata kunci <strong>"<?= htmlspecialchars($keyword) ?>"</strong>. Silakan coba dengan nama atau nomor KWH yang lain.</p>
                        <a href="<?= base_url('dashboard') ?>" class="nj-btn-back">Kembali ke Dashboard</a>
                    </div>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</div>

<script>
    // Penyesuaian DataTable agar tidak merusak styling Next.js
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#tabelbiasa')) {
            $('#tabelbiasa').DataTable().destroy();
        }
        $('#tabelbiasa').DataTable({
            "language": {
                "search": "Filter hasil:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang cocok",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)"
            },
            // Menghilangkan garis tepi bawaan Datatables
            "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rt<"row"<"col-sm-6"i><"col-sm-6"p>>'
        });
    });
</script>