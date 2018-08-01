<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Order;
use App\Models\FutureOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        ]);

        $this->createNewOrder($user->id);
        $this->createFutureOrder($user->id);

        // Fetch the latest shopping cart 
        $order = Order::where('user_id', '=', $user->id)
            ->where('payed_order', '=', 0)->get()->first();
        Session::put('orderId', $order->id);

        // Fetch user's wish list
        $futureOrder = FutureOrder::where('user_id', '=', $user->id)->first();
        Session::put('futureOrderId', $futureOrder->id);

        return $user;
    }

    private function createNewOrder($userId) {
        $order = new Order;
        $order->user_id = $userId;
        $order->save();
    }

    private function createFutureOrder($userId) {
        $futureOrder = new FutureOrder;
        $futureOrder->user_id = $userId;
        $futureOrder->save();
    }
}
