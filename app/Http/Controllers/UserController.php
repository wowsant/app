<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionsDataAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name'     => 'required|max:255',
            'email'    => 'required|unique:users|max:255|email',
            'password' => 'required|max:255'
        );

        if ($this->requestDataValidation($request, $rules)) {

            return ExceptionsDataAPI::error(
                406, $this->requestDataValidation($request, $rules)
            );
        }

        $dataRequest = $request->all();
        $dataRequest['password'] = Hash::make($request->get('password'));

        try {

            $dataReturn = User::create($dataRequest);

            return ExceptionsDataAPI::success(
                200, $dataReturn
            );
        } catch (\Exception $ex) {
            Log::info($ex);
            return ExceptionsDataAPI::error(
                500, $ex
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return ExceptionsDataAPI::success(200, User::find(auth()->user()->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        print_r($id); exit;
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
        //
    }
}
