<?php if($this->session->flashdata('pesan_sukses') !=''): ?>
    <script>
    $(document).ready(function(){
        $("#pesan").modal('show');
    });
    </script>
<?php endif; ?>

<style>
  /* --- TYPOGRAPHY --- */
  .page-title { font-weight: 700; color: #111827; margin-bottom: 24px; font-size: 24px; letter-spacing: -0.5px; }

  /* --- MODERN CARD --- */
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

  /* --- DATATABLES BUTTONS (EXPORT) --- */
  .dt-buttons { margin-bottom: 20px; display: flex; gap: 8px; flex-wrap: wrap; }
  .dt-button { 
    background: #ffffff !important; border: 1px solid #e2e8f0 !important; 
    color: #475569 !important; border-radius: 8px !important; 
    padding: 8px 16px !important; font-size: 13px !important; 
    font-weight: 600 !important; box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
    transition: all 0.2s ease !important;
  }
  .dt-button:hover { background: #f8fafc !important; border-color: #cbd5e1 !important; transform: translateY(-1px); }
  .buttons-pdf { background: #fef2f2 !important; color: #dc2626 !important; border-color: #fee2e2 !important; }
  .buttons-pdf:hover { background: #fee2e2 !important; }

  /* --- UI ELEMENTS --- */
  .btn-modern { background-color: #0070f3; color: white; border: none; border-radius: 8px; padding: 8px 16px; font-weight: 600; transition: all 0.2s ease; }
  .btn-modern:hover { background-color: #005bb5; transform: translateY(-2px); color: white; }
  .btn-secondary-modern { background: #f1f5f9; color: #475569; }

  .dataTables_filter input { border-radius: 8px; border: 1px solid #eaeaea; padding: 8px 12px; outline: none; }
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
              <strong>Rp <?= number_format($bayar,0,',','.') ?></strong>
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

<div class="modal fade" id="pesan" role="dialog">
   <div class="modal-dialog modal-sm" style="margin-top: 15vh;">
     <div class="modal-content" style="text-align: center; padding: 20px; border-radius: 16px; border: none;">
         <div class="modal-body">
             <i class="fa fa-check-circle" style="font-size: 48px; color: #10b981; margin-bottom: 16px;"></i>
             <h4 style="font-weight: 700; color: #111; margin-bottom: 8px;">Berhasil!</h4>
             <p style="color: #64748b; margin-bottom: 20px; font-size: 14px;"><?= $this->session->flashdata('pesan_sukses'); ?></p>
             <button type="button" class="btn-modern" data-dismiss="modal" style="width: 100%;">Tutup</button>
         </div>
     </div>
   </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    // Inisialisasi DataTable
    var table = $('#tabellaporan').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                title: 'Laporan_Tagihan',
                className: 'dt-button'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o"></i> PDF',
                title: 'Laporan Tagihan Listrik',
                className: 'dt-button buttons-pdf',
                orientation: 'portrait',
                pageSize: 'A4',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function (doc) {
                    // Styling PDF agar rapi
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    doc.styles.tableHeader.fillColor = '#0070f3';
                    doc.styles.tableHeader.color = 'white';
                    doc.styles.tableHeader.alignment = 'center';
                }
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Print',
                className: 'dt-button'
            }
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari data...",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                next: '<i class="fa fa-angle-right"></i>',
                previous: '<i class="fa fa-angle-left"></i>'
            }
        }
    });
});
</script>