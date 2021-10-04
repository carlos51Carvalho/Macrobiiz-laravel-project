<?php

namespace App\Http\Controllers;

use App\Models\faltas;
use App\Models\colaboradores;
use Illuminate\Http\Request;
use DB;
use Session;

class FaltasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $colaborador = colaboradores::findORfail($id);
        return view('/faltas/faltas_adicionar', compact('colaborador'));
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

            $this->validate($request,[
                'data_inicio_text' => 'required | date',
                'data_fim_text' => 'required|date|after_or_equal:data_fim_text',
            ]);
        $faltas = new faltas;
        $faltas->id_colaborador = $request->id_colaborador_text;
        $faltas->data_inicio = $request->data_inicio_text;
        $faltas->data_fim = $request->data_fim_text;
        $faltas->horas = $request->horas_text;
        $faltas->descricao = $request->descricao_text;

        $faltas->save();
        $id = $faltas->id_colaborador;

        return redirect()->to('marcacao_faltas/'.$id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\faltas  $faltas
     * @return \Illuminate\Http\Response
     */
    public function show(faltas $faltas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\faltas  $faltas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $faltas = faltas::findOrFail($id);
        $colaborador= colaboradores::findOrFail($faltas->id_colaborador);
        return view('faltas.faltas_edit', compact('faltas','colaborador'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\faltas  $faltas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{

            $this->validate($request,[
                'data_inicio_text' => 'required | date',
                'data_fim_text' => 'required|date|after_or_equal:data_fim_text',
            ]);
        $faltas = faltas::findOrFail($id);
        $faltas->id_colaborador = $request->id_colaborador_text;
        $faltas->data_inicio = $request->data_inicio_text;
        $faltas->data_fim = $request->data_fim_text;
        $faltas->horas = $request->horas_text;
        $faltas->descricao = $request->descricao_text;

        $faltas->update();
        return redirect()->to('marcacao_faltas/'.$faltas->id_colaborador);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\faltas  $faltas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $feria = faltas::findORFail($id);
        faltas::destroy($id);
        return redirect()->to('marcacao_faltas/'.$feria->id_colaborador);
        }
    }
}
