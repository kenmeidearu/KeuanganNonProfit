<?php  
session_start();
if (isset($_SESSION['id_admin']))
{
	session_destroy();
	?><script language="javascript">document.location.href="./../index.php?status=logout"</script><?php 
	
}else{
	?><script language="javascript">document.location.href="./../index.php?status=forbidden"</script><?php 
}
?>