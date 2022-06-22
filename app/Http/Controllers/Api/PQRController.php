<?php

namespace App\Http\Controllers\Api;

use App\Exports\PQRExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\PQRRequest;
use App\Models\PQR;
use App\ServicesImpl\PQRServiceImpl;
use App\ServicesImpl\ResponseServiceImpl;
use Maatwebsite\Excel\Facades\Excel;

class PQRController extends Controller
{
    private $pqrServiceImpl;
    private $responseServiceImpl;
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
        $this->responseServiceImpl = new ResponseServiceImpl();
    }

    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $pqrs = $this->pqrServiceImpl->findAll();
        return $this->responseServiceImpl->responseJson(200, $pqrs);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  App\Http\Requests\PQRRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PQRRequest $request): \Illuminate\Http\JsonResponse
    {
        $pqr = $this->pqrServiceImpl->save($request);
        return $this->responseServiceImpl->responseJson(200, $pqr);
    }

    /**
     * Display the specified resource.
     *
     * @param  PQR  $pqr
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(PQR $pqr): \Illuminate\Http\JsonResponse
    {
        return $this->responseServiceImpl->responseJson(200, $pqr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PQRRequest  $request
     * @param  PQR  $pqr
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PQRRequest $request, PQR $pqr): \Illuminate\Http\JsonResponse
    {
        $this->pqrServiceImpl->update($request, $pqr);
        return $this->responseServiceImpl->responseJson(200, $pqr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PQR  $pqr
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(PQR $pqr): \Illuminate\Http\JsonResponse
    {
        $data = $this->pqrServiceImpl->destroy($pqr);
        return $this->responseServiceImpl->responseJson($data[0], $data[1]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PQRRequest  $request
     * @param  PQR  $pqr
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexPqrForUser(): \Illuminate\Http\JsonResponse
    {
        $pqrs = $this->pqrServiceImpl->findForUser();
        return $this->responseServiceImpl->responseJson(200, $pqrs);
    }

    /**
     * Update status of the specified pqr in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PQR  $pqr
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(PQR $pqr): \Illuminate\Http\JsonResponse
    {
        $this->pqrServiceImpl->updateStatus($pqr);
        return $this->responseServiceImpl->responseJson(200, $pqr);
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
