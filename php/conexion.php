<?php

$mysqli = new mysqli("82.197.82.18", "u482925761_alex2680", "Milo2680", "u482925761_bnmaweb");
if (mysqli_connect_errno()) {
	echo 'Failed to connect', mysqli_connect_error();
	exit();
} else {
	echo 'Successfully Connected';
}
?>