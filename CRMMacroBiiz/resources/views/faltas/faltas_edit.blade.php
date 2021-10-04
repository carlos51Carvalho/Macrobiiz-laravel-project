@extends('includes.app');


@section('conteudo')
    <!-- Conteudo -->
    <div class="content-wrapper">
        <form method="POST" action="/atualizar_faltas/{{$faltas->id_falta}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
        {{-- csrf --}}
        {{ csrf_field() }}
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-6">
                    <h4>Editar faltas</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="/marcacao_faltas/{{$faltas->id_colaborador}}"><button class="btn btn-success btn-sm" role="submit" style="margin-left: 0.5em;"><i class="fas fa-save"></i> Gravar  </button></a>
                        <a href="javascript:history.back()"><button class="btn btn-secondary" style="margin-left: 0.5em;" type="button" formnovalidate>Voltar</button></a>
                    </ol>
                </div>
            </div>
        </section>
        
        <!-- Main content -->
        <section class="content">
            <form method="POST" action="/atualizar_faltas/{{$faltas->id_falta}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
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

                                                        <div class="form-group col-md-7">
                                                            <label for="id_colaborador">Nome do colaborador</label>
                                                            <select class="form-control custom-select" id="id_colaborador" name="id_colaborador_text">
                                                                <option value="{{$colaborador->id_colaborador}}">{{$colaborador->nome}}</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-7">
                                                            <label for="descricao">Justificação</label>
                                                            <input type="text" id="descricao" name="descricao_text" class="form-control" value="{{$faltas->descricao}}" required>
                                                        </div>

                                                        <div class="form-group col-md-7">
                                                            <label for="data_inicio">Data Início</label>
                                                            <input type="date" id="data_inicio" name="data_inicio_text" class="form-control" value="{{$faltas->data_inicio}}" required>
                                                        </div>

                                                        <div class="form-group col-md-7">
                                                            <label for="data_fim">Data Fim</label>
                                                            <input type="date" id="data_fim" name="data_fim_text" class="form-control" value="{{$faltas->data_fim}}"required>
                                                        </div>
                                                        <div class="form-group col-md-7">
                                                            <label for="horas">Horas em Falta</label>
                                                            <input type="number" id="horas" name="horas_text" class="form-control" value="{{$faltas->horas}}"required>
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
                </div>
            </form>
            
        </section>
    </form>
    </div>

@endsection
