<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TodoResource::collection(Todo::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $request->validate(['name' => 'required',
                            'choice' => 'required',
                            'id' => 'required']);
        $todo= new Todo();
        $todo->name=$request->name;
        $todo->save();
        
        if($request->choice ==1){
            $user=User::find($request->id);
            $user->todos()->save($todo);
        }
        else{
            $admin=Admin::find($request->id);
            $admin->todos()->save($todo);
        }


        return new TodoResource($todo);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        
        $todo->is_finished= $request->is_finished;
        $todo->name= $request->name;
        $todo->save();
        return new TodoResource($todo);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        return $todo->delete();
    }
}
