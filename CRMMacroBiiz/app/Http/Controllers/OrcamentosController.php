<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\orcamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;



class OrcamentosController extends Controller
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
        $dados = orcamentos::paginate(15);
        $cliente = cliente::all();
        return view('/orcamentos/orcamentos_index', compact('dados','cliente'));
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
        $cliente = cliente::all();
        return view('/orcamentos/orcamentos_adicionar', compact('cliente'));
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
        $orcamento = new orcamentos;
        $orcamento->id_cliente = $request->id_cliente_text;
        $orcamento->descricao = $request->descricao_text;
        
        if ($request->file('ficheiro') == "") {
            $file1 = "";
            $orcamento->ficheiro = $file1;
        }

        else
        {
            $file2 = $request->file('ficheiro');
            $file2->move(public_path().'/orcamentos/',
                $file2->getClientOriginalName());
            $orcamento->ficheiro=$file2->getClientOriginalName();
        }


        $orcamento->save();


        //redirecionamento para o home

        return redirect('index_orcamentos');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orcamentos  $orcamentos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $orcamento = orcamentos::findOrFail($id);
        $c = cliente::findOrFail($orcamento->id_cliente);
        
        return view('/orcamentos/orcamentos_vista', compact('orcamento', 'c'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orcamentos  $orcamentos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $orcamento = orcamentos::findOrFail($id);
        $cliente = cliente::all();
        $c= cliente::findOrFail($orcamento->id_cliente);
        return view('/orcamentos/orcamentos_edit', compact('orcamento','cliente','c'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orcamentos  $orcamentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $orcamento = orcamentos::findOrFail($id);
        $orcamento->id_cliente = $request->id_cliente_text;
        $orcamento->descricao = $request->descricao_text;

        if ($request->file('ficheiro_text') != "") {
            $file2 = $request->file('ficheiro_text');
            $file2->move(public_path().'/orcamentos/',
                $file2->getClientOriginalName());
            $orcamento->ficheiro=$file2->getClientOriginalName();
        }
        


        $orcamento->update();


        //redirecionamento para o home

        return redirect('/index_orcamentos');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orcamentos  $orcamentos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        orcamentos::destroy($id);
        return redirect('/index_orcamentos');
        }
    }
}
