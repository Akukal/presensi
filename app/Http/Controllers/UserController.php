<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use DataTables;
use Spatie\Permission\Models\Role;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user|create user|edit user|delete user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('website.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('role'));

        toastr('User Created Successfully', 'success', 'User');

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->first();

        return view('website.user.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $input = $request->all();
        $input['password'] = $request->password ? bcrypt($request->password) : $user->password;

        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();

        $user->assignRole($request->input('role'));

        toastr('User Updated Successfully', 'success', 'User', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        toastr('User Deleted Successfully', 'success', 'User', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('users.index');
    }

    public function datatable()
    {
        $users = User::orderBy('created_at', 'DESC');

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('role', function($users) {
                return $users->roles->pluck('name')->first();
            })
            ->addColumn('action', function($users){
                $action = null;

                if(auth()->user()->hasPermissionTo('edit user')) {
                    $action .= '<a href="'.route('users.edit', $users->id).'" class="btn btn-warning btn-sm m-1"><i class="fas fa-edit"></i> </a>';
                }

                if(auth()->user()->hasPermissionTo('delete user')) {
                    $action .= '<button onclick="deleteConfirm(\''.$users->id.'\')" class="btn btn-danger btn-sm m-1"><i class="fa fa-trash"></i></button>
                    <form method="POST" action="'.route('users.destroy', $users->id).'" style="display:inline-block;" id="submit_'.$users->id.'">
                        '.method_field('delete').csrf_field().'
                    </form>';
                }

                return empty($action) ? '-' : $action;
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
    }
}
