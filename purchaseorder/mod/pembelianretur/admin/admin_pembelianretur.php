<?php
if (!defined('AURACMS_admin')) {
    Header("Location: ../index.php");
    exit;
}

if (!cek_login()){
    header("location: index.php");
    exit;
} else{

$JS_SCRIPT.= <<<js
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable({
    "iDisplayLength":50});
} );
</script>
js;
$JS_SCRIPT.= <<<js
<script type="text/javascript">
  $(function() {
$( "#tgl" ).datepicker({ dateFormat: "yy-mm-dd" } );
  });
  </script>
js;
$script_include[] = $JS_SCRIPT;
	
//$index_hal=1;	
	$admin  .='<legend>RETUR PEMBELIAN</legend>';
	$admin  .= '<div class="border2">
<table  width="25%"><tr align="center">
<td>
<a href="admin.php?pilih=pembelianretur&mod=yes">RETUR PEMBELIAN</a>&nbsp;&nbsp;
</td>
<td>
<a href="admin.php?pilih=pembelianretur&mod=yes&aksi=cetak">CETAK RETUR PEMBELIAN</a>&nbsp;&nbsp;
</td>
</tr></table>
</div>';
$admin .='<div class="panel panel-info">';
$admin .= '<script type="text/javascript" language="javascript">
   function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
</script>';
if ($_GET['aksi'] == ''){

if(isset($_POST['submitpembelianretur'])){
$noretur 		= $_POST['noretur'];
$noinvoice 		= $_POST['kodeinv'];
$tgl 		= $_POST['tgl'];
$kodesupplier 		= $_SESSION["kodesupplier"];
$total 		= $_POST['total'];
$user 		= $_POST['user'];
$carabayar 		= $_POST['carabayar'];

if (!$_SESSION["kodesupplier"])  	$error .= "Error:  Kode Supplier harus ada <br />";
if (!$_SESSION["product_id"])  	$error .= "Error:  Kode Barang harus ada <br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT noretur FROM po_pembelianretur WHERE noretur='$noretur'")) > 0) $error .= "Error: Nomor Retur ".$noretur." sudah terdaftar<br />";
foreach ($_SESSION["product_id"] as $cart_itm)
{
$kode = $cart_itm["kode"];
$jumlah = $cart_itm["jumlah"];
}
if ($error){
$admin .= '<div class="error">'.$error.'</div>';
}else{
if($carabayar=='Potong Hutang'){
potonghutang($noinvoice,$total);
}
$hasil  = mysql_query( "INSERT INTO `po_pembelianretur` VALUES ('','$noretur','$noinvoice','$tgl','$kodesupplier','$carabayar','$total','$user')" );
$idpembelian = mysql_insert_id();
foreach ($_SESSION["product_id"] as $cart_itm)
{
$kode = $cart_itm["kode"];
$jumlah = $cart_itm["jumlah"];
$harga = $cart_itm["harga"];
$subdiscount = $cart_itm["subdiscount"];
$subtotal = $cart_itm["subtotal"];
$hasil  = mysql_query( "INSERT INTO `po_pembelianreturdetail` VALUES ('','$noretur','$noinvoice','$kode','$jumlah','$harga','$subdiscount','$subtotal')" );
updatestokbeliretur($kode,$jumlah);
alurstok($tgl,'Retur Pembelian',$noretur,$kode,$jumlah);

}
if($hasil){
$admin .= '<div class="sukses"><b>Berhasil Menambah Retur Pembelian.</b></div>';
pembelianreturrefresh();
pembelianreturcetak($noretur);
unset ($kodesupplier);
}else{
$admin .= '<div class="error"><b>Gagal Menambah Retur Pembelian.</b></div>';
		}		
}	
}

if(isset($_POST['tambahsupplier'])){
$_SESSION['kodesupplier'] = $_POST['kodesupplier'];
}

if(isset($_POST['tambahinv'])){
$_SESSION['product_id']='';
$_SESSION['totalretur']='';
$_SESSION['kodeinv'] = $_POST['kodeinv'];
$hasil3 =  $koneksi_db->sql_query("SELECT * FROM po_pembelian WHERE noinvoice = '$_SESSION[kodeinv]'");
$data3 = $koneksi_db->sql_fetchrow($hasil3);
$kodesupplier = $data3['kodesupplier'];
$carabayar = $data3['carabayar'];
$termin = $data3['termin'];
$_SESSION['kodesupplier']=$kodesupplier;	  
$hasil =  $koneksi_db->sql_query( "SELECT * FROM po_pembeliandetail WHERE noinvoice='$_SESSION[kodeinv]'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) { 
$noinvoice=$data['noinvoice'];
$kode=$data['kodebarang'];
$jumlah=$data['jumlah'];
$harga=$data['harga'];
$subdiscount=$data['subdiscount'];
$subtotal=$data['subtotal'];
$hasil2 =  $koneksi_db->sql_query( "SELECT * FROM sar_katalog WHERE replid='$kode'" );
$data2 = $koneksi_db->sql_fetchrow($hasil2);
$id=$data2['id'];
$getstokminusreturbeli = $jumlah-cekjumreturbeli($noinvoice,$kode);
$subtotal=$getstokminusreturbeli*$harga;
$PRODUCTID = array ();
foreach ($_SESSION['product_id'] as $k=>$v){
$PRODUCTID[] = $_SESSION['product_id'][$k]['kode'];
}
if (!in_array ($kode, $PRODUCTID)){
$_SESSION['product_id'][] = array ('id' => $id,'kode' => $kode, 'jumlah' => $getstokminusreturbeli, 'harga' => $harga, 'jenjang' => $jenjang, 'subdiscount' => $subdiscount, 'subtotal' => $subtotal);
}else{
foreach ($_SESSION['product_id'] as $k=>$v){
if($kode == $_SESSION['product_id'][$k]['kode'])
	{
$_SESSION['product_id'][$k]['jumlah'] = $_SESSION['product_id'][$k]['jumlah'];
    }
}
}
}
}

if(isset($_POST['deletesupplier'])){
pembelianreturrefresh();
}

if($_SESSION["kodesupplier"]!=''){
$supplier = '
		<td>Nama Supplier</td>
		<td>:</td>
		<td>'.getnamasupplier($_SESSION['kodesupplier']).'</td>';
}else{
$supplier = '
		<td></td>
		<td></td>
		<td></td>';	
	
}

if(isset($_POST['hapusbarang'])){
$kode 		= $_POST['kode'];
foreach ($_SESSION['product_id'] as $k=>$v){
    if($kode == $_SESSION['product_id'][$k]['kode'])
	{
unset($_SESSION['product_id'][$k]);
    }
}
}
/*
if(isset($_POST['editjumlah'])){
$kode 		= $_POST['kode'];
$jumlahbeli = $_POST['jumlahbeli'];
$subdiscount = $_POST['subdiscount'];
foreach ($_SESSION['product_id'] as $k=>$v){
    if($kode == $_SESSION['product_id'][$k]['kode'])
	{
$harga = $_SESSION['product_id'][$k]['harga'];
$nilaidiscount=cekdiscount($subdiscount,$harga);
$_SESSION['product_id'][$k]['subdiscount']=$subdiscount;
$_SESSION['product_id'][$k]['jumlah']=$jumlahbeli;
$_SESSION['product_id'][$k]['subtotal'] = $jumlahbeli*($_SESSION['product_id'][$k]['harga']-$nilaidiscount);
		}
}
}
*/
if(isset($_POST['simpandetail'])){
foreach ($_SESSION['product_id'] as $k=>$v){
if (($_POST['jumlahbeliasli'][$k]<$_POST['jumlahbeli'][$k])or($_POST['jumlahbeli'][$k]<'0')) $error .= "Error: Jumlah tidak sesuai , silahkan ulangi.<br />";
if ($error){
$admin .= '<div class="error">'.$error.'</div>';
}else{
$_SESSION['product_id'][$k]['subdiscount']=$_POST['subdiscount'][$k];
$_SESSION['product_id'][$k]['jumlah']=$_POST['jumlahbeli'][$k];
$_SESSION['product_id'][$k]['harga']=$_POST['harga'][$k];
$_SESSION['product_id'][$k]['jumlahbeliasli']=$_POST['jumlahbeliasli'][$k];
$nilaidiscount=cekdiscount($_SESSION['product_id'][$k]['subdiscount'],$_SESSION['product_id'][$k]['harga']);
$_SESSION['product_id'][$k]['subtotal'] =$_SESSION['product_id'][$k]['jumlah']*($_SESSION['product_id'][$k]['harga']-$nilaidiscount);
}
}
$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=pembelianretur&mod=yes" />';
}

if(isset($_POST['tambahbarang'])){
$kodebarang 		= $_POST['kodebarang'];
$jumlah 		= '1';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM po_produk WHERE kode='$kodebarang'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$id=$data['id'];
$kode=$data['kode'];
$stok=$data['jumlah'];
$harga=$data['hargabeli'];
$jenjang=$data['jenjang'];
$error 	= '';
if (!$kode)  	$error .= "Error:  Kode Barang Tidak di Temukan<br />";
if ($error){
$admin .= '<div class="error">'.$error.'</div>';
}else{

$PRODUCTID = array ();
foreach ($_SESSION['product_id'] as $k=>$v){
$PRODUCTID[] = $_SESSION['product_id'][$k]['kode'];
}
if (!in_array ($kode, $PRODUCTID)){
$subdiscount="0";
$subtotal=$harga;
$_SESSION['product_id'][] = array ('id' => $id,'kode' => $kode, 'jumlah' => $jumlah, 'harga' => $harga, 'jenjang' => $jenjang, 'subdiscount' => $subdiscount, 'subtotal' => $subtotal);
}else{
foreach ($_SESSION['product_id'] as $k=>$v){
    if($kode == $_SESSION['product_id'][$k]['kode'])
	{
	$subdiscount="0";
$_SESSION['product_id'][$k]['jumlah'] = $_SESSION['product_id'][$k]['jumlah']+1;
$_SESSION['product_id'][$k]['subtotal'] = $_SESSION['product_id'][$k]['jumlah']*$_SESSION['product_id'][$k]['harga'];
    }
}
		
}
}
}

if(isset($_POST['batalbeliretur'])){
pembelianreturrefresh();
}

$user = $_SESSION['UserName'];
$tglnow = date("Y-m-d");
$noretur = generatereturbeli();
$tgl 		= !isset($tgl) ? $tglnow : $tgl;
$kodeinv 		= !isset($kodeinv) ? $_SESSION['kodeinv'] : $kodeinv;
$kodesupplier 		= !isset($kodesupplier) ? $_SESSION['kodesupplier'] : $kodesupplier;

$sel2 .= '</select>'; 
$admin .= '
<div class="panel-heading"><b>Transaksi Retur Pembelian</b></div>';	
$admin .= '
<form method="post" action="" class="form-inline"id="posts">
<table class="table table-striped table-hover">';
$admin .= '
	<tr>
		<td>Nomor Retur</td>
		<td>:</td>
		<td><input type="text" name="noretur" value="'.$noretur.'" class="form-control"></td>
'.$supplier.'
	</tr>';
$admin .= '
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><input type="text" id="tgl" name="tgl" value="'.$tgl.'" class="form-control">&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>';
$admin .= '
	<tr>
		<td>Kode Invoice</td>
		<td>:</td>
		<td><select class="form-select" name="kodeinv"id="combobox2">';
$hasil = $koneksi_db->sql_query( "SELECT * FROM po_pembelian ORDER BY id DESC" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) { 
$pilihan = ($data['noinvoice']==$kodeinv)?"selected":'';
	$admin .= '
			<option value="'.$data['noinvoice'].'"'.$pilihan.'>'.$data['noinvoice'].' ~ '.getnamasupplier($data['kodesupplier']).' ~ '.$data['total'].'</option>';
}
	$admin .= '</select>&nbsp;<input type="submit" value="Tambah INV" name="tambahinv"class="btn btn-success" >&nbsp;<input type="submit" value="Delete" name="deletesupplier"class="btn btn-danger" >&nbsp;</td>
<td>Cara Pembayaran</td>
		<td>:</td>
		<td>'.$carabayar.'<input type="hidden" name="carabayar" value="'.$carabayar.'" class="form-control"></td>
		</tr>';
$admin .= '	
	<tr><td colspan="5"><input type="hidden"  name="kodesupplier" value="'.$kodesupplier.'"class="form-control" ></td>
		<td>
		</td>
	</tr>
</table>';	
$admin .='</div>';
if(($_SESSION["product_id"])!=""){
$no=1;
$admin .='<div class="panel panel-info">';
$admin .= '
<div class="panel-heading"><b>Detail Retur Pembelian</b></div>';	
$admin .= '
<table class="table table-striped table-hover">';
$admin .= '	
	<tr>
			<th><b>No</b></</th>
		<th><b>Kode</b></</th>
		<th><b>Nama</b></td>
		<th><b>Jumlah</b></</td>
		<th><b>Harga</b></</th>
<th><b>Discount</b></</th>
<th><b>SubDiscount</b></</th>
<th><b>Subtotal</b></</th>
		<th><b>Aksi</b></</th>
	</tr>';
	if ($_GET['editdetail']){
foreach ($_SESSION["product_id"] as $cart_itm)
        {
$array =$no-1;
$nilaidiscount=cekdiscount($cart_itm["subdiscount"],$cart_itm["harga"]);
$admin .= '
<form method="post" action="" class="form-inline"id="posts">';
$admin .= '	
	<tr>
			<td>'.$no.'</td>
			<td>'.$cart_itm["kode"].'</td>
		<td>'.getnamabarang($cart_itm["kode"]).'</td>
		<td><input align="right" type="text" name="jumlahbeli['.$array.']" value="'.$cart_itm["jumlah"].'"class="form-control"></td>
		<td>'.$cart_itm["harga"].'</td>
		<td><input align="right" type="text" name="subdiscount['.$array.']" value="'.$cart_itm["subdiscount"].'"class="form-control"></td>
	<td>'.$nilaidiscount.'</td>
		<td>'.$cart_itm["subtotal"].'</td>
		<td>
		<input type="hidden" name="harga['.$array.']" value="'.$cart_itm["harga"].'">
<input type="hidden" name="jumlahbeliasli['.$array.']" value="'.$cart_itm["jumlah"].'">
		<input type="hidden" name="kode" value="'.$cart_itm["kode"].'"></td>
	</tr>';
	$total +=$cart_itm["subtotal"];
	$no++;
		}
$admin .= '	
	<tr>
		<td colspan="8" ></td>
		<td ><input type="submit" value="SIMPAN" name="simpandetail"class="btn btn-warning" ></td>
	</tr>';
	$admin .= '
</form>';
	}else{
foreach ($_SESSION["product_id"] as $cart_itm)
        {
$nilaidiscount=cekdiscount($cart_itm["subdiscount"],$cart_itm["harga"]);
$admin .= '	
	<tr>
			<td>'.$no.'</td>
			<td>'.$cart_itm["kode"].'</td>
		<td>'.getnamabarang($cart_itm["kode"]).'</td>
		<td>'.$cart_itm["jumlah"].'</td>
		<td>'.$cart_itm["harga"].'</td>
		<td>'.$cart_itm["subdiscount"].'</td>
	<td>'.$nilaidiscount.'</td>
		<td>'.$cart_itm["subtotal"].'</td>
		<td>
		
		<input type="hidden" name="kode" value="'.$cart_itm["kode"].'"></td>
	</tr>';
	$total +=$cart_itm["subtotal"];
	$no++;
		}
$admin .= '	
	<tr>
		<td colspan="8" ></td>
		<td ><a href="./admin.php?pilih=pembelianretur&mod=yes&editdetail=ok" class="btn btn-warning">Edit Detail</a></td>
	</tr>';			
	}
$_SESSION['totalretur']=$total;
$admin .= '	
	<tr>
		<td></td>
		<td></td>		
		<td colspan="6" align="right"><b>Total</b></td>
		<td ><input type="text" name="total" id="total"   class="form-control"  value="'.$_SESSION['totalretur'].'"/></td>
		<td></td>
	</tr>';
	if ($_GET['editdetail']){
$admin .= '
<tr><td colspan="7"></td>
<td></td></tr>';
	}else{
$admin .= '<tr><td colspan="7"></td><td align="right"></td>
		<td><input type="hidden" name="user" value="'.$user.'">
		<input type="submit" value="Batal" name="batalbeliretur"class="btn btn-danger" >
		<input type="submit" value="Simpan" name="submitpembelianretur"class="btn btn-success" >
		</td>
		<td></td></tr>';
		}
$admin .= '</table></form>';	
$admin .='</div>';
	}
}

if ($_GET['aksi'] == 'cetak'){
$koderetur     = $_POST['koderetur'];  
if(isset($_POST['batalcetak'])){
$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=pembelianretur&mod=yes&aksi=cetak" />';
}
$admin .= '
<div class="panel-heading"><b>Cetak Nota Retur Pembelian</b></div>';	
$admin .= '
<form method="post" action="" class="form-inline"id="posts">
<table class="table table-striped table-hover">';
$getlastreturbeli = getlastreturbeli();
$admin .= '
	<tr>
		<td>Kode Retur Pembelian</td>
		<td>:</td>
		<td><select class="form-select" name="koderetur"id="combobox2">';
$hasil = $koneksi_db->sql_query( "SELECT * FROM po_pembelianretur ORDER BY id DESC" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) { 
$pilihan = ($data['noretur']==$koderetur)?"selected":'';
	$admin .= '
			<option value="'.$data['noretur'].'"'.$pilihan.'>'.$data['noretur'].' ~ '.getnamasupplier($data['kodesupplier']).' ~ '.$data['total'].'</option>';
}
	$admin .= '</select>&nbsp;<input type="submit" value="Lihat Retur" name="lihatretur"class="btn btn-success" >&nbsp;<input type="submit" value="Batal" name="batalcetak"class="btn btn-danger" ></td>
<td></td>
		<td></td>
		<td></td>
		</tr>';

$admin .= '</form></table></div>';	
if(isset($_POST['lihatretur'])){
$koderetur     = $_POST['koderetur']; 
$no=1;
$query 		= mysql_query ("SELECT * FROM `po_pembelianretur` WHERE `noretur` like '$koderetur'");
$data 		= mysql_fetch_array($query);
$noinvoice  			= $data['noinvoice'];
$noretur  			= $data['noretur'];
$tgl  			= $data['tgl'];
$kodesupplier  			= $data['kodesupplier'];
$total  			= $data['total'];
$carabayar  			= $data['carabayar'];
$lihatslip = '<a href="cetak_notainvoice.php?kode='.$data['noinvoice'].'&lihat=ok"target="new">'.$data['noinvoice'].'</a>';
	$error 	= '';
		if (!$noretur) $error .= "Error: Kode Retur tidak terdaftar , silahkan ulangi.<br />";
	if ($error){
		$admin .= '<div class="error">'.$error.'</div>';}else{
$admin .= '<div class="panel panel-info">
<div class="panel-heading"><b>Transaksi Retur Pembelian</b></div>';
$admin .= '
		<form method="post" action="cetak_notareturbeli.php" class="form-inline"id="posts"target="_blank">
<table class="table table-striped table-hover">';
$admin .= '
	<tr>
		<td>Nomor Retur</td>
		<td>:</td>
		<td>'.$noretur.'</td>
		<td><input type="hidden" name="kode" value="'.$noretur.'">
		<input type="submit" value="Cetak Nota" name="cetak_notareturbeli"class="btn btn-warning" >

		</td>
	</tr>';
$admin .= '
	<tr>
		<td>Nomor Invoice</td>
		<td>:</td>
		<td>'.$lihatslip.'</td>
		<td></td>
	</tr>';
$admin .= '
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td>'.tanggalindo($tgl).'</td>
		<td></td>
		</tr>';
$admin .= '
	<tr>
		<td>Supplier</td>
		<td>:</td>
		<td>'.getnamasupplier($kodesupplier).'</td>
			<td></td>
	</tr>';	
$admin .= '
	<tr>
		<td>Cara Pembayaran</td>
		<td>:</td>
		<td>'.($carabayar).'</td>
			<td></td>
	</tr>';	
$admin .= '</table>		</form></div>';	
$admin .='<div class="panel panel-info">';
$admin .= '
<div class="panel-heading"><b>Detail Retur Pembelian</b></div>';	
$admin .= '
<table class="table table-striped table-hover">';
$admin .= '	
	<tr>
			<th><b>No</b></</th>
		<th><b>Kode</b></</th>
		<th><b>Nama</b></td>
		<th><b>Jumlah</b></</td>
		<th><b>Harga</b></</th>
<th><b>Discount</b></</th>
<th><b>Subtotal</b></</th>
	</tr>';
$hasild = $koneksi_db->sql_query("SELECT * FROM `po_pembelianreturdetail` WHERE `noretur` like '$koderetur'");
while ($datad =  $koneksi_db->sql_fetchrow ($hasild)){
$admin .= '	
	<tr>
			<td>'.$no.'</td>
			<td>'.$datad["kodebarang"].'</td>
		<td>'.getnamabarang($datad["kodebarang"]).'</td>
		<td>'.$datad["jumlah"].'</td>
		<td>'.rupiah_format($datad["harga"]).'</td>
		<td>'.cekdiscountpersen($datad["subdiscount"]).'</td>
		<td>'.rupiah_format($datad["subtotal"]).'</td>
	</tr>';
	$no++;
		}
$admin .= '	
	<tr>		
		<td colspan="6" align="right"><b>Total-</b></td>
		<td >'.rupiah_format($total).'</td>
	</tr>';
$admin .= '</table></div>';	
		}
	}
}

}
echo $admin;
?>
