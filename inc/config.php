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




//error reporting //////////////////////////////////////////////////////////////////////////////
//matikan
error_reporting(0);

//tampilkan
//error_reporting(E_ALL & ~E_NOTICE);
//error reporting //////////////////////////////////////////////////////////////////////////////




//ALAMAT SITUS //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sumber = "http://localhost/sisfo-sppd";
$kotanya = "kendal";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//KONEKSI DATABASE //////////////////////////////////////////////////////////////////////////////////////////////////////////////
$xhostname = "localhost";
$xdatabase = "sisfo-sppd"; //sesuaikan dengan nama database yang dibikin
$xusername = "biasawae"; //sesuaikan dengan username mysql-server yang ada
$xpassword = "biasawae"; //sesuaikan dengan password user mysql-server yang ada
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//JUMLAH DATA per HALAMAN ///////////////////////////////////////////////////////////////////////////////////////////////////////
$limit = "30";  //jumlah data dalam satu halaman
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//KONFIGURASI WARNA TABEL - DATA ////////////////////////////////////////////////////////////////////////////////////////////////
$warna01 = "#F8F8F8";
$warna02 = "#E3E1F9";
$warnaover = "#C7CBFA";
$warnaheader = "green";
$warnatext = "orange";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//KEY GOOGLE MAP///////////////////////////////////////////////////////////////////////////////////////////////////////
$keyku = "AIzaSyBZ73oHLqNFmGX6bs3qyyRAoCim-_WxdqQ";
//KEY GOOGLE MAP///////////////////////////////////////////////////////////////////////////////////////////////////////







//Lama-nya session //////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sesidt = 3600; //detik
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>