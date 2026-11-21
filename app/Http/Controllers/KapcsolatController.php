<?php

namespace App\Http\Controllers;

use App\Models\Uzenet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KapcsolatController extends Controller
{
    public function index(): View
    {
        $uzenetek = Uzenet::orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        return view('uzenetek', ['uzenetek' => $uzenetek]);
    }

    public function store(Request $request): RedirectResponse
    {
        $adatok = $request->validate([
            'nev' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'uzenet' => ['required', 'string', 'max:3000'],
        ], [
            'nev.required' => 'Add meg a neved.',
            'nev.max' => 'A név legfeljebb 100 karakter lehet.',
            'email.required' => 'Add meg az e-mail-címed.',
            'email.email' => 'Adj meg egy érvényes e-mail-címet.',
            'email.max' => 'Az e-mail-cím legfeljebb 255 karakter lehet.',
            'uzenet.required' => 'Írd be az üzeneted.',
            'uzenet.max' => 'Az üzenet legfeljebb 3000 karakter lehet.',
        ]);

        Uzenet::create($adatok);

        return redirect()->route('kapcsolat')
            ->with('siker', 'Köszönjük, az üzeneted megérkezett.');
    }
}