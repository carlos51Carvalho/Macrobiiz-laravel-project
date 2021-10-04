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
                    <a href="perfil_colaborador/{{$colaborador->id_colaborador}}"><button class="btn btn-secondary" style="margin-left: 0.5em;" role="submit">Voltar</button></a>
                </ol>
            </div>
        </div>
        </section>

        <section class="content">
            <div class="row col-12" style="margin-top: 1em;">
                <div class="form-group col-md-12" style="display: flex;">
                  <div class="card-body pad" style="padding: 0;">
                    <h5 style="padding-top:10px ">Vencimentos</h5>
                    <div class="form-group">
                    <table id="example2" class="table table-bordered table-striped" style="margin: 0 !important;">
                        <thead>
                                <tr>
                                <th>Data de vencimento</th>
                                <th>Ficheiro</th>
                                <th>Opções</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($vencimentos as $vencimento)

                        <tr>
                            <!-- vencimento -->
                            <td><a>{{Carbon\Carbon::parse($vencimento->data)->format('Y-m-d')}}</a></td>
                            <td>{{$vencimento->ficheiro}}</td>


                            <!-- Opções -->
                            <td>                                            
                                <a href="editar_vencimento/{{$vencimento->id_vencimento}}">
                                    <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                </a>
                                {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                <a href="eliminar_vencimento/{{$vencimento->id_vencimento}}">
                                    <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                                {{-- ver cliente, apresentar as vencimentos os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                <a href="vista_vencimento/{{$vencimento->id_vencimento}}">
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
                    <div class="card-header">
                        {{$vencimentos->render()}}
                    </div>
                    </div>



                    
                </div>
            </div>
        </section>
    </div>
@endsection