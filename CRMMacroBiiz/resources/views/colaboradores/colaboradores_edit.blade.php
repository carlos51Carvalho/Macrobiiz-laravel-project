@extends('includes.app');


@section('conteudo')
    <!-- Conteudo -->
    <div class="content-wrapper">
        <form method="POST" action="/atualizar_colaborador/{{$colaborador->id_colaborador}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
        {{-- csrf --}}
        {{ csrf_field() }}
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-6">
                    <h4>Editar Colaborador</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="#"><button class="btn btn-success btn-sm" role="submit" style="margin-left: 0.5em;"><i class="fas fa-save"></i> Gravar  </button></a>
                        <a href="javascript:history.back()"><button class="btn btn-secondary" style="margin-left: 0.5em;" type="button" formnovalidate>Voltar</button></a>
                    </ol>
                </div>
            </div>
        </section>
        
        <!-- Main content -->
        <section class="content">
            <form method="POST" action="atualizar_colaborador/{{$colaborador->id_colaborador}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
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
                                                        
                                                        <div class="form-group col-md-6">
                                                            <label for="nome">Nome</label>
                                                        <input type="text" id="nome" name="nome_text" class="form-control" value="{{$colaborador->nome}}" required>
                                                        </div>

                                                        <div class="form-group col-md-3">
                                                            <label for="bi">BI</label>
                                                            <input type="text" id="bi" name="bi_text" class="form-control" value="{{$colaborador->bi}}" required>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-3">
                                                            <label for="nif">Nif</label>
                                                            <input type="text" id="nif" name="nif_text" class="form-control" value="{{$colaborador->nif}}" required>
                                                        </div>

                                                        <div class="form-group col-md-3">
                                                            <label for="nss">Nss</label>
                                                            <input type="text" id="nss" name="nss_text" class="form-control" value="{{$colaborador->nss}}" required>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-4">
                                                            <label for="morada">Morada</label>
                                                            <input type="text" id="morada" name="morada_text" class="form-control" value="{{$colaborador->morada}}" required>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-6">
                                                            <label for="email">Email</label>
                                                            <input type="email" id="email" name="email_text" class="form-control" value="{{$colaborador->email}}"  required>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-3">
                                                            <label for="contacto">Telemóvel</label>
                                                            <input type="text" id="contacto" name="contacto_text" class="form-control" value="{{$colaborador->contacto}}" required>
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
