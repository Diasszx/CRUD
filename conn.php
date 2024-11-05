<?php

$conn = new PDO("mysql:host=localhost; dbname=crud", "root", "root");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
