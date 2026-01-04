<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{


    public function index()
    {
        $slots = Slot::where('is_active', true)
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('users.slots.create', compact('slots'));
    }


       public function create()
    {
        return view('admin.slots.create');
    }

    public function store(Request $request)
    {

        $overlapExists = Slot::where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>', $request->start_time);
            })
            ->exists();

        if ($overlapExists) {
            return back()->withErrors('This slot overlaps with an existing slot.');
        }

        $request->validate([

            'date'       => 'required|date',
            'start_time' => 'required',
            'end_time'   => 'required|after:start_time',

        
        ]);

        $start = strtotime($request->start_time);
        $end   = strtotime($request->end_time);


        $totalMinutes = ($end - $start) / 60;      


        if ($totalMinutes < 60) {
            return back()->withErrors('Slot must be at least 1 hour long');
        }

        
        Slot::create([
            'date'           => $request->date,
            'start_time'     => $request->start_time,
            'end_time'       => $request->end_time,
            'total_minutes'  => $totalMinutes,
        ]);

        
        return redirect()->back()->with('success', 'Slot created successfully');
    }
    
}
