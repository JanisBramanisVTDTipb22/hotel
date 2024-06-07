<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation; // Assuming you have a Reservation model
class ReservationController extends Controller
{
    // Display a form to create a new reservation
    public function create()
    {
        return view('reservations.create');
    }

    // Store a newly created reservation in the database
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            // Add more validation rules as needed
        ]);

        // Create the reservation
        Reservation::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            // Add more fields as needed
        ]);

        // Redirect the user after storing the reservation
        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully!');
    }

    // Display the specified reservation
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }

    // Display a form to edit an existing reservation
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    // Update the specified reservation in the database
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            // Add more validation rules as needed
        ]);

        // Find the reservation and update it
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            // Add more fields as needed
        ]);

        // Redirect the user after updating the reservation
        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully!');
    }

    // Remove the specified reservation from the database
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        // Redirect the user after deleting the reservation
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully!');
    }

    // Show a list of all reservations
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations', compact('reservations'));
    }
}

