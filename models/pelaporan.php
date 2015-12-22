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

		


		

	}
?>