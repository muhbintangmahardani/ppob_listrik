<style>
    /* --- NEXT.JS STYLE BASE --- */
    :root {
        --nj-primary: #0070f3;
        --nj-text-main: #111827;
        --nj-text-muted: #64748b;
        --nj-border: #eaeaea;
        --nj-bg-subtle: #fafafa;
    }

    .page-title { font-weight: 700; color: var(--nj-text-main); margin-bottom: 24px; font-size: 24px; letter-spacing: -0.5px; }
    
    .nj-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid var(--nj-border);
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
    .nj-btn-primary { background: var(--nj-primary); color: #fff; box-shadow: 0 4px 14px 0 rgba(0,118,255,0.39); }
    .nj-btn-primary:hover { background: #0060d9; color: #fff; transform: translateY(-1px); }
    .nj-btn-secondary { background: #fff; color: #475569; border-color: #e2e8f0; }
    .nj-btn-secondary:hover { background: #f8fafc; color: #0f172a; border-color: #cbd5e1; }

    /* --- REALTIME BADGE --- */
    .live-dot { 
        height: 10px; width: 10px; background-color: #22c55e; border-radius: 50%; 
        display: inline-block; margin-right: 6px; box-shadow: 0 0 0 2px #bbf7d0; 
        animation: blinker 1.5s infinite; 
    }
    @keyframes blinker { 50% { opacity: 0; } }

    /* --- STATUS BADGES --- */
    .badge-lunas {
        background-color: #dcfce7; color: #16a34a; padding: 6px 12px; border-radius: 50px; 
        font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; border: 1px solid #bbf7d0;
    }
    .badge-pending {
        background-color: #fef9c3; color: #ca8a04; padding: 6px 12px; border-radius: 50px; 
        font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; border: 1px solid #fde047;
    }
    .badge-dot { width: 6px; height: 6px; border-radius: 50%; }
    .dot-lunas { background-color: #16a34a; }
    .dot-pending { background-color: #ca8a04; }

    /* --- TABLE STYLING --- */
    .table-modern { width: 100% !important; border-collapse: separate !important; border-spacing: 0 !important; }
    .table-modern thead th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 13px; text-transform: uppercase; padding: 16px; border-bottom: 1px solid var(--nj-border); border-top: 1px solid var(--nj-border); }
    .table-modern thead th:first-child { border-left: 1px solid var(--nj-border); border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
    .table-modern thead th:last-child { border-right: 1px solid var(--nj-border); border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
    .table-modern tbody td { padding: 16px; vertical-align: middle !important; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 14px; }
    .table-modern tbody tr:hover td { background-color: #f8fafc; }

    /* =========================================
       DATATABLES NEXT.JS & BOOTSTRAP OVERRIDE 
       ========================================= */
    .dataTables_wrapper { font-size: 14px; color: var(--nj-text-muted); margin-top: 8px; width: 100%; }
    
    /* 1. Reset Grid Bootstrap yang bikin celah kosong */
    .dataTables_wrapper > .row { margin-left: 0 !important; margin-right: 0 !important; width: 100%; }
    .dataTables_wrapper > .row > [class*="col-"] { padding-left: 0 !important; padding-right: 0 !important; }

    /* 2. Baris Atas (Show & Search) */
    .dataTables_wrapper > .row:first-child { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px !important; }
    
    .dataTables_length select { border: 1px solid var(--nj-border); border-radius: 6px; padding: 6px 12px; margin: 0 6px; outline: none; background: #fff; cursor: pointer; }
    .dataTables_filter input { border: 1px solid var(--nj-border); border-radius: 8px; padding: 6px 12px; outline: none; background: #fff; margin-left: 8px; }

    /* 3. Baris Bawah (Info & Pagination) - Paksa Flexbox mentok kanan-kiri */
    .dataTables_wrapper > .row:last-child { 
        display: flex !important; 
        justify-content: space-between !important; 
        align-items: center !important; 
        margin-top: 20px !important; 
    }

    .dataTables_info { padding-top: 0 !important; margin-top: 0 !important; }
    
    /* 4. Memastikan Pagination Mentok Sejajar Kolom Aksi */
    .dataTables_paginate { 
        display: flex !important; 
        justify-content: flex-end !important; 
        margin: 0 !important; 
        padding: 0 !important; 
    }
    .dataTables_paginate ul.pagination { 
        margin: 0 !important; 
        justify-content: flex-end !important; 
    }
    
    /* Modifikasi UI Tombol Pagination Bootstrap agar lebih estetik */
    .dataTables_wrapper .pagination .page-item .page-link {
        border-radius: 8px !important;
        margin-left: 4px !important;
        border: 1px solid transparent;
        color: var(--nj-text-muted);
        background: transparent;
        transition: all 0.2s;
        box-shadow: none !important;
    }
    .dataTables_wrapper .pagination .page-item.active .page-link,
    .dataTables_wrapper .pagination .page-item .page-link:hover {
        background: var(--nj-primary) !important;
        color: white !important;
        border-color: var(--nj-primary) !important;
        font-weight: 600;
    }
    .dataTables_wrapper .pagination .page-item.disabled .page-link {
        opacity: 0.5; background: transparent; color: var(--nj-text-muted);
    }
    /* ========================================= */

    /* --- IMAGE ZOOM --- */
    .img-zoom { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: transform 0.3s ease; cursor: pointer; position: relative; z-index: 1; display: block; }
    .img-zoom:hover { transform: scale(4); z-index: 9999 !important; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }

    /* --- MODAL INVOICE STYLING --- */
    .modal-content { border-radius: 20px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.15); overflow: hidden; }
    .invoice-container { padding: 32px; background: #fff; }
    .invoice-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
    .invoice-section { display: flex; flex-direction: column; gap: 16px; }
    .invoice-title { font-size: 12px; font-weight: 700; color: var(--nj-text-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--nj-border); padding-bottom: 8px; margin-bottom: 8px; }
    .invoice-row { display: flex; flex-direction: column; gap: 4px; }
    .invoice-label { font-size: 13px; font-weight: 500; color: var(--nj-text-muted); }
    .nj-text-input { width: 100%; padding: 0; border: none; background: transparent !important; font-size: 15px; color: var(--nj-text-main); font-weight: 600; font-family: inherit; }
    .nj-text-input:disabled { color: var(--nj-text-main); opacity: 1; cursor: text; }
    .billing-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px dashed var(--nj-border); }
    .billing-row:last-child { border-bottom: none; }
    .billing-label { font-size: 14px; color: var(--nj-text-muted); font-weight: 500; }
    .billing-value { text-align: right; width: 120px; font-size: 15px; }
    .close-clean { background: transparent; border: none; font-size: 24px; color: var(--nj-text-muted); cursor: pointer; transition: color 0.2s; line-height: 1; }
    .close-clean:hover { color: var(--nj-text-main); }
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 class="page-title" style="margin-bottom: 0;"><?= $judul ?></h2>
    <div style="background: white; padding: 6px 14px; border-radius: 30px; border: 1px solid #eaeaea; font-size: 12px; font-weight: 600; color: #334155; display: flex; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <span class="live-dot"></span> Live Realtime
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="nj-card" style="padding-bottom: 32px;">
            <div class="table-responsive" id="tabel-container">
                <div class="text-center" style="padding: 50px; color: #94a3b8;">
                    <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                    <p style="margin-top: 10px;">Sedang memuat data realtime...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> 
        <div class="modal-content">
            <div style="padding: 24px 32px; border-bottom: 1px solid var(--nj-border); background: var(--nj-bg-subtle); display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h4 style="color: var(--nj-text-main); margin: 0; font-weight: 700; font-size: 20px; letter-spacing: -0.5px;">Invoice Pembayaran</h4>
                    <p style="margin: 4px 0 0 0; font-size: 13px; color: var(--nj-text-muted);">Detail lengkap riwayat transaksi listrik</p>
                </div>
                <button type="button" class="close-clean" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="invoice-container">
                <div class="invoice-grid">
                    
                    <div class="invoice-section">
                        <div class="invoice-title">Data Pelanggan</div>
                        <div class="invoice-row"><span class="invoice-label">Nama Lengkap</span><input type="text" id="nama_pelanggan" disabled class="nj-text-input" style="font-size: 18px; color: var(--nj-primary);"></div>
                        <div class="invoice-row"><span class="invoice-label">Nomor Meter / kWh</span><input type="text" id="nomor_kwh" disabled class="nj-text-input" style="font-family: monospace; font-size: 14px; letter-spacing: 1px;"></div>
                        <div style="display: flex; gap: 24px; margin-top: 8px;">
                            <div class="invoice-row"><span class="invoice-label">Bulan Tagihan</span><input type="text" id="bulan_bayar" disabled class="nj-text-input"></div>
                            <div class="invoice-row"><span class="invoice-label">Tanggal Bayar</span><input type="text" id="tanggal_pembayaran" disabled class="nj-text-input"></div>
                        </div>
                        <div class="invoice-row" style="margin-top: 8px;"><span class="invoice-label">Status</span><input type="text" id="status" disabled class="nj-text-input" style="color: #10b981;"></div>
                        <div class="invoice-row"><span class="invoice-label">Verifikator</span><input type="text" id="nama_admin" disabled class="nj-text-input"></div>
                        <div class="invoice-row" style="margin-top: 16px;">
                            <span class="invoice-label">Bukti Pembayaran</span>
                            <div id="container-bukti-manual" style="display:none; margin-top: 8px;">
                                <div style="padding: 8px; background: #f8fafc; border: 1px solid var(--nj-border); border-radius: 8px; display: inline-block;">
                                    <img src="" name="image" class="img-zoom" id="bukti" alt="Bukti Pembayaran">
                                </div>
                            </div>
                            <div id="container-bukti-midtrans" style="display:none; margin-top: 8px;">
                                <div style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; color: #16a34a; font-size: 13px; font-weight: 600;">
                                    <i class="fa fa-shield"></i> Terverifikasi Otomatis (Midtrans)
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="invoice-section">
                        <div class="invoice-title">Rincian Tagihan</div>
                        <div style="background: #f8fafc; border: 1px solid var(--nj-border); border-radius: 12px; padding: 16px;">
                            <div class="billing-row"><span class="billing-label">Meter Awal</span><div style="display: flex; align-items: center; gap: 4px; justify-content: flex-end;"><input type="text" id="meter_awal" disabled class="nj-text-input billing-value" style="width: auto;"><span style="font-size: 14px; color: var(--nj-text-muted);">kWh</span></div></div>
                            <div class="billing-row"><span class="billing-label">Meter Akhir</span><div style="display: flex; align-items: center; gap: 4px; justify-content: flex-end;"><input type="text" id="meter_akhir" disabled class="nj-text-input billing-value" style="width: auto;"><span style="font-size: 14px; color: var(--nj-text-muted);">kWh</span></div></div>
                            <div class="billing-row" style="border-bottom: none; padding-bottom: 0;"><span class="billing-label" style="font-weight: 600; color: var(--nj-text-main);">Total Pemakaian</span><div style="display: flex; align-items: center; gap: 4px; justify-content: flex-end;"><input type="text" id="jumlah_meter" disabled class="nj-text-input billing-value" style="width: auto; color: var(--nj-primary);"><span style="font-size: 14px; font-weight: 600; color: var(--nj-primary);">kWh</span></div></div>
                        </div>
                        <div style="padding: 0 4px;">
                            <div class="billing-row" style="border-bottom: none;"><span class="billing-label">Biaya Admin</span><span class="billing-value" style="font-weight: 600;">Rp 2.500</span></div>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; background: #111827; border-radius: 12px; padding: 16px 20px; margin-top: 16px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                            <span style="color: #94a3b8; font-weight: 600; font-size: 15px; white-space: nowrap;">Grand Total</span>
                            <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: nowrap; justify-content: flex-end;">
                                <span style="color: #94a3b8; font-weight: 500; font-size: 16px;">Rp</span>
                                <input type="text" id="total_bayar" disabled style="background: transparent; border: none; color: #ffffff; font-size: 24px; font-weight: 700; text-align: right; width: 130px; padding: 0; margin: 0; min-width: 0;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="border-top: 1px solid var(--nj-border); padding: 16px 32px; background: var(--nj-bg-subtle); display: flex; justify-content: flex-end;">
                <button type="button" class="nj-btn nj-btn-secondary" data-dismiss="modal" style="min-width: 120px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let tableCurrentPage = 0;
    let tableCurrentLength = 10;
    let tableSearchQuery = "";

    $(document).ready(function() {
        loadDataRealtime();
        setInterval(function(){ loadDataRealtime(); }, 4000); 
    });

    function loadDataRealtime() {
        $.ajax({
            url: "<?= base_url('riwayat/get_tabel_realtime') ?>", 
            type: "GET",
            cache: false, 
            data: { _: new Date().getTime() },
            success: function(data) {
                if ($.fn.DataTable.isDataTable('.table-modern')) {
                    let table = $('.table-modern').DataTable();
                    tableCurrentPage = table.page();
                    tableCurrentLength = table.page.len();
                    tableSearchQuery = table.search();
                    table.destroy();
                }

                $("#tabel-container").empty().html(data);

                let newTable = $('.table-modern').DataTable({
                    "pageLength": tableCurrentLength,
                    "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                    "autoWidth": false,
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ entri",
                        "search": "Cari:",
                        "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                        "paginate": { "first": "Awal", "last": "Akhir", "next": "Berikutnya", "previous": "Sebelumnya" }
                    },
                    "drawCallback": function(settings) {
                        let api = this.api();
                        api.rows().every(function() {
                            let rowNode = this.node();
                            $(rowNode).find('td').each(function() {
                                let cellText = $(this).text().trim();
                                if (cellText === 'Lunas' && $(this).find('.badge-lunas').length === 0) {
                                    $(this).html('<span class="badge-lunas"><span class="badge-dot dot-lunas"></span> Lunas</span>');
                                } else if (cellText === 'Pending' && $(this).find('.badge-pending').length === 0) {
                                    $(this).html('<span class="badge-pending"><span class="badge-dot dot-pending"></span> Pending</span>');
                                }
                            });
                        });
                    }
                });
                
                newTable.search(tableSearchQuery);
                if (tableCurrentPage > 0) {
                    newTable.page(tableCurrentPage).draw('page');
                }
            },
            error: function(xhr, status, error) { console.log("AJAX Error: ", xhr.responseText); }
        });
    }

    function edit(a) {
        $.ajax({
            type: "post",
            url: "<?=base_url()?>riwayat/detail_riwayat/" + a,
            dataType: "json",
            success: function (data) {
                if(data.bukti === 'MIDTRANS-OTOMATIS') {
                    $('#container-bukti-manual').hide();
                    $('#container-bukti-midtrans').show();
                    $("#nama_admin").val(data.nama_admin ? data.nama_admin : "Otomatis By System");
                } else {
                    $('#container-bukti-midtrans').hide();
                    $('#container-bukti-manual').show();
                    $("#bukti").attr('src','<?php echo base_url()?>assets/bukti/'+data.bukti);
                    $("#nama_admin").val(data.nama_admin);
                }

                $("#tanggal_pembayaran").val(data.tanggal_pembayaran);
                $("#nama_pelanggan").val(data.nama_pelanggan);
                $("#nomor_kwh").val(data.nomor_kwh);
                $("#meter_awal").val(data.meter_awal);
                $("#meter_akhir").val(data.meter_akhir);
                $("#jumlah_meter").val(data.jumlah_meter);
                $("#bulan_bayar").val(data.bulan_bayar);
                $("#status").val(data.status);
                
                let total = parseInt(data.total_bayar);
                if(!isNaN(total)) {
                    $("#total_bayar").val(total.toLocaleString('id-ID'));
                } else {
                    $("#total_bayar").val(data.total_bayar);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) { alert('Gagal mengambil data detail'); }
        });
    }
</script>