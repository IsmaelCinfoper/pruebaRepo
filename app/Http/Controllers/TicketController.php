<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waitingTickets = Ticket::where('status', 'waiting')->orderBy('created_at')->get();
        $currentTickets = Ticket::where('status', 'called')->get();
        return view('tickets.index', compact('waitingTickets', 'currentTickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = ['General', 'Urgencias', 'Pediatría', 'Traumatología'];
        return view('tickets.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'department' => 'required|string'
        ]);

        $ticket = new Ticket();
        $ticket->patient_name = $request->patient_name;
        $ticket->department = $request->department;
        $ticket->ticket_number = Ticket::generateTicketNumber($request->department);
        $ticket->status = 'waiting';
        $ticket->save();

        return redirect()->route('tickets.show', $ticket)->with('success', 'Ticket creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Call the next ticket in the specified department.
     */
    public function callNext($department)
    {
        $nextTicket = Ticket::where('department', $department)
            ->where('status', 'waiting')
            ->orderBy('created_at')
            ->first();

        if ($nextTicket) {
            $nextTicket->status = 'called';
            $nextTicket->counter_number = rand(1, 5); // Simulamos 5 ventanillas
            $nextTicket->save();
            return response()->json($nextTicket);
        }

        return response()->json(['message' => 'No hay tickets en espera'], 404);
    }

    /**
     * Mark the specified ticket as attended.
     */
    public function complete(Ticket $ticket)
    {
        $ticket->status = 'attended';
        $ticket->save();
        return redirect()->back()->with('success', 'Ticket marcado como atendido');
    }

    /**
     * Display the called tickets.
     */
    public function display()
    {
        $calledTickets = Ticket::where('status', 'called')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
        return view('tickets.display', compact('calledTickets'));
    }
}
