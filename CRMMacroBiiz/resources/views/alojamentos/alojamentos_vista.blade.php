@extends('includes.app');


@section('conteudo')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="row">
            <div class="col-6" style="align-self: flex-end;">
                <h2>{{$alojamento->descricao}}</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="javascript:history.back()"><button class="btn btn-secondary" style="margin-left: 0.5em;" role="submit">Voltar</button></a>
                </ol>
            </div>
        </div>
        </section>

        <section class="content">
            <div class="row col-12" style="margin-top: 1em;">
                <div class="form-group col-md-12" style="display: flex;">
                  <div class="card-body pad" style="padding: 0;">
                    <div>
                        <label for="areanova">Nome_Cliente: </label>{{$c->nome}}
                    </div>
                    <div>
                        <label for="areanova">Data Inicio: </label><a>{{Carbon\Carbon::parse($alojamento->data_inicio)->format('Y-m-d')}}</a>
                    </div>
                    <div>
                        <label for="areanova">Data Fim: </label><a>{{Carbon\Carbon::parse($alojamento->data_fim)->format('Y-m-d')}}</a>
                    </div>
                    <div>
                        @if ($alojamento->status == 1)
                            <label for="areanova">Status: </label>Activo
                        @else
                            <label for="areanova">Status: </label>Inativo
                        @endif
                    </div>
                  </div>
                </div>
            </div>
        </section>
    </div>
@endsection

