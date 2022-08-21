<?php

namespace App\Http\Controllers;

use App\Notifications\UserFollowNotification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
// use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function puzzle(){
        return Inertia::render('Puzzle');
    }
    public function index()
    {
        $user = Auth::user();
        $post = [
            'title' => 'post-title',
            'slug' => 'chat'
        ];
        // $user->notify(new WelcomeNotification($post));
        //Notification::send($user, new WelcomeNotification($post));
        return Inertia::render('Home');
    }

    public function notify(){
        if(Auth::check()){
            $user = Auth::user();
            $aux = User::find(3);
            // $user->notify(new UserFollowNotification($aux));
        }else{
            return 'no hay user';
        }
    }

    public function notificaciones(){
        //notifications => Todas las notificaciones
        //unreadNotifications => notificaciones NO leidos
        //readNotifications => notificaciones leidos
        return Auth::user()->unreadNotifications;
    }

    public function markasread(Request $request){
        $data = $request->all();
        if($data['id']){
            Auth::user()->unreadNotifications->where('id',$data['id'])->markAsRead();
        }
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