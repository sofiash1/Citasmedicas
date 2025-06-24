<?php
include("conexion.php");

$id = $_GET['id'];

$conexion->query("DELETE FROM citas WHERE id=$id");

header("Location: inicio.php");
