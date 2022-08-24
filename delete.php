<?php

require 'function.php';

$kd = $_GET["kd"];

if (delete($kd) > 0) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'edit.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = 'edit.php';
		</script>
	";
}

?>