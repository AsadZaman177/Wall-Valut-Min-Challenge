<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::where('crp_id', auth()->user()->crp_id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        if($request->ajax()){

            try {
                return DataTables::of($users)
                    ->addColumn('action', function ($user) {
                        $html = '<div class="text-center d-flex justify-content-center gap-2">';

                        $html .= '<a class="mr-2 btn btn-info btn-sm editUser"  data-id="'. $user->id .'"><i class="fa fa-edit"></i> Edit</a>';


                        $html .= '<a class="btn btn-danger btn-sm deleteUser" href="#" data-id="'. $user->id .'"><i class="fa fa-trash"></i> Delete</a>';
                        $html .= '</div>';

                        return $html;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Throwable $th) {
               dd($th->getMessage());
            }

        }
        return view('users.index');
    }

    // store
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required',
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->crp_id = auth()->user()->crp_id;
            $user->save();

            return response()->json(['success' => 'User created successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error creating user.'], 500);
        }
    }

    // edit
    public function edit($id){
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    //update
    public function update(Request $request){
        $request->validate([
            'edit_name' => 'required|string|max:255',
            'edit_email' => 'required|email|max:255|unique:users,email,' . $request->user_id,
        ],[
            'edit_name.required' => 'Name is required',
            'edit_email.required' => 'Email is required',
            'edit_email.unique' => 'Email already taken',
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $user->name = $request->edit_name;
            $user->email = $request->edit_email;

            if ($request->password) {
                $user->password = Hash::make($request->edit_password);
            }
            $user->save();

            return 'success';
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error updating user.'], 500);
        }
    }

    // delete
    public function delete($id){

        try {
            $user = User::find($id);
            if(auth()->user()->id == $id){
                return response()->json(['error' => 'Own user can not be deleted.'], 500);
            }
            $user->delete();

            return response()->json(['success' => 'User deleted successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error deleting user.'], 500);
        }
    }

}
