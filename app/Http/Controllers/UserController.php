<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function existeNick(Request $request){
        $data = $request->all();
        $consult = User::where('nick', $data['nick'])->get();
        return response()->json(["cantidad" => count($consult)]);
    }

    public function existeEmail(Request $request){
        $data = $request->all();
        $consult = User::where('email', $data['email'])->get();
        return response()->json(["cantidad" => count($consult)]);
    }

    public function existeEmailOrNick(Request $request){
        $data = $request->all();
        $consult = User::where('email', $data['query'])
                        ->orWhere('nick', $data['query'])->get();
        return response()->json(["cantidad" => count($consult)]);
    }
    
    public function getUser(Request $request){
        $data = $request->all();
        $user = User::where('email', $data['query'])
                ->orWhere('nick', $data['query'])->first();
        return response()->json(["user" => $user]);
    }

    public function getAllUser(Request $request){
        $data = $request->all();
        $users = User::where('email', "LIKE", '%'. $data['query'] . '%')
                ->orWhere('name','%'. $data['query'] . '%')
                ->orWhere('nick','%'. $data['query'] . '%')->get();
        return response()->json(["users" => $users]);
    }

    public function datatablesUsers(){
        $users = User::select('id','name','nick','email','status')->get();
        return Datatables::of($users)
                ->addColumn('action', function ($user) {
                return '<a :href="/usuarios/'.$user->id.'/edit" class="btn btn-xs btn-primary rounded-full"><i class="mdi mdi-square-edit-outline"></i</a>';
            })
            ->rawColumns(['action'])->rawColumns(['action'])
            ->make(true);
                // ->where('email', "LIKE", '%'. $data['query'] . '%')
                // ->orWhere('name','%'. $data['query'] . '%')
                // ->orWhere('nick','%'. $data['query'] . '%')->get();
        // return response()->json(["users" => $users]);
    }

    public function tableUsers(){
        $users = User::select('id','name','nick','email','status')->get();
        return response()->json($users);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/Usuario',[
            'users' => User::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $request->validate();
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "nick" => $request->nick,
            'password' => Hash::make($request->password),
            
        ]);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('User/UserEdit',['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}