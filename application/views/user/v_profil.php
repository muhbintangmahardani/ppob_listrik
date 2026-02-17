<style>
    /* STYLE KHUSUS PROFIL */
    .page-title { font-weight: 700; color: #111827; margin-bottom: 24px; font-size: 24px; }
    .nj-card { background: #ffffff; border-radius: 16px; border: 1px solid #eaeaea; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); padding: 30px; margin-bottom: 30px; }

    /* Avatar Area */
    .avatar-box { text-align: center; padding: 25px 20px; background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); border-radius: 12px; border: 1px solid #f1f5f9; margin-bottom: 20px; }
    .avatar-circle { width: 120px; height: 120px; background: #eff6ff; color: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 40px; font-weight: 700; margin: 0 auto 15px; border: 4px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.08); object-fit: cover; }
    
    /* Upload Button */
    .btn-upload { display: inline-block; padding: 6px 12px; background: #fff; border: 1px solid #cbd5e1; border-radius: 20px; font-size: 12px; color: #475569; cursor: pointer; margin-top: 10px; transition: all 0.2s; }
    .btn-upload:hover { background: #f1f5f9; color: #0f172a; border-color: #94a3b8; }

    /* Inputs */
    .nj-input { width: 100%; padding: 10px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; color: #1e293b; background: #fff; height: 42px; }
    .nj-input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); outline: none; }
    .nj-btn-primary { background: #0070f3; color: white; padding: 10px 20px; border-radius: 8px; border: none; font-weight: 600; }
    
    /* List Info */
    .info-list { list-style: none; padding: 0; margin-top: 20px; text-align: left; }
    .info-item { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px dashed #e2e8f0; font-size: 13px; }
    .info-label { color: #64748b; font-weight: 600; }
    .info-value { color: #0f172a; font-weight: 700; font-family: monospace; }
</style>

<h2 class="page-title"><?= $judul ?></h2>

<?php if($this->session->flashdata('pesan_sukses')): ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?= $this->session->flashdata('pesan_sukses') ?></div>
<?php endif; ?>
<?php if($this->session->flashdata('pesan_gagal')): ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?= $this->session->flashdata('pesan_gagal') ?></div>
<?php endif; ?>

<form action="<?= base_url('profil/update') ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="nj-card">
                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="avatar-box">
                            <?php 
                                // Tambahkan time() agar cache browser ter-refresh saat foto baru diupload
                                $foto_path = './assets/img/profil/'.$profil->foto_profil;
                                if(!empty($profil->foto_profil) && file_exists($foto_path)): 
                            ?>
                                <img src="<?= base_url('assets/img/profil/'.$profil->foto_profil) ?>?v=<?= time() ?>" class="avatar-circle">
                            <?php else: ?>
                                <div class="avatar-circle">
                                    <?= strtoupper(substr($profil->nama_pelanggan, 0, 1)) ?>
                                </div>
                            <?php endif; ?>

                            <h4 style="margin:0; font-weight:700; color:#1e293b;"><?= $profil->nama_pelanggan ?></h4>
                            <p style="margin:5px 0 0; color:#64748b; font-size:13px;">Pelanggan Listrik</p>

                            <label class="btn-upload">
                                <i class="fa fa-camera"></i> Ganti Foto
                                <input type="file" name="foto_profil" style="display: none;" onchange="$('#file-info').text('File: ' + this.files[0].name)">
                            </label>
                            <div id="file-info" style="font-size: 11px; color: #0070f3; margin-top: 5px;"></div>

                            <ul class="info-list">
                                <li class="info-item"><span class="info-label">ID Pelanggan</span><span class="info-value">#<?= $profil->id_pelanggan ?></span></li>
                                <li class="info-item"><span class="info-label">No. KWh</span><span class="info-value"><?= $profil->nomor_kwh ?></span></li>
                                <li class="info-item"><span class="info-label">Daya</span><span class="info-value"><?= number_format($profil->daya, 0, ',', '.') ?> VA</span></li>
                                <li class="info-item"><span class="info-label">Tarif</span><span class="info-value">Rp <?= number_format($profil->terperkwh, 0, ',', '.') ?></span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <h3 style="margin: 0 0 25px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Edit Data Diri</h3>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_pelanggan" class="nj-input" value="<?= $profil->nama_pelanggan ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="nj-input" value="<?= $profil->username ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat" class="nj-input" rows="3" style="height: auto;"><?= $profil->alamat ?></textarea>
                        </div>

                        <div style="background: #fffbeb; border: 1px solid #fef3c7; padding: 15px; border-radius: 8px; margin-top: 20px;">
                            <h5 style="margin:0 0 10px; font-weight:700; color:#d97706;"><i class="fa fa-lock"></i> Ganti Password</h5>
                            <input type="password" name="password" class="nj-input" placeholder="Masukkan password baru (Kosongkan jika tidak diganti)">
                        </div>

                        <div style="text-align: right; margin-top: 20px;">
                            <button type="submit" class="nj-btn-primary">
                                <i class="fa fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>