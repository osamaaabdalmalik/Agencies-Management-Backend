<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRegister;
use App\Models\Course;
use App\Models\OperationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'abilities:admin,access']);
    }

    public function create(Request $request){
        $validator = Validator::make(
            $request->only('name','description','agent_type_id'),
            [
                'name' => ['required','string','unique:courses,name'],
                'description' => ['required','string'],
                'agent_type_id'=>['required','exists:agent_types,id']
            ]
        );
        if ($validator->fails()) {
            return $this->success($validator->errors()->first());
        }
        try {
            DB::beginTransaction();
            $course = Course::create([
                'name' => $request->name,
                'description' => $request->description,
                'agent_type_id' => $request->agent_type_id
            ]);
            $AdminRegister=AdminRegister::create([
                'thing_id' => $course->id,
                'admin_id' => $request->user()->id,
                'operation_type_id' => OperationType::CREATE_COURSE
            ]);
            DB::commit();
            return $this->success($AdminRegister);
        }catch (\Exception $e){
            DB::rollBack();
            return $this->error('Server failure', 500);
        }
    }

    public function update(Request $request){
        $validator = Validator::make(
            $request->only('id','name','description'),
            [
                'id'=>['required','exists:courses,id'],
                'name' => ['required','string','unique:courses,name, '.$request->id],
                'description' => ['required','string'],
            ]
        );
        if ($validator->fails()) {
            return $this->success($validator->errors()->first());
        }
        try {
            DB::beginTransaction();
            $course = Course::find($request->id);
            $course->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
            $AdminRegister=AdminRegister::create([
                'thing_id' => $course->id,
                'admin_id' => $request->user()->id,
                'operation_type_id' => OperationType::UPDATE_COURSE
            ]);
            DB::commit();
            return $this->success($AdminRegister);
        }catch (\Exception $e){
            DB::rollBack();
            return $this->error('Server failure', 500);
        }
    }

    public function index(Request $request){
        $validator = Validator::make($request->only('name'),[
            'name' => ['nullable','string'],
        ]);
        if ($validator->fails())
            return $this->error($validator->errors()->first());
        $courses = Course::query();

        if ($request->name != null) {
            $courses->where('name', 'like', '%' . $request->name . '%');
        }
        $courses = $courses->get();
        return $this->success($courses);
    }
}
