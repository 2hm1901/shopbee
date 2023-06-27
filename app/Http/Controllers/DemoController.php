<?php

namespace App\Http\Controllers;

use App\Models\Demo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\players;
use App\Http\Requests\EditRequest;

class DemoController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    // hamkhoitao cua oop
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Demo $demo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demo $demo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Demo $demo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demo $demo)
    {
        //
    }
    public function helloWorld()
    {
        $content = "Hello World!";
        return view('demo',compact('content'));
    }
    public function GetLogin()
    {
        return view('login');
    }
    public function PostLogin(Request $request)
    {
        echo $request->username;
        echo $request->password;
    }

    //player
    public function GetInfor(){
        //This is using query builder
        // $data = DB::table('players')->get()->toArray(); 

        $data = players::all(); //This is using models
        
        return view('player_table.infor',compact('data'));
    }
    public function AddInfor(EditRequest $validator, Request $request){
        //Using query builder
        // DB::table('players')->insert(
        //     ['name_player' => $request->name,
        //     'age_player' => $request->age,
        //     'salary' => $request->salary,
        //     'position' => $request->position]
        // );

        //Using Models
        $new_player = new players();
        $new_player->name_player = $request->name;
        $new_player->age_player = $request->age;
        $new_player->salary = $request->salary;
        $new_player->position = $request->position;
        $new_player->save();

        return redirect('infor');
    }
    public function EditInfor($id){
        //Using query builder
        // $data = DB::table('players')->where('id',$id)->get();

        //Using Models
        $data = players::where('id',$id)->get(); 
        return view('player_table.edit', compact('data'));
    }
    public function UpdateInfor(EditRequest $validator, $id, request $request){
        //Using Query Builder
        // DB::table('players')->where('id',$id)->update(
        // ['name_player' => $request->name,
        //     'age_player' => $request->age,
        //     'salary' => $request->salary,
        //     'position' => $request->position]
        // );

        //Using Models
        players::where('id',$id)->update(
            ['name_player' => $request->name,
            'age_player' => $request->age,
            'salary' => $request->salary,
            'position' => $request->position]
        );
        return redirect('infor');
    }
    public function DeleteInfor($id){
        //Using Query Builder
        // DB::table('players')->where('id',$id)->delete();

        //Using Models
        players::where('id',$id)->delete();
        return redirect('infor');
    }

    
}
    
