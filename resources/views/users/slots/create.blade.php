<h2>Available Slots</h2>

@foreach ($slots as $slot)
    <div style="margin-bottom:20px; border-bottom:1px solid #ccc;">
        <strong>{{ $slot->date }}</strong><br>
        {{ $slot->start_time }} - {{ $slot->end_time }}<br>

        Remaining Minutes: {{ $slot->remainingMinutes() }}

        @if ($slot->remainingMinutes() >= 30)
            <form method="POST" action="/users/bookings">
                @csrf

                <input type="hidden" name="slot_id" value="{{ $slot->id }}">

                <label>Vehicle:</label>
                <select name="vehicle_type">
                    @if ($slot->remainingMinutes() >= 30)
                        <option value="bike">Bike (30 min)</option>
                    @endif

                    @if ($slot->remainingMinutes() >= 60)
                        <option value="car">Car (60 min)</option>
                    @endif
                </select>

                <button type="submit">Book</button>
            </form>
        @else
            <p>Fully booked</p>
        @endif
    </div>
@endforeach
