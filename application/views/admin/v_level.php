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
    .modal-label { font-weight: 600; color: #374151; font-size: 14px; margin-bottom: 6px; display: inline-block; }

    /* --- MODAL STYLING OVERRIDE --- */
    .modal-content { border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.1); overflow: hidden; }
    .modal-header { background: #f8fafc; border-bottom: 1px solid #eaeaea; padding: 20px 24px; }
    .modal-header h4 { margin: 0; font-weight: 700; font-size: 18px; color: #0f172a; }
    .modal-body { padding: 24px; }
    .modal-footer { border-top: 1px solid #eaeaea; padding: 16px 24px; background: #fafafa; }
    .close { font-size: 24px; color: #64748b; opacity: 1; transition: color 0.2s; }
    .close:hover { color: #0f172a; }

    /* --- TOAST NOTIFICATION (TOP RIGHT) --- */
    .nj-toast-container { position: fixed; top: 85px; right: 32px; z-index: 9999; pointer-events: none; }
    .nj-toast {
        background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(0, 0, 0, 0.08); box-shadow: 0 10px 40px -10px rgba(0,0,0,0.15);
        border-radius: 14px; padding: 16px 24px; display: flex; align-items: center; gap: 16px;
        transform: translateX(120%); opacity: 0; transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        pointer-events: auto; min-width: 300px;
    }
    .nj-toast.show { transform: translateX(0); opacity: 1; }
    .nj-toast-icon { background: #dcfce7; color: #22c55e; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
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
            <div style="margin-bottom: 20px;">
                <button data-toggle="modal" data-target="#tambah" class="nj-btn nj-btn-primary">
                    <i class="fa fa-plus"></i> Tambah Level Admin
                </button>
            </div>
            
            <div class="table-responsive">
                <table id="tabelbiasa" class="table table-modern">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Nama Level</th>
                            <th class="text-center" width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($DataLevel as $data) {  ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td>
                                <span style="background:#f1f5f9; padding:6px 14px; border-radius:20px; font-size:13px; font-weight:600; color:#0f172a;">
                                    <?= $data->nama_level ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a class="nj-btn nj-btn-secondary nj-btn-sm" data-toggle="modal" data-target="#edit" href="#" onclick="edit('<?=$data->id_level?>')">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a class="nj-btn nj-btn-danger nj-btn-sm" data-toggle="modal" data-target="#hapus" href="#" onclick="edit('<?=$data->id_level?>')">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4>Tambah Data Level</h4>
            </div>
            
            <form action="<?=base_url('level/tambah_level')?>" method="post">
                <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="modal-label">Nama Level</label>
                        <input type="text" name="nama_level" required="required" class="nj-input" placeholder="Contoh: Super Admin, Operator, dll">
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="nj-btn nj-btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah" class="nj-btn nj-btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4>Edit Data Level Admin</h4>
            </div>
            
            <form action="<?=base_url('level/edit_level')?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id_level" name="id_level" required="required">

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="modal-label">Nama Level</label>
                        <input type="text" id="nama_level" name="nama_level" required="required" class="nj-input">
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="nj-btn nj-btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="edit" class="nj-btn nj-btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?=base_url('level/hapus_level')?>" method="post">
                <div class="modal-body text-center" style="padding: 0 24px 24px 24px;">
                    <div style="font-size: 50px; color: #ef4444; margin-bottom: 16px;">
                        <i class="fa fa-exclamation-circle"></i>
                    </div>
                    <h4 style="font-weight: 700; color: #0f172a; margin-bottom: 8px;">Hapus Data Level?</h4>
                    <p style="color: #64748b; font-size: 14px; margin-bottom: 0;">Tindakan ini tidak dapat dibatalkan. Apakah Anda yakin ingin menghapus level ini?</p>
                    
                    <input type="hidden" id="id_level1" name="id_level" required="required">
                </div>
                
                <div class="modal-footer" style="display: flex; gap: 8px; justify-content: center; background: transparent; border-top: none;">
                    <button type="button" class="nj-btn nj-btn-secondary" data-dismiss="modal" style="flex: 1;">Batal</button>
                    <button type="submit" class="nj-btn nj-btn-danger" style="flex: 1;">Ya, Hapus</button>
                </div>
            </form>
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
            url: "<?=base_url()?>level/detail_level/" + a,
            dataType: "json",
            success: function (data) {
                // Isi ke Modal Edit
                $("#id_level").val(data.id_level);
                $("#nama_level").val(data.nama_level);
                
                // Isi ke Modal Hapus
                $("#id_level1").val(data.id_level);
            }
        });
    }
</script>