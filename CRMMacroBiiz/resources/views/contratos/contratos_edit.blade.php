@extends('includes.app');


@section('conteudo')
    <!-- Conteudo -->
    <div class="content-wrapper">
        <form method="POST" action="/atualizar_contrato/{{$contrato->id_contrato}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
        {{-- csrf --}}
        {{ csrf_field() }}
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-6">
                    <h4>Editar contrato</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="/index_contratos"><button class="btn btn-success btn-sm" role="submit" style="margin-left: 0.5em;"><i class="fas fa-save"></i> Gravar  </button></a>
                        <a href="javascript:history.back()"><button class="btn btn-secondary" style="margin-left: 0.5em;" type="button" formnovalidate>Voltar</button></a>
                    </ol>
                </div>
            </div>
        </section>
        
        <!-- Main content -->
        <section class="content">
            <form method="POST" action="/atualizar_contrato/{{$contrato->id_contrato}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
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
                                                            <p class = "alert alert-danger">Não existem colaboradors para associar contratos</p>
                                                            
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
                                                                <label for="descricao">Descrição</label>
                                                                <input type="text" id="descricao" name="descricao_text" class="form-control" value="{{$contrato->descricao}}" required>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label for="data_inicio">Data Início</label>
                                                                <input type="date" id="data_inicio" name="data_inicio_text" class="form-control" value="{{$contrato->data_inicio}}" required>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label for="data_fim">Data Fim</label>
                                                                <input type="date" id="data_fim" name="data_fim_text" class="form-control" value="{{$contrato->data_fim}}" required>
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
