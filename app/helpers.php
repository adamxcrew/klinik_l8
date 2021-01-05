<?php
if (!function_exists("getLastId")) {
  function getLastId($class, $unique = "id", $string = null)
  {
    $mdl = $class::whereRaw("$unique = (select max(`$unique`) from {$class->getTable()})")->first();
    $eks = $mdl ? $mdl->{$unique} : 0;
    $noUrut = (int) substr($eks, -3, 3);
    $noUrut += 1;
    $kodeName = $string ?? '';
    $lastId = $kodeName . sprintf("%03s", $noUrut);
    return  $lastId;
  }
};


if (!function_exists("rupiah")) {
  function rupiah($angka)
  {
    $hasil_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
  }
}
