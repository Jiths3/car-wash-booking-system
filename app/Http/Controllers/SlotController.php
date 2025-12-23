<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{

       public function create()
    {
        return view('admin.slots.create');
    }

    public function store(Request $request)
    {

        
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
