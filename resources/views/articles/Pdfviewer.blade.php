@extends('layouts.template')

@section('title', 'Visualiser le PDF')

@section('content')
<div class="flex flex-col">
    <div class="flex-grow container mx-auto my-8 text-white px-4 py-2 rounded mb-8 text-center font-bold">
        {{-- titre de l'article et l'image qui lui ai associée --}}

        <div class="flex flex-col items-center ">
            <!-- Titre de l'article -->
            <h2 class="text-2xl font-bold mb-4 text-gray-700">{{ $title }}</h2> 
            
            <img src="{{ $imageUrl }}" alt="{{ $title }}" class="mb-4 max-w-xs h-auto rounded">
        </div>



        <h2 class="text-xl font-bold mb-4 text-gray-700">Visualiser le PDF</h2>
        
        <div class="flex justify-center">
            <iframe src="{{ $pdfUrl }}" class="w-4/5 h-[calc(120vh-350px)] border border-gray-300" frameborder="0"></iframe>
        </div>
        <div class="mt-5 flex justify-center">
            <a href="{{ $pdfUrl }}" class="flex items-center justify-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition max-w-xs w-full" download>
                <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#FFBF66">
                    <path d="M260-160q-91 0-155.5-63T40-377q0-78 47-139t123-78q25-92 100-149t170-57q117 0 198.5 81.5T760-520q69 8 114.5 59.5T920-340q0 75-52.5 127.5T740-160H520q-33 0-56.5-23.5T440-240v-206l-64 62-56-56 160-160 160 160-56 56-64-62v206h220q42 0 71-29t29-71q0-42-29-71t-71-29h-60v-80q0-83-58.5-141.5T480-720q-83 0-141.5 58.5T280-520h-20q-58 0-99 41t-41 99q0 58 41 99t99 41h100v80H260Zm220-280Z text-bold"/>
                </svg>
                Télécharger le PDF
            </a>
        </div>
    </div>
</div>
@endsection
<script>


 
</script>