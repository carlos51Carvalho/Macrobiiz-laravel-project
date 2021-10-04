<?php

namespace App\Http\Controllers;
use App\Models\cliente;
use App\Models\faturas;
use App\Models\outros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;


class OutrosController extends Controller
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
        $dados = outros::paginate(15);
        $cliente = cliente::all();
        return view('/outros/outros_index', compact('dados','cliente'));
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
        return view('/outros/outros_adicionar', compact('cliente'));
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
        $outro = new outros;
        $outro->id_cliente = $request->id_cliente_text;
        $outro->descricao = $request->descricao_text;
        $outro->data_inicio = $request->data_inicio_text;
        $outro->data_fim = $request->data_fim_text;

        //visivilidade
        if(isset($request->status_text)){
            $outro->status = 1;
        }
        else{
            $outro->status = 0;
        }

        $outro->save();


        //redirecionamento para o home

        return redirect('/index_outros');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $outro = outros::findOrFail($id);
        $c = cliente::findOrFail($outro->id_cliente);
        
        return view('/outros/outros_vista', compact('outro', 'c'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        $outro = outros::findOrFail($id);
        $cliente = cliente::all();
        $c= cliente::findOrFail($outro->id_cliente);
        return view('/outros/outros_edit', compact('outro','cliente','c'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
        $outro = outros::findOrFail($id);
        $outro->id_cliente = $request->id_cliente_text;
        $outro->descricao = $request->descricao_text;
        $outro->data_inicio = $request->data_inicio_text;
        $outro->data_fim = $request->data_fim_text;

        //visivilidade
        if(isset($request->status_text)){
            $outro->status = 1;
        }
        else{
            $outro->status = 0;
        }

        $outro->update();


        //redirecionamento para o home

        return redirect('/index_outros');
    }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
        outros::destroy($id);
        return redirect('/index_outros');
        }
    }
}
