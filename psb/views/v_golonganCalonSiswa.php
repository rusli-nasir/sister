<script src="controllers/c_golonganCalonSiswa.js"></script>

<h4>Golongan Calon Siswa</h4>
<div id="loadarea"></div>
<button data-hint="Tambah Data" class="button" id="tambahBC"><i class="icon-plus-2 on-left"></i>Tambah </button>

<table class="table hovered bordered striped">
    <thead>
        <tr class="selected">
            <th class="text-left">No.</th>
            <th class="text-left">Nama Golongan</th>
            <th class="text-left">Keterangan</th>
            <th class="text-left">Aksi</th>
        </tr>
        <tr class="selected">
            <th class="text-left"></th>
            <th class="text-left"><input placeholder="golongan" id="golonganS"name="golonganS"></th>
            <th class="text-left"><input placeholder="keterangan" id="keteranganS"name="keteranganS"></th>
            <th class="text-left"></th>
        </tr>
    </thead>

    <tbody id="tbody">
        <!-- row table -->
    </tbody>
    <tfoot>
        
    </tfoot>
</table>
