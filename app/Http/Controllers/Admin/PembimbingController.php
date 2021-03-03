<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Pembimbing\CreatePembimbingRequest;
use App\Http\Requests\Admin\Pembimbing\UpdatePembimbingRequest;

use App\Imports\Admin\PembimbingImport;
use Yajra\Datatables\DataTables;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Pembimbing;
use App\Models\User;

class PembimbingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('admin.pembimbing.index');
    }

    /**
     * Get pembimbing data with DataTables
     * 
     * @return Object
     */
    public function datatables(): Object
    {
        $pembimbings = Pembimbing::select(['id', 'user_id', 'nip', 'name', 'agama', 'gender', 'photo'])
            ->with('akun')->latest()->get();

        $datatables = DataTables::of($pembimbings)
            ->addIndexColumn()
            ->editColumn('email', function ($pembimbing) {
                return $pembimbing->akun->email;
            })->addColumn('action', '
                <div class="btn-group" role="group" aria-label="Action">
                    <button class="btn btn-sm btn-success" data-action="edit">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" data-action="remove">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            ')->rawColumns(['email', 'action'])->make();

        return $datatables;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Pembimbing\CreatePembimbingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePembimbingRequest $request)
    {
        //
    }

    // Import From Excel
    public function import(): RedirectResponse
    {
        try {
            Excel::import(new PembimbingImport, request()->file('excel_file'));
        } catch (\Exception $ex) {
            return back()->with(['error' => "Something went wrong. Check your file"]);
        } catch (\Error $er) {
            return back()->with(['error' => "Something went wrong. Check your file"]);
        }

        return back()->with(['success' => "Berhasil diimport"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembimbing  $pembimbing
     * @return \Illuminate\Http\Response
     */
    public function show(Pembimbing $pembimbing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembimbing  $pembimbing
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembimbing $pembimbing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Pembimbing\UpdatePembimbingRequest  $request
     * @param  \App\Models\Pembimbing  $pembimbing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePembimbingRequest $request, Pembimbing $pembimbing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembimbing  $pembimbing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembimbing $pembimbing): JsonResponse
    {
        try {
            User::where('pemilik_id', $pembimbing->id)->delete();
            $pembimbing->delete();
        } catch (\Exception $e) {
            return response()->json(['error' => "Something went wront"]);
        }

        return response()->json(['success' => "Berhasil dihapus"]);
    }
}
