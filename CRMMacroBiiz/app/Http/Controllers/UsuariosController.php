<?php

namespace App\Http\Controllers;

use App\Classes\minhaClasse;
use App\Models\usuarios;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Models\alertas;
use App\Models\dominios;
use App\Models\alojamentos;
use App\Models\alertas_aloja;
use Illuminate\Contracts\Session\Session as SessionSession;

class UsuariosController extends Controller
{
    //

    public function index($request)
    {
        if(!session()->has('login')){
            return $this->logForm();
        }
        else{
            return redirect('admin');
        }
    }

    public function logForm()
    {
        //apresentar o formulario login
        return view('users/login');
    }


    public function loginExec(Request $request)
    {
        $this->validate($request,[
            'text_nome' => 'required | between:3,30',
            'text_password' => 'between:6,15',
        ]);

        //verificar se o usuario existe

        $usuario = usuarios::where('nome', "=", $request->text_nome) ->get();

        $user = usuarios::where('nome', $request->text_nome)->first();

        if($usuario->count() == 0){
            $erros_bd = ['Nome de usuário não existente'];
            return view('users/login', compact('erros_bd'));
        }

        //verifica se a senha corresponde ao guardado na bd
        if(!Hash::check($request->text_password,$user->password)){
            $erros_bd = ['A senha está incorreta.'];
            return view('users/login', compact('erros_bd'));
        }

        if($user->status == false){
            $erros_bd = ['Não tem permissão para aceder à aplicação'];
            return view('users/login', compact('erros_bd'));
        }

        //Abrir Sessão do Usuário
        session()->put('login', 'Sim');
        session()->put('descricao', $user->descricao);

        $alertas = alertas::all();
        $alertasloj= alertas_aloja::all();
        $dominios = dominios::all();
        $alojamentos = alojamentos::all();
        return redirect('admin');

    }

    public function CriarConta()
    {
        return view('users/criar');
    }

    public function store(Request $request){

        $users = usuarios::all();

        $this->validate($request,[
            'text_nome' => 'required | between:3,30',
            'text_password' => 'required | between:6,15',
            'text_password_rep' => 'required| same:text_password',
            'text_email' => 'required| email',
        ]);


        if($users->count() == 0 && $request->text_email == "hugoteixeira@macrobiiz.com"){
            $usuario = new usuarios;
            $usuario->nome = $request->text_nome;
            $usuario->password = Hash::make($request->text_password);
            $usuario->email = $request->text_email;
            $usuario->descricao = 'admin';
            $usuario->status = true;

            $usuario->save();
        }
        else if($users->count() == 0 && $request->text_email != "hugoteixeira@macrobiiz.com"){
            $erros_bd = ['De momento é impossível criar conta'];
            return view('users/criar', compact('erros_bd'));
        }
        else{
            $dados = usuarios::where('nome', "=",$request->text_nome)
                                ->orWhere('email', "=", $request->text_email)
                                ->get();

            if($dados->count() != 0){
                $erros_bd = ['Nome ou email já registado'];
                return view('users/criar', compact('erros_bd'));
            }

            $usuario = new usuarios;
            $usuario->nome = $request->text_nome;
            $usuario->password = Hash::make($request->text_password);
            $usuario->email = $request->text_email;

            $usuario->save();
        }

        return redirect('login');
        
    }

    public function RecuperarConta()
    {
        return view('users/recuperar');
    }

    public function Recuperacao(Request $request)
    {
        $this->validate($request,[
            'text_email' => 'required| email',
            'text_password' => 'required | between:6,15',
            'text_password_rep' => 'required| same:text_password',
        ]);

        $usuario = usuarios::where('email', "=", $request->text_email)->get();
        if($usuario->count() == 0){
            $erros_bd = ['O email introduzido não está associado a nenhuma conta existente.'];
            return view('users/recuperar', compact('erros_bd'));
        }


        $usuario = $usuario->first();
        $usuario->password = Hash::make($request->text_password);
        $usuario->update();  

        return redirect('login');
    }

    public function logout()
    {
        session()->flush();
        return redirect('admin');
    }










    //-------------------------------------------------------------------

    public function indexUsers(){
        
        if(!session()->has('login')){
            
            return view('users/login');
        }
        else if(session()->has('login') && session()->get('descricao') == 'admin'){
            $dados = usuarios::paginate(15);
            return view('users/usuarios_index', compact('dados'));
        }
        else{
            return redirect('admin');
        }

    }

    public function editUser($id)
    {
        if(!session()->has('login')){
            return view('users/login');
        }
        
        else if(session()->has('login') && session()->get('descricao') == 'admin'){
            $usuario = usuarios::findOrFail($id);
            return view('/users/usuarios_edit', compact('usuario'));
        }
        else{
            return redirect('admin');
        }
    }

    public function updateUser(Request $request, $id)
    {
        //
        if(!session()->has('login') && session()->get('descricao') == 'admin'){
            return view('users/login');
        }
        else if(session()->has('login') && session()->get('descricao') == 'admin'){
    
            
            $usuario = usuarios::findOrFail($id);

            
            //verifica se o nome ou email foram alterados
            if($request->nome_text != $usuario->nome | $request->email_text != $usuario->email ){
                
                $this->validate($request,[
                    'nome_text' => 'required | between:3,30',
                    'email_text' => 'required| email',
                ]);

                $dados = usuarios::where('nome',$request->nome_text)
                            ->get();
                
                $dados1 = usuarios::where('email',$request->email_text)
                            ->get();

                //verifica se o nome e o email foram os dois alterados e nao constam na bd
                if($dados->count() == 0 && $dados1->count() == 0){
                    
                    $usuario->nome = $request->nome_text;
                    $usuario->email = $request->email_text;
                    $this->updateDesStat($usuario,$request);
                    $usuario->update();
                    return redirect('index_users');
                }

                //verifica que o nome_text não existe na BD e que o email_text existe
                else if($dados->count() == 0 && $dados1->count() != 0){

                    //verifica se o email text mudou 
                    if($request->email_text != $usuario->email){
                        $erros_bd =['Email inserido já registado com outro utilizador'];
                        $exitCode = Artisan::call('view:clear');
                        return view('users/usuarios_edit', compact('usuario','erros_bd'));
                    }
                    else{
                        $usuario->nome = $request->nome_text;
                        $this->updateDesStat($usuario,$request);
                        $usuario->update();
                        return redirect('index_users');
                    }
                }
                
                //verifica que o email_text não existe na BD e que o nome_text existe
                else if($dados->count() != 0 && $dados1->count() == 0){

                    //verifica se o nome text mudou
                    if($request->nome_text != $usuario->nome){
                        $erros_bd =['Nome inserido já registado com outro utilizador'];
                        $exitCode = Artisan::call('view:clear');
                        return view('users/usuarios_edit', compact('usuario','erros_bd'));

                    }
                    else{
                        $usuario->email = $request->email_text;
                        $this->updateDesStat($usuario,$request);
                        $usuario->update();
                        return redirect('index_users');
                    }
                }
                else{
                    $erros_bd = ['Nome ou email escolhidos já registados com outro utilizador!'];
                    $exitCode = Artisan::call('view:clear');
                    return view('includes.erros', compact('erros_bd'));
                }   
            
            }
            else{ 
                $this->updateDesStat($usuario,$request);
                $usuario->update();
                return redirect('index_users');
            }   
        }
        else{
            return redirect('admin');
        }


    }



    public function updateDesStat(usuarios $usuario, Request $request)
    {

        $usuario->descricao = $request->descricao_text;

        if($request->text_password != "" ){
            $this->validate($request,[
                'text_password' => 'sometimes|between:6,15',
                'text_password_rep' => 'sometimes|same:text_password'
            ]);
            $usuario->password = Hash::make($request->text_password);
        }
                    
        //visivilidade
        if(isset($request->status_text)){
            $usuario->status = 1;
        }
        else{
            $usuario->status = 0;
        }
    }




    public function destroyUser($id)
    {
        if(!session()->has('login') ){
            return view('users/login');
        }
        else if(session()->has('login') && session()->get('descricao') == 'admin'){
            usuarios::destroy($id);
            return redirect('index_users');
        }
        else{
            return redirect('admin');
        }
    }

}

