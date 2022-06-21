<?php

namespace App\Http\Controllers;

use App\Exports\PQRExport;
use App\Http\Requests\PQRRequest;
use App\Models\PQR;
use App\Models\PQRType;
use App\ServicesImpl\PQRServiceImpl;
use Maatwebsite\Excel\Facades\Excel;

class PQRController extends Controller
{
    private $pqrServiceImpl;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:pqr.index|pqr.edit|pqr.delete', ['only' => ['index', 'export']]);
        $this->middleware('permission:pqr.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pqr.edit', ['only' => ['edit', 'update', 'changeStatus']]);
        $this->middleware('permission:pqr.delete', ['only' => ['destroy']]);
        $this->middleware('permission:pqr.index.user', ['only' => ['indexPqrForUser']]);

        $this->pqrServiceImpl = new PQRServiceImpl();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $headers = $this->pqrServiceImpl->findAllIndex()[0];
        $data = $this->pqrServiceImpl->findAllIndex()[1];

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
        $this->pqrServiceImpl->save($request);

        if (auth()->user()->roles[0]->name == 'admin') {
            return redirect()->route('pqr.index');
        } else {
            return redirect()->route('pqr.index.user', auth()->user()->email);
        }
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
        if ($pqr->status == 3) {
            return redirect()->route('pqr.index');
        }

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
        $this->pqrServiceImpl->update($request, $pqr);
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
        if ($pqr->status == 3) {
            return redirect()->route('pqr.index');
        }

        $pqr->delete();
        return redirect()->route('pqr.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PQRRequest  $request
     * @param  PQR  $pqr
     * @return \Illuminate\Http\Response
     */
    public function indexPqrForUser($email)
    {
        $headers = $this->pqrServiceImpl->findAllIndex()[0];
        $data = $this->pqrServiceImpl->findAllIndex()[1];
        return view('pqr.index', compact('headers', 'data'));
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
        $this->pqrServiceImpl->updateStatus($pqr);
        return redirect()->route('pqr.index');
    }

    /**
     * Export pqrs in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new PQRExport, 'pqrs.xlsx');
    }
}
