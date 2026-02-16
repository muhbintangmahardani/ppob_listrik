<style>
    /* UI Next.js Style Custom CSS - LARGE & RESPONSIVE VERSION */
    .nj-dashboard {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        padding-bottom: 40px;
        min-height: 80vh; 
    }

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
    
    .nj-card-hero {
        background: linear-gradient(135deg, #0070f3 0%, #3b82f6 100%);
        color: white;
        border: none;
        padding: 48px 36px; 
        box-shadow: 0 12px 35px 0 rgba(0, 112, 243, 0.3);
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
    
    .nj-info { display: flex; flex-direction: column; width: 100%; }
    .nj-number { font-size: 1.85rem; font-weight: 800; color: #111; line-height: 1.2; letter-spacing: -0.5px; }
    .nj-label { font-size: 1rem; color: #64748b; font-weight: 600; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
    
    .nj-bill-box {
        background: #f8fafc;
        padding: 24px;
        border-radius: 16px;
        border: 2px dashed #cbd5e1;
        height: 100%;
        display: flex;
        align-items: center;
    }

    /* --- TOAST ALERT KANAN ATAS --- */
    .nj-toast {
        position: fixed;
        top: 80px; /* Jarak dari atas */
        right: -400px; /* Tersembunyi di luar layar kanan */
        background: #ffffff;
        border-left: 6px solid #22c55e;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        border-radius: 10px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        z-index: 9999;
        width: 320px;
        transition: right 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Efek memantul halus */
    }
    .nj-toast.show {
        right: 24px; /* Muncul ke dalam layar */
    }
    .nj-toast-icon { font-size: 28px; color: #22c55e; margin-right: 16px; }
    .nj-toast-content { flex: 1; }
    .nj-toast-title { font-weight: 700; color: #111; margin: 0 0 4px 0; font-size: 15px; }
    .nj-toast-msg { color: #64748b; margin: 0; font-size: 13px; line-height: 1.4; }
    .nj-toast-close {
        background: none; border: none; font-size: 20px; color: #94a3b8; 
        cursor: pointer; padding: 0 0 0 10px; outline: none; transition: color 0.2s;
    }
    .nj-toast-close:hover { color: #111; }

    /* Animation Fade In Up */
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }

    /* Responsif Tambahan untuk Mobile */
    @media (max-width: 768px) {
        .nj-card { padding: 24px; }
        .nj-card-hero { padding: 32px 24px; }
        .nj-card-hero .nj-title { font-size: 1.75rem; }
        .nj-number { font-size: 1.5rem; }
        .nj-icon { width: 56px; height: 56px; font-size: 24px; }
        .nj-bill-box { flex-direction: column; align-items: flex-start; text-align: left; }
        .nj-bill-box .nj-icon { margin-bottom: 16px; margin-right: 0; }
        .nj-toast { width: calc(100% - 48px); right: -100%; } /* Toast responsif di HP */
    }
</style>

<div class="nj-dashboard">
    
    <div class="row nj-row-flex">
        <div class="col-xs-12 animate-fade-in delay-1">
            <div class="nj-card nj-card-hero">
                <h3 class="nj-title">Halo, <?= htmlspecialchars($this->session->userdata('nama_pelanggan')) ?> 👋</h3>
                <p class="nj-subtitle">Selamat datang di Dashboard PPOB Listrik Pasca Prabayar &copy; 2026. Pantau penggunaan dan tagihan listrik Anda dengan mudah di sini.</p>
            </div>
        </div>
    </div>

    <div class="row nj-row-flex">
        <?php 
        $status_text = 'Belum Tersedia';
        $status_color = '#dc2626';
        $status_bg = 'nj-icon-red';
        $status_icon = 'fa-times-circle';

        if($DataTagihan != NULL && !empty($StatusTagihan)) {
            $status_data = $StatusTagihan[0];
            $status_text = $status_data->status;
            if($status_text == 'Lunas') {
                $status_color = '#16a34a';
                $status_bg = 'nj-icon-green';
                $status_icon = 'fa-calendar-check-o';
            } else {
                $status_icon = 'fa-calendar-times-o';
            }
        }
        ?>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-fade-in delay-2">
            <div class="nj-card">
                <div class="nj-metric">
                    <div class="nj-icon <?= $status_bg ?>"><i class="fa <?= $status_icon ?>"></i></div>
                    <div class="nj-info">
                        <span class="nj-label">Status Bulan Ini</span>
                        <span class="nj-number" style="color: <?= $status_color ?>;">
                            <?= $status_text ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 animate-fade-in delay-3">
            <div class="nj-card">
                <div class="nj-metric">
                    <div class="nj-icon nj-icon-blue"><i class="fa fa-check-circle"></i></div>
                    <div class="nj-info">
                        <span class="nj-label">Total Lunas</span>
                        <span class="nj-number"><?= $JumlahTagihanLunas ?> Bulan</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 animate-fade-in delay-4">
            <div class="nj-card">
                <div class="nj-metric">
                    <div class="nj-icon nj-icon-red"><i class="fa fa-exclamation-circle"></i></div>
                    <div class="nj-info">
                        <span class="nj-label">Total Tunggakan</span>
                        <span class="nj-number"><?= $JumlahTagihanBelumLunas ?> Bulan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row nj-row-flex">
        <div class="col-xs-12 animate-fade-in delay-5">
            <div class="nj-card" style="padding: 40px;">
                <?php if($DataTagihan != NULL): ?>
                    <?php $penggunaan_data = $DataTagihan[0]; ?>
                    
                    <div class="nj-card-header">
                        <h3 class="nj-title">Rincian Penggunaan Listrik ⚡</h3>
                        <p class="nj-subtitle">Periode Tagihan: <strong style="color: #111; font-weight: 700;"><?= $penggunaan_data->bulan ?> <?= $penggunaan_data->tahun ?></strong></p>
                    </div>

                    <div class="row nj-row-flex" style="margin-top: 30px; margin-bottom: -24px;">
                        
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="nj-metric nj-metric-col">
                                <div class="nj-icon nj-icon-blue" style="margin-bottom: 16px;"><i class="fa fa-tachometer"></i></div>
                                <div class="nj-info">
                                    <span class="nj-label">Meter Awal</span>
                                    <span class="nj-number"><?= $penggunaan_data->meter_awal ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="nj-metric nj-metric-col">
                                <div class="nj-icon nj-icon-blue" style="margin-bottom: 16px; transform: scaleX(-1);"><i class="fa fa-tachometer"></i></div>
                                <div class="nj-info">
                                    <span class="nj-label">Meter Akhir</span>
                                    <span class="nj-number"><?= $penggunaan_data->meter_akhir ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                            <div class="nj-metric nj-metric-col">
                                <div class="nj-icon nj-icon-purple" style="margin-bottom: 16px;"><i class="fa fa-bolt"></i></div>
                                <div class="nj-info">
                                    <span class="nj-label">Daya Terpakai</span>
                                    <span class="nj-number"><?= $penggunaan_data->jumlah_meter ?> <span style="font-size: 1.2rem; color: #64748b;">kWh</span></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <div class="nj-bill-box">
                                <div class="nj-icon nj-icon-green"><i class="fa fa-money"></i></div>
                                <div class="nj-info">
                                    <span class="nj-label">Total Tagihan (Inc. Admin)</span>
                                    <?php $bayar = ($penggunaan_data->jumlah_meter * $penggunaan_data->terperkwh) + 2500; ?>
                                    <span class="nj-number" style="font-size: 2.25rem; color: #16a34a; margin-top: 4px;">
                                        Rp<?= number_format($bayar, 0, ',', '.') ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                <?php else: ?>
                    <div class="nj-card-header">
                        <h3 class="nj-title">Rincian Penggunaan Listrik ⚡</h3>
                        <p class="nj-subtitle">Belum ada data penggunaan tercatat untuk bulan ini.</p>
                    </div>
                    <div class="row nj-row-flex" style="margin-top: 30px; margin-bottom: -24px;">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"><div class="nj-metric nj-metric-col"><div class="nj-icon nj-icon-blue" style="margin-bottom: 16px;"><i class="fa fa-tachometer"></i></div><div class="nj-info"><span class="nj-label">Meter Awal</span><span class="nj-number">0</span></div></div></div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"><div class="nj-metric nj-metric-col"><div class="nj-icon nj-icon-blue" style="margin-bottom: 16px;"><i class="fa fa-tachometer" style="transform: scaleX(-1);"></i></div><div class="nj-info"><span class="nj-label">Meter Akhir</span><span class="nj-number">0</span></div></div></div>
                        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12"><div class="nj-metric nj-metric-col"><div class="nj-icon nj-icon-purple" style="margin-bottom: 16px;"><i class="fa fa-bolt"></i></div><div class="nj-info"><span class="nj-label">Daya Terpakai</span><span class="nj-number">0 <span style="font-size: 1.2rem; color: #64748b;">kWh</span></span></div></div></div>
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12"><div class="nj-bill-box"><div class="nj-icon nj-icon-green"><i class="fa fa-money"></i></div><div class="nj-info"><span class="nj-label">Total Tagihan</span><span class="nj-number" style="font-size: 2.25rem; color: #16a34a; margin-top: 4px;">Rp0</span></div></div></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?php if($this->session->flashdata('pesan_sukses') !=''): ?>
    <div id="toastSuccess" class="nj-toast">
        <div class="nj-toast-icon">
            <i class="fa fa-check-circle"></i>
        </div>
        <div class="nj-toast-content">
            <h4 class="nj-toast-title">Sukses!</h4>
            <p class="nj-toast-msg"><?= $this->session->flashdata('pesan_sukses'); ?></p>
        </div>
        <button class="nj-toast-close" onclick="closeToast()">&times;</button>
    </div>

    <script>
        // Memunculkan toast dengan animasi geser dari kanan
        setTimeout(function() {
            var toast = document.getElementById('toastSuccess');
            if(toast) {
                toast.classList.add('show');
                
                // Menghilangkan toast otomatis setelah 5 detik
                setTimeout(function() {
                    toast.classList.remove('show');
                }, 5000);
            }
        }, 300); // delay sebentar setelah halaman dimuat

        // Fungsi jika user menekan tombol X (close)
        function closeToast() {
            var toast = document.getElementById('toastSuccess');
            if(toast) {
                toast.classList.remove('show');
            }
        }
    </script>
<?php endif; ?>