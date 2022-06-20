<?php

namespace App\Http\Controllers;

use App\Http\Requests\PQRRequest;
use App\Models\PQR;
use App\Models\PQRType;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class PQRController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:pqr.index|pqr.create|pqr.edit|pqr.delete', ['only' => ['index']]);
        $this->middleware('permission:pqr.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pqr.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pqr.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pqr = PQR::all();
        return view('pqr.index', compact('pqr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pqrTypes = PQRType::all();
        return view('pqr.create', compact('pqrTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $date = date("Y-m-d H:i:s");
        $mod_date = null;

        //Increasing 2 days
        $request['user_id'] = auth()->id();

        if ($request['pqr_type_id'] == 1) {
            $mod_date = strtotime($date . "+ 7 days");
        }

        if ($request['pqr_type_id'] == 2) {
            $mod_date = strtotime($date . "+ 3 days");
        }

        if ($request['pqr_type_id'] == 3) {
            $mod_date = strtotime($date . "+ 2 days");
        }

        $request['deadline_date'] = date("Y-m-d H:i:s", $mod_date);

        PQR::create($request->except('_token'));

        return redirect()->route('pqr.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
