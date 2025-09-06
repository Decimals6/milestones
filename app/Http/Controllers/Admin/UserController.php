<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'name', 'email', 'address', 'phone', 'is_admin', 'created_at']);
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('role', function($row) {
                    return $row->is_admin ? 'Admin' : 'Customer';
                })
                ->addColumn('action', function($row){
                    return '
                        <button class="btn btn-sm btn-warning btn-edit" data-id="'.$row->id.'">Edit</button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="'.$row->id.'">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.laravel-examples.user-management');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'nullable',
            'phone' => 'nullable',
        ]);

        $data = $request->all();
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        User::updateOrCreate(['id' => $request->user_id], $data);

        return response()->json(['success' => 'User saved successfully.']);
    }

    public function edit($id)
    {
        return response()->json(User::find($id));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }
}
