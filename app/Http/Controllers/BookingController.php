<?php
    
    namespace App\Http\Controllers;


    use App\Models\Booking;
    use App\Models\Slot;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;


    class BookingController extends Controller
    {


        public function store(Request $request)
        {
            $request->validate([
                'slot_id' => 'required|exists:slots,id',
                'vehicle_type' => 'required|in:bike,car',
            ]);

            $duration = $request->vehicle_type === 'bike' ? 30 : 60;

            DB::transaction(function () use ($request, $duration) {

                $slot = Slot::where('id', $request->slot_id)
                    ->lockForUpdate()
                    ->first();

                if (!$slot->canBook($duration)) {
                    abort(400, 'Slot no longer available');
                }

                Booking::create([
                    'user_id' => auth()->id(), // temporary (auth later)
                    'slot_id' => $slot->id,
                    'vehicle_type' => $request->vehicle_type,
                    'duration' => $duration,
                    'status' => 'booked',
                ]);
            });

            return back()->with('success', 'Booking successful');
        }
    }
