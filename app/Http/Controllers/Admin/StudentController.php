<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\Admin\StudentImport;
use Yajra\Datatables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

use App\Models\Rombel;
use App\Models\Student;
use App\Models\Rayon;
use App\Models\User;

class StudentController extends Controller
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
        return view('admin.student.index');
    }

    public function datatables(): Object
    {
        $students = Student::select(['id', 'user_id', 'nis', 'name', 'agama', 'gender', 'photo'])
            ->with('akun')->latest()->get();

        $datatables = DataTables::of($students)
            ->addIndexColumn()
            ->editColumn('email', function ($student) {
                return $student->akun->email;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Rayon $rayon, Rombel $rombel)
    {
        $rayons = $rayon->all();
        $rombels = $rombel->all();
        return view('admin.student.create', compact('rayons', 'rombels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function cekNis(Request $request)
    {
        $cek = Student::select(['id', 'nis'])->where('nis', $request->nis)->count();

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
            'nis' => 'required|string|min:8|max:8|unique:students',
            'rayon_id' => 'required',
            'rombel_id' => 'required',
            'kelas' => 'required|in:10,11,12',
            'agama' => 'required|in:Islam,Kristen,Budha,Hindu',
            'gender' => 'required|in:L,P',
            'photo' => 'image'
        ]);

        $data_student = collect($request->except(['photo', 'email', 'password', '_token', 'password_confirmation']));
        $data_user = collect($request->except(['name', 'nis', 'rayon_id', 'rombel_id', 'kelas', 'agama', 'gender', 'photo', 'password_confirmation', '_token']));

        // try {
        if ($request->hasFile('photo')) {
            $file = $request->photo;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $fileName . '_' . time() . '.' . $file->extension();

            $file->storeAs('public/photos/student', $fileName);

            $photo = $fileName;

            $data_student = $data_student->merge([
                'photo' => $photo
            ]);
        }

        $user = User::create($data_user->all());
        $user->assignRole('student');

        $data_student = $data_student->merge([
            'user_id' => $user->id
        ]);
        $student = Student::create($data_student->all());

        $user->update(['pemilik_id' => $student->id]);
        return redirect()->route('admin.student.index')->with('success', 'Berhasil menambah siswa');
    }

    public function import(): RedirectResponse
    {
        $this->validate(request(), [
            'excel_file' => 'required|max:10240|mimes:xlsx,xls', // max size=10mb, format .xlsx & .xls
        ]);

        try {
            Excel::import(new StudentImport, request()->file('excel_file'));
        } catch (\Exception $ex) {
            return back()->with(['error' => "Something went wrong. Check your file"]);
        } catch (\Error $er) {
            return back()->with(['error' => "Something went wrong. Check your file"]);
        }
        return back()->with(['success' => "Berhasil diimport, segera update data siswa!"]);
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
    public function edit(Student $student, Rayon $rayon, Rombel $rombel)
    {
        $rayons = $rayon->all();
        $rombels = $rombel->all();
        return view('admin.student.edit', compact('student', 'rayons', 'rombels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'rayon_id' => 'required',
            'rombel_id' => 'required',
            'kelas' => 'required|in:10,11,12',
            'agama' => 'required|in:Islam,Kristen,Budha,Hindu',
            'gender' => 'required|in:L,P',
            'photo' => 'image'
        ]);

        try {
            if (request()->delete_photo) {
                File::delete(storage_path("app/public/photos/student/" . $student->photo));
            }
            $data = collect($request->except('photo', 'delete_photo'));
            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $fileName . '_' . time() . '.' . $file->extension();

                $file->storeAs('public/photos/student', $fileName);

                File::delete(storage_path("app/public/photos/student/" . $student->photo));

                $photo = $fileName;

                $data = $data->merge([
                    'photo' => $photo
                ]);
            }

            $student->update($data->all());
        } catch (\Exception $e) {
            return back()->with("error", "Something went wrong");
        }

        return redirect()->route('admin.student.index')->with('success', 'Berhasil mengedit siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student): JsonResponse
    {
        try {
            User::where('pemilik_id', $student->id)->delete();
            $student->delete();
        } catch (\Exception $e) {
            return response()->json(['error' => "Something went wront"]);
        }

        return response()->json(['success' => "Berhasil dihapus"]);
    }
}
