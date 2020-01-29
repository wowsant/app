<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionsDataAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{

    public function __construct(User $user) {
        $this->objectDb = $user;
    }

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
        if ($this->requestDataValidation($request, $this->objectDb->rulesStore)) {
            return ExceptionsDataAPI::error( 406, $this->requestDataValidation($request, $rules));
        }

        $dataRequest = $request->all();
        $dataRequest['password'] = Hash::make($request->get('password'));

        try {
            $dataReturn = $this->objectDb->create($dataRequest);
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
        return ExceptionsDataAPI::success(200, $this->objectDb->find(auth()->user()->id()));
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
    public function update(Request $request)
    {
        if ($this->requestDataValidation($request, $this->objectDb->rulesUpdate)) {
            return ExceptionsDataAPI::error(406, $this->requestDataValidation($request, $rules));
        }

        $this->objectDb = $this->objectDb->find(auth()->user()->id);

        if (isset($request->name)) {
            $this->objectDb->name = $request->name;
        }
        if (isset($request->password)) {
            $this->objectDb->password = Hash::make($request->password);
        }
        if (isset($request->email)) {
            $this->objectDb->email = $request->email;
        }

        try {

            $this->objectDb->save();
            return ExceptionsDataAPI::success(
                200, $this->objectDb
            );
        } catch (Exception $ex) {

            return ExceptionsDataAPI::error(
                401, $ex->getMessage()
            );
        }
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
