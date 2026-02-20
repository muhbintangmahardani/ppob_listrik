<style>
    /* --- STYLE CSS --- */
    .page-title { font-weight: 700; color: #111827; margin-bottom: 24px; font-size: 24px; letter-spacing: -0.5px; }
    
    .nj-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #eaeaea;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        padding: 24px;
        margin-bottom: 30px;
    }

    /* --- BUTTONS --- */
    .nj-btn {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 8px 16px; font-size: 14px; font-weight: 600;
        border-radius: 8px; transition: all 0.2s ease; border: 1px solid transparent;
        cursor: pointer; gap: 8px; outline: none; text-decoration: none !important;
    }
    .nj-btn-primary { background: #0070f3; color: white; border-color: #0070f3; }
    .nj-btn-primary:hover { background: #0051a8; border-color: #0051a8; transform: translateY(-1px); color: white;}
    
    .nj-btn-danger { background: #fff; color: #ef4444; border-color: #fecaca; }
    .nj-btn-danger:hover { background: #fef2f2; color: #dc2626; border-color: #fca5a5; transform: translateY(-1px); }
    .nj-btn-secondary { background: #fff; color: #475569; border-color: #e2e8f0; }
    .nj-btn-secondary:hover { background: #f8fafc; color: #0f172a; border-color: #cbd5e1; }
    .nj-btn-sm { padding: 6px 12px; font-size: 13px; }

    /* --- TAMBAHAN TOMBOL SELESAI & INVOICE --- */
    .nj-btn-success-soft { 
        background: #f0fdf4; 
        color: #16a34a; 
        border: 1px dashed #bbf7d0; 
        cursor: default; 
    }
    .nj-btn-success-soft i {
        color: #22c55e;
    }
    .nj-btn-invoice { 
        background: #fff; 
        color: #0ea5e9; 
        border: 1px solid #bae6fd; 
    }
    .nj-btn-invoice:hover { 
        background: #f0f9ff; 
        color: #0284c7; 
        border-color: #7dd3fc; 
        transform: translateY(-1px); 
    }

    /* --- BADGES (STATUS) --- */
    .nj-badge {
        padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 600;
        display: inline-flex; align-items: center; justify-content: center; line-height: 1.5;
    }
    .nj-badge-warning { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
    .nj-badge-success { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .nj-badge-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

    /* --- TABLE STYLING --- */
    .table-modern { width: 100% !important; border-collapse: separate !important; border-spacing: 0 !important; }
    .table-modern thead th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 13px; text-transform: uppercase; padding: 16px; border-bottom: 1px solid #eaeaea; border-top: 1px solid #eaeaea; }
    .table-modern thead th:first-child { border-left: 1px solid #eaeaea; border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
    .table-modern thead th:last-child { border-right: 1px solid #eaeaea; border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
    .table-modern tbody td { padding: 16px; vertical-align: middle !important; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 14px; }
    .table-modern tbody tr:hover td { background-color: #f8fafc; }

    /* --- TOAST --- */
    .nj-toast-container { position: fixed; top: 85px; right: 32px; z-index: 9999; pointer-events: none; }
    .nj-toast {
        background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(0, 0, 0, 0.08); box-shadow: 0 10px 40px -10px rgba(0,0,0,0.15);
        border-radius: 14px; padding: 16px 24px; display: flex; align-items: center; gap: 16px;
        transform: translateX(120%); opacity: 0; transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        pointer-events: auto; min-width: 300px;
    }
    .nj-toast.show { transform: translateX(0); opacity: 1; }
    .nj-toast-icon { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
    .nj-toast-success .nj-toast-icon { background: #dcfce7; color: #22c55e; }
    .nj-toast-text { display: flex; flex-direction: column; }
    .nj-toast-title { font-weight: 700; color: #111; font-size: 15px; margin-bottom: 2px; }
    .nj-toast-desc { color: #64748b; font-size: 13px; font-weight: 500; }
    .nj-toast-close { background: transparent; border: none; color: #94a3b8; font-size: 20px; cursor: pointer; margin-left: auto; transition: color 0.2s; padding: 0; line-height: 1; }
    .nj-toast-close:hover { color: #111; }
</style>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="GANTI CLIENT KEY INI DENGAN MILIK ANDA"></script>

<h2 class="page-title"><?= $judul ?></h2>

<div class="row">
    <div class="col-md-12">
        <div class="nj-card">
            <div class="table-responsive">
                <table id="tabelbiasa" class="table table-modern">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">Nomor</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Jumlah Meter Penggunaan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($DataTagihan as $data) {  ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td style="font-weight: 600; color: #111827;"><?= $data->bulan ?></td>
                            <td style="color: #64748b;"><?= $data->tahun ?></td>
                            <td>
                                <span style="font-family: monospace; background:#f1f5f9; padding:4px 8px; border-radius:6px; font-size:13px; color:#0f172a; font-weight: 600;">
                                    <?= $data->jumlah_meter ?> kWh
                                </span>
                            </td>
                            
                            <td class="text-center">
                                <?php if($data->status == "Lunas"): ?>
                                    <span class="nj-badge nj-badge-success">
                                        <i class="fa fa-check" style="margin-right:4px;"></i> Lunas
                                    </span>
                                <?php elseif($data->status == "Belum Dikonfirmasi" || $data->status == "Belum Bayar"): ?>
                                    <span class="nj-badge nj-badge-warning"><?= $data->status ?></span>
                                <?php else: ?>
                                    <span class="nj-badge nj-badge-danger"><?= $data->status ?></span>
                                <?php endif ?>
                            </td>

                            <td class="text-center">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    
                                    <?php if($data->status != "Lunas"): ?>
                                        <button class="nj-btn nj-btn-primary nj-btn-sm" style="flex: 1; padding: 8px 4px; font-size: 12px; width: 100%;" onclick="bayarMidtrans('<?=$data->id_tagihan?>', this)">
                                            <i class="fa fa-credit-card"></i> Bayar
                                        </button>
                                        
                                    <?php else: ?>
                                        <div class="nj-btn-success-soft" style="flex: 1; display: inline-flex; align-items: center; justify-content: center; padding: 8px 4px; font-size: 12px; border-radius: 8px;">
                                            <i class="fa fa-check-circle" style="margin-right: 4px; font-size: 14px;"></i> Lunas
                                        </div>

                                        <a href="<?= base_url('tagihan/cetak_invoice/'.$data->id_tagihan) ?>" target="_blank" class="nj-btn nj-btn-invoice nj-btn-sm" style="flex: 1; padding: 8px 4px; font-size: 12px;">
                                            <i class="fa fa-print"></i> Struk
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
    $pesan_sukses = $this->session->flashdata('pesan_sukses');
    if($pesan_sukses != ''): 
?>
<div class="nj-toast-container">
    <div id="njToast" class="nj-toast nj-toast-success">
        <div class="nj-toast-icon">
            <i class="fa fa-check"></i>
        </div>
        <div class="nj-toast-text">
            <span class="nj-toast-title">Berhasil!</span>
            <span class="nj-toast-desc"><?= $pesan_sukses ?></span>
        </div>
        <button class="nj-toast-close" onclick="closeToast()">&times;</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toast = document.getElementById('njToast');
        setTimeout(() => { toast.classList.add('show'); }, 100);
        setTimeout(() => { closeToast(); }, 4500);
    });

    function closeToast() {
        const toast = document.getElementById('njToast');
        if(toast) {
            toast.classList.remove('show');
            setTimeout(() => { toast.style.display = 'none'; }, 500);
        }
    }
</script>
<?php endif; ?>

<script type="text/javascript">
    
    // Fungsi Bayar Midtrans (Logic Update Status Otomatis)
    function bayarMidtrans(id_tagihan, btn) {
        
        // Ubah text tombol jadi loading
        var originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Proses...';
        btn.disabled = true;

        $.ajax({
            url: "<?= base_url('tagihan/token_midtrans') ?>",
            type: "POST",
            data: { id_tagihan: id_tagihan },
            dataType: "json",
            success: function(response) {
                
                // Kembalikan tombol jika sudah dapat respon
                btn.innerHTML = originalText;
                btn.disabled = false;

                if(response.status === 'sukses') {
                    // Panggil Popup Midtrans
                    window.snap.pay(response.token, {
                        
                        // JIKA SUKSES BAYAR
                        onSuccess: function(result) {
                            // Buat form hidden secara dinamis untuk kirim data ke Controller
                            var form = document.createElement('form');
                            form.method = 'post';
                            form.action = "<?= base_url('tagihan/finish_midtrans') ?>";
                            
                            var input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'id_tagihan';
                            input.value = id_tagihan;
                            
                            form.appendChild(input);
                            document.body.appendChild(form);
                            
                            // Submit form -> Controller update DB jadi Lunas -> Redirect balik kesini
                            form.submit();
                        },
                        
                        // JIKA PENDING
                        onPending: function(result) {
                            alert("Menunggu pembayaran Anda! Silakan cek email atau refresh nanti.");
                            location.reload();
                        },
                        
                        // JIKA ERROR
                        onError: function(result) {
                            alert("Pembayaran gagal atau dibatalkan.");
                            location.reload();
                        },
                        
                        // JIKA POPUP DITUTUP TANPA BAYAR
                        onClose: function() {
                            alert('Anda menutup popup tanpa menyelesaikan pembayaran.');
                        }
                    });
                } else {
                    alert("Gagal mendapatkan token: " + response.pesan);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                btn.innerHTML = originalText;
                btn.disabled = false;
                alert("Error Server: Tidak dapat menghubungi Controller.");
                console.log(xhr.responseText);
            }
        });
    }
</script>