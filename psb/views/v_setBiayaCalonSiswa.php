<script src="controllers/c_kelas.js"></script>
<!-- <script src="js/metro/metro-button-set.js"></script> -->
<!-- <script src="js/metro/metro-hint.js"></script> -->

<h4 style="color:white;">Kelas</h4>
<div id="loadarea"></div>

<button data-hint="Tambah Data" xclass="large" id="tambahBC"><span class="icon-plus-2"></span> </button>
<button data-hint="Field Pencarian" xclass="large" id="cariBC"><span class="icon-search"></span> </button>
<div class="input-control select span3">
    <select data-hint="Departemen" name="departemenS" id="departemenS"></select>
</div>
<div class="input-control select span3">
    <select data-hint="Proses" name="prosesS" id="prosesS"></select>
</div>
<div class="input-control select span3">
    <select data-hint="Kelompok" name="kelompokS" id="kelompokS"></select>
</div>

<table class="table hovered bordered striped">
    <thead>
        <tr style="color:white;"class="info">
            <th class="text-left">Kriteria </th>
            <th class="text-left">Golongan</th>
            <th class="text-left">Besar Uang Pangkal</th>
            <th class="text-left">Besar Uang Sekolah</th>
            <!-- <th class="text-left">Keterangan</th> -->
            <th class="text-left">Aksi</th>
        </tr>
<!--         <tr style="display:none;" id="cariTR" class="selected">
            <th class="text-left"><input placeholder="kelas" id="kelasS" name="kelasS"></th>
            <th class="text-left"><input placeholder="wali" id="waliS" name="waliS"></th>
            <th class="text-left"></th>
            <th class="text-left"></th>
            <th class="text-left"></th>
            <th class="text-left"></th> 
        </tr>
 -->   
    </thead>

    <tbody id="tbody">
        <!-- row table -->
    </tbody>
    <tfoot>
        
    </tfoot>
</table>
