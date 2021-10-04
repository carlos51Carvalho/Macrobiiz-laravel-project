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
                    <a href="/nova_faltas/{{$colaborador->id_colaborador}}"><button class="btn btn-success" style="margin-left: 0.5em;" role="submit">Assinalar Falta</button></a>
                    <a href="perfil_colaborador/{{$colaborador->id_colaborador}}"><button class="btn btn-secondary" style="margin-left: 0.5em;" role="submit">Voltar</button></a>
                </ol>
            </div>
        </div>
        </section>


        <section class="content">
            <div class="row col-12" style="margin-top: 1em;">
                <div class="form-group col-md-12" style="display: flex;">
                  <div class="card-body pad" style="padding: 0;">
                    <h5 style="padding-top:10px ">Faltas</h5>
                    <div class="form-group">

                        <table id="example2" class="table table-bordered table-striped" style="margin: 0 !important;">
                            <thead>
                                    <tr>
                                    <th>Mês:</th>
                                    <th>Janeiro</th>
                                    <th>Fevereiro</th>
                                    <th>Março</th>
                                    <th>Abril</th>
                                    <th>Maio</th>
                                    <th>Junho</th>
                                    <th>Julho</th>
                                    <th>Agosto</th>
                                    <th>Setembro</th>
                                    <th>Outubro</th>
                                    <th>Novembro</th>
                                    <th>Dezembro</th>
                                    </tr>
                            </thead>
                            <tbody>

                                <td>Nº Horas:</td>

                            @for($i = 1; $i < 13; $i++)
                                @php
                                    $n_horas =0;
                                @endphp            
                                @foreach ($faltas as $falta)
                                    @if (Carbon\Carbon::parse($falta->data_inicio)->month == $i)
                                        @php
                                            $n_horas += $falta->horas;
                                        @endphp  
                                    @endif
                                @endforeach
                                
                                <td>{{$n_horas}}</td>
                                
                            @endfor
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
            </section>






        
        
        <section class="content">
            <div class="row col-12" style="margin-top: 1em;">
                <div class="form-group col-md-12" style="display: flex;">
                  <div class="card-body pad" style="padding: 0;">
                    <h5 style="padding-top:10px ">Horas em Falta</h5>
                    <div class="form-group">

                        <table id="example2" class="table table-bordered table-striped" style="margin: 0 !important;">
                            <thead>
                                    <tr>
                                    <th>Descrição</th>
                                    <th>Data de Ínicio</th>
                                    <th>Data de Fim</th>
                                    <th>Nº de Horas</th>
                                    <th>Opções</th>
                                    
                                    </tr>
                            </thead>
                            <tbody>
                            @foreach ($faltas as $falta)

                                <tr>
                                    <!-- falta -->
                                    <td>{{$falta->descricao}}</td>
                                    <td><a>{{Carbon\Carbon::parse($falta->data_inicio)->format('Y-m-d')}}</a></td>
                                    <td><a>{{Carbon\Carbon::parse($falta->data_fim)->format('Y-m-d')}}</a></td>
                                    <td>{{$falta->horas}}</td>
        
        
                                    <!-- Opções -->
                                    <td>                                            
                                        <a href="editar_faltas/{{$falta->id_falta}}">
                                            <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                        </a>
                                        {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                        <a href="eliminar_faltas/{{$falta->id_falta}}">
                                            <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                        </a>
                                        {{-- ver cliente, apresentar as faltas os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                    </td>
                                </tr>
                            
                                
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </div>
    @endsection