<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthAdminController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_name'=>['required','string','exists:admins,user_name'],
            'password'=>['required','string','min:6','max:50']
        ]);
        if ($validation->fails())
            return $this->error($validation->errors()->first());
        if (!auth()->guard('admin')->validate($request->only('user_name','password')))
            return $this->error();
        try {
        DB::beginTransaction();
        $admin = Admin::where('user_name',$request->user_name)->first();
        if (!$admin || $admin->blocked)
            return $this->error('you are blocked');
        $token = $admin->createToken(Admin::ADMIN_TOKEN, ['admin'])->plainTextToken;
        DB::commit();
        return $this->success($token);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Server failure : ' . $e, 500);
        }
    }

}
