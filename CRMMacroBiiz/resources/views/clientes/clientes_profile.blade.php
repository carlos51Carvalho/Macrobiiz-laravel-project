@extends('includes.app');


@section('conteudo')

    <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="row">
            <div class="col-6" style="align-self: flex-end;">
                <h2>{{$cliente->nome}}</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="/"><button class="btn btn-secondary" style="margin-left: 0.5em;" role="submit">Voltar</button></a>
                </ol>
            </div>
        </div>
        </section>

        <section class="content">
            <div class="row col-12" style="margin-top: 1em;">
                <div class="form-group col-md-12" style="display: flex;">
                  <div class="card-body pad" style="padding: 0;">
                    <div>
                    <label for="areanova">Morada: </label>{{$cliente->morada}}
                    </div>
                    <div>
                    <label for="areanova">Nif: </label>{{$cliente->nif}}
                    </div>
                    <div>
                    <label for="areanova">Contacto: </label>{{$cliente->contacto}}
                    </div>
                    <div>
                    <label for="areanova">Email: </label>{{$cliente->email}}
                    </div>


                    @if ($cliente->status == 1)
                        <label for="areanova">Status: </label>Activo
                    @else
                        <label for="areanova">Status: </label>Inativo
                    @endif

                    <h5 style="padding-top:10px ">Faturas</h5>
                    <div class="form-group">

                    <table id="example2" class="table table-bordered table-striped" style="margin: 0 !important;">
                        <thead>
                                <tr>
                                <th>Descrição</th>
                                <th>Ficheiro</th>
                                <th>Data</th>
                                <th>Opções</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($faturas as $fatura)

                        <tr>
                            <!-- Fatura -->
                            <td>{{$fatura->descricao}}</td>
                            <td>{{$fatura->ficheiro}}</td>
                            <td><a>{{Carbon\Carbon::parse($fatura->created_at)->format('Y-m-d')}}</a></td>
                            {{-- <td>{{$fatura->updated_at->diffForHumans()}}</td> --}}


                            <!-- Opções -->
                            <td>                                            
                                <a href="editar_fatura/{{$fatura->id_fatura}}">
                                    <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                </a>
                                {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                <a href="eliminar_fatura/{{$fatura->id_fatura}}">
                                    <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                                {{-- ver cliente, apresentar as faturas os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                <a href="vista_fatura/{{$fatura->id_fatura}}">
                                    <i class="fa fa-eye" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                                <a href="/faturas/{{$fatura->ficheiro}}" download>
                                    <i class="fa fa-file-download" style="padding-left: 5px; color: #212529"></i>
                                </a>
                            </td>
                            </tr>
                        
                            
                        @endforeach
                        </tbody>
                    </tr>
                    </table>
                        <div class="card-header">
                            {{$faturas->render()}}
                        </div>
                    </div>





                    <h5 style="padding-top:10px ">Dominios</h5>
                    <div class="form-group">
                    <table id="example2" class="table table-bordered table-striped" style="margin: 0 !important;">
                        <thead>
                                <tr>
                                <th>Descrição</th>
                                <th>Data Inicio</th>
                                <th>Data Final</th>
                                <th>Status</th>
                                <th>Opções</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($dominios as $dominio)

                        <tr>
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
                <div class="card-header">
                    {{$dominios->render()}}
                </div>
            </div>


            <h5 style="padding-top:10px ">Alojamentos</h5>
                    <div class="form-group">
                    <table id="example2" class="table table-bordered table-striped" style="margin: 0 !important;">
                        <thead>
                                <tr>
                                <th>Descrição</th>
                                <th>Data Inicio</th>
                                <th>Data Final</th>
                                <th>Status</th>
                                <th>Opções</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($alojamentos as $alojamento)

                        <tr>
                            <td>{{$alojamento->descricao}}</td>
                            <td><a>{{Carbon\Carbon::parse($alojamento->data_inicio)->format('Y-m-d')}}</a></td>
                            <td><a>{{Carbon\Carbon::parse($alojamento->data_fim)->format('Y-m-d')}}</a></td>
                            @if ($alojamento->status == 1)
                                <td>Ativo</td>
                            @else
                                <td>Inativo</td>
                            @endif
                                    

                            <!-- Opções -->
                            <td>                                            
                                <a href="/editar_alojamento/{{$alojamento->id_alojamento}}">
                                     <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                </a>
                                {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                <a href="/eliminar_alojamento/{{$alojamento->id_alojamento}}">
                                    <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                                {{-- ver cliente, apresentar as alojamento os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                <a href="/vista_alojamento/{{$alojamento->id_alojamento}}">
                                    <i class="fa fa-eye" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                            </td>
                       </tr>
                                    
                                        
                    @endforeach
                </tbody>
                </tr>
                </table>
                <div class="card-header">
                    {{$alojamentos->render()}}
                </div>
            </div>


            <h5 style="padding-top:10px ">Outros</h5>
                    <div class="form-group">
                    <table id="example2" class="table table-bordered table-striped" style="margin: 0 !important;">
                        <thead>
                                <tr>
                                <th>Descrição</th>
                                <th>Data Inicio</th>
                                <th>Data Final</th>
                                <th>Status</th>
                                <th>Opções</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($outros as $outro)

                        <tr>
                            <td>{{$outro->descricao}}</td>
                            <td><a>{{Carbon\Carbon::parse($outro->data_inicio)->format('Y-m-d')}}</a></td>
                            <td><a>{{Carbon\Carbon::parse($outro->data_fim)->format('Y-m-d')}}</a></td>
                            @if ($outro->status == 1)
                                <td>Ativo</td>
                            @else
                                <td>Inativo</td>
                            @endif
                                    

                            <!-- Opções -->
                            <td>                                            
                                <a href="/editar_outro/{{$outro->id_outro}}">
                                     <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                </a>
                                {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                <a href="/eliminar_outro/{{$outro->id_outro}}">
                                    <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                                {{-- ver cliente, apresentar as outro os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                <a href="/vista_outro/{{$outro->id_outro}}">
                                    <i class="fa fa-eye" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                            </td>
                       </tr>
                                    
                                        
                    @endforeach
                </tbody>
                </tr>
                </table>
                <div class="card-header">
                    {{$outros->render()}}
                </div>
            </div>

            <h5 style="padding-top:10px ">Orçamentos</h5>
                    <div class="form-group">
                    <table id="example2" class="table table-bordered table-striped" style="margin: 0 !important;">
                        <thead>
                                <tr>
                                <th>Descrição</th>
                                <th>Ficheiro</th>
                                <th>Data</th>
                                <th>Opções</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($orcamentos as $orcamento)

                        <tr>
                            <!-- orcamento -->
                            <td>{{$orcamento->descricao}}</td>
                            <td>{{$orcamento->ficheiro}}</td>
                            <td><a>{{Carbon\Carbon::parse($orcamento->created_at)->format('Y-m-d')}}</a></td>
                            {{-- <td>{{$orcamento->updated_at->diffForHumans()}}</td> --}}


                            <!-- Opções -->
                            <td>                                            
                                <a href="editar_orcamento/{{$orcamento->id_orcamento}}">
                                    <i class="fa fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                </a>
                                {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                <a href="eliminar_orcamento/{{$orcamento->id_orcamento}}">
                                    <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                                {{-- ver cliente, apresentar as orcamentos os orçamentos que lhe fizeram e os trabalho que ele realizou --}}
                                <a href="vista_orcamento/{{$orcamento->id_orcamento}}">
                                    <i class="fa fa-eye" style="padding-left: 1.5px; color: #212529"></i>
                                </a>
                                <a href="/orcamentos/{{$orcamento->ficheiro}}" download>
                                    <i class="fa fa-file-download" style="padding-left: 5px; color: #212529"></i>
                                </a>
                            </td>
                            </tr>
                        
                            
                        @endforeach
                        </tbody>
                    </tr>
                    </table>
                    <div class="card-header">
                        {{$orcamentos->render()}}
                    </div>
                </div>
        </div>
        </div>
        </div>
        </section>
    </div>
@endsection
  <!-- /.content-wrapper -->
