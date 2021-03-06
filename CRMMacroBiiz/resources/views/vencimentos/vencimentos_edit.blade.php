@extends('includes.app');


@section('conteudo')
    <!-- Conteudo -->
    <div class="content-wrapper">
        <form method="POST" action="/atualizar_vencimento/{{$vencimento->id_vencimento}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
        {{-- csrf --}}
        {{ csrf_field() }}
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-6">
                    <h4>Editar vencimento</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="/index_vencimentos"><button class="btn btn-success btn-sm" role="submit" style="margin-left: 0.5em;"><i class="fas fa-save"></i> Gravar  </button></a>
                        <a href="javascript:history.back()"><button class="btn btn-secondary" style="margin-left: 0.5em;" type="button" formnovalidate>Voltar</button></a>
                    </ol>
                </div>
            </div>
        </section>
        
        <!-- Main content -->
        <section class="content">
            <form method="POST" action="/atualizar_vencimento/{{$vencimento->id_vencimento}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-secondary card-tabs">
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="form-row">

                                                        @if(count($colaborador) == 0)
                                                            <p class = "alert alert-danger">N??o existem colaboradors para associar vencimentos</p>
                                                            
                                                        @else
                                                            <div class="form-group col-md-3">
                                                                <label for="id_colaborador">Nome do colaborador</label>

                                                                {{-- o nome devia ja estar serlecionado !!!! --}}
                                                                <select class="form-control custom-select" id="id_colaborador" name="id_colaborador_text" value="{{$c->nome}}">
                                                                    <option value="{{$c->id_colaborador}}">{{$c->nome}}</option>
                                                                    @foreach($colaborador as $c)
                                                                    <option value="{{$c->id_colaborador}}">{{$c->nome}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label for="data">Data In??cio</label>
                                                                <input type="date" id="data" name="data_text" class="form-control" value="{{$vencimento->data}}" required>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-4">
                                                                <label for="ficheiro">Ficheiro</label>
                                                                <input type="file" id="ficheiro" name="ficheiro_text" class="form-control" >
                                                            </div> 
                                                            
                                                                                                                   
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
        </section>
    </form>
    </div>

@endsection
