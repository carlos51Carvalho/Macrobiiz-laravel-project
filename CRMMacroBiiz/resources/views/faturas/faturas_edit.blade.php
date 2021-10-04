@extends('includes.app');


@section('conteudo')
    <!-- Conteudo -->
    <div class="content-wrapper">
        <form method="POST" action="/atualizar_fatura/{{$fatura->id_fatura}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
        {{-- csrf --}}
        {{ csrf_field() }}
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-6">
                    <h4>Editar Fatura</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="/index_faturas"><button class="btn btn-success btn-sm" role="submit" style="margin-left: 0.5em;"><i class="fas fa-save"></i> Gravar  </button></a>
                        <a href="javascript:history.back()"><button class="btn btn-secondary" style="margin-left: 0.5em;" type="button" formnovalidate>Voltar</button></a>
                    </ol>
                </div>
            </div>
        </section>
        
        <!-- Main content -->
        <section class="content">
            <form method="POST" action="/atualizar_fatura/{{$fatura->id_fatura}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
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
                                                            <p class = "alert alert-danger">Não existem clientes para associar Faturas</p>
                                                            
                                                        @else
                                                            <div class="form-group col-md-3">
                                                                <label for="id_cliente">Nome do Cliente</label>

                                                                {{-- o nome devia ja estar serlecionado !!!! --}}
                                                                <select class="form-control custom-select" id="id_cliente" name="id_cliente_text" value="{{$c->nome}}">
                                                                    <option value="{{$c->id_cliente}}">{{$c->nome}}</option>
                                                                    @foreach($cliente as $c)
                                                                    <option value="{{$c->id_cliente}}">{{$c->nome}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label for="descricao">Descrição</label>
                                                                <input type="text" id="descricao" name="descricao_text" class="form-control" value="{{$fatura->descricao}}" required>
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
