<h2>Create Slot</h2>

<form method="POST" action="/admin/slots">
    @csrf

    <label>Date:</label>
    <input type="date" name="date" required>

    <br><br>

    <label>Start Time:</label>
    <input type="time" name="start_time" required>

    <br><br>

    <label>End Time:</label>
    <input type="time" name="end_time" required>

    <br><br>

    <button type="submit">Create Slot</button>
</form>
