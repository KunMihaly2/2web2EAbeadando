@extends('layouts.balaton')

@section('title', 'Főoldal')

@section('content')
    <h1>Balatoni hajók</h1>
    <p>Ismerd meg a Balaton egykori és ma is üzemelő hajóit,
        tulajdonosaikat és korábbi neveiket.</p>
    <p><a href="{{ route('adatbazis') }}">Hajók böngészése</a></p>
@endsection