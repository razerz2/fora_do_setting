@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perfil \ <span class="h6 mb-0 text-gray-800"> Alterar Senha </span></h1>
    </div>
    <!-- Info boxes -->
    <div class="row align-items-center justify-content-center">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title text-center">Editar senha</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('Perfil.editPassword', ['usuario' => $usuario->id]) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Usuário:</label>
                                    <input type="text" class="form-control" value="{{$usuario->name_full}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password:</label>
                                    <input type="password" class="form-control" value="" name="password"
                                        placeholder="Digite a sua senha..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password Confirm:</label>
                                    <input type="password" class="form-control" value="" name="password_confirmation"
                                        placeholder="Confirme a sua senha..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="row align-items-center justify-content-center text-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <a href="{{ route('Users.index') }}" class="btn btn-secondary btn-sm"><i
                                            class="fas fa-ban"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-save"></i>
                                        Alterar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
@endsection
