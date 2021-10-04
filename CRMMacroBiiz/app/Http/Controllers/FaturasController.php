<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\faturas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;



class FaturasController extends Controller
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
        $dados = faturas::paginate(15);
        $cliente = cliente::all();
        return view('/faturas/faturas_index', compact('dados','cliente'));
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
        return view('/faturas/faturas_adicionar', compact('cliente'));
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
        $fatura = new faturas;
        $fatura->id_cliente = $request->id_cliente_text;
        $fatura->descricao = $request->descricao_text;
        
        if ($request->file('ficheiro') == "") {
            $file1 = "";
            $fatura->ficheiro = $file1;
        }

        else
        {
            $file2 = $request->file('ficheiro');
            $file2->move(public_path().'/faturas/',
                $file2->getClientOriginalName());
            $fatura->ficheiro=$file2->getClientOriginalName();
        }


        $fatura->save();


        //redirecionamento para o home

        return redirect('index_faturas');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\faturas  $faturas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $fatura = faturas::findOrFail($id);
        $c = cliente::findOrFail($fatura->id_cliente);
        
        return view('/faturas/faturas_vista', compact('fatura', 'c'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\faturas  $faturas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $fatura = faturas::findOrFail($id);
        $cliente = cliente::all();
        $c= cliente::findOrFail($fatura->id_cliente);
        return view('/faturas/faturas_edit', compact('fatura','cliente','c'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\faturas  $faturas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $fatura = faturas::findOrFail($id);
        $fatura->id_cliente = $request->id_cliente_text;
        $fatura->descricao = $request->descricao_text;

        if ($request->file('ficheiro_text') != "") {
            $file2 = $request->file('ficheiro_text');
            $file2->move(public_path().'/faturas/',
                $file2->getClientOriginalName());
            $fatura->ficheiro=$file2->getClientOriginalName();
        }
        


        $fatura->update();


        //redirecionamento para o home

        return redirect('/index_faturas');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\faturas  $faturas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{

        faturas::destroy($id);
        return redirect('/index_faturas');
        }
    }
}
