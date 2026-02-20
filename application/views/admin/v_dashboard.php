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
        --nj-text-muted: #555555; /* Sedikit digelapkan agar kontrasnya lebih baik */
        --nj-success: #17c964;
        --nj-danger: #f31260;
        --nj-warning: #f5a524;
        --nj-shadow-sm: 0 2px 4px rgba(0,0,0,0.02);
        --nj-shadow-md: 0 4px 14px rgba(0,0,0,0.05);
        --nj-shadow-lg: 0 12px 30px rgba(0,0,0,0.08);
        --nj-radius-xl: 24px;
        --nj-radius-lg: 16px;
        --nj-radius-md: 12px;
        --nj-transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .nj-dashboard {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        padding-bottom: 40px;
        min-height: 80vh;
        color: var(--nj-text-main);
    }

    /* Flexbox Row System */
    .nj-row-flex { display: flex; flex-wrap: wrap; }
    .nj-row-flex > [class*='col-'] { display: flex; flex-direction: column; margin-bottom: 24px; }

    /* --- STANDARD CARDS --- */
    .nj-card {
        background: var(--nj-bg-main);
        border-radius: var(--nj-radius-lg);
        border: 1px solid var(--nj-border);
        box-shadow: var(--nj-shadow-md);
        transition: var(--nj-transition);
        padding: 32px;
        flex: 1;
        position: relative;
        overflow: hidden;
    }
    .nj-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--nj-shadow-lg);
        border-color: #d4d4d8;
    }
    
    /* --- HERO CARD (GRADIENT BLUE) --- */
    .nj-card-hero {
        background: linear-gradient(135deg, #002244 0%, var(--nj-primary) 100%);
        color: white;
        border: none;
        padding: 48px 40px;
        box-shadow: 0 12px 35px 0 rgba(0, 111, 238, 0.2);
        border-radius: var(--nj-radius-xl);
    }
    .nj-card-hero:hover { transform: translateY(-2px); box-shadow: 0 15px 40px 0 rgba(0, 111, 238, 0.3); }
    /* Font diperbesar */
    .nj-card-hero .nj-title { color: white; font-size: 2.5rem; font-weight: 800; margin-bottom: 16px; line-height: 1.3; letter-spacing: -0.5px; }
    .nj-card-hero .nj-subtitle { color: rgba(255,255,255,0.9); font-size: 1.2rem; line-height: 1.6; font-weight: 400; }

    /* --- TYPOGRAPHY & HEADERS --- */
    .nj-card-header { margin-bottom: 32px; border-bottom: 1px solid var(--nj-border); padding-bottom: 20px; }
    /* Font diperbesar */
    .nj-title { font-size: 1.65rem; font-weight: 700; color: var(--nj-text-main); margin: 0 0 10px 0; letter-spacing: -0.3px; }
    .nj-subtitle { font-size: 1.05rem; color: var(--nj-text-muted); margin: 0; line-height: 1.6; }
    
    /* --- METRICS & ICONS --- */
    .nj-metric { display: flex; align-items: center; }
    .nj-metric-col { display: flex; flex-direction: column; align-items: flex-start; }
    
    .nj-icon {
        width: 68px; height: 68px; border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 32px; margin-right: 24px; flex-shrink: 0;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .nj-card:hover .nj-icon { transform: scale(1.08) rotate(-4deg); }
    
    /* Icon Colors */
    .nj-icon-blue { background: var(--nj-primary-light); color: var(--nj-primary); }
    .nj-icon-green { background: #e8f9f0; color: var(--nj-success); }
    .nj-icon-red { background: #fee7ef; color: var(--nj-danger); }
    .nj-icon-purple { background: #f4e8ff; color: #9353d3; }
    .nj-icon-orange { background: #fef0d7; color: var(--nj-warning); }
    
    .nj-info { display: flex; flex-direction: column; width: 100%; }
    /* Font diperbesar */
    .nj-number { font-size: 2.1rem; font-weight: 800; color: var(--nj-text-main); line-height: 1.2; letter-spacing: -0.5px; }
    .nj-label { font-size: 0.95rem; color: var(--nj-text-muted); font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }

    /* --- QUICK ACTIONS --- */
    /* Font diperbesar */
    .nj-section-title { font-size: 1.3rem; font-weight: 700; color: var(--nj-text-main); margin-bottom: 16px; margin-top: 12px; }
    .nj-quick-action-card {
        background: var(--nj-bg-main);
        border-radius: var(--nj-radius-md);
        border: 1px solid var(--nj-border);
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 18px;
        cursor: pointer;
        text-decoration: none !important;
        color: var(--nj-text-main);
        transition: var(--nj-transition);
        box-shadow: var(--nj-shadow-sm);
        height: 100%;
    }
    .nj-quick-action-card:hover {
        transform: translateY(-3px);
        border-color: var(--nj-primary);
        box-shadow: var(--nj-shadow-md);
    }
    .nj-quick-action-icon {
        width: 50px; height: 50px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; flex-shrink: 0;
        transition: transform 0.3s ease;
    }
    .nj-quick-action-card:hover .nj-quick-action-icon { transform: scale(1.1); }
    /* Font diperbesar */
    .nj-quick-action-text { font-weight: 600; font-size: 1.1rem; line-height: 1.4; color: var(--nj-text-main); }
    .nj-quick-action-card:hover .nj-quick-action-text { color: var(--nj-primary); }

    /* --- HIGHLIGHT BOX --- */
    .nj-highlight-box {
        background: var(--nj-bg-subtle);
        padding: 24px 30px;
        border-radius: var(--nj-radius-lg);
        border: 1px solid var(--nj-border);
        height: 100%;
        display: flex;
        align-items: center;
        transition: var(--nj-transition);
    }
    .nj-highlight-box:hover { background: #fff; border-color: var(--nj-primary-light); box-shadow: var(--nj-shadow-sm); }

    /* --- ANIMATIONS --- */
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.15s; }
    .delay-3 { animation-delay: 0.25s; }
    .delay-4 { animation-delay: 0.35s; }
    .delay-5 { animation-delay: 0.45s; }
    .delay-6 { animation-delay: 0.55s; }

    /* --- TOAST NOTIFICATION --- */
    .nj-toast-container { position: fixed; top: 32px; right: 32px; z-index: 9999; pointer-events: none; }
    .nj-toast {
        background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--nj-border); box-shadow: var(--nj-shadow-lg);
        border-radius: 14px; padding: 16px 20px; display: flex; align-items: center; gap: 16px;
        transform: translateY(-20px) scale(0.95); opacity: 0; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        pointer-events: auto; min-width: 320px;
    }
    .nj-toast.show { transform: translateY(0) scale(1); opacity: 1; }
    .nj-toast-icon { background: var(--nj-primary-light); color: var(--nj-primary); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
    .nj-toast-text { display: flex; flex-direction: column; }
    .nj-toast-title { font-weight: 700; color: var(--nj-text-main); font-size: 15px; margin-bottom: 4px; }
    .nj-toast-desc { color: var(--nj-text-muted); font-size: 14px; font-weight: 500; }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .nj-card { padding: 24px; }
        .nj-card-hero { padding: 32px 24px; border-radius: var(--nj-radius-lg); }
        .nj-card-hero .nj-title { font-size: 1.9rem; }
        .nj-number { font-size: 1.8rem; }
        .nj-icon { width: 56px; height: 56px; font-size: 26px; margin-right: 16px; border-radius: 12px; }
        .nj-highlight-box { flex-direction: column; align-items: flex-start; text-align: left; }
        .nj-highlight-box .nj-icon { margin-bottom: 16px; margin-right: 0; }
        .nj-toast-container { top: 20px; right: 20px; left: 20px; }
        .nj-toast { min-width: unset; width: 100%; }
    }
</style>

<div class="nj-dashboard">
    
    <div class="row nj-row-flex">
        <div class="col-xs-12 animate-fade-in delay-1">
            <div class="nj-card-hero">
                <h3 class="nj-title">Halo, <?= htmlspecialchars($this->session->userdata('nama_admin')) ?> 👋</h3>
                <p class="nj-subtitle">Selamat bertugas! Berikut adalah ringkasan lalu lintas pembayaran PPOB Listrik Pasca Prabayar saat ini.</p>
            </div>
        </div>
    </div>

    <div class="row nj-row-flex">
        
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-fade-in delay-2">
            <div class="nj-card">
                <div class="nj-metric">
                    <div class="nj-icon nj-icon-blue"><i class="fa fa-calendar-o"></i></div>
                    <div class="nj-info">
                        <span class="nj-label">Tagihan Bulan Ini</span>
                        <span class="nj-number"><?= $DataPembayaran ?> <span style="font-size: 1.1rem; color: var(--nj-text-muted); font-weight: 600;">Data</span></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 animate-fade-in delay-3">
            <div class="nj-card">
                <div class="nj-metric">
                    <div class="nj-icon nj-icon-green"><i class="fa fa-check-circle-o"></i></div>
                    <div class="nj-info">
                        <span class="nj-label">Lunas Bulan Ini</span>
                        <span class="nj-number" style="color: var(--nj-success);"><?= $DataPembayaranLunas ?> <span style="font-size: 1.1rem; color: var(--nj-text-muted); font-weight: 600;">Trx</span></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 animate-fade-in delay-4">
            <div class="nj-card">
                <div class="nj-metric">
                    <div class="nj-icon nj-icon-red"><i class="fa fa-exclamation-circle"></i></div>
                    <div class="nj-info">
                        <span class="nj-label">Belum Lunas Bulan Ini</span>
                        <span class="nj-number" style="color: var(--nj-danger);"><?= $DataPembayaranBelumLunas ?> <span style="font-size: 1.1rem; color: var(--nj-text-muted); font-weight: 600;">Trx</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row animate-fade-in delay-4" style="margin-bottom: 8px;">
        <div class="col-xs-12">
            <h4 class="nj-section-title">Aksi Cepat ⚡</h4>
        </div>
    </div>
    <div class="row nj-row-flex animate-fade-in delay-5">
        
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="<?= base_url('/riwayat') ?>" class="nj-quick-action-card">
                <div class="nj-quick-action-icon nj-icon-blue"><i class="fa fa-history"></i></div>
                <div class="nj-quick-action-text">Riwayat<br>Pembayaran</div>
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="<?= base_url('/penggunaan') ?>" class="nj-quick-action-card">
                <div class="nj-quick-action-icon nj-icon-green"><i class="fa fa-bolt"></i></div>
                <div class="nj-quick-action-text">Penggunaan<br>Listrik</div>
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="<?= base_url('/laporan_pembayaran') ?>" class="nj-quick-action-card">
                <div class="nj-quick-action-icon nj-icon-orange"><i class="fa fa-file-text-o"></i></div>
                <div class="nj-quick-action-text">Generate<br>Laporan</div>
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="<?= base_url('/data_pelanggan') ?>" class="nj-quick-action-card">
                <div class="nj-quick-action-icon nj-icon-purple"><i class="fa fa-users"></i></div>
                <div class="nj-quick-action-text">Kelola Data<br>Pelanggan</div>
            </a>
        </div>

    </div>

    <div class="row nj-row-flex">
        <div class="col-xs-12 animate-fade-in delay-6">
            <div class="nj-card">
                <div class="nj-card-header">
                    <h3 class="nj-title">Akumulasi Seluruh Pembayaran 📊</h3>
                    <p class="nj-subtitle">Data rangkuman performa pembayaran sejak sistem digunakan hingga saat ini.</p>
                </div>

                <div class="row nj-row-flex" style="margin-top: 24px; margin-bottom: -24px;">
                    
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="nj-highlight-box">
                            <div class="nj-icon nj-icon-purple"><i class="fa fa-server"></i></div>
                            <div class="nj-info">
                                <span class="nj-label">Total Keseluruhan Tagihan</span>
                                <span class="nj-number" style="font-size: 2.5rem;"><?= $DataSemuaPembayaran ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="nj-metric nj-metric-col" style="padding: 16px;">
                            <div class="nj-icon nj-icon-green" style="margin-bottom: 16px; width: 56px; height: 56px; font-size: 24px;"><i class="fa fa-check"></i></div>
                            <div class="nj-info">
                                <span class="nj-label">Total Semua Lunas</span>
                                <span class="nj-number"><?= $DataSemuaPembayaranLunas ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="nj-metric nj-metric-col" style="padding: 16px;">
                            <div class="nj-icon nj-icon-orange" style="margin-bottom: 16px; width: 56px; height: 56px; font-size: 24px;"><i class="fa fa-clock-o"></i></div>
                            <div class="nj-info">
                                <span class="nj-label">Total Belum Lunas</span>
                                <span class="nj-number"><?= $DataSemuaPembayaranBelumLunas ?></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<?php if($this->session->flashdata('pesan_sukses') != ''): ?>
<div class="nj-toast-container">
    <div id="njToast" class="nj-toast">
        <div class="nj-toast-icon"><i class="fa fa-check"></i></div>
        <div class="nj-toast-text">
            <span class="nj-toast-title">Aksi Berhasil!</span>
            <span class="nj-toast-desc"><?= $this->session->flashdata('pesan_sukses'); ?></span>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toast = document.getElementById('njToast');
        setTimeout(() => { toast.classList.add('show'); }, 150);
        
        // Menghilang halus setelah 4 detik
        setTimeout(() => { 
            toast.classList.remove('show'); 
            setTimeout(() => { toast.style.display = 'none'; }, 400);
        }, 4000);
    });
</script>
<?php endif; ?>