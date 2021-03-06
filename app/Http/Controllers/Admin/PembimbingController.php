<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Imports\Admin\PembimbingImport;
use Yajra\Datatables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

use App\Models\Pembimbing;
use App\Models\Rayon;
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

    public function create()
    {
        return view('admin.pembimbing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Pembimbing\CreatePembimbingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function cekNip(Request $request)
    {
        $cek = Pembimbing::select(['id', 'nip'])->where('nip', $request->nip)->count();

        $response = '<span class="text-success">Available.</span>';

        if ($cek > 0) {
            $response = '<span class="text-danger">Not Available.</span>';
            return response()->json(['invalid' => $response]);
        }

        return response()->json(['valid' => $response]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nip' => 'required|string|min:12|max:18|unique:pembimbings',
            'agama' => 'required|in:Islam,Kristen,Budha,Hindu',
            'gender' => 'required|in:L,P',
            'photo' => 'image'
        ]);

        $data_pembimbing = collect($request->except(['photo', 'email', 'password', '_token', 'password_confirmation']));
        $data_user = collect($request->except(['name', 'nip', 'agama', 'gender', 'photo', 'password_confirmation', '_token']));

        // try {
        if ($request->hasFile('photo')) {
            $file = $request->photo;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $fileName . '_' . time() . '.' . $file->extension();

            $file->storeAs('public/photos/pembimbing', $fileName);

            $photo = $fileName;

            $data_pembimbing = $data_pembimbing->merge([
                'photo' => $photo
            ]);
        }

        $user = User::create($data_user->all());
        $user->assignRole('pembimbing');

        $data_pembimbing = $data_pembimbing->merge([
            'user_id' => $user->id
        ]);
        $pembimbing = Pembimbing::create($data_pembimbing->all());

        $user->update(['pemilik_id' => $pembimbing->id]);
        // } catch (\Exception $ex) {
        //     return back()->with('error', 'Something Wrong, please reinput form');
        // }

        return redirect()->route('admin.pembimbing.index')->with('success', 'Berhasil menambah Pembimbing');
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
        $pembimbing2 = Rayon::select(['id', 'pembimbing_id', 'name'])
            ->with('pembimbing')->where('pembimbing_id', $pembimbing->id)->get();
        $rayon = [];
        foreach ($pembimbing2 as $key => $value) {
            $rayon[$key] = $value->name;
        }
        // dd($rayon);
        return view('admin.pembimbing.edit', compact('pembimbing', 'rayon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Pembimbing\UpdatePembimbingRequest  $request
     * @param  \App\Models\Pembimbing  $pembimbing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembimbing $pembimbing)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'agama' => 'required|in:Islam,Kristen,Budha,Hindu',
            'gender' => 'required|in:L,P',
            'photo' => 'image'
        ]);

        try {
            if (request()->delete_photo) {
                File::delete(storage_path("app/public/photos/pembimbing/" . $pembimbing->photo));
            }
            $data = collect($request->except('photo', 'delete_photo'));
            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $fileName . '_' . time() . '.' . $file->extension();

                $file->storeAs('public/photos/pembimbing', $fileName);

                File::delete(storage_path("app/public/photos/pembimbing/" . $pembimbing->photo));

                $photo = $fileName;

                $data = $data->merge([
                    'photo' => $photo
                ]);
            }

            $pembimbing->update($data->all());
        } catch (\Exception $e) {
            return back()->with("error", "Something went wrong");
        }

        return redirect()->route('admin.pembimbing.index')->with('success', 'Berhasil mengedit pembimbing');
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
