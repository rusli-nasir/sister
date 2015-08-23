<?php
	session_start();
	require_once '../../lib/dbcon.php';
	require_once '../../lib/func.php';
	require_once '../../lib/pagination_class.php';
	$mnu = 'detaildiskontunai';	
	$tb  = 'psb_'.$mnu;

	if(!isset($_POST)){
		$out=array('status'=>'invalid_no_post');		
	}else{
		switch ($_POST['aksi']) {
			// -----------------------------------------------------------------
			case 'tampil':
				$departemen  = isset($_POST['departemenS'])?$_POST['departemenS']:'';
				$tahunajaran = isset($_POST['tahunajaranS'])?$_POST['tahunajaranS']:'';
				$nilai       = isset($_POST['nilaiS'])?$_POST['nilaiS']:'';
				$diskontunai = isset($_POST['diskontunaiS'])?$_POST['diskontunaiS']:'';
				$keterangan  = isset($_POST['keteranganS'])?$_POST['keteranganS']:'';
				$nilai       = (isset($_POST['nilaiS']) && $_POST['nilaiS']!='')?' dd.nilai LIKE "%'.$_POST['nilaiS'].'%" AND':'';
				$isAktif     = (isset($_POST['isAktifS']) && $_POST['isAktifS']!='')?' dd.isAktif='.$_POST['isAktifS'].' AND':'';

				// checkDetailDiskonTunai($departemen,$tahunajaran);
				$sql = 'SELECT 
							dd.replid,
							dd.nilai,
							d.diskontunai,
							d.keterangan,
							dd.isAktif
						FROM  psb_diskontunai d
							LEFT JOIN '.$tb.' dd on dd.diskontunai = d.replid
						WHERE 
							'.$nilai.$isAktif.'
							d.diskontunai like "%'.$diskontunai.'%" and 
							d.keterangan like "%'.$keterangan.'%" and
							dd.tahunajaran ='.$tahunajaran.' and
							dd.departemen ='.$departemen.'
						ORDER BY 
							d.diskontunai asc,
							dd.nilai asc';
							// pr($sql);
				if(isset($_POST['starting'])){ //nilai awal halaman
					$starting=$_POST['starting'];
				}else{
					$starting=0;
				}
				// $menu='tampil';	
				$recpage = 10;
				$aksi    ='tampil';
				$subaksi ='';
				$obj     = new pagination_class($sql,$starting,$recpage,$aksi,$subaksi);
				$result  = $obj->result;

				#ada data
				$jum	= mysql_num_rows($result);
				$out ='';
				if($jum!=0){	
					$nox 	= $starting+1;
					while($res = mysql_fetch_assoc($result)){	
						$btn ='<td align="center">
									<button class="button" onclick="viewFR('.$res['replid'].');">
										<i class="icon-pencil on-left"></i>
									</button>
								 </td>';
						if($res['isAktif']==1){
							$clr  ='green';
							$hint ='aktif';
							$icon ='checkmark';
						}else{
							$clr  ='red';
							$hint ='tidak aktif';
							$icon ='blocked';
						}						 
							
						$out.= '<tr>
									<td>'.$res['diskontunai'].'</td>
									<td align="center">'.$res['nilai'].' %</td>
									<td>'.$res['keterangan'].'</td>
									<td align="center"><button onclick="aktifkan('.$res['replid'].');" data-hint="'.$hint.'" class="fg-white bg-'.$clr.'"><i class="icon-'.$icon.'"></i></button></td>
									'.$btn.'
								</tr>';
						$nox++;
					}
				}
				#kosong
				else
				{
					$out.= '<tr align="center">
							<td  colspan=9 ><span style="color:red;text-align:center;">
							... data tidak ditemukan...</span></td></tr>';
				}
				#link paging
				$out.= '<tr class="info"><td colspan=9>'.$obj->anchors.'</td></tr>';
				$out.='<tr class="info"><td colspan=9>'.$obj->total.'</td></tr>';
			break; 
			// view -----------------------------------------------------------------

			// add / edit -----------------------------------------------------------------
			case 'simpan':
				$s    = ' UPDATE '.$tb.' set nilai = '.filter($_POST['nilaiTB']).' WHERE replid='.$_POST['replid'];
				$e    = mysql_query($s);
				$stat = ($e)?'sukses':'gagal';
				$out  = json_encode(array('status'=>$stat));
			break;
			// add / edit -----------------------------------------------------------------
			
			// delete -----------------------------------------------------------------
			case 'hapus':
				$s 		= 'DELETE from '.$tb.' WHERE replid='.$_POST['replid'];
				$e 		= mysql_query($s);
				$stat 	= ($e)?'sukses':'gagal';
				$out 	= json_encode(array('status'=>$stat));
			break;
			// delete -----------------------------------------------------------------

			// ambiledit -----------------------------------------------------------------
			case 'ambiledit':
				$s = 'SELECT
						dd.nilai,
						dd.departemen,
						d.diskontunai,
						d.keterangan,
						dd.tahunajaran
					FROM
						psb_detaildiskontunai dd 
						JOIN psb_diskontunai d ON d.replid= dd.diskontunai
					WHERE
						dd.replid ='.$_POST['replid'];
						 	// pr($s);
				$e    = mysql_query($s);
				$r    = mysql_fetch_assoc($e);
				$stat = ($e)?'sukses':'gagal';
				$out  = json_encode(array(
							'departemen'  =>$r['departemen'],
							'tahunajaran' =>$r['tahunajaran'],
							'diskontunai' =>$r['diskontunai'],
							'keterangan'  =>$r['keterangan'],
							'status'      =>$stat,
							'nilai'       =>$r['nilai'],
						));
			break;
			// ambiledit -----------------------------------------------------------------

			case 'cmb'.$mnu:
				$w='';
				if(isset($_POST['replid'])){
					$w.='where replid ='.$_POST['replid'];
				}else{
					if(isset($_POST[$mnu])){
						$w.='where '.$mnu.'='.$_POST[$mnu];
					}elseif(isset($_POST['departemen'])){
						$w.='where departemen ='.$_POST['departemen'];
					}
				}
				
				$s	= ' SELECT *
						from '.$tb.'
						'.$w.'		
						ORDER  BY nilai asc';
				// var_dump($s);exit();
				$e 	= mysql_query($s);
				$n 	= mysql_num_rows($e);
				$ar=$dt=array();

				if(!$e){ //error
					$ar = array('status'=>'error');
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
						}$ar = array('status'=>'sukses','nilai'=>$dt);
					}
				}$out=json_encode($ar);
			break;

			// aktifkan -----------------------------------------------------------------
			case 'aktifkan':
				if(!isset($_POST['id_'.$mnu])) $stat='no_id_'.$mnu.'_to_post';
				else{
					$akt = getField('isAktif',$tb,'replid',$_POST['id_'.$mnu]);
					$s   = 'UPDATE  '.$tb.' set isAktif='.($akt==1?0:1).' where replid ='.$_POST['id_'.$mnu];
					$e   = mysql_query($s);
					$stat=!$e?'gagal mengaktifkan':'sukses';
				}$out  = json_encode(array('status'=>$stat));
			break;
			// aktifkan -----------------------------------------------------------------

		}

	}
	echo $out;
	// echo json_encode($out);
?>