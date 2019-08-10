<?php

namespace App\Http\Controllers;

use App\Shared;
use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $select = Shared::where([
           ['shared_with', '=', 22]
        ])->with('todos')->get();

        $get_todos = Todo::where([
           ['author', '=', Auth::user()->id]
        ])->with('shared')->get();

        //dd($select);
        //return $select;

        return view('home', compact('get_todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return dd($request->all());

        $todo = Todo::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author' => Auth::user()->id,
            'schedule' => null,
        ]);

        $todo->save();

        $success = 'succesful created';
        return redirect()->route('todo.list')->with(compact('success'));

       //$todoShared[] = new Shared(['todo_id'=> $todo->id,'shared_with' => 2]);
//
//        $todo->Shared()->saveMany($todoShared);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::where([
            ['id', '=', $id]
        ])->with('shared')->first();

        if (!$todo){
            return abort('404');
        }

        //return $todo->shared;

        return view('todo.show', compact('todo'));
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
        Todo::where('id', $id)->delete();
        $success = 'succesful deleted';
// back() isletme cunki edit-den silende tezeden ozune qayidir ve not found erroru verir
        return redirect()->route('todo.list')->with(compact('success'));
    }
}
