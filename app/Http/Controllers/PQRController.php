<?php

namespace App\Http\Controllers;

use App\DTOs\PQRDTO;
use App\Http\Requests\PQRRequest;
use App\Models\PQR;
use App\Models\PQRType;

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
        $pqrs = PQR::all();
        $pqrDTO = new PQRDTO($pqrs);
        $headers = [
            __('#'),
            __('User'),
            __('PQR type'),
            __('Status'),
            __('Created at'),
            __('Deadline date'),
            __('Options'),
        ];
        $data = $pqrDTO->pqrIndexMap();

        return view('pqr.index', compact('headers', 'data'));
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
     * @param  App\Http\Requests\PQRRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PQRRequest $request)
    {

        $date = date("Y-m-d H:i:s");
        $mod_date = null;

        $request['user_id'] = auth()->id();
        $request['status'] = 1;

        if ($request['pqr_type_id'] == 1) {
            //Increasing 7 days
            $mod_date = strtotime($date . "+ 7 days");
        }

        if ($request['pqr_type_id'] == 2) {
            //Increasing 3 days
            $mod_date = strtotime($date . "+ 3 days");
        }

        if ($request['pqr_type_id'] == 3) {
            //Increasing 2 days
            $mod_date = strtotime($date . "+ 2 days");
        }

        $request['deadline_date'] = date("Y-m-d H:i:s", $mod_date);

        PQR::create($request->except('_token'));

        return redirect()->route('pqr.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  PQR  $pqr
     * @return \Illuminate\Http\Response
     */
    public function show(PQR $pqr)
    {
        return view('pqr.show', compact('pqr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PQR  $pqr
     * @return \Illuminate\Http\Response
     */
    public function edit(PQR $pqr)
    {
        $pqrTypes = PQRType::all();
        return view('pqr.edit', compact('pqr', 'pqrTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PQRRequest  $request
     * @param  PQR  $pqr
     * @return \Illuminate\Http\Response
     */
    public function update(PQRRequest $request, PQR $pqr)
    {
        $date = date("Y-m-d H:i:s");
        $mod_date = null;

        if ($request['pqr_type_id'] == 1) {
            //Increasing 7 days
            $mod_date = strtotime($date . "+ 7 days");
        }

        if ($request['pqr_type_id'] == 2) {
            //Increasing 3 days
            $mod_date = strtotime($date . "+ 3 days");
        }

        if ($request['pqr_type_id'] == 3) {
            //Increasing 2 days
            $mod_date = strtotime($date . "+ 2 days");
        }

        $request['deadline_date'] = date("Y-m-d H:i:s", $mod_date);

        $pqr->update($request->except('_token'));

        return redirect()->route('pqr.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PQR  $pqr
     * @return \Illuminate\Http\Response
     */
    public function destroy(PQR $pqr)
    {
        $pqr->delete();
        return redirect()->route('pqr.index');
    }

    /**
     * Update status of the specified pqr in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PQR  $pqr
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(PQR $pqr)
    {
        if ($pqr->status == 1) {
            $pqr->update(['status' => 2]);
        } else if ($pqr->status == 2) {
            $pqr->update(['status' => 3]);
        }

        return redirect()->route('pqr.index');
    }
}
