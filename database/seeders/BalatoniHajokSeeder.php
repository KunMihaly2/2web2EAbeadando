<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BalatoniHajokSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            foreach ($this->readRows('tulajdonos.txt') as [$az, $nev, $varos]) {
                DB::table('tulajdonos')->updateOrInsert(
                    ['az' => (int) $az],
                    ['nev' => $nev, 'varos' => $varos === '' ? null : $varos]
                );
            }

            foreach ($this->readRows('hajo.txt') as [$az, $nev, $tipus, $tulaz, $uzemel]) {
                DB::table('hajo')->updateOrInsert(
                    ['az' => (int) $az],
                    [
                        'nev' => $nev,
                        'tipus' => $tipus,
                        'tulaz' => $tulaz === '' ? null : (int) $tulaz,
                        'uzemel' => $uzemel === '-1',
                    ]
                );
            }

            foreach ($this->readRows('tort.txt') as [$hajoaz, $nev]) {
                DB::table('tort')->updateOrInsert([
                    'hajoaz' => (int) $hajoaz,
                    'nev' => $nev,
                ]);
            }
        });
    }

    private function readRows(string $filename): iterable
    {
        $contents = File::get(database_path('data/'.$filename));
        $lines = preg_split('/\r\n|\n|\r/', $contents);

        // Az első sor az oszlopneveket tartalmazza.
        foreach (array_slice($lines, 1) as $line) {
            if ($line !== '') {
                yield explode("\t", $line);
            }
        }
    }
}