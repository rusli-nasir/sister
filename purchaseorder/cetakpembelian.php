<?php

include 'includes/config.php';
include 'includes/mysql.php';
include 'includes/configsitus.php';
global $koneksi_db,$url_situs;
$tglmulai 		= $_GET['tglmulai'];
$tglakhir 		= $_GET['tglakhir'];
$carabayar 		= $_GET['carabayar'];
$detail 		= $_GET['detail'];
$jenisproduk 		= $_GET['jenisproduk'];
switch ($carabayar) {
   case 'Semua':
         $wherestatus="";
         break;
   case 'Tunai':
         $wherestatus="and carabayar='Tunai'";
         break;
   case 'Debet Card':
         $wherestatus="and carabayar='Debet Card'";
         break;
   case 'Hutang':
         $wherestatus="and carabayar='Hutang'";
         break;
}
echo "<html><head><title>Laporan Pembelian </title>";
echo '<style type="text/css">
   table { page-break-inside:auto; 
    font-size: 0.8em; /* 14px/16=0.875em */
font-family: "Times New Roman", Times, serif;
   }
   tr    { page-break-inside:avoid; page-break-after:auto }
	table {
    border-collapse: collapse;}
	th,td {
    padding: 5px;
}
.border{
	border: 1px solid black;
}
.border td{
	border: 1px solid black;
}
body {
	margin		: 0;
	padding		: 0;
    font-size: 1em; /* 14px/16=0.875em */
font-family: "Times New Roman", Times, serif;
    margin			: 2px 0 5px 0;
}
</style>';
echo "</head><body>";
echo'
<table align="center">
<tr><td colspan="7"><img style="margin-right:5px; margin-top:5px; padding:1px; background:#ffffff; float:left;" src="images/logo.png" height="70px"><br>
<b>Elyon Christian School</b><br>
Raya Sukomanunggal Jaya 33A, Surabaya 60187</td></tr>';

if(!$detail){
echo'<tr><td colspan="7"><h4>Laporan Pembelian, Dari '.tanggalindo($tglmulai).', Sampai '.tanggalindo($tglakhir).'</h4></td></tr>';
echo '
<tr class="border">
<td>No</td>
<td>No.Invoice</td>
<td>Tanggal</td>
<td>Supplier</td>
<td>Cara Bayar</td>
<td>Total</td>
<td>Bayar</td>
<td>Hutang</td>
<td>Termin</td>
<td>User</td>
</tr>';
$no =1;
$s = mysql_query ("SELECT * FROM `po_pembelian` where tgl >= '$tglmulai' and tgl <= '$tglakhir' $wherestatus order by tgl asc");	
while($datas = mysql_fetch_array($s)){
$id = $datas['id'];
$noinvoice = $datas['noinvoice'];
$nopo = $datas['nopo'];
$tgl = $datas['tgl'];
$kodesupplier = $datas['kodesupplier'];
$carabayar = $datas['carabayar'];
$total = $datas['total'];
$discount = $datas['discount'];
$netto = $datas['netto'];
$bayar = $datas['bayar'];
$hutang = $datas['hutang'];
$termin = $datas['termin'];
if($termin!=''){
$termin = $termin." Hari";
}
$user = $datas['user'];
$urutan = $no + 1;
echo '
<tr class="border">
<td class="text-center">'.$no.'</td>
<td>'.$noinvoice.'</td>
<td>'.tanggalindo($tgl).'</td>
<td>'.getnamasupplier($kodesupplier).'</td>
<td>'.$carabayar.'</td>
<td>'.rupiah_format($total).'</td>
<td>'.rupiah_format($bayar).'</td>
<td>'.rupiah_format($hutang).'</td>
<td>'.$termin.'</td>
<td>'.$user.'</td>
</tr>';
$no++;
$ttotal+=$total;
$tbayar+=$bayar;
$thutang+=$hutang;
}
echo '
<tr class="border" align="right">
<td colspan="5"><b>Grand Total :</b></td>
<td>'.rupiah_format($ttotal).'</td>
<td>'.rupiah_format($tbayar).'</td>
<td>'.rupiah_format($thutang).'</td>
<td colspan="2"></td>
</tr>';
echo '</table>';
}else{
echo'<tr><td colspan="8"><h4>Laporan Pembelian, Dari '.tanggalindo($tglmulai).', Sampai '.tanggalindo($tglakhir).'</h4></td></tr>';
echo '
<tr class="border">
<td>No</td>
<td>No.Invoice</td>
<td>Tanggal</td>
<td>Supplier</td>
<td>Cara Bayar</td>
<td>Jenis</td>
<td>Kode Barang</td>
<td>Nama Barang</td>
<td>Harga</td>
<td>Jumlah</td>
<td>Sub Discount</td>
<td>Sub Total</td>
<td>User</td>
</tr>';
$no =1;
$s = mysql_query ("SELECT * FROM `po_pembelian` where tgl >= '$tglmulai' and tgl <= '$tglakhir' $wherestatus order by tgl asc");	
while($datas = mysql_fetch_array($s)){
$id = $datas['id'];
$noinvoice = $datas['noinvoice'];
$tgl = $datas['tgl'];
$kodesupplier = $datas['kodesupplier'];
$carabayar = $datas['carabayar'];
$user = $datas['user'];
$netto = $datas['netto'];
$tnetto += $netto;
$urutan = $no + 1;
$s2 = mysql_query ("SELECT * FROM `po_pembeliandetail` where noinvoice = '$noinvoice'order by id asc");	
while($datas2 = mysql_fetch_array($s2)){
$kodebarang = $datas2['kodebarang'];
$jumlah = $datas2['jumlah'];
$harga = $datas2['harga'];
$subdiscount = $datas2['subdiscount'];
$subtotal = $datas2['subtotal'];
$jenisbarangid = getjenisbarangid($kodebarang);
if($jenisbarangid==$jenisproduk){
echo '
<tr class="border">
<td class="text-center">'.$no.'</td>
<td>'.$noinvoice.'</td>
<td>'.tanggalindo($tgl).'</td>
<td>'.getnamasupplier($kodesupplier).'</td>
<td>'.$carabayar.'</td>
<td>'.getjenisbarang($kodebarang).'</td>
<td>'.$kodebarang.'</td>
<td>'.getnamabarang($kodebarang).'</td>
<td>'.rupiah_format($harga).'</td>
<td>'.$jumlah.'</td>
<td>'.cekdiscountpersen($subdiscount).'</td>
<td>'.rupiah_format($subtotal).'</td>
<td>'.$user.'</td>
</tr>';
$no++;
$grandtotal+=$subtotal;
}else
if($jenisproduk=='Semua'){
echo '
<tr class="border">
<td class="text-center">'.$no.'</td>
<td>'.$noinvoice.'</td>
<td>'.tanggalindo($tgl).'</td>
<td>'.getnamasupplier($kodesupplier).'</td>
<td>'.$carabayar.'</td>
<td>'.getjenisbarang($kodebarang).'</td>
<td>'.$kodebarang.'</td>
<td>'.getnamabarang($kodebarang).'</td>
<td>'.rupiah_format($harga).'</td>
<td>'.$jumlah.'</td>
<td>'.cekdiscountpersen($subdiscount).'</td>
<td>'.rupiah_format($subtotal).'</td>
<td>'.$user.'</td>
</tr>';
$no++;
$grandtotal+=$subtotal;	
	
}

}
}

echo '
<tr class="border" align="right">
<td colspan="11"><b>Grand Total :</b></td>
<td>'.rupiah_format($grandtotal).'</td>
<td></td>
</tr>';
/*
echo '
<tr class="border" align="right">
<td colspan="12"><b>Grand Netto :</b></td>
<td>'.rupiah_format($tnetto).'</td>
<td></td>
</tr>';*/
echo '</table>';
}
/****************************/
echo "</body</html>";

if (isset($_GET['tglmulai'])){
echo "<script language=javascript>
window.print();
</script>";
}
?>
