@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> 
            Notificações \ <span class="h6 mb-0 text-gray-800"> Visualizar </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form>
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Visualizar Notificação</h6>
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
                                    <label for="exampleInputtime2">Nº Notificação:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputtime2"
                                        value="{{ $notificacao->id_notificacao }}" aria-describedby="NDespesaHelp" readonly>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="exampleInputDespesa">Usuário:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputDespesa"
                                        value="{{ $notificacao->user->name }}" aria-describedby="nameHelp"
                                        placeholder="Informe o tipo de despesa..." readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputArea">Área:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputArea" value="{{ $notificacao->route }}"
                                        aria-describedby="InputArea" readonly>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputDataRegistro">Data:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputDataRegistro" value="{{ \Carbon\Carbon::parse($notificacao->data_registro)->format('d/m/Y h:m:s') }}"
                                        aria-describedby="emailDataRegistro" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="exampleTextarea">Mensagem:</label>
                                    <textarea class="form-control" id="exampleTextarea" readonly>{{ $notificacao->message }}</textarea>
                                </div>
                            </div>
                        </div>
                    <!-- Card Body -->
                    <div class="card-footer">
                        <div class="row align-items-center justify-content-center text-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <a href="{{ route('Notificacao.index') }}" class="btn btn-secondary btn-sm"><i
                                            class="fas fa-ban"></i> Voltar </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
