<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditCard;

class CreditCardController extends Controller
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
        return view('creditCards.create');
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
            'name_on_card' => 'required|string',
            'cc_number' => 'required|string|max:16',
            'security_code' => 'required|string|max:3',
            'expiration_date' => 'required|date',
            'provider' => 'required'
        ]);

        // Create Credit Card object
        $credit_card = new CreditCard;
        $credit_card->user_id = auth()->user()->id;
        $credit_card->name_on_card = $request->input('name_on_card');
        $credit_card->cc_number = $request->input('cc_number');
        $credit_card->security_code = $request->input('security_code');
        $credit_card->expiration_date = $request->input('expiration_date');
        $credit_card->provider = $request->input('provider');
        
        $credit_card->save();

        return redirect('/creditCards/' . auth()->user()->id);
    }

    /**
     * Display the credit cards that belong to the user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $creditCards = CreditCard::where('user_id', '=', $id)->get();
        return view('creditCards.show')->with('creditCards', $creditCards);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $creditCard = CreditCard::find($id);

        // check if user is authorized to edit credit card
        if(auth()->user()->id !== $creditCard->user_id) {
            return redirect('/')->with('error', 'Unauthrized Page');
        }
        
        return view('creditCards.edit')->with('creditCard', $creditCard);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $credit_card = CreditCard::find($id);

        // Check for correct user
        if(auth()->user()->id !== $credit_card->user_id) {
            return redirect('/creditCards/' . $credit_card->user_id)->with('error','Unauthorized Page');
        }

        $credit_card->delete();

        return redirect('/creditCards/' . $credit_card->user_id);
    }
}
