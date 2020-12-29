<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginVerifyRequest;
use App\Http\Requests\UserLoginVerifyRequest;

use Illuminate\Support\Facades\DB;
use App\Admin;
use App\User;
use App\Product;
use App\Category;


class loginController extends Controller
{
    public function adminIndex()
    {
    	return view('admin_panel.adminLogin');
    }
    public function adminLogout()
    {
        session()->flush();   
    	return redirect()->route('admin.login');
    }
    public function adminPosted(AdminLoginVerifyRequest $request)
    {  
        $admin = Admin::where('username',$request->Username)->first();
        
        if($admin==null)
        {
            
            $request->session()->flash('message', 'Invalid Username');
            
            return redirect(route('admin.login'));
        }
        
        else
        {
            if($request->Password==$admin->password)
            {
                session()->put('admin',$admin);
                //$request->session()->put('username', $request->Username);
                return redirect()->route('admin.dashboard');
            }
            
            else if($request->Password!=$admin->password)
            {
                $request->session()->flash('message', 'Invalid Password');
                return view('admin_panel.adminLogin');
            }
        }
        
        
        
    }
    
}