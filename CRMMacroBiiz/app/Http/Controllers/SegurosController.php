<?php

namespace App\Http\Controllers;

use App\Models\seguros;
use App\Models\colaboradores;
use Illuminate\Http\Request;
use Session;

class SegurosController extends Controller
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
        $dados = seguros::paginate(15);
        $colaborador = colaboradores::all();
        return view('/seguros/seguros_index', compact('dados','colaborador'));
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
        $colaborador = colaboradores::all();
        return view('/seguros/seguros_adicionar', compact('colaborador'));
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
        $seguro = new seguros;
        $seguro->id_colaborador = $request->id_colaborador_text;
        $seguro->descricao = $request->descricao_text;
        $seguro->data_inicio = $request->data_inicio_text;
        $seguro->data_fim = $request->data_fim_text;

        if ($request->file('ficheiro') == "") {
            $file1 = "";
            $seguro->ficheiro = $file1;
        }

        else
        {
            $file2 = $request->file('ficheiro');
            $file2->move(public_path().'/seguros/',
                $file2->getClientOriginalName());
            $seguro->ficheiro=$file2->getClientOriginalName();
        }


        $seguro->save();


        //redirecionamento para o home

        return redirect('/index_seguros');
    }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\seguros  $seguros
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $seguro = seguros::findOrFail($id);
        $c = colaboradores::findOrFail($seguro->id_colaborador);
        
        return view('/seguros/seguros_vista', compact('seguro', 'c'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\seguros  $seguros
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $seguro = seguros::findOrFail($id);
        $colaborador = colaboradores::all();
        $c= colaboradores::findOrFail($seguro->id_colaborador);
        return view('/seguros/seguros_edit', compact('seguro','colaborador','c'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\seguros  $seguros
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
        $seguro = seguros::findOrFail($id);
        $seguro->id_colaborador = $request->id_colaborador_text;
        $seguro->descricao = $request->descricao_text;
        $seguro->data_inicio = $request->data_inicio_text;
        $seguro->data_fim = $request->data_fim_text;

        if ($request->file('ficheiro_text') != "") {
            $file2 = $request->file('ficheiro_text');
            $file2->move(public_path().'/seguros/',
                $file2->getClientOriginalName());
            $seguro->ficheiro=$file2->getClientOriginalName();
        }


        $seguro->update();


        //redirecionamento para o home

        return redirect('/index_seguros');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\seguros  $seguros
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        seguros::destroy($id);
        return redirect('/index_seguros');
        }
    }
}
