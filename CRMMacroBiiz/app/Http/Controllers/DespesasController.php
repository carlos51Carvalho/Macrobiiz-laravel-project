<?php

namespace App\Http\Controllers;

use App\Models\despesas;
use App\Models\colaboradores;
use Illuminate\Http\Request;
use Session;

class DespesasController extends Controller
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
            $dados = despesas::paginate(15);
            $colaborador = colaboradores::all();
            return view('/despesas/despesas_index', compact('dados','colaborador'));
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
            return view('/despesas/despesas_adicionar', compact('colaborador'));
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
            $despesa = new despesas;
            $despesa->id_colaborador = $request->id_colaborador_text;
            $despesa->descricao = $request->descricao_text;
            $despesa->data = $request->data_text;

            if ($request->file('ficheiro') == "") {
                $file1 = "";
                $despesa->ficheiro = $file1;
            }

            else
            {
                $file2 = $request->file('ficheiro');
                $file2->move(public_path().'/despesas/',
                    $file2->getClientOriginalName());
                $despesa->ficheiro=$file2->getClientOriginalName();
            }


            $despesa->save();


            //redirecionamento para o home

            return redirect('/index_despesas');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\despesas  $despesas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //4
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $despesa = despesas::findOrFail($id);
            $c = colaboradores::findOrFail($despesa->id_colaborador);
            
            return view('/despesas/despesas_vista', compact('despesa', 'c'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\despesas  $despesas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $despesa = despesas::findOrFail($id);
            $colaborador = colaboradores::all();
            $c= colaboradores::findOrFail($despesa->id_colaborador);
            return view('/despesas/despesas_edit', compact('despesa','colaborador','c'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\despesas  $despesas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $despesa = despesas::findOrFail($id);
            $despesa->id_colaborador = $request->id_colaborador_text;
            $despesa->descricao = $request->descricao_text;
            $despesa->data = $request->data_text;

            if ($request->file('ficheiro_text') != "") {
                $file2 = $request->file('ficheiro_text');
                $file2->move(public_path().'/despesas/',
                    $file2->getClientOriginalName());
                $despesa->ficheiro=$file2->getClientOriginalName();
            }


            $despesa->update();


            //redirecionamento para o home

            return redirect('/index_despesas');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\despesas  $despesas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        despesas::destroy($id);
        return redirect('/index_despesas');
        }
    }
}
