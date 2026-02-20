<style>
    /* --- VERCEL / NEXT.JS THEME BASE --- */
    :root {
        --nj-primary: #006fee;      /* Biru utama selaras dengan sidebar */
        --nj-primary-hover: #005bc4;
        --nj-primary-light: #e6f1fe;
        --nj-bg-main: #ffffff;
        --nj-bg-subtle: #fafafa;
        --nj-border: #eaeaea;
        --nj-text-main: #0a0a0a;
        --nj-text-muted: #666666;
        --nj-danger: #e11d48;
        --nj-danger-light: #ffe4e6;
        --nj-shadow-sm: 0 2px 4px rgba(0,0,0,0.02);
        --nj-shadow-md: 0 4px 14px rgba(0,0,0,0.05);
        --nj-shadow-lg: 0 10px 30px rgba(0,0,0,0.08);
        --nj-radius-lg: 16px;
        --nj-radius-md: 10px;
        --nj-radius-sm: 8px;
        --nj-transition: all 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    body { color: var(--nj-text-main); }
    
    .page-title { 
        font-weight: 800; color: var(--nj-text-main); margin-bottom: 24px; 
        font-size: 26px; letter-spacing: -0.8px; 
        display: flex; align-items: center; gap: 12px;
    }
    .page-title::before {
        content: ""; display: block; width: 4px; height: 24px; 
        background: var(--nj-primary); border-radius: 4px;
    }

    /* --- CARDS --- */
    .nj-card {
        background: var(--nj-bg-main);
        border-radius: var(--nj-radius-lg);
        border: 1px solid var(--nj-border);
        box-shadow: var(--nj-shadow-md);
        padding: 24px;
        margin-bottom: 30px;
        transition: var(--nj-transition);
    }
    .nj-card:hover { box-shadow: var(--nj-shadow-lg); }

    /* --- BUTTONS --- */
    .nj-btn {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 10px 18px; font-size: 14px; font-weight: 600;
        border-radius: var(--nj-radius-md); transition: var(--nj-transition); 
        border: 1px solid transparent; cursor: pointer; gap: 8px; outline: none; text-decoration: none !important;
        letter-spacing: -0.2px;
    }
    .nj-btn:active { transform: scale(0.96); } /* Animasi klik */
    
    .nj-btn-primary { 
        background: var(--nj-primary); color: #fff; 
        box-shadow: 0 4px 14px 0 rgba(0, 111, 238, 0.25); 
    }
    .nj-btn-primary:hover { background: var(--nj-primary-hover); color: #fff; box-shadow: 0 6px 20px rgba(0, 111, 238, 0.35); }
    
    .nj-btn-danger { background: #fff; color: var(--nj-danger); border-color: var(--nj-danger-light); }
    .nj-btn-danger:hover { background: var(--nj-danger-light); color: var(--nj-danger); border-color: transparent; }
    
    .nj-btn-secondary { background: #fff; color: var(--nj-text-muted); border-color: var(--nj-border); }
    .nj-btn-secondary:hover { background: var(--nj-bg-subtle); color: var(--nj-text-main); border-color: #d4d4d8; }

    .nj-btn-sm { padding: 6px 12px; font-size: 13px; border-radius: var(--nj-radius-sm); }

    /* --- TABLE STYLING --- */
    .table-modern { width: 100% !important; border-collapse: separate !important; border-spacing: 0 8px !important; margin-top: -8px; }
    .table-modern thead th { 
        border: none; color: var(--nj-text-muted); font-weight: 600; font-size: 12px; 
        text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; 
    }
    .table-modern tbody tr { 
        box-shadow: var(--nj-shadow-sm); transition: var(--nj-transition); 
        border-radius: var(--nj-radius-md); background: #fff;
    }
    .table-modern tbody tr:hover { 
        transform: translateY(-2px); box-shadow: var(--nj-shadow-md); 
        background: var(--nj-bg-subtle);
    }
    .table-modern tbody td { 
        padding: 16px; vertical-align: middle !important; border: none; font-size: 14px; color: #3f3f46;
        border-top: 1px solid var(--nj-border); border-bottom: 1px solid var(--nj-border);
    }
    .table-modern tbody td:first-child { border-left: 1px solid var(--nj-border); border-top-left-radius: var(--nj-radius-md); border-bottom-left-radius: var(--nj-radius-md); }
    .table-modern tbody td:last-child { border-right: 1px solid var(--nj-border); border-top-right-radius: var(--nj-radius-md); border-bottom-right-radius: var(--nj-radius-md); }

    /* --- BADGES --- */
    .nj-badge {
        background: var(--nj-primary-light); color: var(--nj-primary);
        padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;
        display: inline-flex; align-items: center; gap: 4px; letter-spacing: -0.2px;
    }
    .nj-badge::before { content: ""; width: 6px; height: 6px; border-radius: 50%; background: var(--nj-primary); }

    /* --- FORM INPUTS --- */
    .nj-input, .nj-select {
        width: 100%; padding: 12px 16px; font-size: 14px;
        border: 1px solid var(--nj-border); border-radius: var(--nj-radius-md); transition: var(--nj-transition);
        background-color: var(--nj-bg-subtle); color: var(--nj-text-main); font-family: inherit;
    }
    .nj-input:hover, .nj-select:hover { border-color: #d4d4d8; }
    .nj-input:focus, .nj-select:focus {
        background-color: #fff; border-color: var(--nj-primary); outline: none; 
        box-shadow: 0 0 0 4px rgba(0, 111, 238, 0.15);
    }
    .modal-label { font-weight: 600; color: var(--nj-text-main); font-size: 13px; margin-bottom: 8px; display: inline-block; letter-spacing: -0.2px; }

    /* --- MODAL STYLING OVERRIDE --- */
    .modal-content { 
        border-radius: 20px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden; 
        animation: modalFadeIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes modalFadeIn {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .modal-header { background: #fff; border-bottom: 1px solid var(--nj-border); padding: 24px; display: flex; align-items: center; justify-content: space-between; }
    .modal-header h4 { margin: 0; font-weight: 700; font-size: 20px; color: var(--nj-text-main); letter-spacing: -0.5px; }
    .modal-body { padding: 24px; }
    .modal-footer { border-top: 1px solid var(--nj-border); padding: 16px 24px; background: var(--nj-bg-subtle); display: flex; gap: 12px; justify-content: flex-end; }
    .close { font-size: 24px; color: #a1a1aa; opacity: 1; transition: color 0.2s; line-height: 1; background: transparent; border: none; margin: 0; padding: 0; }
    .close:hover { color: var(--nj-text-main); }

    /* --- TOAST NOTIFICATION --- */
    .nj-toast-container { position: fixed; top: 32px; right: 32px; z-index: 9999; pointer-events: none; }
    .nj-toast {
        background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--nj-border); box-shadow: var(--nj-shadow-lg);
        border-radius: 14px; padding: 16px 20px; display: flex; align-items: center; gap: 16px;
        transform: translateY(-20px) scale(0.95); opacity: 0; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        pointer-events: auto; min-width: 320px;
    }
    .nj-toast.show { transform: translateY(0) scale(1); opacity: 1; }
    .nj-toast-icon { background: var(--nj-primary-light); color: var(--nj-primary); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
    .nj-toast-text { display: flex; flex-direction: column; }
    .nj-toast-title { font-weight: 700; color: var(--nj-text-main); font-size: 14px; margin-bottom: 2px; }
    .nj-toast-desc { color: var(--nj-text-muted); font-size: 13px; font-weight: 500; }

    /* Simple Custom Checkbox */
    .nj-checkbox-wrapper { display: flex; align-items: center; gap: 10px; cursor: pointer; margin-top: 12px; width: fit-content; }
    .nj-checkbox-wrapper input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; accent-color: var(--nj-primary); border-radius: 4px; }
    .nj-checkbox-text { font-size: 14px; color: var(--nj-text-muted); font-weight: 500; transition: color 0.2s;}
    .nj-checkbox-wrapper:hover .nj-checkbox-text { color: var(--nj-text-main); }
</style>

<h2 class="page-title"><?= $judul ?></h2>

<div class="row">
    <div class="col-md-12">
        <div class="nj-card">
            <div style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;">
                <button data-toggle="modal" data-target="#tambah" class="nj-btn nj-btn-primary">
                    <i class="fa fa-plus"></i> Tambah Admin Baru
                </button>
            </div>
            
            <div class="table-responsive">
                <table id="tabelbiasa" class="table table-modern">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Nama Admin</th>
                            <th>Username</th>
                            <th>Level Akses</th>
                            <th class="text-center" width="18%">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($DataAdmin as $data) {  ?>
                        <tr>
                            <td class="text-center" style="color: var(--nj-text-muted); font-weight: 600;"><?= $no++ ?></td>
                            <td><strong style="color: var(--nj-text-main); font-size: 15px; letter-spacing: -0.2px;"><?= $data->nama_admin ?></strong></td>
                            <td style="color: var(--nj-text-muted);"><i class="fa fa-user-circle-o" style="margin-right: 6px; opacity: 0.5;"></i><?= $data->username ?></td>
                            <td>
                                <span class="nj-badge">
                                    <?= $data->nama_level ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a class="nj-btn nj-btn-secondary nj-btn-sm" data-toggle="modal" data-target="#edit" href="#" onclick="edit('<?=$data->id_admin?>')">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <a class="nj-btn nj-btn-danger nj-btn-sm" data-toggle="modal" data-target="#hapus" href="#" onclick="edit('<?=$data->id_admin?>')">
                                        <i class="fa fa-trash-o"></i> Hapus
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

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fa fa-user-plus" style="margin-right: 8px; color: var(--nj-primary);"></i>Tambah Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?=base_url('data_admin/tambah_admin')?>" method="post">
                <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="modal-label">Nama Lengkap</label>
                        <input type="text" name="nama_admin" required="required" class="nj-input" placeholder="Misal: Budi Santoso">
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="modal-label">Jenis Hak Akses</label>
                        <select class="nj-select" name="id_level" required="required">
                            <option value="" disabled selected>-- Pilih Peran Level --</option>
                            <?php foreach ($DataLevel as $data) {  ?>
                            <option value="<?=$data->id_level?>"><?= $data->nama_level ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="modal-label">Username</label>
                        <input type="text" name="username" required="required" class="nj-input" placeholder="Untuk login aplikasi">
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="modal-label">Kata Sandi</label>
                        <input type="password" id="sp" name="password" required="required" class="nj-input" placeholder="Minimal 6 karakter">
                        
                        <label class="nj-checkbox-wrapper">
                            <input type="checkbox" name="check" onclick="FPassword()">
                            <span class="nj-checkbox-text">Tampilkan Kata Sandi</span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nj-btn nj-btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" name="tambah" class="nj-btn nj-btn-primary"><i class="fa fa-save"></i> Simpan Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fa fa-pencil-square-o" style="margin-right: 8px; color: var(--nj-primary);"></i>Edit Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?=base_url('data_admin/edit_admin')?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id_admin" name="id_admin" required="required">

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="modal-label">Nama Lengkap</label>
                        <input type="text" id="nama_admin" name="nama_admin" required="required" class="nj-input">
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="modal-label">Username</label>
                        <input type="text" id="username" name="username" required="required" class="nj-input">
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="modal-label">Jenis Hak Akses</label>
                        <select class="nj-select" id="id_level" name="id_level" required="required">
                            <option value="" disabled>-- Pilih Peran Level --</option>
                            <?php foreach ($DataLevel as $data) { ?>
                            <option value="<?=$data->id_level?>"><?= $data->nama_level ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nj-btn nj-btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" name="edit" class="nj-btn nj-btn-primary"><i class="fa fa-check"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 24px;">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 20px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?=base_url('data_admin/hapus_admin')?>" method="post">
                <div class="modal-body text-center" style="padding: 10px 32px 32px 32px;">
                    <div style="width: 72px; height: 72px; background: var(--nj-danger-light); color: var(--nj-danger); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 32px; margin-bottom: 20px;">
                        <i class="fa fa-trash"></i>
                    </div>
                    <h4 style="font-weight: 800; color: var(--nj-text-main); margin-bottom: 12px; font-size: 22px; letter-spacing: -0.5px;">Hapus Data?</h4>
                    <p style="color: var(--nj-text-muted); font-size: 14px; margin-bottom: 0; line-height: 1.6;">Admin ini akan dihapus secara permanen dari sistem. Tindakan ini tidak bisa dibatalkan.</p>
                    
                    <input type="hidden" id="id_admin1" name="id_admin" required="required">
                </div>
                
                <div class="modal-footer" style="padding: 20px; background: #fff; border-top: none; display: flex; gap: 12px;">
                    <button type="button" class="nj-btn nj-btn-secondary" data-dismiss="modal" style="flex: 1; padding: 12px;">Batal</button>
                    <button type="submit" class="nj-btn nj-btn-danger" style="flex: 1; padding: 12px; background: var(--nj-danger); color: white;">Ya, Hapus</button>
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
            <span class="nj-toast-title">Berhasil Memperbarui!</span>
            <span class="nj-toast-desc"><?= $this->session->flashdata('pesan_sukses'); ?></span>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toast = document.getElementById('njToast');
        setTimeout(() => { toast.classList.add('show'); }, 150);
        // Toast otomatis hilang setelah 4 detik, efek melayang halus
        setTimeout(() => { 
            toast.classList.remove('show'); 
            setTimeout(() => { toast.style.display = 'none'; }, 400);
        }, 4000);
    });
</script>
<?php endif; ?>

<script>
    // Fungsi Lihat Password
    function FPassword() {
        var x = document.getElementById("sp");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    // Fungsi Ambil Data Edit via AJAX
    function edit(a) {
        $.ajax({
            type: "post",
            url: "<?=base_url()?>data_admin/detail_admin/" + a,
            dataType: "json",
            success: function (data) {
                $("#id_admin").val(data.id_admin);
                $("#nama_admin").val(data.nama_admin);
                $("#id_level").val(data.id_level);
                $("#username").val(data.username);
                $("#id_admin1").val(data.id_admin);
            }
        });
    }
</script>