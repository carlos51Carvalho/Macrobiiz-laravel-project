<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\task;
use App\Models\alertas;
use App\Models\dominios;
use App\Models\alojamentos;
use App\Models\alertas_aloja;
use Carbon\Carbon;
use Carbon\Doctrine\CarbonDoctrineType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $tasks = Task::all();
        $categorias = categoria::all();
        $alertas = alertas::all();
        $alertasloj= alertas_aloja::all();
        $dominios = dominios::all();
        $alojamentos = alojamentos::all();
        return view('\tasks\task_index', compact('tasks','categorias', 'alertas','alertasloj', 'dominios','alojamentos'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        return view('\tasks\task_adicionar');
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
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $task = new task;
        $task->id_task = $request->id_task_text;
        $task->nome = $request->nome_text;
        $task->id_categoria = $request->id_categoria_text;
        $task->data_inicio = $request->data_inicio_text;
        $task->data_fim = $request->data_fim_text;

        $task->save();

        return redirect('admin');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $task = task::findORFail($id);
        return view('\tasks\task_edit', compact('task'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        task::destroy($id);
        return redirect('admin');
        }
    }



    public function storeCategoria(Request $request)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $categorias = new categoria;
        $categorias->id_categoria = $request->id_categoria_text;
        $categorias->descricao = $request->descricao_text;
        $categorias->cor = $request->cor_text;

        $categorias->save();

        return redirect('admin');
        }

    }


    public function destroyCategoria($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $tasks = DB::table('tasks')->where('id_categoria','=' ,$id)->get();
        $today = Carbon::today();

        if(count($tasks)>0){
            foreach($tasks as $task){
                if($task->data_fim == null){
                    if($task->data_inicio > $today){
                        return redirect('admin')
                                ->with('error','A categoria que está a eliminar está associada a uma tarefa agendada');
                    }

                }
                elseif($task->data_fim > $today){
                        return redirect('admin')
                                ->with('error','A categoria que está a eliminar está associada a uma tarefa agendada');;
                }
            }

            foreach($tasks as $task){
                task::destroy($task->id_task);
            }

            categoria::destroy($id); 
            return redirect('admin');

        }
        else{
            categoria::destroy($id); 
            return redirect('admin');
            }
        }

    }



    
}
