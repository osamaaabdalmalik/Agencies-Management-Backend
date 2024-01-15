<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AuthMail;
use App\Mail\BlockedMail;
use App\Mail\PasswordMail;
use App\Models\AdminRegister;
use App\Models\OperationType;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReceptionistAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'abilities:admin,access']);
    }

    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'full_name' => ['required', 'string'],
                'phone' => ['required', 'string', 'unique:receptionists,phone'],
                'email' => ['required', 'string', 'email', 'unique:receptionists,email'],
                'password' => ['required', 'string', 'min:6', 'max:50']
            ]
        );
        if ($validator->fails()) {
            return $this->success($validator->errors()->first());
        }
        try {
            DB::beginTransaction();
            $details = ['password' => $request->password, 'full_name' => $request->full_name];
            Mail::to($request->email)->send(new PasswordMail($details));
            $receptionist = Receptionist::create([
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            AdminRegister::create([
                'thing_id' => $receptionist->id,
                'admin_id' => $request->user()->id,
                'operation_type_id' => OperationType::CREATE_RECIPTIONIST
            ]);
            DB::commit();
            return $this->success();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Server failure: ' . $e, 500);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => ['required', 'exists:receptionists,id'],
                'full_name' => ['required', 'string'],
                'phone' => ['required', 'string', 'unique:receptionists,phone, ' . $request->id],
                'email' => ['required', 'string', 'email', 'exists:receptionists,email', 'unique:receptionists,email, ' . $request->id],
            ]
        );
        if ($validator->fails()) {
            return $this->success($validator->errors()->first());
        }
        try {
            DB::beginTransaction();
            $receptionist = Receptionist::find($request->id);
            $receptionist->update([
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
            AdminRegister::create([
                'thing_id' => $receptionist->id,
                'admin_id' => $request->user()->id,
                'operation_type_id' => OperationType::UPDATE_RECIPTIONIST
            ]);
            $receptionist->save();
            DB::commit();
            return $this->success();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Server failure: ' . $e, 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->only('id','password'), [
            'id' => ['required', 'exists:receptionists,id'],
            'password' => ['required', 'string', 'min:6', 'max:50']
        ]);
        if ($validator->fails())
            return $this->error($validator->errors()->first());
        try {
            DB::beginTransaction();
            $receptionist = Receptionist::find($request->id);
            $receptionist->update([
                'password' => Hash::make($request->password),
            ]);
            $receptionist->save();
            $details = ['password' => $request->password, 'full_name' => $receptionist->full_name];
            Mail::to($receptionist->email)->send(new PasswordMail($details));
            DB::commit();
            return $this->success();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Server failure: ' . $e, 500);
        }
    }

    public function blockAccount(Request $request){
        $validator = Validator::make($request->only('id'), [
            'id' => ['required', 'exists:receptionists,id'],
        ]);
        if ($validator->fails())
            return $this->error($validator->errors()->first());
        try {
            DB::beginTransaction();
            $receptionist = Receptionist::find($request->id);
            $receptionist->update([
                'blocked' => !$receptionist->blocked,
            ]);
            $receptionist->save();
            Mail::to($receptionist->email)->send(new BlockedMail(['block'=> $receptionist->blocked]));
            DB::commit();
            return $this->success();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Server failure: ' . $e, 500);
        }
    }

    public function index(Request $request){
        $validator = Validator::make($request->only('name'),[
            'full_name' => ['nullable','string'],
        ]);
        if ($validator->fails())
            return $this->error($validator->errors()->first());
        $receptionists = Receptionist::query();

        if ($request->full_name != null) {
            $receptionists->where('full_name', 'like', '%' . $request->full_name . '%');
        }
        $receptionists = $receptionists->get();
        return $this->success($receptionists);
    }
}
