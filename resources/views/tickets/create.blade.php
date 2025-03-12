@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-center">Solicitar Nuevo Ticket</h2>

    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="patient_name" class="block text-gray-700 font-bold mb-2">Nombre del Paciente</label>
            <input type="text" name="patient_name" id="patient_name" required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="department" class="block text-gray-700 font-bold mb-2">Departamento</label>
            <select name="department" id="department" required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                @foreach($departments as $department)
                    <option value="{{ $department }}">{{ $department }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" 
            class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
            Generar Ticket
        </button>
    </form>
</div>
@endsection
