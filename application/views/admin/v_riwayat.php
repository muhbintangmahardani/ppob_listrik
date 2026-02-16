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

    /* --- IMAGE ZOOM --- */
    .img-zoom {
        width: 80px; height: 80px; object-fit: cover;
        border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer; position: relative; z-index: 1; display: block;
    }
    .img-zoom:hover {
        transform: scale(4); z-index: 9999 !important; box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    /* --- MODAL & FORM STYLING --- */
    .modal-content { border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.1); overflow: visible; }
    .close { font-size: 24px; color: #64748b; opacity: 1; transition: color 0.2s; }
    .close:hover { color: #0f172a; }
    
    .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
    .detail-item { display: flex; flex-direction: column; gap: 6px; }
    .detail-item.full-width { grid-column: 1 / -1; }
    .detail-label { font-size: 13px; font-weight: 600; color: #64748b; }
    
    .nj-input { 
        width: 100%; padding: 10px 14px; border: 1px solid #eaeaea; 
        border-radius: 8px; font-size: 14px; color: #111; 
        background: #fff; box-sizing: border-box; font-family: inherit;
    }
    .nj-input:disabled { background: #f8fafc; color: #475569; font-weight: 500; cursor: not-allowed; }
    
    .nj-input-group { 
        display: flex; align-items: stretch; border: 1px solid #eaeaea; 
        border-radius: 8px; overflow: hidden; background: #f8fafc; 
    }
    .nj-input-group .nj-input { border: none; border-radius: 0; background: transparent; flex: 1; min-width: 0; }
    .nj-input-group-addon { 
        padding: 10px 14px; background: #f1f5f9; color: #64748b; 
        font-size: 13px; font-weight: 600; display: flex; align-items: center;
    }
    .nj-input-group-addon.left { border-right: 1px solid #eaeaea; }
    .nj-input-group-addon.right { border-left: 1px solid #eaeaea; }
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
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>No. kWh</th>
                            <th>Bulan Bayar</th>
                            <th>Grand Total</th>
                            <th class="text-center">Status</th>
                            <th>Pemverifikasi</th>
                            <th class="text-center" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($DataRiwayat as $data) {  ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td style="color: #64748b;"><?= $data->tanggal_pembayaran ?></td>
                            <td style="font-weight: 600; color: #111827;"><?= $data->nama_pelanggan ?></td>
                            <td>
                                <span style="font-family: monospace; background:#f1f5f9; padding:4px 8px; border-radius:6px; font-size:13px; color:#475569;">
                                    <?= $data->nomor_kwh ?>
                                </span>
                            </td>
                            <td style="color: #64748b;"><?= $data->bulan_bayar ?></td>
                            <td style="font-weight: 600; color: #059669;">
                                Rp <?= number_format($data->total_bayar, 2, ',', '.') ?>
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
                            <td style="color: #475569; font-size: 13px;">
                                <i class="fa fa-user" style="margin-right:4px; opacity:0.5;"></i> <?= $data->nama_admin ?>
                            </td>
                            <td class="text-center">
                                <a onclick="edit('<?=$data->id_pembayaran ?>')" class="nj-btn nj-btn-primary nj-btn-sm" data-toggle="modal" data-target="#detail" href="#">
                                    <i class="fa fa-eye"></i> Detail
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

<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid #eaeaea; padding: 20px 24px; background: #fafafa;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -4px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 style="color: #111827; margin: 0; font-weight: 700; font-size: 18px;">
                    <i class="fa fa-file-text-o" style="color: #0070f3; margin-right: 8px;"></i> Detail Riwayat Pembayaran
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; background: #fff;">
                
                <div class="detail-grid">
                    <div class="detail-item">
                        <label class="detail-label">Tanggal Bayar</label>
                        <input type="text" id="tanggal_pembayaran" disabled class="nj-input">
                    </div>
                    
                    <div class="detail-item">
                        <label class="detail-label">Status</label>
                        <input type="text" id="status" disabled class="nj-input" style="font-weight: 700;">
                    </div>

                    <div class="detail-item full-width" style="margin-bottom: 8px;">
                        <label class="detail-label">Bukti Bayar</label>
                        <div style="padding: 12px; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px; display: inline-block;">
                            <img src="" name="image" class="img-zoom" id="bukti" alt="Bukti Pembayaran">
                        </div>
                        <small style="color: #94a3b8; font-size: 12px; margin-top: 4px;"><i class="fa fa-info-circle"></i> Arahkan kursor ke gambar untuk memperbesar</small>
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Nama Pelanggan</label>
                        <input type="text" id="nama_pelanggan" disabled class="nj-input">
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Nomor kWh</label>
                        <input type="text" id="nomor_kwh" disabled class="nj-input" style="font-family: monospace;">
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Bulan Bayar</label>
                        <input type="text" id="bulan_bayar" disabled class="nj-input">
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Pemverifikasi</label>
                        <input type="text" id="nama_admin" disabled class="nj-input">
                    </div>
                </div>

                <hr style="border-top: 1px dashed #eaeaea; margin: 24px 0;">

                <div class="detail-grid">
                    <div class="detail-item">
                        <label class="detail-label">Meter Awal</label>
                        <div class="nj-input-group">
                            <input type="text" value="2000" id="meter_awal" disabled class="nj-input text-right">
                            <span class="nj-input-group-addon right">kWh</span>
                        </div>
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Meter Akhir</label>
                        <div class="nj-input-group">
                            <input type="text" id="meter_akhir" disabled class="nj-input text-right">
                            <span class="nj-input-group-addon right">kWh</span>
                        </div>
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Total Meter Digunakan</label>
                        <div class="nj-input-group">
                            <input type="text" id="jumlah_meter" disabled class="nj-input text-right">
                            <span class="nj-input-group-addon right">kWh</span>
                        </div>
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Biaya Admin</label>
                        <div class="nj-input-group">
                            <span class="nj-input-group-addon left">Rp</span>
                            <input type="text" value="2500" disabled class="nj-input text-right">
                        </div>
                    </div>

                    <div class="detail-item full-width" style="margin-top: 8px;">
                        <label class="detail-label" style="color: #111;">Grand Total Bayar</label>
                        <div class="nj-input-group" style="background: #ecfdf5; border-color: #a7f3d0;">
                            <span class="nj-input-group-addon left" style="background: #d1fae5; color: #047857; border-color: #a7f3d0;">Rp</span>
                            <input type="text" id="total_bayar" disabled class="nj-input text-right" style="color: #047857; font-weight: 700; font-size: 16px;">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer" style="border-top: 1px solid #eaeaea; padding: 16px 24px; background: #fafafa;">
                <button type="button" class="nj-btn nj-btn-secondary w-100" data-dismiss="modal" style="width: 100%;">Tutup Detail</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function edit(a) {
        $.ajax({
            type: "post",
            url: "<?=base_url()?>riwayat/detail_riwayat/" + a,
            dataType: "json",
            success: function (data) {
                $("#bukti").attr('src','<?php echo base_url()?>assets/bukti/'+data.bukti);
                $("#tanggal_pembayaran").val(data.tanggal_pembayaran);
                $("#nama_pelanggan").val(data.nama_pelanggan);
                $("#nomor_kwh").val(data.nomor_kwh);
                $("#nama_admin").val(data.nama_admin);
                $("#meter_awal").val(data.meter_awal);
                $("#meter_akhir").val(data.meter_akhir);
                $("#jumlah_meter").val(data.jumlah_meter);
                $("#bulan_bayar").val(data.bulan_bayar);
                $("#id_level1").val(data.id_level);
                $("#status").val(data.status);
                
                // Format angka total bayar agar lebih rapi saat ditampilkan
                let total = parseInt(data.total_bayar);
                if(!isNaN(total)) {
                    $("#total_bayar").val(total.toLocaleString('id-ID'));
                } else {
                    $("#total_bayar").val(data.total_bayar);
                }
            }
        });
    }
</script>