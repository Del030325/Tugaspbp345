<?php
// Membuat array bunga
$arrString = ["Mawar", "Melati", "Anggrek", "Tulip", "Lili"];

// Mengecek apakah variabel adalah array
if (is_array($arrString)) {
    echo "Ini adalah array nama bunga\n\n";
}

$total = count($arrString);
echo "Jumlah bunga: $total \n\n";

$contoh = $arrString[0];
$sub = substr($contoh, 0, 3);
echo "nama bunga pertama: $contoh \n";
echo "3 huruf pertama: $sub \n\n";

// Sebelum sort
echo "Sebelum sort: ";
for ($i = 0; $i < count($arrString); $i++) {
    echo $arrString[$i] . " ";
}

// sort()
sort($arrString);
echo "\nSetelah sort: ";
for ($i = 0; $i < count($arrString); $i++) {
    echo $arrString[$i] . " ";
}

// shuffle()
shuffle($arrString);
echo "\nSetelah shuffle: ";
for ($i = 0; $i < count($arrString); $i++) {
    echo $arrString[$i] . " ";
}

?>