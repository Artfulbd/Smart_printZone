<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class ManageAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Admin Dash Board
    public function index()
    {
        $admin = DB::table('users as u')
            ->join('admin as a', 'u.id', '=', 'a.id')
            ->where('u.admin' ,'=','1')
            ->get();



        if($admin->isEmpty())
        {
            $data = array(
                'found' => false,
            );
        }else{
            $data = array(
                'found' => true,
                'data' => $admin
            );
        }

        return view('admin.manage_admin')->with('data',$data);
    }


    public function create_admin(Request $request)
    {
        $request->validate([
            'c_user_id' => 'required|max:255|unique:users,id',
            'c_name' => 'required|string|max:255',
            'c_email' => 'required|string|email|max:255|unique:users,email',
            'c_password' => 'required|min:4',
            'c_role' => 'required',
            'c_status' => 'required'
        ]);


        $user_id = $request->input('c_user_id');
        $name = $request->input('c_name');
        $email = $request->input('c_email');
        $password = $request->input('c_password');
        $role = $request->input('c_role');
        $status = $request->input('c_status');


        // Inserting Data in Users Table
        $user = new User();
        $user->id = $user_id;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = $role;
        $user->admin = 1;
        $user->created_at = now();
        $user->save();


        // Insertin Data into Admin Table
        $admin = new Admin();
        $admin->id = $user_id;
        $admin->status = $status;
        $admin->role = $role;
        $admin->created_at = now();
        $admin->save();

        return redirect('/view_manage_admin')->with('success','New Admin Created Successfully');
    }


    public function edit_admin(Request $request)
    {

        /*$request->validate([
            'user_id' => 'required|max:255|unique:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role' => 'required',
            'status' => 'required'
        ]);*/


        $user_id = $request->input('user_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');
        $status = $request->input('status');


        // Inserting Data in Users Table
        $user = User::find($user_id);
        $user->id = $user_id;
        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        $user->admin = 1;
        $user->updated_at = now();
        $user->save();


        // Insertin Data into Admin Table
        $admin = Admin::find($user_id);
        $admin->id = $user_id;
        $admin->status = $status;
        $admin->role = $role;
        $admin->updated_at = now();
        $admin->save();

        return redirect('/view_manage_admin')->with('success','Admin ID no : '.$user_id.' Updated Successfully');
    }


    public function delete_admin(Request $request)
    {
        $user_id = $request->input('user_id');


        $response_1 = User::where('id',$user_id)->delete();
        $response_2 = Admin::where('id',$user_id)->delete();


        return redirect('/view_manage_admin')->with('success','Admin ID no : '.$user_id.' deleted Successfully');

    }
}
