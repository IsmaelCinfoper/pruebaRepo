@extends('layouts.app')

@section('content')
<div class="bg-black min-h-screen">
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold text-white text-center mb-8">Panel de Llamadas</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($calledTickets as $ticket)
                <div class="bg-blue-600 rounded-lg p-6 text-white animate-pulse">
                    <div class="text-center">
                        <div class="text-5xl font-bold mb-4">{{ $ticket->ticket_number }}</div>
                        <div class="text-2xl mb-2">{{ $ticket->department }}</div>
                        <div class="text-3xl font-semibold">
                            Ventanilla {{ $ticket->counter_number }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($calledTickets->isEmpty())
            <p class="text-2xl text-white text-center mt-8">No hay tickets siendo llamados actualmente</p>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function refreshDisplay() {
        location.reload();
    }
    // Actualizar la pantalla cada 10 segundos
    setInterval(refreshDisplay, 10000);
});
</script>
@endsection
