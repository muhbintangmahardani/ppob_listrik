<style>
  /* --- TYPOGRAPHY & CARD --- */
  .page-title { font-weight: 700; color: #111827; margin-bottom: 24px; font-size: 24px; letter-spacing: -0.5px; }
  .modern-card { background: #ffffff; border-radius: 16px; border: 1px solid #eaeaea; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); padding: 24px; margin-bottom: 30px; }

  /* --- TABLE STYLING --- */
  .table-modern { width: 100% !important; border-collapse: separate !important; border-spacing: 0 !important; }
  .table-modern thead th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 13px; text-transform: uppercase; padding: 16px; border-bottom: 1px solid #eaeaea; border-top: 1px solid #eaeaea; }
  .table-modern thead th:first-child { border-left: 1px solid #eaeaea; border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
  .table-modern thead th:last-child { border-right: 1px solid #eaeaea; border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
  .table-modern tbody td { padding: 16px; vertical-align: middle !important; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 14px; }
  .table-modern tbody tr:hover td { background-color: #f8fafc; }

  /* --- BADGES --- */
  .badge-modern { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; }
  .badge-warning { background-color: #fef3c7; color: #d97706; }
  .badge-success { background-color: #d1fae5; color: #059669; }
  .badge-danger { background-color: #fee2e2; color: #dc2626; }

  /* --- DATATABLES BUTTONS (EXPORT) MODERN STYLE --- */
  div.dt-buttons { margin-bottom: 15px; }
  button.dt-button, div.dt-button, a.dt-button { 
    background: #ffffff !important; border: 1px solid #e2e8f0 !important; 
    color: #475569 !important; border-radius: 8px !important; 
    padding: 8px 16px !important; font-size: 13px !important; 
    font-weight: 600 !important; box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
    transition: all 0.2s ease !important; margin-right: 6px !important;
    background-image: none !important;
  }
  button.dt-button:hover, div.dt-button:hover, a.dt-button:hover { 
      background: #f8fafc !important; border-color: #cbd5e1 !important; transform: translateY(-1px); color: #0070f3 !important; 
  }
  .dataTables_filter input { border-radius: 8px; border: 1px solid #eaeaea; padding: 8px 12px; outline: none; margin-left: 8px; }
</style>

<h2 class="page-title"><?= $judul ?></h2>

<div class="row">
  <div class="col-md-12">
    <div class="modern-card">
      <table id="tabellaporan" class="table table-modern" width="100%">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>Bulan Pembayaran</th>
            <th>Nama Pelanggan</th>
            <th>No. kWh</th>
            <th class="text-center">Meter Awal</th>
            <th class="text-center">Meter Akhir</th>
            <th class="text-center">Jumlah Meter</th>
            <th>Total Bayar</th>
            <th class="text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($DataPembayaran as $data) { ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><strong><?= $data->bulan_bayar ?></strong></td>
            <td><?= $data->nama_pelanggan ?></td>
            <td><?= $data->nomor_kwh ?></td>
            <td class="text-center"><?= $data->meter_awal ?> <span class="text-muted">kWh</span></td>
            <td class="text-center"><?= $data->meter_akhir ?> <span class="text-muted">kWh</span></td>
            <td class="text-center">
              <?php $jumlah = ($data->meter_akhir - $data->meter_awal) ?>
              <strong><?= $jumlah ?></strong> <span class="text-muted">kWh</span>
            </td>
            <td><strong>Rp <?= number_format($data->total_bayar,2,',','.') ?></strong></td>
            <td class="text-center">
              <?php if($data->status == "Belum Dikonfirmasi"): ?>
                <span class="badge-modern badge-warning"><?= $data->status ?></span>
              <?php elseif($data->status == "Lunas"): ?>
                <span class="badge-modern badge-success"><i class="fa fa-check-circle" style="margin-right:4px"></i> <?= $data->status ?></span>
              <?php else: ?>
                <span class="badge-modern badge-danger"><?= $data->status ?></span>
              <?php endif ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
// Pastikan menunggu jQuery dari template utama dimuat duluan
document.addEventListener("DOMContentLoaded", function() {
    $('#tabellaporan').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', text: '<i class="fa fa-files-o"></i> Copy' },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i> CSV' },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i> Excel' },
            // PDF di-set ke landscape agar tabel dengan kolom banyak ini muat dan rapi
            { extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf-o"></i> PDF', orientation: 'landscape', pageSize: 'A4' },
            { extend: 'print', text: '<i class="fa fa-print"></i> Print' }
        ],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: { next: '>>', previous: '<<' }
        }
    });
});
</script>