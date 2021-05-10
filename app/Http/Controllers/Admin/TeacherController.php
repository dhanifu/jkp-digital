<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Imports\Admin\TeacherImport;
use Yajra\Datatables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

use App\Models\Teacher;
use App\Models\Rayon;
use App\Models\User;

class TeacherController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
        $this->model = new Teacher;
    }

    public function index(): View
    {
        return view('admin.teacher.index');
    }

    public function datatables(): Object
    {
        $teachers = $this->model->select(['id', 'user_id', 'nip', 'name', 'agama', 'gender', 'photo'])
            ->with('akun.roles')->latest()->get();

        $datatables = DataTables::of($teachers)
            ->addIndexColumn()
            ->editColumn('email', function ($teacher) {
                return $teacher->akun->email;
            })->editColumn('role', function ($teacher) {
                return $teacher->akun->roles[0]->name;
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
        return view('admin.teacher.create');
    }

    public function cekNip(Request $request)
    {
        $cek = $this->model->select(['id', 'nip'])->where('nip', $request->nip)->count();

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
            'nip' => 'required|string|min:12|max:18|unique:teachers',
            'agama' => 'required|in:Islam,Kristen,Budha,Hindu',
            'gender' => 'required|in:L,P',
            'photo' => 'image',
            'role' => 'required|string'
        ]);

        $data_teacher = collect($request->except(['photo', 'email', 'password', '_token', 'password_confirmation']));
        $data_user = collect($request->except(['name', 'nip', 'agama', 'gender', 'photo', 'password_confirmation', '_token']));

        // try {
        if ($request->hasFile('photo')) {
            $file = $request->photo;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $fileName . '_' . time() . '.' . $file->extension();

            $file->storeAs('public/photos/teacher', $fileName);

            $photo = $fileName;

            $data_teacher = $data_teacher->merge([
                'photo' => $photo
            ]);
        }

        $user = User::create($data_user->all());
        $user->assignRole($data_teacher['role']);

        $data_teacher = $data_teacher->merge([
            'user_id' => $user->id
        ]);

        $teacher = $this->model->create($data_teacher->all());

        $user->update(['pemilik_id' => $teacher->id]);
        // } catch (\Exception $ex) {
        //     return back()->with('error', 'Something Wrong, please reinput form');
        // }

        return redirect()->route('admin.teacher.index')->with('success', 'Berhasil menambah Guru');
    }

    // Import From Excel
    public function import(): RedirectResponse
    {
        $this->validate(request(), [
            'excel_file' => 'required|max:10240|mimes:xlsx,xls', // max size=10mb, format .xlsx & .xls
            'role' => 'required'
        ]);

        try {
            $role = request()->role;
            Excel::import(new TeacherImport($role), request()->file('excel_file'));
        } catch (\Exception $ex) {
            return back()->with(['error' => "Something went wrong. Check your file"]);
        } catch (\Error $er) {
            return back()->with(['error' => "Something went wrong. Check your file"]);
        }

        return back()->with(['success' => "Berhasil diimport"]);
    }

    public function show(Teacher $teacher)
    {
        //
    }

    public function edit(Teacher $teacher)
    {
        $teacher2 = Rayon::select(['id', 'teacher_id', 'name'])
            ->with('teacher')->where('teacher_id', $teacher->id)->get();
        $rayon = [];
        foreach ($teacher2 as $key => $value) {
            $rayon[$key] = $value->name;
        }
        // dd($rayon);
        return view('admin.teacher.edit', compact('teacher', 'rayon'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'agama' => 'required|in:Islam,Kristen,Budha,Hindu',
            'gender' => 'required|in:L,P',
            'photo' => 'image',
            'role' => 'required'
        ]);

        try {
            if (request()->delete_photo) {
                File::delete(storage_path("app/public/photos/teacher/" . $teacher->photo));
            }

            $data = collect($request->except('role', 'photo', 'delete_photo'));

            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $fileName . '_' . time() . '.' . $file->extension();

                $file->storeAs('public/photos/teacher', $fileName);

                File::delete(storage_path("app/public/photos/teacher/" . $teacher->photo));

                $photo = $fileName;

                $data = $data->merge([
                    'photo' => $photo
                ]);
            }

            $teacher->update($data->all());
            $user = User::where('pemilik_id', $teacher->id)->first();
            $user->syncRoles($request->role);
        } catch (\Exception $e) {
            return back()->with("error", "Something went wrong");
        }

        return redirect()->route('admin.teacher.index')->with('success', 'Berhasil mengedit guru');
    }

    public function destroy(Teacher $teacher): JsonResponse
    {
        try {
            User::where('pemilik_id', $teacher->id)->delete();
            $teacher->delete();
        } catch (\Exception $e) {
            return response()->json(['error' => "Something went wront"]);
        }

        return response()->json(['success' => "Berhasil dihapus"]);
    }
}
