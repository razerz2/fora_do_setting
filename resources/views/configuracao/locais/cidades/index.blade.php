@extends('layout')

@section('content')
    <!-- Error message -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fa-solid fa-triangle-exclamation"></i> Atenção, </strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        @foreach (collect($errors->all())->sort() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Cidades para Locais</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Cidades</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col md-10">
                    <a data-toggle="modal" data-target="#criar" class="btn btn-secondary btn-sm"> <i class="fa fa-plus"></i>
                        Adicionar </a>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th style="width: 5%"> ID </th>
                            <th> País </th>
                            <th> Estado </th>
                            <th> Cidade </th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cidades as $cidade)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $cidade->id_cidade }}</small></td>
                                <td class="text-center"><small>{{ $cidade->estado->pais->nome }}</small></td>
                                <td class="text-center"><small>{{ $cidade->estado->nome_estado }}</small></td>
                                <td class="text-center"><small>{{ $cidade->nome_cidade }}</small></td>
                                <td align="center">
                                    <button type="button" data-toggle="modal" data-target="#editar"
                                        class="btn btn-secondary btn-sm"
                                        onclick="editar_cidade({{ $cidade->id_cidade }}, '{{ $cidade->nome_cidade }}', {{ $cidade->estado_id }}, {{ $cidade->estado->pais_id }});">
                                        <i class="fa fa-edit"></i> Editar </button>
                                    <button type="button" data-toggle="modal" data-target="#excluir"
                                        class="btn btn-secondary btn-sm"
                                        onclick="excluir_cidade({{ $cidade->id_cidade }}, '{{ $cidade->nome_cidade }}');">
                                        <i class="fa fa-trash"></i> Excluir </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Criar -->
    <div class="modal modal-danger fade" id="criar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Registrar Cidade</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('LocaisCidades.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="paisSelect">Paises:</label>
                                    <select id="paisSelect" name="pais_id" class="form-control form-control-user" onchange="handlePaisChange()" required>
                                        <option> Selecione um país... </option>
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->id_pais }}"> {{ $pais->nome }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="stateSelect">Estado:</label>
                                    <select id="stateSelect" name="estado_id" class="form-control form-control-user" required>
                                    </select>
                                </div>
                            </div>    
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="md-criar-nome_cidade">Nome Cidade: </label>
                                    <input id="md-criar-nome_cidade" type="text" class="form-control form-control-user" value=""
                                        name="nome_cidade" aria-describedby="nameHelp"
                                        placeholder="Informe o nome da cidade..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Editar -->
    <div class="modal modal-danger fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Editar Cidade Nº<span
                            id="md-edit-span-id_cidade"></span> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('LocaisCidades.update') }}" method="POST">
                    @csrf
                    <input id="md-edit-id_cidade" type="hidden" name="id_cidade" value="">
                    <div class="modal-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="md-edit-paisSelect">Paises:</label>
                                    <select id="md-edit-paisSelect" name="pais_id" class="form-control form-control-user" onchange="EditHandlePaisChange()" required>
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->id_pais }}"> {{ $pais->nome }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="md-edit-stateSelect">Estado:</label>
                                    <select id="md-edit-stateSelect" name="estado_id" class="form-control form-control-user" required>
                                    </select>
                                </div>
                            </div>    
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="md-edit-nome_cidade">Nome Cidade: </label>
                                    <input id="md-edit-nome_cidade" type="text" class="form-control form-control-user" value=""
                                        name="nome_cidade" aria-describedby="nameHelp"
                                        placeholder="Informe o nome da cidade..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Excluír -->
    <div class="modal modal-danger fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel"> Excluir Nº <span
                            id="md-excluir-span-id_cidade"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('LocaisCidades.destroy') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja excluir a cidade "<span id="md-excluir-span-nome_cidade"></span>"?
                        </p>
                        <input type="hidden" name="id_cidade" id="md-excluir-id_cidade" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light"><i class="fa fa-trash"></i> Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/configuracoes/locais/cidades/index.js') }}"></script>
@endsection