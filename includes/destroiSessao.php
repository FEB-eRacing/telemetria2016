<?php
	SESSION_start();
	session_destroy();
	header("Location: ../.");
?>