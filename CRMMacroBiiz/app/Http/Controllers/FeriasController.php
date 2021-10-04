<?php

namespace App\Http\Controllers;

use App\Models\ferias;
use App\Models\colaboradores;
use Illuminate\Http\Request;
use Session;

class FeriasController extends Controller
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
        return view('/ferias/ferias_adicionar', compact('colaborador'));
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
        $ferias = new ferias;
        $ferias->id_colaborador = $request->id_colaborador_text;
        $ferias->data_inicio = $request->data_inicio_text;
        $ferias->data_fim = $request->data_fim_text;

        $ferias->save();
        $id = $ferias->id_colaborador;

        return redirect()->to('marcacao_ferias/'.$id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ferias  $ferias
     * @return \Illuminate\Http\Response
     */
    public function show(ferias $ferias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ferias  $ferias
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $ferias = ferias::findOrFail($id);
        $colaborador= colaboradores::findOrFail($ferias->id_colaborador);
        return view('ferias/ferias_edit', compact('ferias','colaborador'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ferias  $ferias
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
        $ferias = ferias::findOrFail($id);
        $ferias->id_colaborador = $request->id_colaborador_text;
        $ferias->data_inicio = $request->data_inicio_text;
        $ferias->data_fim = $request->data_fim_text;

        $ferias->update();
        return redirect()->to('marcacao_ferias/'.$ferias->id_colaborador);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ferias  $ferias
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $feria = ferias::findORFail($id);
        ferias::destroy($id);
        return redirect()->to('marcacao_ferias/'.$feria->id_colaborador);
        }
    }
}
