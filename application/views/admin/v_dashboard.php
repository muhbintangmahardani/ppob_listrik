<style>
    /* UI Next.js Style Custom CSS - LARGE & RESPONSIVE VERSION */
    .nj-dashboard {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        padding-bottom: 40px;
        min-height: 80vh;
    }

    /* Flexbox Row untuk memastikan tinggi card selalu sejajar */
    .nj-row-flex {
        display: flex;
        flex-wrap: wrap;
    }
    .nj-row-flex > [class*='col-'] {
        display: flex;
        flex-direction: column;
        margin-bottom: 24px;
    }

    .nj-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #eaeaea;
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        padding: 32px;
        flex: 1;
        position: relative;
        overflow: hidden;
    }
    .nj-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px 0 rgba(0, 0, 0, 0.1);
        border-color: #0070f3;
    }
    
    /* Card Khusus Header/Welcome (Lebih Besar) */
    .nj-card-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: white;
        border: none;
        padding: 48px 36px;
        box-shadow: 0 12px 35px 0 rgba(15, 23, 42, 0.3);
    }
    .nj-card-hero:hover {
        transform: scale(1.01);
        border-color: transparent;
    }
    .nj-card-hero .nj-title { color: white; font-size: 2.25rem; font-weight: 700; margin-bottom: 12px; line-height: 1.2;}
    .nj-card-hero .nj-subtitle { color: rgba(255,255,255,0.85); font-size: 1.15rem; line-height: 1.5; }

    .nj-card-header {
        margin-bottom: 28px;
        border-bottom: 2px solid #f3f4f6;
        padding-bottom: 16px;
    }
    .nj-title { font-size: 1.5rem; font-weight: 700; color: #111; margin: 0 0 8px 0; }
    .nj-subtitle { font-size: 1rem; color: #666; margin: 0; }
    
    .nj-metric { display: flex; align-items: center; }
    .nj-metric-col { display: flex; flex-direction: column; align-items: flex-start; }
    
    .nj-icon {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        font-size: 32px;
        margin-right: 20px;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }
    .nj-card:hover .nj-icon { transform: scale(1.1) rotate(5deg); }
    
    .nj-icon-blue { background: #eff6ff; color: #3b82f6; }
    .nj-icon-green { background: #dcfce7; color: #22c55e; }
    .nj-icon-red { background: #fee2e2; color: #ef4444; }
    .nj-icon-purple { background: #f3e8ff; color: #a855f7; }
    .nj-icon-orange { background: #ffedd5; color: #f97316; }
    
    .nj-info { display: flex; flex-direction: column; width: 100%; }
    .nj-number { font-size: 1.85rem; font-weight: 800; color: #111; line-height: 1.2; letter-spacing: -0.5px; }
    .nj-label { font-size: 1rem; color: #64748b; font-weight: 600; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }

    /* Box Khusus untuk highlight data */
    .nj-highlight-box {
        background: #f8fafc;
        padding: 24px;
        border-radius: 16px;
        border: 2px dashed #cbd5e1;
        height: 100%;
        display: flex;
        align-items: center;
    }

    /* Animation Fade In Up */
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }

    /* --- TOAST NOTIFICATION NEXT.JS STYLE (POJOK KANAN ATAS) --- */
    .nj-toast-container {
        position: fixed;
        top: 85px; /* Diberi jarak agar tidak menabrak navbar */
        right: 32px;
        z-index: 9999;
        pointer-events: none;
    }
    .nj-toast {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 10px 40px -10px rgba(0,0,0,0.15);
        border-radius: 14px;
        padding: 16px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        transform: translateX(120%);
        opacity: 0;
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        pointer-events: auto;
        min-width: 300px;
    }
    .nj-toast.show {
        transform: translateX(0);
        opacity: 1;
    }
    .nj-toast-icon {
        background: #dcfce7;
        color: #22c55e;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
    .nj-toast-text {
        display: flex;
        flex-direction: column;
    }
    .nj-toast-title {
        font-weight: 700;
        color: #111;
        font-size: 15px;
        margin-bottom: 2px;
    }
    .nj-toast-desc {
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
    }
    .nj-toast-close {
        background: transparent;
        border: none;
        color: #94a3b8;
        font-size: 20px;
        cursor: pointer;
        margin-left: auto;
        transition: color 0.2s;
        padding: 0;
        line-height: 1;
    }
    .nj-toast-close:hover { color: #111; }

    /* Responsif Tambahan untuk Mobile */
    @media (max-width: 768px) {
        .nj-card { padding: 24px; }
        .nj-card-hero { padding: 32px 24px; }
        .nj-card-hero .nj-title { font-size: 1.75rem; }
        .nj-number { font-size: 1.5rem; }
        .nj-icon { width: 56px; height: 56px; font-size: 24px; }
        .nj-highlight-box { flex-direction: column; align-items: flex-start; text-align: left; }
        .nj-highlight-box .nj-icon { margin-bottom: 16px; margin-right: 0; }
        
        .nj-toast-container {
            top: 85px;
            right: 20px;
            left: 20px;
        }
        .nj-toast { min-width: unset; width: 100%; }
    }
</style>

<div class="nj-dashboard">
    
    <div class="row nj-row-flex">
        <div class="col-xs-12 animate-fade-in delay-1">
            <div class="nj-card nj-card-hero">
                <h3 class="nj-title">Halo, <?= htmlspecialchars($this->session->userdata('nama_admin')) ?> 🛡️</h3>
                <p class="nj-subtitle">Selamat bertugas! Berikut adalah ringkasan lalu lintas pembayaran PPOB Listrik Pasca Prabayar saat ini.</p>
            </div>
        </div>
    </div>

    <div class="row nj-row-flex">
        
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-fade-in delay-2">
            <div class="nj-card">
                <div class="nj-metric">
                    <div class="nj-icon nj-icon-blue"><i class="fa fa-calendar"></i></div>
                    <div class="nj-info">
                        <span class="nj-label">Total Tagihan Bulan Ini</span>
                        <span class="nj-number"><?= $DataPembayaran ?> Data</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 animate-fade-in delay-3">
            <div class="nj-card">
                <div class="nj-metric">
                    <div class="nj-icon nj-icon-green"><i class="fa fa-check-circle"></i></div>
                    <div class="nj-info">
                        <span class="nj-label">Lunas Bulan Ini</span>
                        <span class="nj-number" style="color: #16a34a;"><?= $DataPembayaranLunas ?> Transaksi</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 animate-fade-in delay-4">
            <div class="nj-card">
                <div class="nj-metric">
                    <div class="nj-icon nj-icon-red"><i class="fa fa-exclamation-triangle"></i></div>
                    <div class="nj-info">
                        <span class="nj-label">Belum Lunas Bulan Ini</span>
                        <span class="nj-number" style="color: #dc2626;"><?= $DataPembayaranBelumLunas ?> Transaksi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row nj-row-flex">
        <div class="col-xs-12 animate-fade-in delay-5">
            <div class="nj-card" style="padding: 40px;">
                <div class="nj-card-header">
                    <h3 class="nj-title">Akumulasi Seluruh Pembayaran 📊</h3>
                    <p class="nj-subtitle">Data rangkuman performa pembayaran sejak sistem digunakan hingga saat ini.</p>
                </div>

                <div class="row nj-row-flex" style="margin-top: 30px; margin-bottom: -24px;">
                    
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="nj-highlight-box" style="background: #f8fafc; border-color: #cbd5e1;">
                            <div class="nj-icon nj-icon-purple"><i class="fa fa-database"></i></div>
                            <div class="nj-info">
                                <span class="nj-label">Total Keseluruhan Tagihan</span>
                                <span class="nj-number" style="font-size: 2.25rem;"><?= $DataSemuaPembayaran ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="nj-metric nj-metric-col" style="padding: 16px;">
                            <div class="nj-icon nj-icon-green" style="margin-bottom: 16px;"><i class="fa fa-check"></i></div>
                            <div class="nj-info">
                                <span class="nj-label">Total Semua Lunas</span>
                                <span class="nj-number"><?= $DataSemuaPembayaranLunas ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="nj-metric nj-metric-col" style="padding: 16px;">
                            <div class="nj-icon nj-icon-orange" style="margin-bottom: 16px;"><i class="fa fa-clock-o"></i></div>
                            <div class="nj-info">
                                <span class="nj-label">Total Semua Belum Lunas</span>
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
            <span class="nj-toast-title">Berhasil!</span>
            <span class="nj-toast-desc"><?= $this->session->flashdata('pesan_sukses'); ?></span>
        </div>
        <button class="nj-toast-close" onclick="closeToast()">&times;</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toast = document.getElementById('njToast');
        
        // Munculkan toast setelah sedikit delay biar animasinya mulus
        setTimeout(() => {
            toast.classList.add('show');
        }, 100);

        // Otomatis hilang setelah 4.5 detik
        setTimeout(() => {
            closeToast();
        }, 4500);
    });

    function closeToast() {
        const toast = document.getElementById('njToast');
        if(toast) {
            toast.classList.remove('show');
            // Hapus dari DOM setelah animasi selesai
            setTimeout(() => {
                toast.style.display = 'none';
            }, 500);
        }
    }
</script>
<?php endif; ?>