<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\faturas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

class ClienteController extends Controller
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
                $dados=DB::table('clientes as c')
                    ->select('c.id_cliente', 'c.nome','c.nif', 'c.morada',
                        'c.email', 'c.contacto', 'c.status')
                    ->where('c.nome', 'LIKE', '%'.$query.'%')
                    ->orWhere('c.morada', 'LIKE', '%'.$query.'%')
                    ->orWhere('c.email', 'LIKE', '%'.$query.'%')
                    ->paginate(15);
                    
                return view('clientes.clientes_index', [
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
            $dados = cliente::paginate(15);
            return view('/clientes/clientes_index', compact('dados'));
        }
    }

    public function indexI()
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $dados = cliente::all();
            return view('/clientes/clientes_indexIN', compact('dados'));
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
            //apresentar pagina com o formulario de criaçao de novo cliente
            return view('/clientes/clientes_adicionar');
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

        $aux = 0;

        if(!session()->has('login')){
            return view('users/login');
        }
        elseif($aux==0){

        //gravar uma novo cliente
            $cliente = new cliente;

            $cliente->nome = $request->nome_text;
            $cliente->nif = $request->nif_text;
            $cliente->morada = $request->morada_text;
            $cliente->email = $request->email_text;
            $cliente->contacto = $request->contacto_text;
            
            //visivilidade
            if(isset($request->status_text)){
                $cliente->status = 1;
            }
            else{
                $cliente->status = 0;
            }

            //salvar a cliente
            $cliente->save();

            //redirecionamento para o home

            $aux=1;

            return redirect('perfil_cliente/'.$cliente->id_cliente);
        }

        else if($aux ==1){

            return "1";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $cliente = cliente::findOrFail($id);
            $faturas = DB::table('faturas')->where('id_cliente', $id)->paginate(15);
            $dominios = DB::table('dominios')->where('id_cliente', $id)->paginate(15);
            $alojamentos = DB::table('alojamentos')->where('id_cliente', $id)->paginate(15);
            $orcamentos = DB::table('orcamentos')->where('id_cliente', $id)->paginate(15);
            $outros = DB::table('outros')->where('id_cliente', $id)->paginate(15);


            return view('/clientes/clientes_profile', compact('cliente','faturas','dominios', 'alojamentos','orcamentos','outros'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!session()->has('login')){
            return view('users/login');
        }
        else{
            $cliente = cliente::findOrFail($id);
            return view('/clientes/clientes_edit', compact('cliente'));
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
            $cliente = cliente::findOrFail($id);
            
            $cliente->nome = $request->nome_text;
            $cliente->nif = $request->nif_text;
            $cliente->morada = $request->morada_text;
            $cliente->email = $request->email_text;
            $cliente->contacto = $request->contacto_text;

            //visivilidade
            if(isset($request->status_text)){
                $cliente->status = 1;
            }
            else{
                $cliente->status = 0;
            }

            //salvar a cliente
            $cliente->update();


            //redirecionamento para o home

            return redirect('perfil_cliente/'.$cliente->id_cliente);
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
            cliente::destroy($id);
            return redirect('/');
        }
    }
}
