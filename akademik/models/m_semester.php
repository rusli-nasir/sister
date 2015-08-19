<?php
	session_start();
	require_once '../../lib/dbcon.php';
	require_once '../../lib/func.php';
	require_once '../../lib/pagination_class.php';
	require_once '../../lib/tglindo.php';
	$mnu = 'semester';
	$tb  = 'aka_'.$mnu;
	// $out=array();

	if(!isset($_POST['aksi'])){
		$out=json_encode(array('status'=>'invalid_no_post'));		
		// $out=['status'=>'invalid_no_post'];		
	}else{
		switch ($_POST['aksi']) {
			// -----------------------------------------------------------------
			case 'tampil':
				$tahunajaran = isset($_POST['tahunajaranS'])?filter($_POST['tahunajaranS']):'';
				$sql = 'SELECT 
							replid,
							IF(semester=1,"Ganjil","Genap")semester,
							tglMulai,
							tglSelesai
						FROM '.$tb.'
						WHERE 
							tahunajaran ='.$tahunajaran.' 
						ORDER 
							BY tglMulai asc';
				// print_r($sql);exit();
				if(isset($_POST['starting'])){ //nilai awal halaman
					$starting=$_POST['starting'];
				}else{
					$starting=0;
				}

				$recpage = 5;//jumlah data per halaman
				$aksi    ='tampil';
				$subaksi ='ju';
				$obj     = new pagination_class($sql,$starting,$recpage,$aksi,$subaksi);
				$result  = $obj->result;

				#ada data
				$out='';
				$jum = mysql_num_rows($result);
				if($jum!=0){	
					$nox 	= $starting+1;
					while($r = mysql_fetch_assoc($result)){	
						$btn ='<td align="center">
									<button data-hint="ubah"  onclick="viewFR('.$r['replid'].');">
										<i class="icon-pencil on-left"></i>
									</button>
									<button data-hint="hapus" onclick="del('.$r['replid'].');">
										<i class="icon-remove on-left"></i>
									</button>
								 </td>';
						$out.= '<tr>
									<td>'.$r['semester'].'</td>
									<td align="center">'.tgl_indo5($r['tglMulai']).' - '.tgl_indo5($r['tglSelesai']).'</td>
									'.$btn.'
								</tr>';
						// $nox++;
					}
				}else{ #kosong
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
				$s = $tb.' set 	tahunajaran = "'.$_POST['tahunajaranH'].'",
								semester    = "'.$_POST['semesterTB'].'",
								tglMulai    = "'.tgl_indo6($_POST['tglMulaiTB']).'",
								tglSelesai  = "'.tgl_indo6($_POST['tglSelesaiTB']).'"';

				$s2	= isset($_POST['replid'])?'UPDATE '.$s.' WHERE replid='.$_POST['replid']:'INSERT INTO '.$s;
				$e2 = mysql_query($s2);
				if(!$e2){
					$stat = 'gagal menyimpan';
				}else{
					$stat = 'sukses';
				}$out = json_encode(array('status'=>$stat));
			break;
			// add / edit -----------------------------------------------------------------
			
			// delete -----------------------------------------------------------------
			case 'hapus':
				$d    = mysql_fetch_assoc(mysql_query('SELECT * from '.$tb.' where replid='.$_POST['replid']));
				$s    = 'DELETE from '.$tb.' WHERE replid='.$_POST['replid'];
				$e    = mysql_query($s);
				$stat = ($e)?'sukses':'gagal';
				$out  = json_encode(array('status'=>$stat,'terhapus'=>$d['semester']));
			break;
			// delete -----------------------------------------------------------------

			// ambiledit -----------------------------------------------------------------
			case 'ambiledit':
				$s = ' SELECT
						s.replid,
						s.semester,
						s.tglMulai,
						s.tglSelesai,
						t.tahunajaran
					FROM
						aka_semester s
						LEFT JOIN aka_tahunajaran t ON t.replid = s.tahunajaran
					WHERE
						s.replid='.$_POST['replid'];
					// var_dump($s);exit();
				$e 		= mysql_query($s);
				$r 		= mysql_fetch_assoc($e);
				$stat 	= ($e)?'sukses':'gagal';
				$out 	= json_encode(array(
							'status'      =>$stat,
							'tahunajaran' =>$r['tahunajaran'],
							'semester'    =>$r['semester'],
							'tglMulai'    =>tgl_indo5($r['tglMulai']),
							'tglSelesai'  =>tgl_indo5($r['tglSelesai']),
						));
			break;
			// ambiledit -----------------------------------------------------------------
			// cmbsemester -----------------------------------------------------------------
			case 'cmbsemester':
				if(isset($_POST['replid'])){
					$w='where replid ='.$_POST['replid'];
				}else{
					if(isset($_POST[$mnu])) $w='where '.$mnu.'='.$_POST[$mnu];
					elseif(isset($_POST['tahunajaran'])) $w='where tahunajaran ='.$_POST['tahunajaran']; 
					else $w=''; 
				}
				
				$s	= ' SELECT 
							replid,
							if(semester=1,"Ganjil","Genap")semester,
							tglMulai,
							tglSelesai
						from '.$tb.'
						'.$w.'		
						ORDER  BY semester asc';
// var_dump($s);exit();
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
						}
						$ar = array('status'=>'sukses','semester'=>$dt);
					}
				}$out=json_encode($ar);
			break;
			// cmbsemester -----------------------------------------------------------------
		}
	}echo $out;

	// ---------------------- //
	// -- created by epiii -- //
	// ---------------------- //
?>