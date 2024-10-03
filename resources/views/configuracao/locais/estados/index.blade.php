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
    <h1 class="h3 mb-2 text-gray-800">Estados para Locais</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Estados</h6>
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
                            <th> Estado </th>
                            <th> UF </th>
                            <th> País </th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estados as $estado)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $estado->id_estado }}</small></td>
                                <td class="text-center"><small>{{ $estado->nome_estado }}</small></td>
                                <td class="text-center"><small>{{ $estado->uf }}</small></td>
                                <td class="text-center"><small>{{ $estado->pais->nome }}</small></td>
                                <td align="center">
                                    <button type="button" data-toggle="modal" data-target="#editar"
                                        class="btn btn-secondary btn-sm"
                                        onclick="editar_estado({{ $estado->id_estado }}, '{{ $estado->nome_estado }}', '{{ $estado->uf }}', '{{ $estado->pais_id }}', '{{ $estado->pais->nome }}');">
                                        <i class="fa fa-edit"></i> Editar </button>
                                    <button type="button" data-toggle="modal" data-target="#excluir"
                                        class="btn btn-secondary btn-sm"
                                        onclick="excluir_estado({{ $estado->id_estado }}, '{{ $estado->nome_estado }}');">
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
                    <h4 class="modal-title text-center" id="myModalLabel">Registrar Estado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('LocaisEstados.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="paisSelect">Paises:</label>
                                    <select id="paisSelect" name="pais_id" class="form-control form-control-user" required>
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->id_pais }}"> {{ $pais->nome }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="md-criar-nome_estado">Nome Estado: </label>
                                    <input id="md-criar-nome_estado" type="text" class="form-control form-control-user" value=""
                                        name="nome_estado" aria-describedby="nameHelp"
                                        placeholder="Informe o nome do estado..." required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="md-criar-uf">UF: </label>
                                    <input id="md-criar-uf" type="text" class="form-control form-control-user" value=""
                                        name="uf" aria-describedby="nameHelp"
                                        placeholder="Informe a UF do estado..." required>
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
                    <h4 class="modal-title text-center" id="myModalLabel">Editar Estado Nº<span
                            id="md-editar-span-id_estado"></span> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('LocaisEstados.update') }}" method="POST">
                    @csrf
                    <input id="md-editar-id_estado" type="hidden" name="id_pais" value="">
                    <div class="modal-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="md-editar-nome_pais">País: </label>
                                    <input id="md-editar-nome_pais" type="text" class="form-control form-control-user" value=""
                                         aria-describedby="nameHelp" readonly>
                                    <input id="md-editar-pais_id" type="hidden" name="pais_id" value=""> 
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="md-editar-nome_estado">Nome Estado: </label>
                                    <input id="md-editar-nome_estado" type="text" class="form-control form-control-user" value=""
                                        name="nome_estado" aria-describedby="nameHelp"
                                        placeholder="Informe o nome do estado..." required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="md-editar-uf">UF: </label>
                                    <input id="md-editar-uf" type="text" class="form-control form-control-user" value=""
                                        name="uf" aria-describedby="nameHelp"
                                        placeholder="Informe a UF do estado..." required>
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
                            id="md-excluir-span-id_estado"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('LocaisEstados.destroy') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja excluir o país "<span id="md-excluir-span-nome_estado"></span>"?
                        </p>
                        <input type="hidden" name="id_pais" id="md-excluir-id_estado" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light"><i class="fa fa-trash"></i> Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/configuracoes/locais/estados/index.js') }}"></script>
@endsection