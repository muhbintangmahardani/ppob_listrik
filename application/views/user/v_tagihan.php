<style>
  /* --- TYPOGRAPHY & HEADER --- */
  .page-title { font-weight: 700; color: #111827; margin-bottom: 24px; font-size: 24px; letter-spacing: -0.5px; }

  /* --- MODERN CARD/PANEL --- */
  .modern-card { background: #ffffff; border-radius: 16px; border: 1px solid #eaeaea; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); padding: 24px; margin-bottom: 30px; }

  /* --- MODERN TABLE --- */
  .table-modern { width: 100%; border-collapse: separate; border-spacing: 0; }
  .table-modern thead th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; padding: 16px; border-bottom: none; border-top: 1px solid #eaeaea; border-bottom: 1px solid #eaeaea; }
  .table-modern thead th:first-child { border-left: 1px solid #eaeaea; border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
  .table-modern thead th:last-child { border-right: 1px solid #eaeaea; border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
  .table-modern tbody td { padding: 16px; vertical-align: middle !important; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 14px; transition: background-color 0.2s ease; }
  .table-modern tbody tr:hover td { background-color: #f8fafc; }
  .table-modern tbody tr:last-child td { border-bottom: none; }

  /* --- MODERN BADGES (STATUS) --- */
  .badge-modern { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; }
  .badge-warning { background-color: #fef3c7; color: #d97706; }
  .badge-success { background-color: #d1fae5; color: #059669; }
  .badge-danger { background-color: #fee2e2; color: #dc2626; }

  /* --- MODERN BUTTONS --- */
  .btn-modern { background-color: #0070f3; color: white; border: none; border-radius: 8px; padding: 8px 16px; font-size: 13px; font-weight: 600; transition: all 0.2s ease; box-shadow: 0 4px 10px rgba(0, 112, 243, 0.2); }
  .btn-modern:hover { background-color: #005bb5; transform: translateY(-2px); color: white; }
  .btn-modern.btn-secondary { background: #f1f5f9; color: #475569; box-shadow: none; }
  .btn-modern.btn-secondary:hover { background: #e2e8f0; color: #0f172a; }

  /* --- DATA TABLES OVERRIDE --- */
  .dataTables_wrapper .dataTables_filter input { border-radius: 20px; border: 1px solid #eaeaea; padding: 6px 12px; margin-left: 8px; outline: none; }
  .dataTables_wrapper .dataTables_filter input:focus { border-color: #0070f3; box-shadow: 0 0 0 2px rgba(0,112,243,0.1); }
  .dataTables_wrapper .dataTables_length select { border-radius: 8px; border: 1px solid #eaeaea; padding: 4px; }

  /* --- IMAGE ZOOM --- */
  .img-zoom-wrapper { width: 60px; height: 60px; border-radius: 8px; overflow: hidden; border: 1px solid #eaeaea; margin: 0 auto; }
  .img-zoom { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
  .img-zoom-wrapper:hover .img-zoom { transform: scale(1.5); cursor: zoom-in; }

  /* --- MODAL STYLING --- */
  .modal-content { border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
  .modal-header { border-bottom: 1px solid #eaeaea; padding: 20px 24px; background: #fafafa; border-top-left-radius: 16px; border-top-right-radius: 16px; }
  .modal-footer { border-top: 1px solid #eaeaea; padding: 16px 24px; background: #fafafa; border-bottom-left-radius: 16px; border-bottom-right-radius: 16px; }
  .modal-title, .modal-header h4 { font-weight: 700; color: #111; margin: 0; }
</style>

<h2 class="page-title"><?= $judul ?></h2>

<div class="row">
  <div class="col-md-12">
    <div class="modern-card">
      <table id="tabelbiasa" class="table table-modern">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>Bulan Tagihan</th>
            <th>Jumlah Meter</th>
            <th>Biaya Admin</th>
            <th>Total Bayar</th>
            <th class="text-center">Bukti</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($DataTagihan as $data) :
              $cek_bayar=$this->tagihan->cek_pembayaran($data->id_tagihan); ?>
          <tr>
            <td class="text-center"><?=$no++ ?></td>
            <td><strong><?=$data->bulan ?> <?=$data->tahun ?></strong></td>
            <td><?= $data->jumlah_meter ?> <span class="text-muted">kWh</span></td>
            <td>
              <?php $admin = 2500 ?>
              Rp <?=number_format($admin,0,',','.') ?>
            </td>
            <td>
              <?php $bayar = ($data->jumlah_meter * $data->terperkwh + 2500) ?>
              <strong>Rp <?=number_format($bayar,0,',','.') ?></strong>
            </td>
            <td class="text-center">
              <?php if(@$cek_bayar->bukti!=""): ?>
                  <div class="img-zoom-wrapper">
                    <img src="<?=base_url('assets/bukti/'.$cek_bayar->bukti )?>" class="img-zoom" alt="Bukti">
                  </div>
              <?php else: ?>
                  <span class="text-muted" style="font-size: 12px;">-</span>
              <?php endif ?>
            </td>
            <td class="text-center">
              <?php if($data->status == "Belum Dikonfirmasi"): ?>
                <span class="badge-modern badge-warning"><?=$data->status?></span>
              <?php elseif($data->status == "Lunas"): ?>
                <span class="badge-modern badge-success"><i class="fa fa-check-circle" style="margin-right: 4px;"></i> <?=$data->status?></span>
              <?php else: ?>
                <span class="badge-modern badge-danger"><?=$data->status?></span>
              <?php endif ?>
            </td>
            <td class="text-center">
              <?php if($data->status != "Lunas"): ?>
                <button class="btn-modern" data-toggle="modal" data-target="#upload" onclick="bayar('<?=$data->id_tagihan?>')">
                  <i class="fa fa-upload"></i> Upload
                </button>
              <?php else: ?>
                <span class="text-success" style="font-weight: 600;"><i class="fa fa-check"></i> Selesai</span>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="formUpload" action="<?=base_url('tagihan/upload_bukti')?>" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4>Upload Bukti Pembayaran</h4>
        </div>
        <div class="modal-body" style="padding: 30px 24px;">
          
          <input type="hidden" name="id_tagihan" id="id_tagihan" required="required">

          <div class="form-group" style="margin-bottom: 0;">
            <label class="control-label col-md-4 col-sm-4 col-xs-12" style="text-align: left; padding-top: 8px;">Pilih File Gambar</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input type="file" id="bukti" name="bukti" required="required" class="form-control" style="border-radius: 8px; padding: 6px 12px; height: auto;">
              <small class="text-muted" style="display: block; margin-top: 8px;">Format JPG/PNG, Max 2MB.</small>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn-modern btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn-modern">Simpan Bukti</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="konfirmasi_upload" role="dialog" style="z-index: 1060;"> 
   <div class="modal-dialog modal-sm" style="margin-top: 15vh;">
     <div class="modal-content" style="text-align: center; padding: 20px;">
         <div class="modal-body">
             <i class="fa fa-question-circle" style="font-size: 48px; color: #0070f3; margin-bottom: 16px;"></i>
             <h4 style="font-weight: 700; color: #111; margin-bottom: 8px;">Konfirmasi Upload</h4>
             <p style="color: #64748b; margin-bottom: 20px; font-size: 14px;">Pastikan gambar bukti transfer yang dipilih sudah benar dan jelas. Lanjutkan?</p>
             <div style="display: flex; gap: 10px; justify-content: center;">
                 <button type="button" class="btn-modern btn-secondary" data-dismiss="modal" style="flex: 1;">Batal</button>
                 <button type="button" id="btn-submit-form" class="btn-modern" style="flex: 1;">Ya, Upload</button>
             </div>
         </div>
     </div>
   </div>
</div>

<div class="modal fade" id="pesan" role="dialog">
   <div class="modal-dialog modal-sm" style="margin-top: 15vh;">
     <div class="modal-content" style="text-align: center; padding: 20px;">
         <div class="modal-body">
             <i class="fa fa-check-circle" style="font-size: 48px; color: #10b981; margin-bottom: 16px;"></i>
             <h4 style="font-weight: 700; color: #111; margin-bottom: 8px;">Berhasil!</h4>
             <p style="color: #64748b; margin-bottom: 20px; font-size: 14px;"><?= $this->session->flashdata('pesan_sukses'); ?></p>
             <button type="button" class="btn-modern" data-dismiss="modal" style="width: 100%;">Tutup</button>
         </div>
     </div>
   </div>
</div>

<div class="modal fade" id="modal_gagal" role="dialog">
   <div class="modal-dialog modal-sm" style="margin-top: 15vh;">
     <div class="modal-content" style="text-align: center; padding: 20px;">
         <div class="modal-body">
             <i class="fa fa-times-circle" style="font-size: 48px; color: #dc2626; margin-bottom: 16px;"></i>
             <h4 style="font-weight: 700; color: #111; margin-bottom: 8px;">Oops, Gagal!</h4>
             <p style="color: #64748b; margin-bottom: 20px; font-size: 14px;"><?= $this->session->flashdata('pesan_gagal'); ?></p>
             <button type="button" class="btn-modern btn-secondary" data-dismiss="modal" style="width: 100%;">Tutup</button>
         </div>
     </div>
   </div>
</div>

<script type="text/javascript">
    function bayar(id_tagihan){
        $("#id_tagihan").val(id_tagihan);
    }

    $(document).ready(function() {
        // 1. Cegat proses submit form untuk modal konfirmasi
        $('#formUpload').on('submit', function(e) {
            e.preventDefault(); 
            $('#konfirmasi_upload').modal('show'); 
        });

        // 2. Jika tombol 'Ya, Upload' diklik, teruskan submit
        $('#btn-submit-form').on('click', function() {
            $('#konfirmasi_upload').modal('hide');
            $('#formUpload')[0].submit();
        });
    });
</script>

<?php if($this->session->flashdata('pesan_sukses') != ''): ?>
    <script>
        // setTimeout memastikan jQuery dan Bootstrap sudah selesai di-load oleh template
        setTimeout(function() {
            if (typeof jQuery !== 'undefined' && typeof $.fn.modal !== 'undefined') {
                $('#pesan').modal('show');
            } else {
                alert("Berhasil! <?= $this->session->flashdata('pesan_sukses'); ?>");
            }
        }, 600);
    </script>
<?php endif; ?>

<?php if($this->session->flashdata('pesan_gagal') != ''): ?>
    <script>
        setTimeout(function() {
            if (typeof jQuery !== 'undefined' && typeof $.fn.modal !== 'undefined') {
                $('#modal_gagal').modal('show');
            } else {
                alert("Gagal! <?= strip_tags($this->session->flashdata('pesan_gagal')); ?>");
            }
        }, 600);
    </script>
<?php endif; ?>