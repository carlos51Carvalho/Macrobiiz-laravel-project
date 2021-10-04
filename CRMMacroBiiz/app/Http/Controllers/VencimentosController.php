<?php

namespace App\Http\Controllers;

use App\Models\vencimentos;
use App\Models\colaboradores;
use Illuminate\Http\Request;
use Session;

class VencimentosController extends Controller
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
        $dados = vencimentos::paginate(15);
        $colaborador = colaboradores::all();
        return view('/vencimentos/vencimentos_index', compact('dados','colaborador'));
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
        return view('/vencimentos/vencimentos_adicionar', compact('colaborador'));
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
        $vencimento = new vencimentos;
        $vencimento->id_colaborador = $request->id_colaborador_text;
        $vencimento->data = $request->data_text;

        if ($request->file('ficheiro') == "") {
            $file1 = "";
            $vencimento->ficheiro = $file1;
        }

        else
        {
            $file2 = $request->file('ficheiro');
            $file2->move(public_path().'/vencimentos/',
                $file2->getClientOriginalName());
            $vencimento->ficheiro=$file2->getClientOriginalName();
        }


        $vencimento->save();


        //redirecionamento para o home

        return redirect('/index_vencimentos');
    }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vencimentos  $vencimentos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $vencimento = vencimentos::findOrFail($id);
        $c = colaboradores::findOrFail($vencimento->id_colaborador);
        
        return view('/vencimentos/vencimentos_vista', compact('vencimento', 'c'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vencimentos  $vencimentos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $vencimento = vencimentos::findOrFail($id);
        $colaborador = colaboradores::all();
        $c= colaboradores::findOrFail($vencimento->id_colaborador);
        return view('/vencimentos/vencimentos_edit', compact('vencimento','colaborador','c'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vencimentos  $vencimentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $vencimento = vencimentos::findOrFail($id);
        $vencimento->id_colaborador = $request->id_colaborador_text;
        $vencimento->data = $request->data_text;

        if ($request->file('ficheiro_text') != "") {
            $file2 = $request->file('ficheiro_text');
            $file2->move(public_path().'/vencimentos/',
                $file2->getClientOriginalName());
            $vencimento->ficheiro=$file2->getClientOriginalName();
        }


        $vencimento->update();


        //redirecionamento para o home

        return redirect('/index_vencimentos');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vencimentos  $vencimentos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        vencimentos::destroy($id);
        return redirect('/index_vencimentos');
        }
    }
}
