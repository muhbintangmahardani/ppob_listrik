<style>
  /* --- TYPOGRAPHY & CARD --- */
  .page-title { font-weight: 700; color: #111827; margin-bottom: 24px; font-size: 24px; }
  .modern-card { background: #ffffff; border-radius: 16px; border: 1px solid #eaeaea; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); padding: 24px; margin-bottom: 30px; }

  /* --- TABLE --- */
  .table-modern { width: 100% !important; border-collapse: separate !important; border-spacing: 0 !important; }
  .table-modern thead th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 13px; text-transform: uppercase; padding: 16px; border-bottom: 1px solid #eaeaea; border-top: 1px solid #eaeaea; }
  .table-modern tbody td { padding: 16px; vertical-align: middle !important; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 14px; }

  /* --- BADGES --- */
  .badge-modern { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; }
  .badge-warning { background-color: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
  .badge-success { background-color: #d1fae5; color: #059669; border: 1px solid #bbf7d0; }
  .badge-danger { background-color: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }

  /* --- BUTTONS --- */
  .dt-button { background: #fff !important; border: 1px solid #ddd !important; border-radius: 4px !important; padding: 5px 10px !important; margin-right: 5px !important; }
</style>

<h2 class="page-title"><?= $judul ?></h2>

<div class="row">
  <div class="col-md-12">
    <div class="modern-card">
      <div class="table-responsive">
          <table id="tabellaporan" class="table table-modern" width="100%">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th>Tanggal</th>
                <th>Bulan Bayar</th>
                <th>Nama Pelanggan</th>
                <th>No. kWh</th>
                <th class="text-center">Total Meter</th>
                <th>Total Bayar</th>
                <th class="text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if(!empty($DataPembayaran)):
                  $no=1; 
                  foreach ($DataPembayaran as $data) { 
              ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= date('d/m/Y', strtotime($data->tanggal_pembayaran)) ?></td>
                <td style="font-weight:600;"><?= $data->bulan_bayar ?></td>
                
                <td><?= !empty($data->nama_pelanggan) ? $data->nama_pelanggan : 'Data Terhapus' ?></td>
                <td>
                    <span style="font-family: monospace; background:#f1f5f9; padding:2px 6px; border-radius:4px; color:#475569;">
                        <?= !empty($data->nomor_kwh) ? $data->nomor_kwh : '-' ?>
                    </span>
                </td>
                
                <td class="text-center">
                  <?php 
                    // Logika hitung meteran yang aman
                    $jumlah = 0;
                    if(!empty($data->jumlah_meter)) {
                        $jumlah = $data->jumlah_meter;
                    } elseif(isset($data->meter_akhir) && isset($data->meter_awal)) {
                        $jumlah = $data->meter_akhir - $data->meter_awal;
                    }
                  ?>
                  <strong><?= $jumlah ?></strong> kWh
                </td>
                
                <td style="font-weight:700; color:#059669;">
                    Rp <?= number_format($data->total_bayar, 0, ',', '.') ?>
                </td>
                
                <td class="text-center">
                  <?php if($data->status == "Lunas"): ?>
                    <span class="badge-modern badge-success">Lunas</span>
                  <?php elseif($data->status == "Ditolak"): ?>
                    <span class="badge-modern badge-danger">Ditolak</span>
                  <?php else: ?>
                    <span class="badge-modern badge-warning">Pending</span>
                  <?php endif ?>

                  <?php if($data->bukti == 'MIDTRANS-OTOMATIS'): ?>
                      <div style="font-size: 10px; color: #3b82f6; margin-top: 2px;">(Midtrans)</div>
                  <?php endif; ?>
                </td>
              </tr>
              <?php } // end foreach 
              else: ?>
              <tr>
                  <td colspan="8" class="text-center">Belum ada data pembayaran.</td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Cek jika jQuery & DataTable tersedia
    if (typeof $ !== 'undefined' && $.fn.DataTable) {
        $('#tabellaporan').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    }
});
</script>