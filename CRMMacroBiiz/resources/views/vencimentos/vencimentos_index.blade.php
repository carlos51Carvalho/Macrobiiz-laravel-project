@extends('includes.app');


@section('conteudo')

    <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="row">
            <div class="col-6" style="align-self: flex-end;">
                <h4>Vencimentos</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <a href="/nova_vencimento"><button class="btn btn-success" role="submit" ><i class="fas fa-plus"></i> Inserir vencimento  </button></a>
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
                                <p class = "alert alert-danger">Não foram encontradas vencimentos no Sistema</p>
                            @else
                            
                                <table id="example2" class="table table-bordered table-hover" style="margin: 0 !important;">
                                    <thead>
                                            <tr>
                                            <td>Nome_colaborador</td>
                                            <th>Data de vencimento</th>
                                            <th>Ficheiro</th>
                                            <th>Opções</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($dados as $vencimento)
                                       <tr>
                                        <!-- vencimento -->
                                        @foreach ($colaborador as $c)
                                            @if ($c->id_colaborador == $vencimento->id_colaborador)
                                            <td>{{$c->nome}}</td>
                                            @endif
                                        @endforeach
                                        <td><a>{{Carbon\Carbon::parse($vencimento->data)->format('Y-m-d')}}</a></td>
                                        <td>{{$vencimento->ficheiro}}</td>
                                    

                                        <!-- Opções -->
                                        <td>                                            
                                            <a href="/editar_vencimento/{{$vencimento->id_vencimento}}">
                                                <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                            </a>
                                            {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                            <a href="/eliminar_vencimento/{{$vencimento->id_vencimento}}">
                                                <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                            </a>
                                            {{-- ver colaborador, apresentar as vencimento os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                            <a href="/vista_vencimento/{{$vencimento->id_vencimento}}">
                                                <i class="fa fa-eye" style="padding-left: 1.5px; color: #212529"></i>
                                            </a>

                                            <a href="/vencimentos/{{$vencimento->ficheiro}}" download>
                                                <i class="fa fa-file-download" style="padding-left: 5px; color: #212529"></i>
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
