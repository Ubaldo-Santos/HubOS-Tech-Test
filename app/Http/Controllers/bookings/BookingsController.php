<?php

namespace App\Http\Controllers\bookings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rooms as Room;
use App\Models\Bookings as Booking;
use Database\Seeders\rooms;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{

    public function store(Request $request, $hotel_id, $room_id)
    {
        if (Auth::user()->role != '1') {
            return json_encode(['error' => 'You are not authorized to book a room.']);
        }

        // check occupancy in room
        $max_occupancy = Room::find($room_id)->max_occupancy;

        if ($request->guests > $max_occupancy) {
            return json_encode(['error' => 'The number of guests exceeds the maximum occupancy of the room.']);
        }

        if ($request->guests < 1) {
            return json_encode(['error' => 'The number of guests must be at least 1.']);
        }

        //check dates are valid
        if ($request->check_in > $request->check_out) {
            return json_encode(['error' => 'The number of guests exceeds the maximum occupancy of the room.']);
        }

        // check if room is available
        $bookings = Booking::where('room_id', $room_id)
            ->where('check_in', '<=', $request->check_in)
            ->where('check_out', '>=', $request->check_in)
            ->get();

        if (count($bookings) > 0) {
            return json_encode(['error' => 'The room is not available for the selected dates.']);
        }

        // store
        $booking = new Booking();
        $booking->check_in = $request->check_in;
        $booking->check_out = $request->check_out;
        $booking->guests = $request->guests;
        $booking->room_id = $room_id;
        $booking->user_id = Auth::user()->id;
        $booking->save();

        return json_encode(['success' => 'The room has been booked successfully.']);
    }

    public function destroy($hotel_id, $room_id, $booking_id)
    {
        // delete if user is admin or the user who created the booking
        if (Auth::user()->role != '1') {
            $booking = Booking::find($booking_id);
            $booking->delete();
            return redirect()->route('rooms.show', [$hotel_id, $room_id])->with('success', 'The booking has been deleted successfully.');
        } else if (Auth::user()->id == Booking::find($booking_id)->user_id) {
            $booking = Booking::find($booking_id);
            $booking->delete();

            return redirect()->route('rooms.show', [$hotel_id, $room_id])->with('success', 'The booking has been deleted successfully.');
        } else {
            return redirect()->route('rooms.show', [$hotel_id, $room_id])->with('error', 'You are not authorized to delete this booking.');
        }
    }

    public function list($hotel_id, $room_id)
    {

        // Select all bookings for the room
        // join with users table to get user name
        // and get the id, check_in, check_out, guests, name of the user

        $bookings = Booking::where('room_id', $room_id)->join('users', 'bookings.user_id', '=', 'users.id')->select('bookings.id', 'bookings.check_in', 'bookings.check_out', 'bookings.guests', 'users.name', 'users.id as uid')->get();


        return json_encode($bookings);
    }
}
