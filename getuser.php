<pre>
<?php
ini_set( 'display_errors', true );
class User{
   public $uid;
   public $name;
   public $username;
}

function GetUserInfo($id,$user)
{
	//include "./include/conn.php";
    $koneksi = open_connection();
    $userObj = new User();
	$query = "select * from tabel_admin where username='$user' and id_admin='$id'";
	$result = $koneksi->query( $query );
	if ( $result->num_rows > 0 ) {
		while ( ( $row = $result->fetch_assoc() ) !== null ) {
			$id_admin = $row[ 'id_admin' ];
			$nama = $row[ 'nama' ];
			$user = $row[ 'username' ];
			$userObj->uid=$id_admin;
   			$userObj->name=$nama;
   			$userObj->username=$user;
		}
		$result->close();
		//update login time
		close_connection( $koneksi );
		
	}else{
		close_connection( $koneksi );
		$userObj->uid=$id;
   		$userObj->name='NO USER';
   		$userObj->username=$user;
	}
   return $userObj;
}
?>
</pre>