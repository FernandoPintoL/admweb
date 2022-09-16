<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;

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
                return '<a href="/usuario/'.$user->id.'/update" class="btn btn-xs btn-primary rounded-full"><i class="mdi mdi-square-edit-outline"></i</a>';
            })
            ->rawColumns(['action'])->rawColumns(['action'])
            ->make(true);
                // ->where('email', "LIKE", '%'. $data['query'] . '%')
                // ->orWhere('name','%'. $data['query'] . '%')
                // ->orWhere('nick','%'. $data['query'] . '%')->get();
        // return response()->json(["users" => $users]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/Usuario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = User::create([
            "name" => $data['name'],
            "email" => $data['email'],
            "nick" => $data['nick'],
            'password' => Hash::make($data['password']),
            
        ]);
        return response()->json($user);
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