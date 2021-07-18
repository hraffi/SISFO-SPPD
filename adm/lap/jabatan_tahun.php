<?php
//////////////////////////////////////////////////////////////////////
// SISFO-SPPD, Sistem Informasi Surat Perintah Perjalanan Dinas.    //
// Cocok untuk kantor - kantor yang membutuhkan pengarsipan surat   //
// perintah tugas perjalanan dinas.                                 //
//////////////////////////////////////////////////////////////////////
// Dikembangkan oleh : Agus Muhajir                                 //
// E-Mail : hajirodeon@gmail.com                                    //
// HP/SMS/WA : 081-829-88-54                                        //
// source code : http://github.com/hajirodeon                       //
//////////////////////////////////////////////////////////////////////



session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admin.html");

nocache;

//nilai
$filenya = "jabatan_tahun.php";
$judul = "[LAPORAN]. Per Jabatan & Tahun";
$judulku = "$judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kd = nosql($_REQUEST['kd']);





$limit = 1000;







//isi *START
ob_start();



//jml notif
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_history ".
									"WHERE dibaca = 'false'");
$jml_notif = mysqli_num_rows($qyuk);

echo $jml_notif;

//isi
$i_loker = ob_get_contents();
ob_end_clean();










//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//isi *START
ob_start();

//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>


	<script>
	$(document).ready(function() {
	  		
		$.noConflict();
	    
	});
	</script>
	  
	

<?php
echo '<form action="'.$filenya.'" method="post" name="formx">';


//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT * FROM m_jabatan ".
				"ORDER BY nama ASC";

$sqlresult = $sqlcount;
$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysqli_fetch_array($result);


echo '<div class="table-responsive">          
<table class="table" border="1">
<thead>

	<tr valign="top" bgcolor="'.$warnaheader.'">
	<th><strong><font color="'.$warnatext.'">NAMA</font></strong></th>';
	
	for ($k=$tahun-5;$k<=$tahun;$k++)
		{
		echo '<td align="center"><strong><font color="'.$warnatext.'">'.$k.'</font></strong></td>';
		}
	
	echo '</tr>

</thead>
<tbody>';



//hapus dulu, biar update
mysqli_query($koneksi, "DELETE FROM lap_jabatan_tahun");
							
							


if ($count != 0)
	{
	do {
		if ($warna_set ==0)
			{
			$warna = $warna01;
			$warna_set = 1;
			}
		else
			{
			$warna = $warna02;
			$warna_set = 0;
			}

		$nomer = $nomer + 1;
		$kd = nosql($data['kd']);
		$i_nama = balikin($data['nama']);
		$i_nama2 = cegah($data['nama']);


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$i_nama.'</td>';
		

		for ($k=$tahun-5;$k<=$tahun;$k++)
			{
			$kk = "0$k";
			
			//hitung totalnya
			$qyuk = mysqli_query($koneksi, "SELECT SUM(total) AS totalnya ".
												"FROM lap_jabatan_bulan ".
												"WHERE jabatan = '$i_nama2' ".
												"AND tahun = '$k'");
			$ryuk = mysqli_fetch_assoc($qyuk);
			$yuk_total = balikin($ryuk['totalnya']);

			//insert
			$xyz = md5("$k$nomer");
			mysqli_query($koneksi, "INSERT INTO lap_jabatan_tahun(kd, tahun, jabatan, total, postdate) VALUES ".
										"('$xyz', '$k', '$i_nama2', '$yuk_total', '$today')");

			
			echo '<td align="right">'.xduit2($yuk_total).'</td>';
			}
			
						
        echo '</tr>';
		}
	while ($data = mysqli_fetch_assoc($result));
	}



echo '</tbody>	
	<tfoot>

	<tr valign="top" bgcolor="'.$warnaheader.'">
	<th><strong><font color="'.$warnatext.'">TOTAL</font></strong></th>';
	
	
	for ($k=$tahun-5;$k<=$tahun;$k++)
		{
		//hitung totalnya
		$qyuk = mysqli_query($koneksi, "SELECT SUM(total) AS total ".
											"FROM lap_jabatan_tahun ".
											"WHERE tahun = '$k'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$yuk_total = balikin($ryuk['total']);
	
		echo '<td align="right"><strong><font color="'.$warnatext.'">'.xduit2($yuk_total).'</font></strong></td>';
		}
	
	echo '</tr>

	</tfoot>

  </table>





<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
<input name="jml" type="hidden" value="'.$count.'">
</td>
</tr>
</table>


</div>



</form>';



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//null-kan
xfree($qbw);
xclose($koneksi);
exit();
?>