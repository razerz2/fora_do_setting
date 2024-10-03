@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Configurações \ <span class="h6 mb-0 text-gray-800"> Editar Período </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form action="{{ route('Periodo.update', ['Periodo' => $periodo->id_ap]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Editar Perído</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach (collect($errors->all())->sort() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputtime0">Período:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputtime0"
                                        value="{{ old('periodo', $periodo->periodo) }}" name="periodo"
                                        aria-describedby="HorarioHelp" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputtime1">Horário Inicial:</label>
                                    <input type="time" class="form-control form-control-user" id="exampleInputtime1"
                                        value="{{ old('hora_inicial', substr($periodo->hora_inicial, 0, 5)) }}" name="hora_inicial"
                                        aria-describedby="HorarioHelp">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputtime2">Horário Final:</label>
                                    <input type="time" class="form-control form-control-user" id="exampleInputtime2"
                                        value="{{ old('hora_final', substr($periodo->hora_final, 0, 5)) }}" name="hora_final"
                                        aria-describedby="HorarioHelp">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Card Body -->
                    <div class="card-footer">
                        <div class="row align-items-center justify-content-center text-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <a href="{{ route('Periodo.index') }}" class="btn btn-secondary btn-sm"><i
                                            class="fas fa-ban"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-save"></i>
                                        Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
