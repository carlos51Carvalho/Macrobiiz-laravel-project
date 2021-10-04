@extends('includes.app');


@section('conteudo')
    <!-- Conteudo -->
    <div class="content-wrapper">
        <form method="POST" action="/atualizar_alerta/{{$alerta->id_alerta}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
        {{-- csrf --}}
        {{ csrf_field() }}
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-6">
                    <h4>Editar alerta</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="homepage"><button class="btn btn-success btn-sm" role="submit" style="margin-left: 0.5em;"><i class="fas fa-save"></i> Gravar  </button></a>
                    </ol>
                </div>
            </div>
        </section>
        
        <!-- Main content -->
        <section class="content">
            <form method="POST" action="atualizar_alerta/{{$alerta->id_alerta}}" id="postnormal" enctype="multipart/form-data" style="display: block;">
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

                                                        <div class="col-md-2 form-inline" style="margin-top: 5px;">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox">
                                                                    @if ($alerta->status==1)
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
