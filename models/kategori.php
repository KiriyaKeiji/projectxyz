<?php 
	require_once '../lib/DBClass.php';
	/**
	* 
	*/
	class Kategori extends DBClass
	{
		
		public function getKategori()
		{
			$sql="SELECT * FROM `kategorilapor`";
			$rs=$this->getRows($sql);
			$this->close();
			return $rs;
		}


		

	}
?>