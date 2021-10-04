<?php

namespace App\Console\Commands;
use App\Models\alertas;
use App\Models\alertas_aloja;
use App\Models\dominios;
use App\Models\alojamentos;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StoreOnAlertas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:storeAlertas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Povoava a Migração de Alertas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('alertas')->delete();

        $today = Carbon::today();
        $dominios = dominios::all();
            
        foreach($dominios as $dominio){
            $d_final = $dominio->data_fim;
            $diffInDays = $today->diffInDays($d_final);

            if($d_final>$today && $diffInDays<=30 ){
                $alerta = new alertas;
                $alerta->id_dominio = $dominio->id_dominio;
                $alerta->save();
            }
        }

        DB::table('alertas_alojas')->delete();
        $alojamentos = alojamentos::all();
            
        foreach($alojamentos as $alojamento){
            $d_final = $alojamento->data_fim;
            $diffInDays = $today->diffInDays($d_final);

            if($d_final>$today && $diffInDays<=30 ){
                $alertal = new alertas_aloja;
                $alertal->id_alojamento = $alojamento->id_alojamento;
                $alertal->save();
            }
        }
    }
}
