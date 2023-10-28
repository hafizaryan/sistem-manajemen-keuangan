<?php
// memanggil library FPDF
require('../library/fpdf181/fpdf.php');


include '../koneksi.php'; 
$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',14);
// mencetak string 
$pdf->Cell(280,7,'SISTEM INFORMASI KEUANGAN',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(280,7,'LAPORAN KEUANGAN',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);

$pdf->Cell(35,6,'DARI TANGGAL',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6, date('d-m-Y', strtotime($tgl_dari)) ,0,0);
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(35,6,'SAMPAI TANGGAL',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6, date('d-m-Y', strtotime($tgl_sampai)) ,0,0);
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(35,6,'KATEGORI',0,0);
$pdf->Cell(5,6,':',0,0);
$kategori = $_GET['kategori'];
if($kategori == "semua"){
  $kkk = "SEMUA KATEGORI";
}else{
  $k = mysqli_query($koneksi,"select * from kategori where kategori_id='$kategori'");
  $kk = mysqli_fetch_assoc($k);
  $kkk = $kk['kategori'];
}
$pdf->Cell(35,6, $kkk ,0,0);


$pdf->Cell(10,10,'',0,1);
$pdf->SetFont('Arial','B',10);

$pdf->Cell(10,14,'NO',1,0,'C');
$pdf->Cell(35,14,'TANGGAL',1,0,'C');
$pdf->Cell(45,14, 'KATEGORI' ,1,0,'C');
$pdf->Cell(105,14,'KETERANGAN',1,0,'C');

$pdf->Cell(82,7,'JENIS',1,0,'C');
$pdf->Cell(1,7,'',0,1);
$pdf->Cell(195,7,'',0,0);
$pdf->Cell(41,7,'PEMASUKAN',1,0,'C');
$pdf->Cell(41,7,'PENGELUARAN',1,1,'C');

$pdf->Cell(10,0,'',0,1);




$pdf->SetFont('Arial','',10);

$no=1;
$total_pemasukan=0;
$total_pengeluaran=0;
if($kategori == "semua"){
  $data = mysqli_query($koneksi,"SELECT * FROM transaksi,kategori where kategori_id=transaksi_kategori and date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'");
}else{
  $data = mysqli_query($koneksi,"SELECT * FROM transaksi,kategori where kategori_id=transaksi_kategori and kategori_id='$kategori' and date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'");
}
while($d = mysqli_fetch_array($data)){

  if($d['transaksi_jenis'] == "Pemasukan"){
    $total_pemasukan += $d['transaksi_nominal'];
  }elseif($d['transaksi_jenis'] == "Pengeluaran"){
    $total_pengeluaran += $d['transaksi_nominal'];
  }

  $pdf->Cell(10,7,$no++,1,0,'C');
  $pdf->Cell(35,7,date('d-m-Y', strtotime($d['transaksi_tanggal'])),1,0,'C');
  $pdf->Cell(45,7, $d['kategori'] ,1,0,'C');
  $pdf->Cell(105,7,$d['transaksi_keterangan'],1,0,'C');

  if($d['transaksi_jenis'] == "Pemasukan"){
    $pem = "Rp. ".number_format($d['transaksi_nominal'])." ,-";
  }else{
    $pem = "-";
  }

  if($d['transaksi_jenis'] == "Pengeluaran"){
    $peng = "Rp. ".number_format($d['transaksi_nominal'])." ,-";
  }else{
    $peng = "-";
  }

  $pdf->Cell(41,7,$pem,1,0,'C');
  $pdf->Cell(41,7,$peng,1,1,'C');

  $pdf->Cell(10,0,'',0,1);
}

$pdf->Cell(195,7, "TOTAL" ,1,0,'R');
$pdf->Cell(41,7,"Rp. ".number_format($total_pemasukan)." ,-",1,0,'C');
$pdf->Cell(41,7,"Rp. ".number_format($total_pengeluaran)." ,-",1,1,'C');

$pdf->Cell(10,0,'',0,1);

$pdf->Cell(195,7, "SALDO" ,1,0,'R');
$pdf->Cell(82,7,"Rp. ".number_format($total_pemasukan - $total_pengeluaran)." ,-",1,0,'C');






$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','',10);



$pdf->Output();
?>