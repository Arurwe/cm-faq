@extends('layouts.app')

@section('title', 'Lista kategorii')

@section('content')
<div class="container mx-auto px-4 py-6">
    

    <!-- Sekcja kategorii -->
    <div class="mt-8 " > 
        <x-category-list :categories="$categories" style="categoriesPage" />
        
     </div>
</div>
@endsection
