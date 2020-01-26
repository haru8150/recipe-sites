<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;//Userモデルの名前空間を追加
use App\Recipe;//Recipeモデルの名前空間を追加

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //ユーザーのお気に入り一覧表示機能 
    public function favorites($id)
    {
        //ユーザーごとにお気に入り一覧を表示
        $user = User::find($id);
        //Userモデルのfavorites()を呼び出す
        $favorites = $user->favorites()->paginate(10);
        
        $data = [
            'user' => $user,
            'recipes' => $favorites,
        ];
        
        // $data += $this->UserOfCounts($user);
        
        return view('users.favorites', $data);
    } 
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
