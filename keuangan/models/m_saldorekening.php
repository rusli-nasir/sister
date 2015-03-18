<?php
	session_start();
	require_once '../../lib/dbcon.php';
	require_once '../../lib/func.php';
	require_once '../../lib/pagination_class.php';
	require_once '../../lib/tglindo.php';
	$mnu  = 'saldorekening';
	$tb   = 'keu_'.$mnu;

	if(!isset($_POST['aksi'])){
		$out=json_encode(array('status'=>'invalid_no_post'));		
	}else{
		switch ($_POST['aksi']) {
			// -----------------------------------------------------------------
			case 'tampil':
				$kategorirek = trim($_POST['kategorirekS'])?filter($_POST['kategorirekS']):'';
				$kode        = trim($_POST['kodeS'])?filter($_POST['kodeS']):'';
				$nama        = trim($_POST['namaS'])?filter($_POST['namaS']):'';
				$tahunbuku   = trim($_POST['tahunbukuS'])?filter($_POST['tahunbukuS']):'';

				$sql = 'SELECT
							sr.replid,
							r.replid idrekening,
							kr.replid  idkategorirek,
							kr.nama kategorirek,
							r.kode,
							r.nama,
							IFNULL(sr.nominal2,0)saldo
						FROM
							keu_rekening r
							LEFT JOIN keu_saldorekening sr ON sr.rekening = r.replid
							LEFT JOIN keu_kategorirek kr ON kr.replid = r.kategorirek
						WHERE
							kr.replid LIKE "%'.$kategorirek.'%"
							AND r.nama LIKE "%'.$nama.'%"
							AND r.kode LIKE "%'.$kode.'%"
							AND sr.tahunbuku = "'.$tahunbuku.'"';
				if(isset($_POST['starting'])){ //nilai awal halaman
					$starting=$_POST['starting'];
				}else{
					$starting=0;
				}
				// $menu='tampil';	
				$recpage = 10;//jumlah data per halaman
				$aksi    ='tampil';
				$subaksi ='';
				$obj     = new pagination_class($sql,$starting,$recpage,$aksi, $subaksi);
				$result  =$obj->result;
				#ada data
				$jum	= mysql_num_rows($result);
				$out ='';
				if($jum!=0){	
					$nox 	= $starting+1;
					$curKat = '';
					$ec = mysql_query($sql);
					while($res = mysql_fetch_assoc($result)){	
 						if($res['replid']==NULL){ // belum ada
							$si = 'INSERT INTO keu_saldorekening set 
									rekening = '.$res['idrekening'].',
									tahunbuku = '.$tahunbuku;
							$ei = mysql_query($si);
							if($ei)
								echo '<script>window.location=\'saldo-rekening\';</script>';
							else
								$out.='<tr><td>'.$res['nama'].' is failed to insert </td></tr>';
						}else{ //sudah ada
							if($res['idkategorirek']!=$curKat){ // kategori rek 
								$ss = 'SELECT replid,nama,RPAD(kode,6,0)kode from keu_kategorirek where replid='.$res['idkategorirek'];	
								$ee = mysql_query($ss);
								$rr = mysql_fetch_assoc($ee);
								$out.= '<tr>
											<td><b>'.$rr['kode'].'</b></td>
											<td colspan="3"><b>'.$rr['nama'].'</b></td>
										</tr>';
							}else{ // sub rekening
								$btn ='<td>
											<button data-hint="ubah"  class="button" onclick="viewFR('.$res['replid'].');">
												<i class="icon-pencil on-left"></i>
											</button>
									 </td>';
								$out.= '<tr>
											<td class="text-right">'.$res['kode'].'</td>
											<td>'.$res['nama'].'</td>
											<td class="text-right">Rp. '.number_format($res['saldo']).',-</td>
											'.$btn.'
										</tr>';
							}$curKat=$res['idkategorirek'];
						}$nox++;
					}
				}else{ #kosong
					$out.= '<tr align="center">
							<td  colspan=9><span style="color:red;text-align:center;">
							... data tidak ditemukan...</span></td></tr>';
				}
				#link paging
				$out.='<tr class="info"><td colspan="9">'.$obj->anchors.'</td></tr>';
				$out.='<tr class="info"><td colspan="9">'.$obj->total.'</td></tr>';
			break; 
			// view -----------------------------------------------------------------

			// add / edit -----------------------------------------------------------------
			case 'simpan':
				$s    = $tb.' set nominal = "'.filter($_POST['nominalTB']).'", nominal2 = "'.filter($_POST['nominalTB']).'"';
				$s2   = isset($_POST['replid'])?'UPDATE '.$s.' WHERE replid='.$_POST['replid']:'INSERT INTO '.$s;
				$e    = mysql_query($s2);
				$stat = ($e)?'sukses':'gagal';
				$out  = json_encode(array('status'=>$stat));
			break;
			// add / edit -----------------------------------------------------------------
			
			// ambiledit -----------------------------------------------------------------
			case 'ambiledit':
				$s = 'SELECT
							tb.nama tahunbuku,
							kr.nama kategorirek,
							r.kode,
							r.nama,
							IFNULL(sr.nominal,0)nominal
						FROM
							keu_rekening r
							LEFT JOIN keu_saldorekening sr ON sr.rekening = r.replid
							LEFT JOIN keu_kategorirek kr ON kr.replid = r.kategorirek
							LEFT JOIN keu_tahunbuku tb  ON tb.replid =sr.tahunbuku
						WHERE
							sr.replid ='.$_POST['replid'];
				// print_r($s);exit();
				$e   = mysql_query($s);
				$r   = mysql_fetch_assoc($e);
				$out = json_encode(array(
							'tahunbuku'   =>$r['tahunbuku'],
							'kategorirek' =>$r['kategorirek'],
							'kode'        =>$r['kode'],
							'nama'        =>$r['nama'],
							'nominal'     =>$r['nominal']
						));
			break;
			// ambiledit -----------------------------------------------------------------
			
			// cmbkategorirek -----------------------------------------------------------------
			case 'cmbkategorirek':
				$w='';
				if(isset($_POST['replid'])){
					$w='where replid ='.$_POST['replid'];
				}else{
					if(isset($_POST[$mnu])){
						$w='where '.$mnu.'='.$_POST[$mnu];
					}
				}
				
				$s	= ' SELECT *
						from keu_kategorirek
							'.$w.'		
						ORDER  BY 
							kode asc ,
							nama asc';

				$e  = mysql_query($s);
				$n  = mysql_num_rows($e);
				$ar =$dt=array();

				if(!$e){ //error
					$ar = array('status'=>'error'.mysql_error());
				}else{
					if($n=0){ // kosong 
						$ar = array('status'=>'kosong');
					}else{ // ada data
						if(!isset($_POST['replid'])){
							while ($r=mysql_fetch_assoc($e)) {
								$dt[]=$r;
							}
						}else{
							$dt[]=mysql_fetch_assoc($e);
						}$ar = array('status'=>'sukses','kategorirek'=>$dt);
					}
				}$out=json_encode($ar);
			break;
			// cmbdepartemen -----------------------------------------------------------------

		}
	}echo $out;

    // ---------------------- //
    // -- created by rovi  -- //
    // ---------------------- // 
?>