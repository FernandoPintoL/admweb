<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Yajra\Datatables\Datatables;
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
                return '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
        //
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