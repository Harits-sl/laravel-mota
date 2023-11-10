<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class ApiCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function register(Request $request)
    {
        $customer = Customer::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password
        ]);

        $data = [
            'id' => $customer->id,
            'email' => $customer->email,
            'username' => $customer->username
        ];


        return new CustomerResource(201, true, 'Success Add Customer', $data);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $customer = Customer::where('email', $email)
            ->first();

        if ($customer->password == $password) {
            $data = [
                'id' => $customer->id,
                'email' => $customer->email,
                'username' => $customer->username
            ];

            return new CustomerResource(200, true, 'Success Login', $data);
        } else {
            return new CustomerResource(401, false, 'Failed Login', []);
        }
    }
}
