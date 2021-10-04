@extends('includes.app');


@section('conteudo')

    <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="row">
            <div class="col-6" style="align-self: flex-end;">
                <h4>Colaboradores</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <a href="novo_colaborador"><button class="btn btn-success" role="submit" ><i class="fas fa-plus"></i> Inserir Colaborador  </button></a>
                {{-- <a href="#"><button class="btn btn-success" style="margin-left: 0.5em; padding: 10px;" role="submit"><i class="far fa-lightbulb"></i></button></a> --}}
                    {{-- <button type="submit" class="btn btn-success" name="changeStatus" value="0"><i class="fas fa-lightbulb" value="1"></button> --}}
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
                            <div class="card-header">
                                @include('includes.searchColaborador')
                            </div>
                            <div class="card-body table-responsive p-0">
                            @if(count($dados) == 0)
                                <p class = "alert alert-danger">Não foram encontrados colaboradors</p>
                            @else
                                {{-- apresentar as noticias existentes na bd --}}
                            
                                <table id="example2" class="table table-bordered table-hover" style="margin: 0 !important;">
                                    <thead>
                                            <tr>
                                            <th>Nome</th>
                                            <th>BI</th>
                                            <th>Nif</th>
                                            <th>NSS</th>
                                            <th>Morada</th>
                                            <th>email</th>
                                            <th>Contacto</th>
                                            <th>Opções</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($dados as $colaborador)
                                        
       
                                        <tr>
                                            <!-- Nome colaborador -->
                                            <td>{{$colaborador->nome}}</td>
                                            <td>{{$colaborador->bi}}</td>
                                            <td>{{$colaborador->nif}}</td>
                                            <td>{{$colaborador->nss}}</td>
                                            <td>{{$colaborador->morada}}</td>
                                            <td>{{$colaborador->email}}</td>
                                            <td>{{$colaborador->contacto}}</td>
                                            
                                            
                                            <!-- Opções -->
                                            <td>                                            
                                                <a href="editar_colaborador/{{$colaborador->id_colaborador}}">
                                                    <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                                </a>
                                                
                                                {{-- ver colaborador, apresentar as faturas os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                                <a href="perfil_colaborador/{{$colaborador->id_colaborador}}">
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
