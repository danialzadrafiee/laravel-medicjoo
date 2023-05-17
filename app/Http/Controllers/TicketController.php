<?php

namespace App\Http\Controllers;

use App\Credit;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->user()->id)->where('parent_id', 0)->orderBy('id', 'DESC')->get();
        return view('ticket.index', compact('tickets'));
    }
    public function create()
    {
        return view('ticket.create');
    }
    public function store(Request $request)
    {
        if (empty($request->parent_id)) {
            $validated = $request->validate([
                'amount' => 'required|numeric|min:50000|max:100000000',
            ]);
        } else {
            $validated = $request->validate([
                'message' => 'required',
            ]);
        }

        $request->request->add([
            'user_id' => auth()->user()->id,
        ]);
        Ticket::create($request->all());
        if (auth()->user()->UserAttr()->first()->job == 'client') {
            return redirect()->route('ticket_index')->with('msg', 'درخواست شما ثبت شد و درحال بررسی است');
        }
        return redirect()->back()->with('msg', 'درخواست شما ثبت شد و درحال بررسی است');
    }
    public function show($id)
    {
        $main_ticket = Ticket::where('id', $id)->first();
        $sub_tickets = Ticket::where('parent_id', $main_ticket->id)->get();
        return view('ticket.show', compact('main_ticket', 'sub_tickets'));
    }

    public function admin_index()
    {
        $tickets = Ticket::orderBy('id', 'DESC')->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function admin_show($id)
    {
        $main_ticket = Ticket::where('id', $id)->first();
        $sub_tickets = Ticket::where('parent_id', $main_ticket->id)->get();
        $is_it_main =  Ticket::where('id', $id)->first()->amount != null;
        return view('admin.ticket.show', compact('main_ticket', 'sub_tickets', 'is_it_main'));
    }
    public function users()
    {
        $users = User::orderBy('updated_at', 'DESC')->get();
        return view('admin.ticket.users', compact('users'));
    }
    public function update(Request $request)
    {
        $ticket = Ticket::where('id', $request->main_ticket_id);
        if ($request->filled('status')) {
            $ticket->update([
                'status' => $request->status
            ]);

            if ($request->status == 1) {

                Credit::create([
                    'user_id' => $ticket->first()->user_id,
                    'change' => $ticket->first()->amount,
                    'debt' => $ticket->first()->amount,
                    'describe' => 'تایید تیکت درخواست',
                ]);
            }
        }

        return redirect()->back()->with('msg', 'تغییرات انجام شد');
    }
}
