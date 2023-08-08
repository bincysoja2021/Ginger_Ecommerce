<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use App\Models\Role;


class UserController extends Controller
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
        $user = User::with('role_data')->orderBy('id','desc')->paginate(5);
        return view('user.index',compact('user'));
    }

     public function add_user()
    {
        $role=Role::get();
        return view('user.add',compact('role'));
    }

    public function store(Request $request)
    {
        $request->validate([
                'name'   => 'required',
                'email'  => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'role'   =>'required'

        ]);
        
        $User=new User();
        $User->name=$request->name;
        $User->email=$request->email;
        $User->role=$request->role;
        $User->password=Hash::make($request->password);
        $User->save();

        return redirect()->route('list_user')->with('success','User has been created successfully.');
    }

    public function edit(Request $req)
    {
        $user=User::where('id',$req->id)->first();
        $role_val=Role::get();
        return view('user.edit',compact('user','role_val'));
    }

    public function update(Request $req)
    {
        $req->validate([
                'name'   => 'required',
                'email' => 'required|email',
                'role'=>'required'
        ]);
        $user_Data=User::where('id',$req->id)->first();
        if($req->password == null)
        {
           $user=User::where('id',$req->id)->update(['name'=>$req->name,'email'=>$req->email,'role'=>$req->role]);
        }
        else
        {
            if (Hash::check($req->password, $user_Data->password)) 
            {
              $user=User::where('id',$req->id)->update(['name'=>$req->name,'email'=>$req->email,'role'=>$req->role]);  
            }
            else
            {
               $user=User::where('id',$req->id)->update(['name'=>$req->name,'email'=>$req->email,'password'=>Hash::make($req->password),'role'=>$req->role]);
            }

        }
        return redirect()->route('list_user')->with('success','user Has Been updated successfully');
    }

        
     public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('list_user')->with('success','User has been deleted successfully');
    }
    public function forbidden()
    {
        return view('forbidden');
    }
}
