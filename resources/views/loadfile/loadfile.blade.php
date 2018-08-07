@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Выберите</div>
                    <form action="/diller/loadbase" method="POST" enctype="multipart/form-data">
                        <div class="panel-body">
                            <input type="file" name="file_excel" value="Загрузать Excel"><br><br>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" value="Загрузить">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
