<?php

namespace App\Http\Controllers;

use App\Models\alertas_aloja;
use App\Models\cliente;
use App\Models\faturas;
use App\Models\alojamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;


class AlojamentosController extends Controller
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
            $dados = alojamentos::paginate(15);
            $cliente = cliente::all();
            return view('/alojamentos/alojamentos_index', compact('dados','cliente'));
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
            return view('/alojamentos/alojamentos_adicionar', compact('cliente'));
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
            $alojamento = new alojamentos;
            $alojamento->id_cliente = $request->id_cliente_text;
            $alojamento->descricao = $request->descricao_text;
            $alojamento->data_inicio = $request->data_inicio_text;
            $alojamento->data_fim = $request->data_fim_text;

            //visivilidade
            if(isset($request->status_text)){
                $alojamento->status = 1;
            }
            else{
                $alojamento->status = 0;
            }

            $alojamento->save();


            //redirecionamento para o home

            return redirect('/index_alojamentos');
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
        }else{
        $alojamento = alojamentos::findOrFail($id);
        $c = cliente::findOrFail($alojamento->id_cliente);
        
        return view('/alojamentos/alojamentos_vista', compact('alojamento', 'c'));
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
            $alojamento = alojamentos::findOrFail($id);
            $cliente = cliente::all();
            $c= cliente::findOrFail($alojamento->id_cliente);
            return view('/alojamentos/alojamentos_edit', compact('alojamento','cliente','c'));
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
            $alojamento = alojamentos::findOrFail($id);

            $alojamento->id_cliente = $request->id_cliente_text;
            $alojamento->descricao = $request->descricao_text;
            $alojamento->data_inicio = $request->data_inicio_text;
            $alojamento->data_fim = $request->data_fim_text;
            
            //visivilidade
            if(isset($request->status_text)){
                $alojamento->status = 1;
            }
            else{
                $alojamento->status = 0;
            }
            
            $alojamento->update();
            
            $today = Carbon::today();
            $d_final = $alojamento->data_fim;
            $diffInDays = $today->diffInDays($d_final);

            if(DB::table('alertas_alojas')->where('id_alojamento', $id)->exists() && $diffInDays > 30){
                $alerta = DB::table('alertas_alojas')->where('id_alojamento', $id)->first();
                $id_alerta = $alerta->id_alerta;
                alertas_aloja::destroy($id_alerta);
            }

            //redirecionamento para o home

            return redirect('/index_alojamentos');
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
            alojamentos::destroy($id);
            return redirect('/index_alojamentos');
        }
    }


    // public function aviso()
    // {
    //     # code...
    //     $date = Carbon::now();
    //     $alojamentos = DB::table('alojamentos as d')
    //         ->select('d.data_fim', 'd.data_inicio')
    //         ->where(date_diff($date, $alojamentos->))



    //         // ->where('c.nome', 'LIKE', '%'.$query.'%')
    //         //     ->orWhere('c.morada', 'LIKE', '%'.$query.'%')
    //         //     ->orWhere('c.email', 'LIKE', '%'.$query.'%')
    // }
}
