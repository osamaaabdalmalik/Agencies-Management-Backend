<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AgentsController extends Controller
{
    public function addAgent(Request $request)
    {
        try {
        $validator = Validator::make($request->all(), [
            'receipt_number' => 'required|string|unique:agents',
            'course_id' => 'required|exists:courses,id',
            'parent_id' => 'required|exists:agents,id',
        ]);
        if ($validator->fails()) {
            // convert to arabic messages
            return $this->error($validator->errors()->first());
        }
        $agent = Agent::find($request->parent_id);
        if ($agent->left_id != null && $agent->right_id != null) {
            return $this->error('لا يوجد متسع لإضافة أي وكالة مباشرة للوكالة الأب');
        }
        DB::beginTransaction();
        $createdAgent = Agent::create([
            'password' => Hash::make('123456789'),
            'receipt_number' => $request->receipt_number,
            'course_id' => $request->course_id,
            'parent_id' => $request->parent_id,
            'client_id' => $agent->client->id,
        ]);
        if ($agent->left_id == null) {
            $agent->left_id = $createdAgent->id;
            Child::create([
                'level' => 2,
                'type' => 'left',
                'state' => 0,
                'agent_id' => $agent->id,
                'child_id' => $createdAgent->id,
            ]);
            if ($agent->parent_id != null) {
                $this->updateParent($createdAgent, $agent->parent_id, 3);
            }
        } else {
            $agent->right_id = $createdAgent->id;
            Child::create([
                'level' => 2,
                'type' => 'right',
                'state' => 0,
                'agent_id' => $agent->id,
                'child_id' => $createdAgent->id,
            ]);
            if ($agent->parent_id != null) {
                $this->updateParent($createdAgent, $agent->parent_id, 3);
            }
        }
        $agent->save();
        DB::commit();
        return $this->success($createdAgent);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e, 500);
        }
    }

    public function updateParent($createdAgent, $parent_id, $level)
    {
        $parent = $this->get($parent_id);
        if ($parent == null) {
            return;
        }
        $countLeft = null;
        if ($parent->left_id != null) {
            $countLeft = Child::where([
                'agent_id' => $parent->left_id,
                'child_id' => $createdAgent->id,
            ])->first();
        }
        Child::create([
            'level' => $level,
            'type' => $countLeft != null ? 'left' : 'right',
            'state' => 0,
            'agent_id' => $parent->id,
            'child_id' => $createdAgent->id,
        ]);
        if ($parent->parent_id != null) {
            $this->updateParent($createdAgent, $parent->parent_id, $level + 1);
        }
    }

    public function get($id)
    {
        return Agent::with(['client' => function ($q) {
            return $q->select('id', 'full_name');
        }])
//            ->with(['course' => function ($q) {
//                return $q->select('id', 'name');
//            }])
            ->with('left')
            ->with('right')
            ->where('id', $id)->first();
    }

    public function getAgents(Request $request)
    {
        $tree = $this->iterate(
            $this->get($request->id),
            $request->id,
            1
        );
        $leftChildrenCount = Child::where([
            'agent_id' => $request->id,
            'type' => 'left',
        ])->where('level', '>', 6)->count();
        $rightChildrenCount = Child::where([
            'agent_id' => $request->id,
            'type' => 'right',
        ])->where('level', '>', 6)->count();

        return $this->success([
            'tree' => $tree,
            'left_children_count' => $leftChildrenCount,
            'right_children_count' => $rightChildrenCount,
        ]);
    }

    public function iterate($tempAgent, $id, $level)
    {
        if ($tempAgent == null || $level > 6) {
            return null;
        }
        $relationInfo = Child::where(['agent_id' => $id, 'child_id' => $tempAgent->id])->first();
        $agent = [
            'id' => $tempAgent->id,
            'state' => $relationInfo != null ? $relationInfo->state : null,
            'client_name' => $tempAgent->client->full_name,
            'left' => $tempAgent->left,
            'right' => $tempAgent->right,
            'level' => $level,
        ];
        if ($tempAgent->left_id != null) {
            $agent['left'] = $this->iterate($this->get($tempAgent->left_id), $id, $level + 1);
        }
        if ($tempAgent->right_id != null) {
            $agent['right'] = $this->iterate($this->get($tempAgent->right_id), $id, $level + 1);
        }
        return $agent;
    }
}
