<?php
session_start();
ini_set( 'display_errors', true );

//untuk koneksi
include "./../include/conn.php";
$koneksi = open_connection();

if ( isset( $_POST[ 'userlogin' ] ) && isset($_POST['id'])  ) {
	$username = htmlentities( ( trim( $_POST[ 'userlogin' ] ) ) );
	$password = htmlentities( md5( $_POST[ 'password' ] ) );
	$nama = htmlentities( trim( $_POST[ 'nama' ] ) );
	$id = htmlentities( ( trim( $_POST[ 'id' ] ) ) );
	$query = "select * from tabel_admin where username='$username' and id_admin='$id'";
	$result = $koneksi->query( $query );
	if ( $result->num_rows > 0 ) {
		while ( ( $row = $result->fetch_assoc() ) !== null ) {
			$id_admin = $row[ 'id_admin' ];
			$_SESSION[ 'id_admin' ] = $id_admin;
			$_SESSION[ 'nama' ] = $nama;
			if(isset($_POST['optionsCheckboxes'])){
				$query1 = "update tabel_admin set username='$username',password='$password',nama='$nama', tanggal=now() where id_admin='$id'";
			}else{
				$query1 = "update tabel_admin set username='$username',nama='$nama', tanggal=now() where id_admin='$id'";
			}
			$koneksi->query( $query1 );
		}
		$result->close();
		close_connection( $koneksi );

		echo '<script language="javascript">
			document.location.href = "./../profile.php"
			</script>';
	} else {
		$result->close();
		close_connection( $koneksi );
		echo '<script language="javascript">
			document.location.href = "./../profile.php?status=error"
		</script>';
	}

} else {
	close_connection( $koneksi );
	echo '<script language="javascript">
			document.location.href = "./../index.php"
			</script>';
}

?>