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
    <h1 class="h3 mb-2 text-gray-800">Motivos para Inativações</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Inativações</h6>
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
                            <th> Motivo da Inativação </th>
                            <th> Descrição </th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($motivos as $motivo)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $motivo->id_mi }}</small></td>
                                <td class="text-center"><small>{{ $motivo->nome_mi }}</small></td>
                                <td class="text-center"><small>{{ $motivo->descricao_mi }}</small></td>
                                <td align="center">
                                    <button type="button" data-toggle="modal" data-target="#editar"
                                        class="btn btn-secondary btn-sm"
                                        onclick="editar_motivo({{ $motivo->id_mi }}, '{{ $motivo->nome_mi }}', '{{ $motivo->descricao_mi }}');">
                                        <i class="fa fa-edit"></i> Editar </button>
                                    <button type="button" data-toggle="modal" data-target="#excluir"
                                        class="btn btn-secondary btn-sm"
                                        onclick="excluir_motivo({{ $motivo->id_mi }}, '{{ $motivo->nome_mi }}');">
                                        <i class="fa fa-ban"></i> Excluir </button>
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
                    <h4 class="modal-title text-center" id="myModalLabel">Criar novo motivo para inativação</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('MotivoInativacao.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="md_edit_nome_mi">Motivo: </label>
                                    <input type="text" class="form-control form-control-user" value=""
                                        name="nome_mi" aria-describedby="nameHelp"
                                        placeholder="Informe o nome para este motivo..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="exampleTextarea">Descrição: </label>
                                    <textarea class="form-control" name="descricao_mi" rows="3"></textarea>
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
                    <h4 class="modal-title text-center" id="myModalLabel">Editar Motivo Nº<span
                            id="md-editar-span-id_mi"></span> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('MotivoInativacao.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_mi" id="md-editar-id_mi" value="">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="md_edit_nome_mi">Motivo: </label>
                                    <input type="text" class="form-control form-control-user" id="md-editar-nome_mi"
                                        value="" name="nome_mi" aria-describedby="nameHelp"
                                        placeholder="Informe o tipo de despesa..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="exampleTextarea">Descrição: </label>
                                    <textarea class="form-control" id="md-editar-descricao" name="descricao_mi" rows="3"></textarea>
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
                            id="md-excluir-span-id_mi"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('MotivoInativacao.destroy') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja excluir o motivo "<span id="md-excluir-span-nome_mi"></span>"?
                        </p>
                        <input type="hidden" name="id_mi" id="md-excluir-id_mi" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/configuracoes/motivo_inativacao/index.js') }}"></script>
@endsection