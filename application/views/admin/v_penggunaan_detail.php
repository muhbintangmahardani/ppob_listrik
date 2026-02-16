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
    .nj-btn-primary { background: #0070f3; color: #fff; box-shadow: 0 4px 14px 0 rgba(0,118,255,0.39); }
    .nj-btn-primary:hover { background: #0060d9; color: #fff; transform: translateY(-1px); }
    
    .nj-btn-danger { background: #fff; color: #ef4444; border-color: #fecaca; }
    .nj-btn-danger:hover { background: #fef2f2; color: #dc2626; border-color: #fca5a5; transform: translateY(-1px); }
    
    .nj-btn-secondary { background: #fff; color: #475569; border-color: #e2e8f0; }
    .nj-btn-secondary:hover { background: #f8fafc; color: #0f172a; border-color: #cbd5e1; }

    .nj-btn-sm { padding: 6px 12px; font-size: 13px; }

    /* --- TABLE STYLING --- */
    .table-modern { width: 100% !important; border-collapse: separate !important; border-spacing: 0 !important; }
    .table-modern thead th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 13px; text-transform: uppercase; padding: 16px; border-bottom: 1px solid #eaeaea; border-top: 1px solid #eaeaea; }
    .table-modern thead th:first-child { border-left: 1px solid #eaeaea; border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
    .table-modern thead th:last-child { border-right: 1px solid #eaeaea; border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
    .table-modern tbody td { padding: 16px; vertical-align: middle !important; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 14px; }
    .table-modern tbody tr:hover td { background-color: #f8fafc; }

    /* --- FORM INPUTS --- */
    .nj-input {
        width: 100%; padding: 10px 14px; font-size: 14px;
        border: 1px solid #d1d5db; border-radius: 8px; transition: all 0.2s;
        background-color: #fff; color: #111827; box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }
    .nj-input:focus {
        border-color: #0070f3; outline: none; box-shadow: 0 0 0 3px rgba(0,112,243,0.15);
    }
    select.nj-input { padding-right: 32px; appearance: auto; }
    .modal-label { font-weight: 600; color: #374151; font-size: 14px; margin-bottom: 6px; display: inline-block; }

    /* --- MODAL STYLING OVERRIDE --- */
    .modal-content { border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.1); overflow: hidden; }
    .modal-header { background: #f8fafc; border-bottom: 1px solid #eaeaea; padding: 20px 24px; }
    .modal-header h4 { margin: 0; font-weight: 700; font-size: 18px; color: #0f172a; }
    .modal-body { padding: 24px; }
    .modal-footer { border-top: 1px solid #eaeaea; padding: 16px 24px; background: #fafafa; }
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
                            <th class="text-center" width="5%">No</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Meter Awal</th>
                            <th>Meter Akhir</th>
                            <th>Total Penggunaan</th>
                            <th class="text-center" width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($DataPenggunaan as $data) {  ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td style="font-weight: 600; color: #111827;"><?= $data->bulan ?></td>
                            <td style="color: #64748b;"><?= $data->tahun ?></td>
                            <td><?= $data->meter_awal ?> kWh</td>
                            <td><?= $data->meter_akhir ?> kWh</td>
                            <td>
                                <?php 
                                    if($data->meter_awal > $data->meter_akhir) {
                                        $total = (($data->meter_akhir - $data->meter_awal) * (-1));
                                    } else {
                                        $total = $data->meter_akhir - $data->meter_awal;
                                    }
                                ?>
                                <span style="font-family: monospace; background:#f1f5f9; padding:4px 8px; border-radius:6px; font-size:13px; color:#0f172a; font-weight: 600;">
                                    <?= $total ?> kWh
                                </span>
                            </td>
                            <td class="text-center">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a class="nj-btn nj-btn-primary nj-btn-sm" style="flex: 1; padding: 8px 4px; font-size: 12px;" data-toggle="modal" data-target="#penggunaan" href="#" onclick="edit('<?=$data->id_penggunaan?>')">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <a class="nj-btn nj-btn-danger nj-btn-sm" style="flex: 1; padding: 8px 4px; font-size: 12px;" data-toggle="modal" data-target="#hapus" href="#" onclick="hapus('<?=$data->id_penggunaan?>')">
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

<div class="modal fade" id="penggunaan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4>Edit Data Penggunaan</h4>
            </div>
            
            <form action="<?=base_url('penggunaan/edit_penggunaan')?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id_pelanggan" name="id_pelanggan" required="required">
                    <input type="hidden" id="id_penggunaan" name="id_penggunaan" required="required">

                    <?php
                        $arr_bulan = array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                    ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modal-label">Bulan</label>
                                <select id="bulan" name="bulan" required="required" class="nj-input">
                                    <option value="" disabled selected>Pilih Bulan</option>
                                    <?php foreach ($arr_bulan as $key => $bulan): ?>
                                        <option value="<?=$bulan?>"><?=$bulan?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modal-label">Tahun</label>
                                <select id="tahun" name="tahun" required="required" class="nj-input">
                                    <option value="" disabled selected>Pilih Tahun</option>
                                    <?php
                                        for($i=2019; $i<=2030; $i++){
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="modal-label">Meter Awal</label>
                                <input type="number" id="meter_awal" min="0" name="meter_awal" required="required" class="nj-input">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="modal-label">Meter Akhir</label>
                                <input type="number" id="meter_akhir" min="0" name="meter_akhir" required="required" class="nj-input">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer text-right">
                    <button type="button" class="nj-btn nj-btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah" class="nj-btn nj-btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #fef2f2; border-bottom: 1px solid #fecaca;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 style="color: #dc2626;">Hapus Data</h4>
            </div>
            <form action="<?=base_url('penggunaan/hapus_tagihan')?>" method="post">
                <div class="modal-body text-center">
                    <i class="fa fa-exclamation-triangle" style="font-size: 40px; color: #ef4444; margin-bottom: 16px; display: block;"></i>
                    <h5 style="color: #111827; font-weight: 600;">Anda Yakin Ingin Menghapus?</h5>
                    <p style="color: #64748b; font-size: 13px; margin: 0;">Data penggunaan dan tagihan yang terkait akan dihapus secara permanen.</p>
                    
                    <input type="hidden" id="id_penggunaan1" name="id_penggunaan" required="required">
                    <input type="hidden" id="id_tagihan1" name="id_tagihan" required="required">
                </div>
                <div class="modal-footer" style="display: flex; gap: 8px;">
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
            url: "<?=base_url()?>penggunaan/data_penggunaan/" + a,
            dataType: "json",
            success: function (data) {
                $("#id_pelanggan").val(data.id_pelanggan);
                $("#id_penggunaan").val(data.id_penggunaan);
                $("#bulan").val(data.bulan);
                $("#tahun").val(data.tahun);
                $("#meter_awal").val(data.meter_awal);
                $("#meter_akhir").val(data.meter_akhir);
            }
        });
    }

    function hapus(a) {
        $.ajax({
            type: "post",
            url: "<?=base_url()?>penggunaan/data_tagihan_detail/" + a,
            dataType: "json",
            success: function (data) {
                // Sesuai kode aslimu, ini untuk mengisi ID yang akan dihapus
                $("#id_tagihan1").val(data.id_tagihan);
                $("#id_penggunaan1").val(data.id_penggunaan);
            }
        });
    }
</script>