<?php

namespace App\Http\Controllers;

use App\Models\colaboradores;
use App\Models\ferias;
use App\Models\faltas;
use App\Models\vencimentos;
use App\Models\despesas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

class ColaboradoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function teste(Request $request){

        if(!session()->has('login')){
            return view('users/login');
        }
        else{

            if($request){
                $query=trim($request->get('searchText'));
                $dados=DB::table('colaboradores as c')
                    ->select('c.id_colaborador', 'c.nome','c.nif','c.nss','c.bi', 'c.morada',
                        'c.email', 'c.contacto')
                    ->where('c.nome', 'LIKE', '%'.$query.'%')
                    ->orWhere('c.morada', 'LIKE', '%'.$query.'%')
                    ->orWhere('c.email', 'LIKE', '%'.$query.'%')
                    ->orWhere('c.nif', 'LIKE', '%'.$query.'%')
                    ->orWhere('c.nss', 'LIKE', '%'.$query.'%')
                    ->orWhere('c.bi', 'LIKE', '%'.$query.'%')
                    ->paginate(15);
                    
                return view('colaboradores.colaboradores_index', [
                    "dados"=>$dados, "searchText"=>$query
                ]);
            }
        }
    } 

    public function index()
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $dados = colaboradores::paginate(15);
            return view('/colaboradores/colaboradores_index', compact('dados'));
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            //apresentar pagina com o formulario de criaçao de novo colaboradores
            return view('/colaboradores/colaboradores_adicionar');
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
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            //gravar uma novo colaborador
            $colaborador = new colaboradores;

            $colaborador->nome = $request->nome_text;
            $colaborador->morada = $request->morada_text;
            $colaborador->bi = $request->bi_text;
            $colaborador->nif = $request->nif_text;
            $colaborador->nss = $request->nss_text;
            $colaborador->email = $request->email_text;
            $colaborador->contacto = $request->contacto_text;
            
        

            //salvar a colaborador
            $colaborador->save();

            //redirecionamento para o home

            return redirect('index_colaborador');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $colaborador = colaboradores::findOrFail($id);
            $contratos = DB::table('contratos')->where('id_colaborador', $id)->paginate(15);
            $seguros = DB::table('seguros')->where('id_colaborador', $id)->paginate(15);
            $despesas = DB::table('despesas')->where('id_colaborador', $id)->paginate(15);
            $vencimentos = DB::table('vencimentos')->where('id_colaborador', $id)->paginate(15);


            return view('/colaboradores/colaboradores_profile', compact('colaborador','contratos','seguros','despesas', 'vencimentos'));
        }
    }


    public function showVencimentos($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $colaborador = colaboradores::findOrFail($id);
            $vencimentos = DB::table('vencimentos')->where('id_colaborador', $id)->paginate(15);
            return view('/colaboradores/vencimentos', compact('colaborador','vencimentos'));
        }
    }

    //showDespesas

    public function showDespesas($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $colaborador = colaboradores::findOrFail($id);
            $despesas = DB::table('despesas')->where('id_colaborador', $id)->paginate(15);
            return view('/colaboradores/despesas', compact('colaborador','despesas'));
        }
    }

    public function showFerias($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $colaborador = colaboradores::findOrFail($id);
            $ferias = DB::table('ferias')->where('id_colaborador', $id)->paginate(15);
            return view('/colaboradores/ferias', compact('colaborador','ferias'));
        }
    }


    public function showFaltas($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $colaborador = colaboradores::findOrFail($id);
            $faltas = DB::table('faltas')->where('id_colaborador', $id)->paginate(15);
            return view('/colaboradores/faltas', compact('colaborador','faltas'));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $colaborador = colaboradores::findOrFail($id);
            return view('/colaboradores/colaboradores_edit', compact('colaborador'));
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
            $colaborador = colaboradores::findOrFail($id);
            
            $colaborador->nome = $request->nome_text;
            $colaborador->bi = $request->bi_text;
            $colaborador->nif = $request->nif_text;
            $colaborador->nss = $request->nss_text;
            $colaborador->morada = $request->morada_text;
            $colaborador->email = $request->email_text;
            $colaborador->contacto = $request->contacto_text;

            //salvar a colaborador
            $colaborador->update();


            //redirecionamento para o home

            return redirect('index_colaborador');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            colaboradores::destroy($id);
            return redirect('index_colaborador');
        }
    }
}
