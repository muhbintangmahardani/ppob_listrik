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

  /* --- UI ELEMENTS --- */
  .btn-modern { background-color: #0070f3; color: white; border: none; border-radius: 8px; padding: 8px 16px; font-weight: 600; transition: all 0.2s ease; }
  .btn-modern:hover { background-color: #005bb5; transform: translateY(-2px); color: white; }
  .btn-secondary-modern { background: #f1f5f9; color: #475569; border: none; border-radius: 8px; padding: 8px 16px; font-weight: 600; }
  
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
            <th>Bulan Tagihan</th>
            <th class="text-center">Meter Awal</th>
            <th class="text-center">Meter Akhir</th>
            <th class="text-center">Jumlah Meter</th>
            <th>Total Bayar</th>
            <th class="text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($DataTagihan as $data) : ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><strong><?= $data->bulan ?> <?= $data->tahun ?></strong></td>
            <td class="text-center"><?= $data->meter_awal ?> <span class="text-muted">kWh</span></td>
            <td class="text-center"><?= $data->meter_akhir ?> <span class="text-muted">kWh</span></td>
            <td class="text-center"><strong><?= $data->jumlah_meter ?></strong> <span class="text-muted">kWh</span></td>
            <td>
              <?php $bayar = ($data->jumlah_meter * $data->terperkwh + 2500) ?>
              <strong>Rp <?= number_format($bayar,2,',','.') ?></strong>
            </td>
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
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document" style="margin-top: 10vh;">
    <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
      <div class="modal-header" style="border-bottom: 1px solid #eaeaea; padding: 20px 24px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 0.5; margin-top: -10px;">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: 700; color: #111827; margin: 0;">Upload Bukti Pembayaran</h4>
      </div>
      <form action="<?=base_url('tagihan/upload_bukti')?>" method="post" enctype="multipart/form-data">
        <div class="modal-body" style="padding: 24px;">
          <input type="hidden" name="id_tagihan" id="id_tagihan" required>
          
          <div class="form-group" style="margin-bottom: 0;">
            <label style="font-size: 14px; font-weight: 600; color: #475569; display: block; margin-bottom: 10px;">Pilih File Bukti <span class="text-danger">*</span></label>
            <input type="file" id="bukti" name="bukti" required class="form-control" style="border-radius: 8px; padding: 10px; height: auto;">
          </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #eaeaea; padding: 16px 24px;">
          <button type="button" class="btn-secondary-modern" data-dismiss="modal">Tutup</button>
          <button type="submit" name="upload" class="btn-modern"><i class="fa fa-upload" style="margin-right: 6px;"></i> Simpan Bukti</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="pesan" role="dialog">
   <div class="modal-dialog modal-sm" style="margin-top: 15vh;">
     <div class="modal-content" style="text-align: center; padding: 24px; border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
         <div class="modal-body">
             <i class="fa fa-check-circle" style="font-size: 48px; color: #10b981; margin-bottom: 16px;"></i>
             <h4 style="font-weight: 700; color: #111; margin-bottom: 8px;">Berhasil!</h4>
             <p style="color: #64748b; margin-bottom: 24px; font-size: 14px;"><?= $this->session->flashdata('pesan_sukses'); ?></p>
             <button type="button" class="btn-modern" data-dismiss="modal" style="width: 100%;">Tutup</button>
         </div>
     </div>
   </div>
</div>

<script>
// Fungsi Modal Upload
function bayar(id_tagihan){
    document.getElementById("id_tagihan").value = id_tagihan;
}

// Skrip baru dijalankan SETELAH template memuat jQuery di bagian paling bawah
document.addEventListener("DOMContentLoaded", function() {
    
    // Panggil Modal Pesan Sukses jika ada Flashdata dari Controller
    <?php if($this->session->flashdata('pesan_sukses') !=''): ?>
        $("#pesan").modal('show');
    <?php endif; ?>

    // Inisialisasi DataTables + Tombol Export
    $('#tabellaporan').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', text: '<i class="fa fa-files-o"></i> Copy' },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i> CSV' },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i> Excel' },
            { extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf-o"></i> PDF', orientation: 'portrait', pageSize: 'A4' },
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