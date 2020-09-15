<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\User;

class UserController extends Controller
{
    public function store(UserStoreRequest $request) {
        $data = $request->validated();
        if($data['password'] !== request('confirmPassword')) {
            return response()->json(["error" => "password did not match"], 422);
        }
        $data['password'] = bcrypt(request('password'));
        User::create($data);

        return response()->json('Successfully added user record', 200);
    }

    public function role() {
        $email = request('email');
        $user = User::where('email', $email)->first();
        return response()->json($user->role);
    }

    public function index() {
        $sortBy = request('sortBy');
        $descending = request('descending');
        $page = request('page');
        $rowsPerPage = request('rowsPerPage');
        $filter = request('filter');
        $role = request('role');
        $status = request('status');

        $startRow = ($page - 1) * $rowsPerPage;

        $query = User::orderBy($sortBy, ($descending) ? 'desc' : 'asc');

        if(!empty($role) and $role !== 'All') {
            $query = $query->where('role', $role);
        }

        if(!empty($status) and $status !== 'All') {
            $query = $query->where('status', $status);
        }

        if($filter !== '') {                            
            $query = $query->where('name', 'LIKE', '%' . $filter . '%');
        }

        $total = $query->count();
        $fetchCount = $rowsPerPage === 0 ? $rowsPerPage : $total;

        $rowsPerPage = $rowsPerPage === 0 ? $total : $rowsPerPage;

        $users = $query->skip($startRow)->take($rowsPerPage)->get();

        foreach($users as $user ) {
            $actions = [];
            $actions[] = [
                'title' => 'Edit',
                'name' => 'edit',
                'icon' => 'create',
                'colour' => 'primary',
                'userId' => $user->id
            ];
            $user->actions = $actions;
        }

        $result = [
            'items' => $users,
            'total' => $fetchCount,
            'page' => $page + 1,
            'rowsPerPage' => $rowsPerPage,
            'sortBy' => $sortBy,
            'descending' => $descending
        ];

        return response()->json($result);
    }

    public function online() {
        $user = User::find(request('id'));
        $user->status = 'active';
        $user->save();
    }

    public function offline() {
        $user = User::find(request('id'));
        $user->status = 'inactive';
        $user->save();
    }

    public function edit($id)
    {
        $user = User::find($id);
        $attribute = request()->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $user->update($attribute);
    }
}
