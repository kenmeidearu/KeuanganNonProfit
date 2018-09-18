<?php
session_start();
ini_set( 'display_errors', true );

//untuk koneksi
include "./../include/conn.php";
$koneksi = open_connection();

//untuk tanggal log
$waktu = date( "Y-m-d H:i:s" );

if ( isset( $_POST[ 'username' ] ) ) {

	$username = htmlentities( ( trim( $_POST[ 'username' ] ) ) );
	$password = htmlentities( md5( $_POST[ 'password' ] ) );
	$query = "select * from tabel_admin where username='$username' and password='$password'";

	$result = $koneksi->query( $query );
	if ( $result->num_rows > 0 ) {
		while ( ( $row = $result->fetch_assoc() ) !== null ) {
			$id_admin = $row[ 'id_admin' ];
			$nama = $row[ 'nama' ];
			$tanggal = $row[ 'tanggal' ];
			$_SESSION[ 'id_admin' ] = $id_admin;
			$_SESSION['user']=$row['username'];
			$_SESSION[ 'nama' ] = $nama;
			$query1 = "update tabel_admin set tanggal=now() where id_admin='$id_admin'";
			$koneksi->query( $query1 );
		}
		$result->close();
		//update login time
		close_connection( $koneksi );
		echo '<script language="javascript">
			document.location.href = "./../dashboard.php"
			</script>';
	} else {
		$result->close();
		close_connection( $koneksi );
		echo '<script language="javascript">
			document.location.href = "./../index.php?status=error"
			</script>';
	}

} else {
	unset( $_POST[ 'username' ] );
	close_connection( $koneksi );
	echo '<script language="javascript">
			document.location.href = "./../index.php"
			</script>';
}
?>