<?php 
	require_once '../lib/DBClass.php';
	/**
	* 
	*/
	class Pelaporan extends DBClass
	{
		
		public function newReport($isi,$image,$nim,$kategori,$departemen=array())
		{
			$sql="INSERT INTO `pelaporan` (`isi_Pelaporan`, `ImagePath`, `Mahasiswa_NIM`, `KategoriLapor_id_KategoriLapor`) VALUES ( '$isi','$image', $nim, $kategori)";
			$rs=$this->putRows($sql);
			$this->close();
			foreach ($departemen as $dep => $value) {
				$sql="INSERT INTO `departemen_has_pelaporan` (`Departemen_id_Departemen`, `Pelaporan_id_Pelaporan`) VALUES ($value, (select max(id_pelaporan) from pelaporan))";
				$rs=$this->putRows($sql);
				$this->close();
			}
			
			
		}

		public function newRespond($isi,$oleh,$idlaporan)
		{
			$sql="INSERT INTO `tanggapan` (`id_Tanggapan`, `isi_Tanggapan`, `tgl_Tanggapan`, `Administrator_user_Admin`, `Pelaporan_id_Pelaporan`) VALUES (NULL, '$isi', CURRENT_TIMESTAMP, '$oleh', '$idlaporan') ";
			$rs=$this->putRows($sql);
			$this->close();
				
			
		}

		public function createSiswa($nim,$nama,$pwd)
		{
			$sql="INSERT INTO `mahasiswa` (`NIM`, `nama_Mahasiswa`, `pswd_Mahasiswa`) VALUES ('$nim', '$nama', '$pwd') ";
			$rs=$this->putRows($sql);
			$this->close();
				
			
		}


		public function updateRespond($isi,$id)
		{
			$sql="UPDATE `tanggapan` SET `isi_Tanggapan` = '$isi' WHERE `tanggapan`.`id_Tanggapan` = $id ";
			$rs=$this->putRows($sql);
			$this->close();
				
			
		}

		public function deleteRespond($id)
		{
			$sql="DELETE from `tanggapan`  WHERE `tanggapan`.`id_Tanggapan` = $id ";
			$rs=$this->putRows($sql);
			$this->close();
				
			
		}

		public function getReportbyID($id)
		{
			$str = "SELECT p.*,DATE_FORMAT(tgl_Pelaporan,'%a, %b %d %Y %h:%i %p') as 'tanggal', k.nama_KategoriLapor as 'kategori' FROM `pelaporan` p JOIN kategorilapor k on p.KategoriLapor_id_KategoriLapor=k.id_KategoriLapor where mahasiswa_nim=$id";		
			$r = $this->getRows($str);
			$this->close();
		
			return $r;
		}

		public function getTujuan($id)
		{
			$str = "select nama_departemen as'dep' from pelaporan p JOIN departemen_has_pelaporan dp on p.id_Pelaporan=dp.Pelaporan_id_Pelaporan join departemen d on d.id_Departemen=dp.Departemen_id_Departemen where p.id_Pelaporan=$id";		
			$r = $this->getRows($str);
			$this->close();
		
			return $r;
		}

		public function getTanggapanbyid($id)
		{
			$str = "SELECT `isi_Tanggapan` as isi, DATE_FORMAT(`tgl_Tanggapan`,'%a, %b %d %Y %h:%i %p') as tanggal, `Administrator_user_Admin` as oleh, `Pelaporan_id_Pelaporan` as idlapor,departemen.nama_Departemen as dep,id_Tanggapan as idtanggap FROM `tanggapan` JOIN administrator on tanggapan.Administrator_user_Admin=administrator.user_Admin JOIN departemen on administrator.Departemen_id_Departemen=departemen.id_Departemen WHERE Pelaporan_id_Pelaporan=$id";		
			$r = $this->getRows($str);
			$this->close();
		
			return $r;
		}

		public function getRepliedbyID($id)
		{
			$str = "select p.*,DATE_FORMAT(tgl_Pelaporan,'%a, %b %d %Y %h:%i %p') as 'tanggal', k.nama_KategoriLapor as 'kategori' from pelaporan p JOIN kategorilapor k on p.KategoriLapor_id_KategoriLapor=k.id_KategoriLapor LEFT join tanggapan on p.id_Pelaporan=tanggapan.Pelaporan_id_Pelaporan
where tanggapan.Pelaporan_id_Pelaporan is not null and Mahasiswa_NIM=$id";		
			$r = $this->getRows($str);
			$this->close();
		
			return $r;
		}

		public function getReportbyTujuan($dep)
		{
			$str = "SELECT p.*,DATE_FORMAT(tgl_Pelaporan,'%a, %b %d %Y %h:%i %p') as 'tanggal', k.nama_KategoriLapor as 'kategori',id_Pelaporan as idlapor,mahasiswa.nama_Mahasiswa as namemhs FROM `pelaporan` p JOIN kategorilapor k on p.KategoriLapor_id_KategoriLapor=k.id_KategoriLapor JOIN departemen_has_pelaporan dp on p.id_Pelaporan=dp.Pelaporan_id_Pelaporan JOIN departemen d on dp.Departemen_id_Departemen=d.id_Departemen join mahasiswa on mahasiswa.nim=p.mahasiswa_nim where d.nama_Departemen='$dep'";		
			$r = $this->getRows($str);
			$this->close();
		
			return $r;
		}
		
		public function getReportbyIDLapor($id,$dep)
		{
			$str = "SELECT p.*,DATE_FORMAT(tgl_Pelaporan,'%a, %b %d %Y %h:%i %p') as 'tanggal', k.nama_KategoriLapor as 'kategori',id_Pelaporan as idlapor,m.nama_Mahasiswa as mhs FROM `pelaporan` p JOIN kategorilapor k on p.KategoriLapor_id_KategoriLapor=k.id_KategoriLapor JOIN departemen_has_pelaporan dp on p.id_Pelaporan=dp.Pelaporan_id_Pelaporan JOIN departemen d on dp.Departemen_id_Departemen=d.id_Departemen join mahasiswa m on p.Mahasiswa_NIM=m.NIM where p.id_Pelaporan=$id and d.nama_Departemen='$dep'";		
			$r = $this->getRows($str);
			$this->close();
		
			return $r;
		}

		public function getUnRepliedbyTujuan($id)
		{
			$str = "select p.*,DATE_FORMAT(tgl_Pelaporan,'%a, %b %d %Y %h:%i %p') as 'tanggal', k.nama_KategoriLapor as 'kategori' from pelaporan p JOIN kategorilapor k on p.KategoriLapor_id_KategoriLapor=k.id_KategoriLapor LEFT join tanggapan on p.id_Pelaporan=tanggapan.Pelaporan_id_Pelaporan where tanggapan.Pelaporan_id_Pelaporan is not null and Mahasiswa_NIM=$id";		
			$r = $this->getRows($str);
			$this->close();
		
			return $r;
		}

		public function report()
		{
			$str = "select kategorilapor.nama_KategoriLapor as Tipe,pelaporan.isi_Pelaporan as Isi,mahasiswa.nama_Mahasiswa as Oleh,pelaporan.tgl_Pelaporan as Pada,tanggapan.isi_Tanggapan as 'Tanggapan',administrator.nama_Admin as Oleh,departemen.nama_Departemen as 'Department',tanggapan.tgl_Tanggapan as Pada from pelaporan JOIN kategorilapor on pelaporan.KategoriLapor_id_KategoriLapor=kategorilapor.id_KategoriLapor JOIN mahasiswa on mahasiswa.NIM=pelaporan.Mahasiswa_NIM    right join tanggapan on tanggapan.Pelaporan_id_Pelaporan=pelaporan.id_Pelaporan JOIN administrator on tanggapan.Administrator_user_Admin=administrator.user_Admin JOIN departemen on departemen.id_Departemen=administrator.Departemen_id_Departemen";		
			$r = $this->getRows($str);
			$this->close();
		
			return $r;
		}
		


		


		

	}
?>