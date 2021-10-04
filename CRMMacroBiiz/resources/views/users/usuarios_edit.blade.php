@extends('includes.app');

@section('conteudo')
<!-- Conteudo -->
<div class="content-wrapper">
    <form method="POST" action="atualizar_usuario/{{$usuario->id_usuario}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
        {{-- csrf --}}
        {{ csrf_field() }}
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-6">
                    <h4>Editar Usuario</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="index_users"><button class="btn btn-success btn-sm" role="submit" style="margin-left: 0.5em;"><i class="fas fa-save"></i> Gravar  </button></a>
                    </ol>
                </div>
            </div>
        </section>
        
        <!-- Main content -->
        <section class="content">
            @include('includes.erros')
            <form method="POST" action="atualizar_usuario/{{$usuario->id_usuario}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
                {{ csrf_field() }}
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
                                                        
                                                        <div class="form-group col-md-7" style="align-content: center">
                                                            <label for="nome">Nome</label>
                                                        <input type="text" id="nome" name="nome_text" class="form-control" value="{{$usuario->nome}}" required>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-7" style="align-content: center">
                                                            <label for="descricao">Descricao</label>
                                                            <input type="text" id="descricao" name="descricao_text" class="form-control" value="{{$usuario->descricao}}">
                                                        </div>
                                                        
                                                        <div class="form-group col-md-7" style="align-content: center">
                                                            <label for="email">Email</label>
                                                            <input type="email" id="email" name="email_text" class="form-control" value="{{$usuario->email}}"  required>
                                                        </div>

                                                        <div class="form-group col-md-7" style="align-content: center">
                                                            <label for="password">Nova Password (6-15 carateres)</label>
                                                            <input type="password" id="password" name="text_password" class="form-control" placeholder="Nova Senha">
                                                        </div>

                                                        <div class="form-group col-md-7" style="align-content: center">
                                                            <label for="password_rep">Nova Password Repetida (6-15 carateres)</label>
                                                            <input type="password" id="password_rep" name="text_password_rep" class="form-control"  placeholder="Nova Senha" >
                                                        </div>
                                                        
                                                        <div class="col-md-7 form-group" style="margin-top: 5px;">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox">
                                                                    @if ($usuario->status==1)
                                                                        <input class="custom-control-input" type="checkbox" id="status" name="status_text" checked>
                                                                    @else
                                                                        <input class="custom-control-input" type="checkbox" id="status" name="status_text">
                                                                    @endif
                                                                    <label for="status" class="custom-control-label">Activo</label>
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
                    </div>
                </div>
            </form>
            
        </section>
    </form>
    </div>

@endsection
