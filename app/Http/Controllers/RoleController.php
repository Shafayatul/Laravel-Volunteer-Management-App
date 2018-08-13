<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Http\Request;
use \DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('role.create');
    }


    /**
     * Assign role to user
     *
     * @return \Illuminate\View\View
     */
    public function assign()
    {
        $roles = Role::all();
        return view('role.assign', compact('roles'));
    }    

    
    public function datatable_user_role()
    {
        $users = User::
                select(
                    'users.id as id', 
                    'users.name as name', 
                    'users.email as email'
                );
        return Datatables::of($users)
            ->addColumn('action', function($row){
                return '
                <button type="button" class="btn bg-blue-grey waves-effect addign-specialist" data-toggle=" model" title="Change Assigned Specialist" data-target="#assign-user-model" id="'.$row->id.'">
                    <i class="material-icons">merge_type</i>
                </button>';
            })
            ->addColumn('role', function($row){
                $user = User::where('id', $row->id)->first();
                return '<span id="role_'.$row->id.'">'.$user->getRoleNames().'</span>';
            })
            ->rawColumns(['action', 'role'])
            ->make(true);
    }

    /**
     * Assign role to user - ajax
     */
    public function assignRole(Request $request)
    {
        $role = $request->input('role');
        $user_id = $request->input('user_id');

        $user = user::find($user_id);
        $user->syncRoles($role);

        return response()->json(array('msg'=> 'Success'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Role::create($requestData);

        return redirect('admin/role')->with('flash_message', 'Role added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $role = Role::findOrFail($id);
        $role->update($requestData);

        return redirect('admin/role')->with('flash_message', 'Role updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Role::destroy($id);

        return redirect('admin/role')->with('flash_message', 'Role deleted!');
    }
}
