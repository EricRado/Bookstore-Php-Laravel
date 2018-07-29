<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'street_address' => 'required|string',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:2',
            'zip_code' => 'required|string|max:5',
        ]);

        // Create Address object
        $address = new Address;
        $address->user_id = auth()->user()->id;
        $address->street_address = $request->input('street_address');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->zip_code = $request->input('zip_code');

        $address->save();

        return redirect('/addresses/' . auth()->user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $addresses = Address::where('user_id', '=', $id)->get();
        return view('address.show')->with('addresses', $addresses);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = Address::find($id);

        // check if user is authorized to edit credit card
        if(auth()->user()->id !== $address->user_id) {
            return redirect('/')->with('error', 'Unauthrized Page');
        }

        return view('address.edit')->with('address', $address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'street_address' => 'required|string',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:2',
            'zip_code' => 'required|string|max:5',
        ]);

        $address = Address::find($id);

        // Update Address object's values
        $address->street_address = $request->input('street_address');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->zip_code = $request->input('zip_code');
        $address->save();

        return redirect('/addresses/' . auth()->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);

        // Check for correct user
        if(auth()->user()->id !== $address->user_id) {
            return redirect('/addresses/' . $address->user_id)->with('error','Unauthorized Page');
        }

        $address->delete();

        return redirect('/addresses/' . $address->user_id);
    }
}
