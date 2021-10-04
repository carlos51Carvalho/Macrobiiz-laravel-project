<?php

namespace App\Http\Controllers;

use App\Models\contratos;
use Session;
use App\Models\colaboradores;
use Illuminate\Http\Request;

class ContratosController extends Controller
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
            $dados = contratos::paginate(15);
            $colaborador = colaboradores::all();
            return view('/contratos/contratos_index', compact('dados','colaborador'));
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
            return view('/contratos/contratos_adicionar', compact('colaborador'));
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
            $contrato = new contratos;
            $contrato->id_colaborador = $request->id_colaborador_text;
            $contrato->descricao = $request->descricao_text;
            $contrato->data_inicio = $request->data_inicio_text;
            $contrato->data_fim = $request->data_fim_text;

            if ($request->file('ficheiro') == "") {
                $file1 = "";
                $contrato->ficheiro = $file1;
            }

            else
            {
                $file2 = $request->file('ficheiro');
                $file2->move(public_path().'/contratos/',
                    $file2->getClientOriginalName());
                $contrato->ficheiro=$file2->getClientOriginalName();
            }


            $contrato->save();


            //redirecionamento para o home

            return redirect('/index_contratos');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $contrato = contratos::findOrFail($id);
            $c = colaboradores::findOrFail($contrato->id_colaborador);
            
            return view('/contratos/contratos_vista', compact('contrato', 'c'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $contrato = contratos::findOrFail($id);
            $colaborador = colaboradores::all();
            $c= colaboradores::findOrFail($contrato->id_colaborador);
            return view('/contratos/contratos_edit', compact('contrato','colaborador','c'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\contratos  $contratos
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
            $contrato = contratos::findOrFail($id);
            $contrato->id_colaborador = $request->id_colaborador_text;
            $contrato->descricao = $request->descricao_text;
            $contrato->data_inicio = $request->data_inicio_text;
            $contrato->data_fim = $request->data_fim_text;

            if ($request->file('ficheiro_text') != "") {
                $file2 = $request->file('ficheiro_text');
                $file2->move(public_path().'/contratos/',
                    $file2->getClientOriginalName());
                $contrato->ficheiro=$file2->getClientOriginalName();
            }


            $contrato->update();


            //redirecionamento para o home

            return redirect('/index_contratos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            contratos::destroy($id);
            return redirect('/index_contratos');
        }
    }
}
