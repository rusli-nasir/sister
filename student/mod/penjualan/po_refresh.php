<?php
include '../../includes/pdo.php';

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM pos_popenjualan WHERE nopo LIKE (:keyword) ORDER BY id DESC LIMIT 0, 20";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$kode = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['nopo']);
	// add new option
    echo '<li onclick="set_itempo(\''.str_replace("'", "\'", $rs['nopo']).'\')">'.$kode.' - '.$rs['kodecustomer'].' - '.$rs['total'].'</li>';
}
?>