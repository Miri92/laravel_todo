<?php

namespace App\Http\Controllers;

use App\Shared;
use App\Todo;
use App\User;
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
            $error = '404 not found';
            return $error;
        }

        $check_shared = Shared::where([
            ['shared_with','=',Auth::user()->id],
            ['todo_id','=',$id]
        ])->first();

        if ($todo->author == Auth::user()->id || $check_shared){
            return view('todo.show', compact('todo'));
        }

        $error = 'you have not permission';
        return $error;

        //return $todo->shared;


    }

    public function share(Request $request)
    {
        //return dd($request->all());

        $get_user = User::where([
            ['name','=',$request->input('shared_with')]
        ])->first();
        if (!$get_user){
            $error = 'user not found';
            return redirect()->route('todo.detail',$request->input('todo_id'))->with(compact('error'));
        }

        //check if already shared
        $check_shared = Shared::where([
            ['shared_with','=',$get_user->id],
            ['todo_id','=',$request->input('todo_id')]
        ])->first();

        if ($check_shared){
            $error = 'this Todo already shared with the user';
            return redirect()->route('todo.detail',$request->input('todo_id'))->with(compact('error'));
        }

        $todo = Shared::create([
            'todo_id' => $request->input('todo_id'),
            'shared_with' => $get_user->id,
        ]);

        $todo->save();

        $success = 'succesful shared';
        return redirect()->route('todo.detail', $request->input('todo_id'))->with(compact('success'));

        //$todoShared[] = new Shared(['todo_id'=> $todo->id,'shared_with' => 2]);
//
//        $todo->Shared()->saveMany($todoShared);
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
