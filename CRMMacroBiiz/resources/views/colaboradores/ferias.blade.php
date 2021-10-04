@extends('includes.app');


@section('conteudo')

    <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="row">
            <div class="col-6" style="align-self: flex-end;">
                <h2>{{$colaborador->nome}}</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="/nova_ferias/{{$colaborador->id_colaborador}}"><button class="btn btn-success" style="margin-left: 0.5em;" role="submit">Marcar Férias</button></a>
                    <a href="perfil_colaborador/{{$colaborador->id_colaborador}}"><button class="btn btn-secondary" style="margin-left: 0.5em;" role="submit">Voltar</button></a>
                </ol>
            </div>
        </div>
        </section>

        <section class="content">
            <div class="row col-12" style="margin-top: 1em;">
                <div class="form-group col-md-12" style="display: flex;">
                  <div class="card-body pad" style="padding: 0;">
                    <h5 style="padding-top:10px ">Mapa de Férias</h5>
                    <div class="form-group">


                        @php
                            require '../vendor/autoload.php';
                            $numMax = 22;
                            $ano = Carbon\Carbon::now()->year;
                            $holidays = Yasumi\Yasumi::create('Portugal', $ano);
                            $official = new Yasumi\Filters\OfficialHolidaysFilter($holidays->getIterator());
                            $holiday_list = array();

                            foreach ($official as $day) {
                                $data = Carbon\Carbon::create(date($day));
                                array_push($holiday_list, $data);
                            }
                        @endphp


                        <table id="example2" class="table table-bordered table-striped" style="margin: 0 !important;">
                            <thead>
                                    <tr>
                                    <th>Nº dias úteis </th>
                                    <th>Data de Ínicio</th>
                                    <th>Data de Fim</th>
                                    <th>Opções</th>
                                    
                                    </tr>
                            </thead>
                            <tbody>
                            @foreach ($ferias as $feria)
                            
                        
                                @php
                                    $start = Carbon\Carbon::parse($feria->data_inicio);
                                    $aux = $start;
                                    $end = Carbon\Carbon::parse($feria->data_fim);
                                    // array_push($holiday_list, Carbon\Carbon::today());
                                    $days = 1;

                                    while( $aux->notEqualTo($end) ){
                                        if ($aux->isWeekday()  && !in_array($aux, $holiday_list)) {
                                            $days +=1;
                                        }
                                        $aux->addDay();
                                    }

                                    // $days = $start->diffInDaysFiltered(function (Carbon $date) use ($holiday_list) {
                                    //             return $date->isWeekday() && !in_array($date, $holiday_list);
                                    // }, $end);

                                    //$days = (Carbon\Carbon::parse($feria->data_inicio))->diffInWeekdays(Carbon\Carbon::parse($feria->data_fim)) + 1;
                                    $numMax = $numMax - $days;
                                @endphp
                                
                                <tr>
                                    <!-- feria -->
                                    
                                    <td>{{ $days}}</td>
                                    <td><a>{{Carbon\Carbon::parse($feria->data_inicio)->format('Y-m-d')}}</a></td>
                                    <td><a>{{Carbon\Carbon::parse($feria->data_fim)->format('Y-m-d')}}</a></td>
        
        
                                    <!-- Opções -->
                                    <td>                                            
                                        <a href="editar_ferias/{{$feria->id_ferias}}">
                                            <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                        </a>
                                        {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                        <a href="eliminar_ferias/{{$feria->id_ferias}}">
                                            <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                        </a>
                                        {{-- ver cliente, apresentar as ferias os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                    </td>
                                </tr>
                            
                                
                            @endforeach
                            <tr>Nº de dias em falta: {{$numMax}}</tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </div>
    @endsection