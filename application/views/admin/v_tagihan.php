<style>
    /* --- NEXT.JS STYLE BASE --- */
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
    .nj-btn-danger { background: #fff; color: #ef4444; border-color: #fecaca; }
    .nj-btn-danger:hover { background: #fef2f2; color: #dc2626; border-color: #fca5a5; transform: translateY(-1px); }
    .nj-btn-secondary { background: #fff; color: #475569; border-color: #e2e8f0; }
    .nj-btn-secondary:hover { background: #f8fafc; color: #0f172a; border-color: #cbd5e1; }
    .nj-btn-sm { padding: 6px 12px; font-size: 13px; }

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

    /* --- MODAL STYLING OVERRIDE --- */
    .modal-content { border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.1); overflow: hidden; }
    .close { font-size: 24px; color: #64748b; opacity: 1; transition: color 0.2s; }
    .close:hover { color: #0f172a; }

    /* --- TOAST NOTIFICATION --- */
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
                            <th class="text-center" width="15%">Action</th>
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
                                <?php if($data->status == "Belum Dikonfirmasi"): ?>
                                    <span class="nj-badge nj-badge-warning"><?= $data->status ?></span>
                                <?php elseif($data->status == "Lunas"): ?>
                                    <span class="nj-badge nj-badge-success"><i class="fa fa-check" style="margin-right:4px;"></i> <?= $data->status ?></span>
                                <?php else: ?>
                                    <span class="nj-badge nj-badge-danger"><?= $data->status ?></span>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a class="nj-btn nj-btn-danger nj-btn-sm" style="flex: 1; padding: 8px 4px; font-size: 12px;" data-toggle="modal" data-target="#hapus" href="#" onclick="edit('<?=$data->id_tagihan?>')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
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

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #fef2f2; border-bottom: 1px solid #fecaca; padding: 20px 24px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -4px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 style="color: #dc2626; margin: 0; font-weight: 700; font-size: 18px;">Hapus Data</h4>
            </div>
            <form action="<?=base_url('penggunaan/hapus_tagihan')?>" method="post">
                <div class="modal-body text-center" style="padding: 24px;">
                    <i class="fa fa-exclamation-triangle" style="font-size: 40px; color: #ef4444; margin-bottom: 16px; display: block;"></i>
                    <h5 style="color: #111827; font-weight: 600;">Anda Yakin Ingin Menghapus Tagihan?</h5>
                    <p style="color: #64748b; font-size: 13px; margin: 0;">Tindakan ini tidak dapat dibatalkan.</p>
                    
                    <input type="hidden" id="id_penggunaan" name="id_penggunaan" required="required">
                    <input type="hidden" id="id_tagihan" name="id_tagihan" required="required">
                    
                    <input type="hidden" id="id_pelanggan">
                    <input type="hidden" id="bulan">
                    <input type="hidden" id="tahun">
                    <input type="hidden" id="jumlah_meter">
                    <input type="hidden" id="status">
                </div>
                <div class="modal-footer" style="display: flex; gap: 8px; border-top: 1px solid #eaeaea; padding: 16px 24px; background: #fafafa;">
                    <button type="button" class="nj-btn nj-btn-secondary" style="flex: 1;" data-dismiss="modal">Batal</button>
                    <button type="submit" class="nj-btn nj-btn-danger" style="flex: 1;">Ya, Hapus</button>
                </div>
            </form>
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
    function edit(a) {
        $.ajax({
            type: "post",
            url: "<?=base_url()?>penggunaan/data_tagihan/" + a,
            dataType: "json",
            success: function (data) {
                $("#id_tagihan").val(data.id_tagihan);
                $("#id_penggunaan").val(data.id_penggunaan);
                
                // Field di bawah ini hanya agar console tidak error saat populate
                $("#id_pelanggan").val(data.id_pelanggan);
                $("#bulan").val(data.bulan);
                $("#tahun").val(data.tahun);
                $("#jumlah_meter").val(data.jumlah_meter);
                $("#status").val(data.status);
            }
        });
    }
</script>