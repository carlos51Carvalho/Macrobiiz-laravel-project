<?php

namespace App\Http\Controllers;

use App\Models\alertas;
use App\Models\cliente;
use App\Models\faturas;
use App\Models\dominios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;


class DominiosController extends Controller
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
        $dados = dominios::paginate(15);
        $cliente = cliente::all();
        return view('/dominios/dominios_index', compact('dados','cliente'));
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
        return view('/dominios/dominios_adicionar', compact('cliente'));
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
            'data_fim_text' => 'required|date|after_or_equal:data_inicio_text',
        ]);

        $dominio = new dominios;
        $dominio->id_cliente = $request->id_cliente_text;
        $dominio->descricao = $request->descricao_text;
        $dominio->data_inicio = $request->data_inicio_text;
        $dominio->data_fim = $request->data_fim_text;

        //visivilidade
        if(isset($request->status_text)){
            $dominio->status = 1;
        }
        else{
            $dominio->status = 0;
        }

        $dominio->save();


        //redirecionamento para o home

        return redirect('/index_dominios');
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
        $dominio = dominios::findOrFail($id);
        $c = cliente::findOrFail($dominio->id_cliente);
        
        return view('/dominios/dominios_vista', compact('dominio', 'c'));
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
        $dominio = dominios::findOrFail($id);
        $cliente = cliente::all();
        $c= cliente::findOrFail($dominio->id_cliente);
        return view('/dominios/dominios_edit', compact('dominio','cliente','c'));
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
            
            $dominio = dominios::findOrFail($id);
            
            $dominio->id_cliente = $request->id_cliente_text;
            $dominio->descricao = $request->descricao_text;
            $dominio->data_inicio = $request->data_inicio_text;
            $dominio->data_fim = $request->data_fim_text;
            
            //visivilidade
            if(isset($request->status_text)){
                $dominio->status = 1;
            }
            else{
                $dominio->status = 0;
            }
            
            
            
            $dominio->update();
            
            $today = Carbon::today();
            $d_final = $dominio->data_fim;
            $diffInDays = $today->diffInDays($d_final);
            
            if(DB::table('alertas')->where('id_dominio', $id)->exists() && $diffInDays > 30){
                $alerta = DB::table('alertas')->where('id_dominio', $id)->first();
                $id_alerta = $alerta->id_alerta;
                alertas::destroy($id_alerta);
            }

            //redirecionamento para o home

            return redirect('/index_dominios');
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
        dominios::destroy($id);
        return redirect('/index_dominios');
        }
    }


    // public function aviso()
    // {
    //     # code...
    //     $date = Carbon::now();
    //     $dominios = DB::table('dominios as d')
    //         ->select('d.data_fim', 'd.data_inicio')
    //         ->where(date_diff($date, $dominios->))



    //         // ->where('c.nome', 'LIKE', '%'.$query.'%')
    //         //     ->orWhere('c.morada', 'LIKE', '%'.$query.'%')
    //         //     ->orWhere('c.email', 'LIKE', '%'.$query.'%')
    // }
}
