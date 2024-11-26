@extends('layouts.template')

@section('title', 'Visualiser le PDF')

@section('content')
<div class="flex flex-col h-screen">
    <div class="flex-grow container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4">Visualiser le PDF</h2>
        <iframe src="{{ $pdfUrl }}" class="w-4/5 h-4/5 border border-gray-300" frameborder="0"></iframe>
        <div class="mt-4">
            <a href="{{ $pdfUrl }}" class="text-blue-500 hover:underline" download>Télécharger le PDF</a>
        </div>
    </div>
</div>
@endsection