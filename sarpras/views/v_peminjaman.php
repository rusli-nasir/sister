<script src="controllers/c_peminjaman.js"></script>
<script src="js/metro/metro-button-set.js"></script>
<script src="js/metro/metro-hint.js"></script>

<h4 style="color:white;">Peminjaman</h4>
<div id="loadarea"></div>

<button data-hint="Tambah Data" xclass="large" id="tambahBC"><span class="icon-plus-2"></span> </button>
<button data-hint="Field Pencarian" xclass="large" id="cariBC"><span class="icon-search"></span> </button>

<div class="input-control select span3">
    <!-- (name & id) usahakan sama  -->
    <!-- <select data-hint="lokasi" name="lokasiTB" id="lokasiS"></select> -->
    <select data-hint="lokasi" name="lokasiS" id="lokasiS"></select>
</div>

<table class="table hovered bordered striped">
    <thead>
        <tr style="color:white;"class="info">
            <th class="text-center">Peminjam</th>
            <th class="text-center">Barang</th>
            <th class="text-center">Tanggal Peminjaman</th>
            <th class="text-left">Tanggal Pengembalian</th>
            <th class="text-left">Tempat Peminjaman</th>
            <th class="text-left">Keterangann</th>
            <th class="text-left">Aksi</th>
        </tr>
        
    </thead>

    <tbody id="tbody">
        <!-- row table -->
    </tbody>
    <tfoot>
        
    </tfoot>
</table>
<!-- 
    // ---------------------- //
    // -- created by rovi  -- //
    // ---------------------- // 
 -->