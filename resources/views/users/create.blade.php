@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuários \ <span class="h6 mb-0 text-gray-800"> Cadastrar Usuário </span></h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form id="userForm" action="{{ route('Users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Cadastro de Usuário</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputImagem">Foto de Perfil:</label>
                                    <div class="text-center">
                                        <div id="imageContainer" class="rounded" style="width: 150px; height: 150px;">
                                            <img id="exampleInputImagem" src="{{ asset('img/user-default.jpg') }}"
                                                style="width: 150px; height: 150px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Arquivo:</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="InputFile" type="file" class="custom-file-input" name="InputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Buscar
                                                arquivo...</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="input-group-text" type="button"
                                                id="uploadButton">Carregar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputNameFull">Nome de exibição:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputName"
                                        value="{{ old('name') }}" name="name" aria-describedby="nameFullHelp"
                                        placeholder="Nome de Exibição...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName">Nome Completo:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputNameFull"
                                        value="{{ old('name_full') }}" name="name_full" aria-describedby="nameHelp"
                                        placeholder="Nome Completo...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName">Email:</label>
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        value="{{ old('email') }}" name="email" aria-describedby="emailHelp"
                                        placeholder="Digite seu E-mail...">
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputPassword">Senha:</label>
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                        value="{{ old('password') }}" name="password" aria-describedby="passwordHelp"
                                        placeholder="Digite sua senha...">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputPassword">Confirmar Senha:</label>
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputConfirmedPassword" aria-describedby="passwordConfirmHelp"
                                        value="{{ old('password_confirm') }}" name="password_confirmation"
                                        placeholder="Confirme sua senha...">
                                </div>
                            </div>
                        </div>
                        <hr class="hr" />
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="d-sm-flex align-items-center justify-content-between md-10">
                                    <h1 class="h5 md-10 text-gray-800">Permissões:</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-check">
                                    <input id="defaultCheck1" class="form-check-input" type="checkbox" name="permissoes[]" value="agenda">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Agenda
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="defaultCheck2" class="form-check-input" type="checkbox" name="permissoes[]" value="pacientes">
                                    <label class="form-check-label" for="defaultCheck2">
                                        Pacientes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="defaultCheck3" class="form-check-input" type="checkbox" name="permissoes[]" value="pagamentos">
                                    <label class="form-check-label" for="defaultCheck3">
                                        Pagamentos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="defaultCheck4" class="form-check-input" type="checkbox" name="permissoes[]" value="sessoes">
                                    <label class="form-check-label" for="defaultCheck4">
                                        Sessões
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-check">
                                    <input id="defaultCheck5" class="form-check-input" type="checkbox" name="permissoes[]" value="gastos_pessoais">
                                    <label class="form-check-label" for="defaultCheck5">
                                        Gastos Pessoais
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="defaultCheck6" class="form-check-input" type="checkbox" name="permissoes[]" value="gastos_profissionais">
                                    <label class="form-check-label" for="defaultCheck6">
                                        Gastos Profissionais
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="defaultCheck7" class="form-check-input" type="checkbox" name="permissoes[]" value="relatorios">
                                    <label class="form-check-label" for="defaultCheck7">
                                        Relatórios
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="defaultCheck8" class="form-check-input" type="checkbox" name="permissoes[]" value="sistema">
                                    <label class="form-check-label" for="defaultCheck8">
                                        Sistema
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-footer">
                        <div class="row align-items-center justify-content-center text-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm"><i
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
    <script src="{{ asset('js/users/create.js') }}"></script>
@endsection
