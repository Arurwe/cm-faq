@extends('layouts.admin')

@section('title', 'Zarządzaj Kategoriami')

@section('content')
<div class="container">

    <h1 class="text-2xl font-bold mb-4">Zarządzaj Kategoriami</h1>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Nazwa</th>
                <th class="px-4 py-2">Opcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr class="hover:bg-slate-200">
                <td class="border px-4 py-2">{{ $category-> }}</td>
            </tr>
                
            @endforeach
        </tbody>
    </table>

</div>
@endsection