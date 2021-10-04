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
                    <a href="marcacao_faltas/{{$colaborador->id_colaborador}}"><button class="btn btn-success" role="submit">Faltas</button></a>
                    <a href="marcacao_ferias/{{$colaborador->id_colaborador}}"><button class="btn btn-success" role="submit">Férias</button></a>
                    <a href="folha_despesas/{{$colaborador->id_colaborador}}"><button class="btn btn-success" style="margin-left: 0.5em;" role="submit">Despesas</button></a>
                    <a href="folha_vencimentos/{{$colaborador->id_colaborador}}"><button class="btn btn-success" style="margin-left: 0.5em;"  role="submit">Vencimentos</button></a>
                    <a href="javascript:history.back()"><button class="btn btn-secondary" style="margin-left: 0.5em;" role="submit">Voltar</button></a>
                </ol>
            </div>
        </div>
        </section>

        <section class="content">
            <div class="row col-12" style="margin-top: 1em;">
                <div class="form-group col-md-12" style="display: flex;">
                  <div class="card-body pad" style="padding: 0;">
                    <div>
                    <label for="areanova">Morada: </label>{{$colaborador->morada}}
                    </div>
                    <div>
                    <label for="areanova">BI: </label>{{$colaborador->bi}}
                    </div>
                    <div>
                        <label for="areanova">NIF: </label>{{$colaborador->nif}}
                    </div>
                    <div>
                    <label for="areanova">NSS: </label>{{$colaborador->nss}}
                    </div>
                    <div>
                    <label for="areanova">Contacto: </label>{{$colaborador->contacto}}
                    </div>
                    <div>
                    <label for="areanova">Email: </label>{{$colaborador->email}}
                    </div>

                    <h5 style="padding-top:10px ">Contratos</h5>
                    <div class="form-group">
                    <table id="example2" class="table table-bordered table-striped" style="margin: 0 !important;">
                        <thead>
                                <tr>
                                <th>Descrição</th>
                                <th>Data Inicio</th>
                                <th>Data Final</th>
                                <th>Ficheiro</th>
                                <th>Opções</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($contratos as $contrato)

                        <tr>
                            <!-- contrato -->
                            <td>{{$contrato->descricao}}</td>
                            <td><a>{{Carbon\Carbon::parse($contrato->data_inicio)->format('Y-m-d')}}</a></td>
                            <td><a>{{Carbon\Carbon::parse($contrato->data_fim)->format('Y-m-d')}}</a></td>
                            <td>{{$contrato->ficheiro}}</td>


                            <!-- Opções -->
                            <td>                                            
                                <a href="editar_contrato/{{$contrato->id_contrato}}">
                                    <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                </a>
                                {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                <a href="eliminar_contrato/{{$contrato->id_contrato}}">
                                    <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                                {{-- ver cliente, apresentar as contratos os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                <a href="vista_contrato/{{$contrato->id_contrato}}">
                                    <i class="fa fa-eye" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                                <a href="/contratos/{{$contrato->ficheiro}}" download>
                                    <i class="fa fa-file-download" style="padding-left: 5px; color: #212529"></i>
                                </a>
                            </td>
                            </tr>
                        
                            
                        @endforeach
                        </tbody>
                    </tr>
                    </table>
                    <div class="card-header">
                        {{$contratos->render()}}
                    </div>
                    </div>


                    <h5 style="padding-top:10px ">Seguros</h5>
                    <div class="form-group">
                    <table id="example2" class="table table-bordered table-striped" style="margin: 0 !important;">
                        <thead>
                                <tr>
                                <th>Descrição</th>
                                <th>Data Inicio</th>
                                <th>Data Final</th>
                                <th>Ficheiro</th>
                                <th>Opções</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($seguros as $seguro)

                        <tr>
                            <!-- seguro -->
                            <td>{{$seguro->descricao}}</td>
                            <td><a>{{Carbon\Carbon::parse($seguro->data_inicio)->format('Y-m-d')}}</a></td>
                            <td><a>{{Carbon\Carbon::parse($seguro->data_fim)->format('Y-m-d')}}</a></td>
                            <td>{{$seguro->ficheiro}}</td>


                            <!-- Opções -->
                            <td>                                            
                                <a href="editar_seguro/{{$seguro->id_seguro}}">
                                    <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                </a>
                                {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                <a href="eliminar_seguro/{{$seguro->id_seguro}}">
                                    <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                                {{-- ver cliente, apresentar as seguros os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                <a href="vista_seguro/{{$seguro->id_seguro}}">
                                    <i class="fa fa-eye" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                                <a href="/seguros/{{$seguro->ficheiro}}" download>
                                    <i class="fa fa-file-download" style="padding-left: 5px; color: #212529"></i>
                                </a>
                            </td>
                            </tr>
                        
                            
                        @endforeach
                        </tbody>
                    </tr>
                    </table>
                    <div class="card-header">
                        {{$seguros->render()}}
                    </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
  <!-- /.content-wrapper -->
