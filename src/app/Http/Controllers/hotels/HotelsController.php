<?php

namespace App\Http\Controllers\hotels;

use App\Http\Controllers\Controller;
use App\Models\Hotels as Hotel;
use Illuminate\Http\Request;


class HotelsController extends Controller
{

    // index
    public function index()
    {
        // get all hotels
        $hotels = Hotel::all();

        return view('hotels.index', compact('hotels'));
    }

    // create
    public function create()
    {
        return view('hotels.create');
    }


    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required',
            'address_Country' => 'required',
            'address_City' => 'required',
            'address_PostalCode' => 'required|numeric',
            'address_Street' => 'required',
            'contact_Phone' => 'required|numeric',
            'contact_Email' => 'required|email',
        ]);

        // store
        $hotel = new Hotel();
        $hotel->name = $request->name;
        $hotel->address_Country = $request->address_Country;
        $hotel->address_City = $request->address_City;
        $hotel->address_PostalCode = $request->address_PostalCode;
        $hotel->address_Street = $request->address_Street;
        $hotel->contact_Phone = $request->contact_Phone;
        $hotel->contact_Email = $request->contact_Email;
        $hotel->save();

        // redirect with status success message
        return redirect()->route('hotels.index')->with('success', 'Hotel created successfully.');
    }

    // show
    public function show($id)
    {
        // get hotel
        $hotel = Hotel::find($id);
        return view('hotels.show', compact('hotel'));
    }

    public function edit($id)
    {
        // get hotel
        $hotel = Hotel::find($id);
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request, $id)
    {
        // validate
        $request->validate([
            'name' => 'required',
            'address_Country' => 'required',
            'address_City' => 'required',
            'address_PostalCode' => 'required|numeric',
            'address_Street' => 'required',
            'contact_Phone' => 'required|numeric',
            'contact_Email' => 'required|email',
        ]);

        // compare  and show the difference
        $hotel = Hotel::find($id);
        $hotel->name = $request->name;
        $hotel->address_Country = $request->address_Country;
        $hotel->address_City = $request->address_City;
        $hotel->address_PostalCode = $request->address_PostalCode;
        $hotel->address_Street = $request->address_Street;
        $hotel->contact_Phone = $request->contact_Phone;
        $hotel->contact_Email = $request->contact_Email;
        $hotel->save();

        $changes = $hotel->getChanges();
        unset($changes['updated_at']);
        unset($changes['created_at']);
        $changes = implode(', ', array_map(
            function ($v, $k) {
                return sprintf("%s='%s'", $k, $v);
            },
            $changes,
            array_keys($changes)
        ));

        $hotels = Hotel::all();

        // redirect with status success message and changes made and show all hotels 
        return redirect()->route('hotels.index', compact('hotel'))->with('success', 'Hotel updated successfully. Changes made: ' . $changes);
    }

    public function destroy($id)
    {
        // get hotel
        $hotel = Hotel::find($id);
        $hotel->delete();

        $hotels = Hotel::all();

        // redirect with status success message
        return redirect()->route('hotels.index', compact('hotel'))->with('success', 'Hotel deleted successfully');
    }
}
