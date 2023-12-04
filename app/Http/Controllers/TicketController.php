<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //$userTickets = Auth::user()->tickets;

        return Inertia::render('Tickets/Index', [
            'tickets' => Ticket::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'category' => 'required|in:Desenvolvimento Web,Programação Embarcada,Inteligência Artificial,Banco de Dados,Outros',
        ]);

        $request->user()->tickets()->create($validated);

        return redirect(route('tickets.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorize('update', $ticket);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'category' => 'required|in:Desenvolvimento Web,Programação Embarcada,Inteligência Artificial,Banco de Dados,Outros',
        ]);

        $ticket->update($validated);

        return redirect(route('tickets.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket): RedirectResponse
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return redirect(route('tickets.index'));
    }
}
