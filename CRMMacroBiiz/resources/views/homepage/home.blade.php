@extends('includes.app');


@section('conteudo')

    <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="row">
            <div class="col-6" style="align-self: flex-end;">
                <h4>Home</h4>
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
                            @if(count($alertas) == 0)
                                <p class = "alert alert-danger">Não foram encontrados Dominios no Sistema</p>
                            @else
                            
                                <table id="example2" class="table table-bordered table-hover" style="margin: 0 !important;">
                                    <thead>
                                            <tr>
                                            <td>Dominio</td>
                                            <th>Data Final</th>
                                            <th>Dias</th>
                                            <th>Opções</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($alertas->reverse() as $alerta)

                                       <tr>
                                        <!-- dominio -->
                                        @foreach ($dominios as $dominio)
                                            @if ($alerta->id_dominio == $dominio->id_dominio)
                                            <td>{{$dominio->descricao}}</td>
                                            <td><a>{{Carbon\Carbon::parse($dominio->data_fim)->format('Y-m-d')}}</a></td>
                                            {{-- @php
                                                $d_final = $dominio->data_fim;
                                                $diffInDays = ({{Carbon\Carbon::today()}}) ->diffInDays($d_final); 
                                            @endphp --}}
                                            <td>{{(Carbon\Carbon::today()) ->diffInDays($dominio->data_fim);}}</td>
                                            @endif
                                        @endforeach

                                        <!-- Opções -->
                                        <td>  
                                            {{-- editar dominio --}}                                      
                                            <a href="editar_dominio/{{$alerta->id_dominio}}">
                                                <i class="fas fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                            </a>
                                            {{-- elimiar alerta --}}
                                            <a href="eliminar_alerta/{{$alerta->id_alerta}}">
                                                <i class="fas fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                            </a>
                                        </td>
                                        </tr>
                                    
                                        
                                    @endforeach
                                    </tbody>
                                </tr>
                                </table>
                                        
                                        
                                        
                            @endif

                            </div>
                        </div>
                    </div>
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
                            @if(count($alertasloj) == 0)
                                <p class = "alert alert-danger">Não foram encontrados alojamentos no Sistema</p>
                            @else
                            
                                <table id="example2" class="table table-bordered table-hover" style="margin: 0 !important;">
                                    <thead>
                                            <tr>
                                            <td>Alojamento</td>
                                            <th>Data Final</th>
                                            <th>Dias</th>
                                            <th>Opções</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($alertasloj->reverse() as $alertal)

                                       <tr>
                                        <!-- alojamento -->
                                        @foreach ($alojamentos as $alojamento)
                                            @if ($alertal->id_alojamento == $alojamento->id_alojamento)
                                            <td>{{$alojamento->descricao}}</td>
                                            <td><a>{{Carbon\Carbon::parse($alojamento->data_fim)->format('Y-m-d')}}</a></td>
                                            {{-- @php
                                                $d_final = $alojamento->data_fim;
                                                $diffInDays = ({{Carbon\Carbon::today()}}) ->diffInDays($d_final); 
                                            @endphp --}}
                                            <td>{{(Carbon\Carbon::today()) ->diffInDays($alojamento->data_fim);}}</td>
                                            @endif
                                        @endforeach

                                        <!-- Opções -->
                                        <td>  
                                            {{-- editar alojamento --}}                                      
                                            <a href="editar_alojamento/{{$alertal->id_alojamento}}">
                                                <i class="fas fa-edit" style="padding-left: 2.5px; color: #212529"></i>
                                            </a>
                                            {{-- elimiar alerta --}}
                                            <a href="eliminar_alerta/{{$alertal->id_alerta}}">
                                                <i class="fas fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                            </a>
                                        </td>
                                        </tr>
                                    
                                        
                                    @endforeach
                                    </tbody>
                                </tr>
                                </table>
                                        
                                        
                                        
                            @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
  <!-- /.content-wrapper -->
