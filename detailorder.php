<?php

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}
function rupiah1($angka){
	
	$hasil_rupiah = number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}
function rupiah2($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,3,',','.');
	return $hasil_rupiah;
 
}

$asal        = $_POST['asal'];
$tujuan      = $_POST['tujuan'];
$jarak       = $_POST['jarak'];
$tarif       = $_POST['tarif'];
$catatan     = $_POST['catatan'];
$pembayaran  = $_POST['pembayaran'];
$promo       = rupiah1($_POST['promo']);
$total       = $tarif-$promo;
$driver      = $_POST['driver'];


if(isset($driver)){
	echo "Pengemudi Anda : ".$driver."<br>";
}
echo "Catatan Pengemudi : ".$catatan."<br>";
echo "Asal Tujuan Anda : ".$asal."<br>";
echo "Lokasi Tujuan Anda : ".$tujuan."<br>";
echo "Jarak Dan Waktu Tempuh Perjalanan tujuan anda : ".$jarak."<br>";
echo "Tarif Perjalanan Anda : ".$tarif."<br>";

if(isset($pembayaran)){
	echo "Jenis Pembayaran : ".$pembayaran."<br>";
}

echo "Promo Anda Adalah : ".$promo."<br>";
echo "Total Biaya Perjalanan Anda Adalah : ".rupiah2($total);

