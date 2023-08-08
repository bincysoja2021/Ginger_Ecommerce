<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\Rolepermission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Role::orderBy('id','desc')->paginate(5);
        return view('Role.index',compact('role'));
    }

    public function add_role()
    {
        $permissions=Permission::get();
        return view('Role.add',compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $role = Role::create(['name' => $request->name]);

        if ($request->perms == null || count($request->perms) > 0) $role->Permissions()
            ->sync($request->perms);

        return redirect()->route('list_role')->with('success','Role has been created successfully.');
    }

    public function edit(Request $req)
    {
        $role=Role::where('id',$req->id)->first();
        $permissions = Permission::all();
        return view('Role.edit',compact('role','permissions'));
    }

    public function update(Request $req)
    {
        
        $req->validate([
            'name' => 'required'
        ]);
        
        $role = Role::where(['id' => $req
            ->id])
            ->first();

        $role->update(['name' => $req->name]);
        if ($req->perms == null || count($req->perms) > 0) $role->Permissions()
            ->sync($req->perms);

        return redirect()->route('list_role')->with('success','Role Has Been updated successfully');
    }

            

     public function destroy($id)
    {
        $checkexists=User::where('role',$id)->exists();
        if($checkexists==true)
        {
          return redirect()->route('list_role')->with('success','Cannot delete Role!.');
        }
        else
        {
          Role::find($id)->delete();
          return redirect()->route('list_role')->with('success','Role has been deleted successfully');
        } 
        
    }
}
