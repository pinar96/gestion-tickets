<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Auth::user()->tickets()->get();
        return view('dashboard', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ticketsStatuses = TicketStatus::all();
        return view('tickets.create', compact('ticketsStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'status_id' => 'required|exists:ticket_statuses,id',
        ]);
        DB::beginTransaction();
        try {
            $ticket = Ticket::create([
                'subject' => $request->subject,
                'body' => $request->body,
                'status_id' => $request->status_id,
                'user_id' => Auth::id(),
            ]);
            DB::commit();
            $notification = array(
                'message' => 'Ticket creado exitosamente!',
                'alert-type' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false
            );
            return redirect()->route('tickets.index')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            $notification = array(
                'message' => 'Error al crear el ticket: ' . $e->getMessage(),
                'alert-type' => 'error',
                'showConfirmButton' => true
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $ticketsStatuses = TicketStatus::all();
        return view('tickets.show', compact('ticket', 'ticketsStatuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $ticketsStatuses = TicketStatus::all();
        return view('tickets.edit', compact('ticket', 'ticketsStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'status_id' => 'required|exists:ticket_statuses,id',
        ]);
        DB::beginTransaction();
        try {
            $ticket->update([
                'subject' => $request->subject,
                'body' => $request->body,
                'status_id' => $request->status_id,
                'user_id' => Auth::id(),
            ]);
            DB::commit();
            $notification = array(
                'message' => 'Ticket #'.$ticket->id.' actualizado exitosamente!',
                'alert-type' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false
            );
            return redirect()->route('tickets.index')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            $notification = array(
                'message' => 'Error al actualizar el ticket: ' . $e->getMessage(),
                'alert-type' => 'error',
                'showConfirmButton' => true
            );
            return redirect()->back()->withErrors($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ticket_id)
    {
        try {
            $ticket = Ticket::findOrFail($ticket_id);
            $ticket->delete();

            return response()->json([
                'message' => 'Ticket #' . $ticket->id . ' eliminado exitosamente!',
                'id' => $ticket->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar el ticket: ' . $e->getMessage(),
            ], 500);
        }
    }
}
