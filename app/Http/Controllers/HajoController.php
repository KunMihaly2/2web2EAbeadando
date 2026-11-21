<?php

namespace App\Http\Controllers;

use App\Models\Hajo;
use Illuminate\View\View;

class HajoController extends Controller
{
    public function index(): View
    {
        $hajok = Hajo::with(['tulajdonos', 'korabbiNevek'])
            ->orderBy('nev')
            ->orderBy('az')
            ->simplePaginate(15);

        return view('hajok.index', ['hajok' => $hajok]);

    }

    public function diagram(): View
    {
    $tipusok = Hajo::query()
        ->selectRaw('tipus, COUNT(*) AS darab')
        ->groupBy('tipus')
        ->orderByDesc('darab')
        ->orderBy('tipus')
        ->get();

    return view('hajok.diagram', [
        'cimkek' => $tipusok->pluck('tipus')->all(),
        'darabszamok' => $tipusok->pluck('darab')
            ->map(fn ($darab) => (int) $darab)
            ->all(),
    ]);
    }

}