{!!Form::open(array('url'=>'/teste', 'method'=>'GET', 'autocomplete'=>'off', 'role' => 'search'))!!}

<div class="card-tools">
    <div class="input-group input-group-sm" >
        <input type="text" name="searchText" class="form-control float-right" placeholder="Search" >

        <div class="input-group-append">
            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
        </div>
    </div>
</div>

{{Form::close()}}
