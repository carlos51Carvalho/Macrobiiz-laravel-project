<?php

namespace App\Http\Controllers;

use App\Models\alertas;
use App\Models\dominios;
use App\Models\alojamentos;
use App\Models\alertas_aloja;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use SebastianBergmann\Diff\Diff;

class AlertasController extends Controller
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

            $alertas = alertas::all();
            $alertasloj= alertas_aloja::all();
            $dominios = dominios::all();
            $alojamentos = alojamentos::all();
            return view('/tasks/task_index', compact('alertas','alertasloj', 'dominios','alojamentos'));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        if(!session()->has('login')){
            
            return view('users/login');
        }

        else{

        $alerta = alertas::findOrFail($id);
        return view('/alertas/alertas_edit', compact('alerta'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\alertas  $alertas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(!session()->has('login')){
            
            return view('users/login');
        }
        else{
            $alerta = alertas::findOrFail($id);
            
            //visivilidade
            if(isset($request->status_text)){
                $alerta->status = 1;
            }
            else{
                $alerta->status = 0;
            }

            //salvar a alerta
            $alerta->update();


            //redirecionamento para o home

            return redirect('admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\alertas  $alertas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!session()->has('login')){
            
            return view('users/login');
        }else{
            alertas::destroy($id);
            return redirect('admin');
        }
    }

    public function destroyA($id)
    {
        //
        if(!session()->has('login')){
            
            return view('users/login');
        }else{
            alertas_aloja::destroy($id);
            return redirect('admin');
        }
    }


}
