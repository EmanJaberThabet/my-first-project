<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // استعراض جميع المستخدمين
    public function index()
    {
        $users = DB::table('users')->get();
        return view('users', compact('users'));
    }

    // إضافة مستخدم جديد
    public function add(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back();
    }

    // حذف مستخدم
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $users = DB::table('users')->get();

        return view('users', compact('user', 'users'));
    }

    
    public function update(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // تحديث كلمة المرور فقط إذا أدخل المستخدم كلمة مرور جديدة
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $request->id)->update($data);

        return redirect('users');
    }
}
