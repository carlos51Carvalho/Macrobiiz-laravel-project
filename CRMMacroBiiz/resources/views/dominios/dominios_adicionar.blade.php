@extends('includes.app');


@section('conteudo')
    <!-- Conteudo -->
    <div class="content-wrapper">
        <form method="POST" action="gravar_dominio" id="postnormal" enctype="multipart/form-data" style="display: block;">
        {{-- csrf --}}
        {{ csrf_field() }}
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-6">
                    <h4>Adicionar dominio</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-success btn-sm teste" role="submit" style="margin-left: 0.5em;"><i class="fas fa-save"></i> Gravar  </button>
                        <a href="javascript:history.back()"><button class="btn btn-secondary" style="margin-left: 0.5em;" type="button" formnovalidate>Voltar</button></a>
                    </ol>
                </div>
            </div>
        </section>
        
        <!-- Main content -->
        <section class="content">
            <form method="POST" action="gravar_dominio" id="postnormal" enctype="multipart/form-data" style="display: block;">
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

                                                        @if(count($cliente) == 0)
                                                            <p class = "alert alert-danger">Não existem clientes para associar dominios</p>
                                                            
                                                        @else

                                                            <div class="form-group col-md-3">
                                                                <label for="id_cliente">Nome do Cliente</label>
                                                                <select class="form-control custom-select" id="id_cliente" name="id_cliente_text" required>
                                                                    <option value="">Selecione</option>
                                                                    @foreach($cliente as $c)
                                                                    <option value="{{$c->id_cliente}}">{{$c->nome}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label for="descricao">Descrição</label>
                                                                <input type="text" id="descricao" name="descricao_text" class="form-control" required>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label for="data_inicio">Data Início</label>
                                                                <input type="date" id="data_inicio" name="data_inicio_text" class="form-control" required>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label for="data_fim">Data Fim</label>
                                                                <input type="date" id="data_fim" name="data_fim_text" class="form-control" required>
                                                            </div>

                                                            <div class="col-md-2 form-inline" style="margin-top: 5px;">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input class="custom-control-input" type="checkbox" id="status" name="status_text">
                                                                        <label for="status" class="custom-control-label">Activo</label>
                                                                    </div>
                                                                </div>
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
