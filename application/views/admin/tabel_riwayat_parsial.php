<style>
    /* CSS khusus untuk animasi pending di tabel AJAX */
    .pending-dot { 
        height: 8px; width: 8px; background-color: #d97706; border-radius: 50%; 
        display: inline-block; box-shadow: 0 0 0 2px #fde68a; 
        animation: blinker-pending 1.5s infinite; 
    }
    @keyframes blinker-pending { 50% { opacity: 0; } }
</style>

<table class="table table-modern">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Tanggal</th>
            <th width="15%">Pelanggan</th>
            <th width="15%">No. Meter</th>
            <th width="15%">Bulan Bayar</th>
            <th width="12%">Total Bayar</th>
            <th width="10%" class="text-center">Status</th>
            <th width="13%" class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($DataRiwayat)): ?>
            <?php $no = 1; foreach($DataRiwayat as $data): ?>
            <tr>
                <td style="color: #64748b;"><?= $no++ ?></td>
                
                <td style="color: #334155; font-size: 13px;">
                    <?php 
                        if(!empty($data->tanggal_pembayaran) && $data->tanggal_pembayaran != '0000-00-00 00:00:00') {
                            echo date('d/m/Y H:i', strtotime($data->tanggal_pembayaran));
                        } else {
                            echo '<span style="color: #94a3b8; font-style: italic;">Menunggu...</span>';
                        }
                    ?>
                </td>
                
                <td style="font-weight: 600; color: #111827;">
                    <?= $data->nama_pelanggan ?>
                </td>
                
                <td style="font-family: monospace; color: #64748b; font-size: 13px;">
                    <?= $data->nomor_kwh ?>
                </td>
                
                <td style="color: #64748b;">
                    <?= isset($data->bulan_bayar) ? $data->bulan_bayar : '-' ?>
                </td>
                
                <td style="font-weight: 700; color: #047857;">
                    Rp <?= number_format($data->total_bayar, 0, ',', '.') ?>
                </td>
                
                <td class="text-center">
                    <?php if(strtolower($data->status) == "lunas"): ?>
                        <span class="nj-badge nj-badge-success">Lunas</span>
                        
                    <?php elseif(strtolower($data->status) == "batal" || strtolower($data->status) == "ditolak"): ?>
                        <span class="nj-badge nj-badge-danger"><?= ucfirst($data->status) ?></span>
                        
                    <?php else: ?>
                        <span class="nj-badge nj-badge-warning" style="display: inline-flex; align-items: center; gap: 6px;">
                            <span class="pending-dot"></span> Pending
                        </span>
                    <?php endif ?>
                </td>
                
                <td class="text-center">
                    <a href="javascript:void(0)" onclick="edit('<?= $data->id_pembayaran ?>')" data-toggle="modal" data-target="#detail" class="nj-btn nj-btn-primary nj-btn-sm" style="width: 100%;">
                        <i class="fa fa-eye"></i> Detail
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="text-center" style="padding: 60px 20px; color: #94a3b8;">
                    <i class="fa fa-inbox fa-3x" style="margin-bottom: 16px; color: #cbd5e1; display: block;"></i>
                    <span style="font-size: 15px; font-weight: 500;">Belum ada riwayat transaksi.</span>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>