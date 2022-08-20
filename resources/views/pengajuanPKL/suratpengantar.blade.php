<!DOCTYPE html>
<html>
<head>
	<title>Surat Pengajuan PKL</title>
	<style type="text/css">
		table {
			border-style: double;
			border-width: 3px;
			border-color: white;
			border-collapse: collapse;
			margin-right: 150px;
		}
		table tr .text2 {
			text-align: right;
			font-size: 13px;
		}
		table tr .text {
			text-align: center;
			font-size: 13px;
		}
		table tr td {
			font-size: 13px;
		}
		
		.text3 {
			text-align: justify;
			font-size: 13px;
		}

		.paragraf {
			text-indent: 0.2in;
		}
		.paragraf1 {
			text-indent: 0.7in;
		}

		.indent {
			text-indent: 1.2in;
		}
		.indent1 {
			margin-left: 70px;
		}

		.paragraf2 {
			text-indent: 0.46in;		
		}
	</style>
</head>
<body>
	<center>
		<table>
			<tr>
				<td><img src="{{ public_path ('img/logo.jpg')}}" width="80" height="110"></td>
				<td>
				<center><b>
					<font size="4">PEMERINTAH PROVINSI KALIMANTAN TIMUR</font><br>
					<font size="4">DINAS PENDIDIKAN DAN KEBUDAYAAN</font><br>
					<font size="5">SMK NEGERI 2 BALIKPAPAN</font><br>
					<font size="2">Alamat Jalan Soekarno – Hatta Gn. Samarinda III  Kec. Balikpapan Utara Kota Balikpapan</font><br>
					<font size="2">Telepon (0542) 423182 Fax. 750073 website  www.smkn2balikpapan.sch.id e-mail  smkn2_bppn@yahoo.com</font>
				</b></center>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<hr>
				</td>
			</tr>
		</table>

		<table width="625" class="paragraf">
			<tr>
		       <td>
			       Balikpapan, {{$tanggal_sekarang}}
		       </td>
		    </tr>
		</table>

		<table width="625" class="paragraf">
			<tr>
				<td>&nbsp;Nomor</td>
				<td width="530">: </td>
			</tr>
			<tr>
				<td>&nbsp;Sifat</td>
				<td>: Biasa</td>
			</tr>
			<tr>
				<td>&nbsp;Lampiran</td>
				<td>: --</td>
			</tr>
			<tr>
				<td>&nbsp;Perihal</td>
				<td>: <b>Permohonan Praktik Kerja Lapangan</b></td>
			</tr>
		</table>
		<br>
		<table width="455">
			<tr>
		       <td class="paragraf1">
					<font size="2">Kepada
					<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Yth. {{$pengajuan->nama_dudi}}
					<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						di-</font>
					<p class="indent"><b><u>BALIKPAPAN</u></b></p></font>
		       </td>
		    </tr>
		</table>
		<table width="500">
			<tr class="text3">
		       	<td>
			       <font size="2"><p class="indent1 paragraf2">Sehubungan dengan informasi penerimaan siswa PKL di perusahaan 
					Bapak/Ibu, maka dengan ini kami mohon untuk dapat menerima siswa kami melaksanakan 
					Praktik Kerja Industri di Perusahaan Bapak/Ibu pimpin, selama 3 (tiga) bulan 
					mulai tanggal {{$tanggal_mulai}} s/d {{$tanggal_selesai}}. 
					Adapun daftar nama para siswa Praktik tersebut adalah sebagai berikut :</p></font>
		       	</td>
			</tr>
			<tr>
			   	<td>	
				   <table class="text" width="455" border="1" style="border: 1px solid black; padding: 10px; margin-left: 60px;">
						<tr>
							<td>No</td>
							<td>N A M A</td>
							<td>NIS/NISN</td>
							<td>K E L A S</td>
						</tr>
						<tr>
							<td>1</td>
							<td>{{$pengajuan->nama_siswa}}</td>
							<td>{{$pengajuan->nis}} / {{$pengajuan->nisn}}</td>
							<td>{{$pengajuan->nama_kelas}}</td>
						</tr>
    				</table>
				</td>
			</tr>
			<tr class="text3">
				<td>
			       <font size="2"><p class="indent1 paragraf2">Mohon memberikan informasi kepada kami atau melalui e-mail: <a href="mailto:smkn2_bppn@yahoo.com"><b>smkn2_bppn@yahoo.com</b></a> sebagai <b><i>Bukti Administrasi Sekolah.</i></b></p></font>
				   <font size="2"><p class="indent1 paragraf2">Demikian yang dapat kami sampaikan, atas bantuan dan kerjasamanya kami ucapkan terimakasih.</p></font>
		       	</td>
		    </tr>
		</table>
		<br>
		<table width="500">
			<tr>
				<td width="370"></td>
				<td>{{$kepalasekolah->jabatan}},<br><br><br><br>{{$kepalasekolah->nama_kepsek}}<br>{{$kepalasekolah->pangkat_gol}}<br>NIP. {{$kepalasekolah->nip}}</td>
			</tr>
	     </table>
	</center>
</body>
</html>