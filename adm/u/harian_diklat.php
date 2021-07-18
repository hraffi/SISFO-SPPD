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
require("../../inc/class/paging.php");
require("../../inc/cek/adm.php");
$tpl = LoadTpl("../../template/admin.html");

nocache;

//nilai
$filenya = "harian_diklat.php";
$judul = "[UANG & BIAYA]. Harian Diklat";
$judulku = "$judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kd = nosql($_REQUEST['kd']);
$propnama = cegah($_REQUEST['propnama']);

	
	
$limit = 10;



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}



//jika edit
if ($s == "edit")
	{
	$kdx = nosql($_REQUEST['kd']);

	$qx = mysqli_query($koneksi, "SELECT * FROM m_uang_harian ".
						"WHERE prop_nama = '$propnama'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_prop_nama = balikin($rowx['prop_nama']);
	$e_walkot = balikin($rowx['walkot']);
	$e_eselon_2 = balikin($rowx['eselon_2']);
	$e_eselon_3 = balikin($rowx['eselon_3']);
	$e_eselon_4 = balikin($rowx['eselon_4']);
	$e_gol_4 = balikin($rowx['gol_4']);
	$e_gol_3 = balikin($rowx['gol_3']);
	$e_gol_lainnya = balikin($rowx['gol_lainnya']);
	$e_ket = balikin($rowx['ket']);
	}



//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$page = nosql($_POST['page']);
	$e_propnama = cegah($_POST['propnama']);
	$e_walkot = cegah($_POST['e_walkot']);
	$e_eselon_2 = cegah($_POST['e_eselon_2']);
	$e_eselon_3 = cegah($_POST['e_eselon_3']);
	$e_eselon_4 = cegah($_POST['e_eselon_4']);
	$e_gol_4 = cegah($_POST['e_gol_4']);
	$e_gol_3 = cegah($_POST['e_gol_3']);
	$e_gol_lainnya = cegah($_POST['e_gol_lainnya']);
	$e_ket = cegah($_POST['e_ket']);
	
	$e_walkotb = cegah($_POST['e_walkotb']);
	$e_eselon_2b = cegah($_POST['e_eselon_2b']);
	$e_eselon_3b = cegah($_POST['e_eselon_3b']);
	$e_eselon_4b = cegah($_POST['e_eselon_4b']);
	$e_gol_4b = cegah($_POST['e_gol_4b']);
	$e_gol_3b = cegah($_POST['e_gol_3b']);
	$e_gol_lainnyab = cegah($_POST['e_gol_lainnyab']);
	$e_ketb = cegah($_POST['e_ketb']);



	//hapus dulu, sebelum insert
	mysqli_query($koneksi, "DELETE FROM m_uang_harian ".
								"WHERE prop_nama = '$propnama'");
	
	
	
	//insert
	$jenis = "HARIAN";
	$xyz = "$x$jenis";
	mysqli_query($koneksi, "INSERT INTO m_uang_harian(kd, prop_nama, jenis, walkot, ".
					"eselon_2, eselon_3, eselon_4, ".
					"gol_4, gol_3, gol_lainnya, ".
					"ket, postdate) VALUES ".
					"('$xyz', '$propnama', '$jenis', '$e_walkot', ".
					"'$e_eselon_2', '$e_eselon_3', '$e_eselon_4', ".
					"'$e_gol_4', '$e_gol_3', '$e_gol_lainnya', ".
					"'$e_ket', '$today')");
	
	
	//insert
	$jenis = "DIKLAT";
	$xyz = "$x$jenis";
	mysqli_query($koneksi, "INSERT INTO m_uang_harian(kd, prop_nama, jenis, walkot, ".
					"eselon_2, eselon_3, eselon_4, ".
					"gol_4, gol_3, gol_lainnya, ".
					"ket, postdate) VALUES ".
					"('$xyz', '$propnama', '$jenis', '$e_walkotb', ".
					"'$e_eselon_2b', '$e_eselon_3b', '$e_eselon_4b', ".
					"'$e_gol_4b', '$e_gol_3b', '$e_gol_lainnyab', ".
					"'$e_ketb', '$today')");
	
																								

	//masukin ke database
	$kode = "$propnama [$e_gol]";
	mysqli_query($koneksi, "INSERT INTO user_history(kd, user_kd, user_nip, ".
				"user_nama, user_jabatan, perintah_sql, ".
				"menu_ket, postdate) VALUES ".
				"('$x', 'admin', 'admin', ".
				"'admin', 'admin', 'UPDATE : $kode', ".
				"'$judul', '$today')");
					



	//re-direct
	xloc($filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();






?>

	
<script>
$(document).ready(function() {
  		
	$.noConflict();
    
});
</script>
  



              	
              	
<!-- Bootstrap core JavaScript -->
<script src="../../template/vendors/jquery/jquery.min.js"></script>





<script language='javascript'>
//membuat document jquery
$(document).ready(function(){

$.noConflict();

	  $('#e_tarif').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  		});


		
});

</script>




  
<?php
//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika edit
if ($s == "edit")
	{
	?>
	
	
	
	<script>
	$(document).ready(function() {
	  		
		$.noConflict();
	    
	});
	</script>
	  
	
	
	
	              	
	              	
	<!-- Bootstrap core JavaScript -->
	<script src="../../template/vendors/jquery/jquery.min.js"></script>
	
	
	
	
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
	$.noConflict();
	
		  $('#e_walkot').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});
	

		  $('#e_eselon_2').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_eselon_3').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});
	
		  $('#e_eselon_4').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_gol_4').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_gol_3').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_gol_lainnya').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});
	


		  $('#e_walkotb').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});
	

		  $('#e_eselon_2b').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_eselon_3b').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});
	
		  $('#e_eselon_4b').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_gol_4b').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_gol_3b').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_gol_lainnyab').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});
	

			
	});
	
	</script>
	
	
	
	
	<?php
	echo '<form action="'.$filenya.'" method="post" name="formx21">
	
			<p>
			PROVINSI : 
			<br>

			<input name="e_prop" id="e_prop" type="text" size="20" value="'.$propnama.'" class="btn btn-primary" readonly required>
			</p>
			<br>
			
			
			
			<div class="table-responsive">          
			<table class="table" border="1">
			<thead>
				<tr valign="top" bgcolor="'.$warnaheader.'">
				<td><strong><font color="'.$warnatext.'">JENIS UANG</font></strong></td>
				<td><strong><font color="'.$warnatext.'">WALKOT K.DPRD</font></strong></td>
				<td><strong><font color="'.$warnatext.'">ESELON 2</font></strong></td>
				<td><strong><font color="'.$warnatext.'">ESELON 3</font></strong></td>
				<td><strong><font color="'.$warnatext.'">ESELON 4</font></strong></td>
				<td><strong><font color="'.$warnatext.'">GOL 4</font></strong></td>
				<td><strong><font color="'.$warnatext.'">GOL 3</font></strong></td>
				<td><strong><font color="'.$warnatext.'">GOL 2,1 &lainnya</font></strong></td>
				<td><strong><font color="'.$warnatext.'">KETERANGAN</font></strong></td>
				</tr>
			</thead>
			<tbody>';
			
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>HARIAN</td>
				<td align="right">
					<input name="e_walkot" id="e_walkot" type="text" size="15" value="'.$e_walkot.'" class="btn btn-warning" required>
				</td>
				<td align="right">
					<input name="e_eselon_2" id="e_eselon_2" type="text" size="15" value="'.$e_eselon_2.'" class="btn btn-warning" required>
				</td>
				<td align="right">
					<input name="e_eselon_3" id="e_eselon_3" type="text" size="15" value="'.$e_eselon_3.'" class="btn btn-warning" required>

				</td>
				<td align="right">
					<input name="e_eselon_4" id="e_eselon_4" type="text" size="15" value="'.$e_eselon_4.'" class="btn btn-warning" required>

				</td>
				<td align="right">
					<input name="e_gol_4" id="e_gol_4" type="text" size="15" value="'.$e_gol_4.'" class="btn btn-warning" required>

				</td>
				<td align="right">
					<input name="e_gol_3" id="e_gol_3" type="text" size="15" value="'.$e_gol_3.'" class="btn btn-warning" required>

				</td>
				<td align="right">
					<input name="e_gol_lainnya" id="e_gol_lainnya" type="text" size="15" value="'.$e_gol_lainnya.'" class="btn btn-warning" required>

				</td>
				<td>
					<input name="e_ket" id="e_ket" type="text" size="15" value="'.$e_ket.'" class="btn btn-warning" required>

				</td>
				</tr>';


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>DIKLAT</td>
				<td align="right">
					<input name="e_walkotb" id="e_walkotb" type="text" size="15" value="'.$e_walkotb.'" class="btn btn-warning" required>
				</td>
				<td align="right">
					<input name="e_eselon_2b" id="e_eselon_2b" type="text" size="15" value="'.$e_eselon_2b.'" class="btn btn-warning" required>
				</td>
				<td align="right">
					<input name="e_eselon_3b" id="e_eselon_3b" type="text" size="15" value="'.$e_eselon_3b.'" class="btn btn-warning" required>

				</td>
				<td align="right">
					<input name="e_eselon_4b" id="e_eselon_4b" type="text" size="15" value="'.$e_eselon_4b.'" class="btn btn-warning" required>

				</td>
				<td align="right">
					<input name="e_gol_4b" id="e_gol_4b" type="text" size="15" value="'.$e_gol_4b.'" class="btn btn-warning" required>

				</td>
				<td align="right">
					<input name="e_gol_3b" id="e_gol_3b" type="text" size="15" value="'.$e_gol_3b.'" class="btn btn-warning" required>

				</td>
				<td align="right">
					<input name="e_gol_lainnyab" id="e_gol_lainnyab" type="text" size="15" value="'.$e_gol_lainnyab.'" class="btn btn-warning" required>

				</td>
				<td>
					<input name="e_ketb" id="e_ketb" type="text" size="15" value="'.$e_ketb.'" class="btn btn-warning" required>

				</td>
				</tr>
				
			</tbody>
		</table>
	

	
	<div class="row">
		<div class="col-md-12">
	
			<hr>
			<input name="s" type="hidden" value="'.$s.'">
			<input name="kd" type="hidden" value="'.$kdx.'">
			<input name="propnama" type="hidden" value="'.$propnama.'">
			<input name="page" type="hidden" value="'.$page.'">
			
			<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
			
			<a href="'.$filenya.'" class="btn btn-info">BATAL</a>
			<hr>
	
		</div>
	</div>
	
		
		
	</form>';
	}

else
	{
	echo '<form action="'.$filenya.'" method="post" name="formx">
	
	<div class="row">
	
		<div class="col-md-12">';
	
			//query
			$p = new Pager();
			$start = $p->findStart($limit);
			
			$sqlcount = "SELECT * FROM m_propinsi ".
							"ORDER BY nama ASC";
			$sqlresult = $sqlcount;
			
			$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
	
	
			
			echo '<table id="example" class="table table-striped table-bordered row-border hover order-column" style="width:100%">
			    <thead>
			
				<tr valign="top" bgcolor="'.$warnaheader.'">
				<td width="1">&nbsp;</td>
				<td><strong><font color="'.$warnatext.'">PROVINSI</font></strong></td>
				<td><strong><font color="'.$warnatext.'">WALKOT K.DPRD</font></strong></td>
				<td><strong><font color="'.$warnatext.'">ESELON 2</font></strong></td>
				<td><strong><font color="'.$warnatext.'">ESELON 3</font></strong></td>
				<td><strong><font color="'.$warnatext.'">ESELON 4</font></strong></td>
				<td><strong><font color="'.$warnatext.'">GOL 4</font></strong></td>
				<td><strong><font color="'.$warnatext.'">GOL 3</font></strong></td>
				<td><strong><font color="'.$warnatext.'">GOL 2,1 &lainnya</font></strong></td>
				<td><strong><font color="'.$warnatext.'">KETERANGAN</font></strong></td>
				</tr>
			
			</thead>
			<tbody>';
			
			
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
					$i_prop_nama = balikin($data['nama']);
					$i_prop_nama2 = cegah($data['nama']);
					
					
					//detailnya HARIAN
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_uang_harian ".
														"WHERE prop_nama = '$i_prop_nama2' ".
														"AND jenis = 'HARIAN'");
					$ryuk = mysqli_fetch_assoc($qyuk);
					$i_walkot = balikin($ryuk['walkot']);
					$i_eselon_2 = balikin($ryuk['eselon_2']);
					$i_eselon_3 = balikin($ryuk['eselon_3']);
					$i_eselon_4 = balikin($ryuk['eselon_4']);
					$i_gol_4 = balikin($ryuk['gol_4']);
					$i_gol_3 = balikin($ryuk['gol_3']);
					$i_gol_lainnya = balikin($ryuk['gol_lainnya']);
					$i_ket = balikin($ryuk['ket']);
			
			
					//detailnya DIKLAT
					$qyukb = mysqli_query($koneksi, "SELECT * FROM m_uang_harian ".
														"WHERE prop_nama = '$i_prop_nama2' ".
														"AND jenis = 'DIKLAT'");
					$ryukb = mysqli_fetch_assoc($qyukb);
					$i_walkotb = balikin($ryukb['walkot']);
					$i_eselon_2b = balikin($ryukb['eselon_2']);
					$i_eselon_3b = balikin($ryukb['eselon_3']);
					$i_eselon_4b = balikin($ryukb['eselon_4']);
					$i_gol_4b = balikin($ryukb['gol_4']);
					$i_gol_3b = balikin($ryukb['gol_3']);
					$i_gol_lainnyab = balikin($ryukb['gol_lainnya']);
					$i_ketb = balikin($ryukb['ket']);
			
			
					echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
					echo '<td>
					<a href="'.$filenya.'?s=edit&kunci='.$kunci.'&kd='.$kd.'&propnama='.$i_prop_nama2.'"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
					</td>
					<td>'.$i_prop_nama.'</td>
					<td align="right">
					Harian :
					<br>
					<b>'.xduit2($i_walkot).'</b>
					<br>
					<br>
					
					Diklat :
					<br>
					<b>'.xduit2($i_walkotb).'</b>
					
					</td>
					<td align="right">
					Harian :
					<br>
					<b>'.xduit2($i_eselon_2).'</b>
					<br>
					<br>
					
					Diklat : 
					<br>
					
					<b>'.xduit2($i_eselon_2b).'</b>					
					</td>
					<td align="right">
					Harian :
					<br>
					<b>'.xduit2($i_eselon_3).'</b>
					<br>
					<br>
					
					Diklat :
					<br>
					<b>'.xduit2($i_eselon_3b).'</b>
					
					</td>
					<td align="right">
					Harian :
					<br>
					<b>'.xduit2($i_eselon_4).'</b>
					<br>
					<br>
					
					Diklat :
					<br>
					<b>'.xduit2($i_eselon_4b).'</b>
					</td>
					<td align="right">
					Harian :
					<br>
					<b>'.xduit2($i_gol_4).'</b>
					<br>
					<br>
					
					Diklat :
					<br>
					
					<b>'.xduit2($i_gol_4b).'</b>
					</td>
					<td align="right">
					Harian :
					<br>
					<b>'.xduit2($i_gol_3).'</b>
					<br>
					<br>
					
					Diklat :
					<br>
					<b>'.xduit2($i_gol_3b).'</b>
					</td>
					<td align="right">
					Harian :
					<br>
					<b>'.xduit2($i_gol_lainnya).'</b>
					<br>
					<br>
					
					Diklat :
					<br>
					<b>'.xduit2($i_gol_lainnyab).'</b>
					</td>
					<td>
					'.$i_ket.'
					<br>
					<br>
					<br>
					
					'.$i_ketb.'
					</td>
					</tr>';
					}
				while ($data = mysqli_fetch_assoc($result));
				}
			
			echo '</tbody>
				
				<tfoot>
	
				<tr valign="top" bgcolor="'.$warnaheader.'">
				<td width="1">&nbsp;</td>
				<td><strong><font color="'.$warnatext.'">PROVINSI</font></strong></td>
				<td><strong><font color="'.$warnatext.'">WALKOT K.DPRD</font></strong></td>
				<td><strong><font color="'.$warnatext.'">ESELON 2</font></strong></td>
				<td><strong><font color="'.$warnatext.'">ESELON 3</font></strong></td>
				<td><strong><font color="'.$warnatext.'">ESELON 4</font></strong></td>
				<td><strong><font color="'.$warnatext.'">GOL 4</font></strong></td>
				<td><strong><font color="'.$warnatext.'">GOL 3</font></strong></td>
				<td><strong><font color="'.$warnatext.'">GOL 2,1 &lainnya</font></strong></td>
				<td><strong><font color="'.$warnatext.'">KETERANGAN</font></strong></td>
				</tr>
	
				</tfoot>
			
			</table>
	
	
			
			<table width="100%" border="0" cellspacing="0" cellpadding="3">
			<tr>
			<td>
			
			<b><font color=red>'.$count.'</font></b> Data. '.$pagelist.'
			<hr>
			
			
			<input name="jml" type="hidden" value="'.$count.'">
			</td>
			</tr>
			</table>
			
		</div>
	</div>
	
	
	</form>
	<br><br><br>';
	}

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//null-kan
xfree($qbw);
xclose($koneksi);
exit();
?>