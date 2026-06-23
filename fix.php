<?php
$c = file_get_contents('temp.php');
$c = preg_replace('/<\?php\n\$content = <<<EOF\n/', '', $c);
$c = preg_replace('/EOF;\n.*/s', '', $c);
$c = str_replace('\\$', '$', $c);
$c = str_replace('Sudah', 'Lunas', $c);
$c = str_replace('$pemesanan->status == "paid"', 'in_array($pemesanan->status, ["paid", "confirmed", "completed"])', $c);
file_put_contents('resources/views/admin/pemesanans/index.blade.php', $c);
echo "Done";
