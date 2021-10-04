@extends('includes.app');


@section('conteudo')

    <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="row">
            <div class="col-6" style="align-self: flex-end;">
                <h4>Dominios</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <a href="/nova_dominio"><button class="btn btn-success" role="submit" ><i class="fas fa-plus"></i> Inserir Dominio  </button></a>
                </ol>
            </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                            @if(count($dados) == 0)
                                <p class = "alert alert-danger">Não foram encontrados Dominios no Sistema</p>
                            @else
                            
                                <table id="example2" class="table table-bordered table-hover" style="margin: 0 !important;">
                                    <thead>
                                            <tr>
                                            <td>Nome_Cliente</td>
                                            <th>Descrição</th>
                                            <th>Data Inicio</th>
                                            <th>Data Final</th>
                                            <th>Status</th>
                                            <th>Opções</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($dados as $dominio)
                                       <tr>
                                        <!-- dominio -->
                                        @foreach ($cliente as $c)
                                            @if ($c->id_cliente == $dominio->id_cliente)
                                            <td>{{$c->nome}}</td>
                                            @endif
                                        @endforeach
                                        <td>{{$dominio->descricao}}</td>
                                        <td><a>{{Carbon\Carbon::parse($dominio->data_inicio)->format('Y-m-d')}}</a></td>
                                        <td><a>{{Carbon\Carbon::parse($dominio->data_fim)->format('Y-m-d')}}</a></td>
                                        @if ($dominio->status == 1)
                                            <td>Ativo</td>
                                            @else
                                            <td>Inativo</td>
                                            @endif
                                    

                                        <!-- Opções -->
                                        <td>                                            
                                            <a href="/editar_dominio/{{$dominio->id_dominio}}">
                                                <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                            </a>
                                            {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                            <a href="/eliminar_dominio/{{$dominio->id_dominio}}">
                                                <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                            </a>
                                            {{-- ver cliente, apresentar as dominio os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                            <a href="/vista_dominio/{{$dominio->id_dominio}}">
                                                <i class="fa fa-eye" style="padding-left: 1.5px; color: #212529"></i>
                                            </a>
                                        </td>
                                        </tr>
                                    
                                        
                                    @endforeach
                                    </tbody>
                                </tr>
                                </table>
                                        
                                        
                                        
                            @endif

                            </div>
                            <div class="card-header">
                                {{$dados->render()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
  <!-- /.content-wrapper -->
