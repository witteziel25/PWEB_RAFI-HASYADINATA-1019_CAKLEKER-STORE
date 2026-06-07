<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = \DB::table('users')->get()->map(fn($item) => (array) $item)->toArray();
$lelangs = \DB::table('lelangs')->get()->map(fn($item) => (array) $item)->toArray();
$fotos = \DB::table('foto_lelangs')->get()->map(fn($item) => (array) $item)->toArray();
$penawarans = \DB::table('penawarans')->get()->map(fn($item) => (array) $item)->toArray();

$code = "<?php\n\nnamespace Database\\Seeders;\n\nuse Illuminate\\Database\\Seeder;\nuse Illuminate\\Support\\Facades\\DB;\n\nclass DataLelangSeeder extends Seeder\n{\n    public function run()\n    {\n";

// Helper for arrays
function exportArray($data) {
    $str = "[\n";
    foreach ($data as $row) {
        $str .= "            [\n";
        foreach ($row as $k => $v) {
            $val = is_null($v) ? 'null' : (is_numeric($v) && !preg_match('/^0[0-9]+$/', $v) ? $v : "'" . addslashes($v) . "'");
            $str .= "                '" . $k . "' => " . $val . ",\n";
        }
        $str .= "            ],\n";
    }
    $str .= "        ]";
    return $str;
}

$code .= "        DB::table('users')->insert(" . exportArray($users) . ");\n\n";
$code .= "        DB::table('lelangs')->insert(" . exportArray($lelangs) . ");\n\n";
$code .= "        DB::table('foto_lelangs')->insert(" . exportArray($fotos) . ");\n\n";
$code .= "        DB::table('penawarans')->insert(" . exportArray($penawarans) . ");\n\n";

$code .= "    }\n}\n";

file_put_contents(__DIR__.'/database/seeders/DataLelangSeeder.php', $code);
echo "Seeder successfully written to database/seeders/DataLelangSeeder.php\n";
