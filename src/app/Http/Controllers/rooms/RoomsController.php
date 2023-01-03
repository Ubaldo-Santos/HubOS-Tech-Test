<?php

namespace App\Http\Controllers\rooms;

use App\Http\Controllers\Controller;
use App\Models\Hotels as Hotel;
use App\Models\Rooms as Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    // store
    public function store(Request $request, $hotel_id)
    {

        if (Auth::user()->role == '1') {

            // validate
            $request->validate([
                'name' => 'required',
                'floor' => 'required|numeric',
                'max_occupancy' => 'required|numeric',
            ]);

            // store
            $room = new Room();
            $room->name = $request->name;
            $room->floor = $request->floor;
            $room->max_occupancy = $request->max_occupancy;
            $room->hotel_id = $hotel_id;
            $room->save();

            // redirect with status success message
            return redirect()->route('hotels.show', $hotel_id)->with('success', 'Room created successfully.');
        } else {
            return redirect()->route('hotels.show', $hotel_id)->with('error', 'You are not authorized to create a room.');
        }
    }

    // show
    public function show($hotel_id, $room_id)
    {
        // get hotel
        $hotel = Hotel::find($hotel_id);

        // get room
        $room = Room::find($room_id);

        return view('rooms.show', compact('hotel', 'room'));
    }


    // update
    public function update(Request $request, $hotel_id, $room_id)
    {
        if (Auth::user()->role == '1') {

            // validate
            $request->validate([
                'name' => 'required',
                'floor' => 'required|numeric',
                'max_occupancy' => 'required|numeric',
            ]);

            // update
            $room = Room::find($room_id);
            $room->name = $request->name;
            $room->floor = $request->floor;
            $room->max_occupancy = $request->max_occupancy;
            $room->hotel_id = $hotel_id;
            $room->save();

            $changes = $room->getChanges();
            unset($changes['updated_at']);
            unset($changes['created_at']);
            $changes = implode(', ', array_map(
                function ($v, $k) {
                    return sprintf("%s='%s'", $k, $v);
                },
                $changes,
                array_keys($changes)
            ));

            // redirect with status success message
            return redirect()->route('hotels.show', $hotel_id)->with('success', 'Room updated successfully. Changes made: ' . $changes);
        } else {
            return redirect()->route('hotels.show', $hotel_id)->with('error', 'You are not authorized to update a room.');
        }
    }


    // destroy

    public function destroy($hotel_id, $room_id)
    {
        if (Auth::user()->role == '1') {

            // delete
            $room = Room::find($room_id);
            $room->delete();

            // redirect with status success message
            return redirect()->route('hotels.show', $hotel_id)->with('success', 'Room deleted successfully.');
        } else {
            return redirect()->route('hotels.show', $hotel_id)->with('error', 'You are not authorized to delete a room.');
        }
    }
}
