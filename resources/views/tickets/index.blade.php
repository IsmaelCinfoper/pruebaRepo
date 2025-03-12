@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Lista de tickets en espera -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Tickets en Espera</h2>
        <div class="space-y-4">
            @foreach($waitingTickets as $ticket)
                <div class="border p-4 rounded-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="font-bold text-lg">{{ $ticket->ticket_number }}</span>
                            <p class="text-gray-600">{{ $ticket->patient_name }}</p>
                            <p class="text-sm text-gray-500">{{ $ticket->department }}</p>
                        </div>
                        <form action="{{ route('tickets.callNext', $ticket->department) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Llamar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            @if($waitingTickets->isEmpty())
                <p class="text-gray-500 text-center">No hay tickets en espera</p>
            @endif
        </div>
    </div>

    <!-- Tickets siendo atendidos -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">En Atención</h2>
        <div class="space-y-4">
            @foreach($currentTickets as $ticket)
                <div class="border p-4 rounded-lg bg-blue-50">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="font-bold text-lg">{{ $ticket->ticket_number }}</span>
                            <p class="text-gray-600">{{ $ticket->patient_name }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $ticket->department }} - Ventanilla {{ $ticket->counter_number }}
                            </p>
                        </div>
                        <form action="{{ route('tickets.complete', $ticket) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Completar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            @if($currentTickets->isEmpty())
                <p class="text-gray-500 text-center">No hay tickets en atención</p>
            @endif
        </div>
    </div>
</div>
@endsection
