<?php

require_once('DBClass.php');
class User extends DBClass{
	
	public function login($u, $p){
		$str = "select ifnull((select 'mahasiswa' from mahasiswa m  WHERE m.nim='$u' and m.pswd_mahasiswa='$p'),(select 'admin' from administrator a WHERE a.user_admin='$u' and a.pswd_admin='$p')) as 'type',ifnull((select nim from mahasiswa m  WHERE m.nim='$u' and m.pswd_mahasiswa='$p'),(select user_Admin from administrator a WHERE a.user_admin='$u' and a.pswd_admin='$p')) as 'id'";		
		$r = $this->getRows($str);
		$this->close();
		
		return $r;
	} 
		
}
