<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CRM Macrobiiz</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-bootstrap/main.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
@include('includes.header')

@include('includes.navLateral')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      @include('includes.flash_message')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendar</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="gravar_task" id="postnormal" enctype="multipart/form-data" style="display: block;">
            {{-- csrf --}}
        {{ csrf_field() }}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Adicionar Evento</h4>
                            </div>
                        <div class="card-body">
                        <!-- the events -->
                        <div id="external-events">
                            <div class="form-group col-md-12">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome_text" class="form-control" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="id_categoria">Categoria</label>
            
                                <select class="form-control custom-select" id="id_categoria" name="id_categoria_text">
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id_categoria}}">{{$categoria->descricao}}</option> {{--blue--}}
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label for="data_inicio">Data Início</label>
                                <input type="datetime-local" id="data_inicio" name="data_inicio_text" class="form-control" required>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label for="data_fim">Data Fim</label>
                                <input type="datetime-local" id="data_fim" name="data_fim_text" class="form-control">
                            </div>
                            <form method="POST" action="gravar_task" id="postnormal" enctype="multipart/form-data" style="display: block;">
                                <a href="admin"><button class="btn btn-success btn-sm" role="submit" style="align-content: center"  ><i class="fas fa-save"></i> Gravar  </button></a>
                            </form>
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div>
                            <div class="card-body">
                                <table>
                                    <tbody>
                                    @foreach($categorias as $categoria)
                                        <tr>
                                            <td><li><i class="fas fa-square" style="color: {{$categoria->cor}}"></i> {{$categoria->descricao}}</li></td>
                                            <td>                                       
                                                {{-- <a href="#" data-target="#modal-delete-{{$c->id_contactos}}" data-toggle="modal"> --}}
                                                <a href="eliminar_categoria/{{$categoria->id_categoria}}">
                                                    <i class="fa fa-trash" style="padding-left: 1.5px; color: #212529"></i>
                                                </a>
                                            </td>                                    
                                        </tr>
                                        @endforeach
                                    </tbody>   
                                </table>
                            
                            </div>

                            <div class="card">
                                <form method="POST" action="gravar_categoria" id="postnormal" enctype="multipart/form-data" style="display: block;">
                                    {{-- csrf --}}
                                    {{ csrf_field() }}
                                <div class="card">
                                    <div class="card-header">
                                      <h3 class="card-title">Adicionar Categoria</h3>
                                    </div>
                                    <div class="card-body"> 
                                        <div class="input-group">
                                            <input id="colorWell" name="cor_text" type="color" class="form-control" placeholder="#0073b7">
                                        </div>
                                        
                                      <!-- /btn-group -->
                                        <div class="input-group">
                                            <input id="descricao" name="descricao_text" type="text" class="form-control" placeholder="Descrição">
                                        </div>
                    
                                       
                                        <form method="POST" action="/gravar_categoria" id="postnormal" enctype="multipart/form-data" style="display: block;">
                                            <a href="admin"><button class="btn btn-success btn-sm" role="submit" style="align-content: center"  ><i class="fas fa-save"></i> Gravar  </button></a>
                                        </form>
                                        
                                      <!-- /input-group -->
                                    </div>
                                  </div>
                                </form>
                            </div>
                        </div>

                    
                        </div>
                    <!-- /.card -->
                    
                    </div>
                </div>
        <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
        </form>
    </section>


    <section class="content">
      <div class="container-fluid">
          <!-- /.row -->
          <div class="row">
              <div class="col-6">
                  <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                      @if(count($alertas) == 0)
                          <p class = "alert alert-warning">Não foram encontrados Alertas de Dominios no Sistema</p>
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
          <!-- /.row -->
              <div class="col-6">
                  <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                      @if(count($alertasloj) == 0)
                          <p class = "alert alert-warning">Não foram encontrados Alertas de Alojamentos no Sistema</p>
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
                                      <a href="eliminar_alerta_aloj/{{$alertal->id_alerta}}">
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

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  @include('includes.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/fullcalendar/main.min.js"></script>
<script src="../plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="../plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="../plugins/fullcalendar-interaction/main.min.js"></script>
<script src="../plugins/fullcalendar-bootstrap/main.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------


    var calendar = new Calendar(calendarEl, {
      plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      'themeSystem': 'bootstrap',
      //Random default events
      events    : [
        
        @foreach($tasks as $task)
            @foreach($categorias as $categoria)
                @if($task->id_categoria == $categoria->id_categoria)
                    @if($task->data_fim == null)
                    
                    {
                        title          : '{{ $task->nome }}',
                        start          : new Date('{{ $task->data_inicio }}'),
                        backgroundColor: '{{$categoria->cor}}', 
                        borderColor    : '{{$categoria->cor}}', 
                        allDay         : true
                    },

                    @else
                    {
                    title          : '{{ $task->nome }}',
                    start          : new Date('{{ $task->data_inicio }}'),
                    end            : new Date('{{ $task->data_fim }}'),
                    backgroundColor: '{{$categoria->cor}}', 
                    borderColor    : '{{$categoria->cor}}', 
                    allDay         : false
                    },
                    
                    @endif
                @endif
            @endforeach
        @endforeach

        
      ],
      editable  : true,   
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>


</body>
</html>
