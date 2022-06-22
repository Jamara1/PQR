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
     * Display a listing of the user.
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
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $pqrTypes = PQRType::all();
        return view('pqr.create', compact('pqrTypes'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  App\Http\Requests\PQRRequest  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(PQRRequest $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(PQR $pqr): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('pqr.show', compact('pqr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PQR  $pqr
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(PQR $pqr): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
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
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(PQRRequest $request, PQR $pqr): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $this->pqrServiceImpl->update($request, $pqr);
        return redirect()->route('pqr.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PQR  $pqr
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(PQR $pqr): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $this->pqrServiceImpl->destroy($pqr);
        return redirect()->route('pqr.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PQRRequest  $request
     * @param  PQR  $pqr
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function indexPqrForUser(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $headers = $this->pqrServiceImpl->findPqrForUserIndex()[0];
        $data = $this->pqrServiceImpl->findPqrForUserIndex()[1];
        return view('pqr.index', compact('headers', 'data'));
    }

    /**
     * Update status of the specified pqr in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PQR  $pqr
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function changeStatus(PQR $pqr): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $this->pqrServiceImpl->updateStatus($pqr);
        return redirect()->route('pqr.index');
    }

    /**
     * Export pqrs in storage.
     *
     * \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new PQRExport, 'pqrs.xlsx');
    }
}
