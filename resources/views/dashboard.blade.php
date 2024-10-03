<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <img class="border-logo-main" src="{{ asset('storage/' . config('settings.system_logo')) }}" width="100%"
                height="100%" />
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Menu</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Opções
    </div>

    @if (Auth::check())
        @php
            $permissoes = Auth::user()->permissao()->pluck('area_sistema')->toArray();
        @endphp

        @if (in_array('agenda', $permissoes))
            <!-- Nav Item - Agenda -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo0"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-regular fa-calendar"></i>
                    <span>Agenda</span>
                </a>
                <div id="collapseTwo0" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('Agendamento.create') }}">Criar Horário</a>
                        <a class="collapse-item" href="{{ route('Agendamento.index') }}">Agendamentos</a>
                        <a class="collapse-item" href="{{ route('Agendamento.agenda') }}">Painel de Agendamentos</a>
                    </div>
                </div>
            </li>

        @endif

        @if (in_array('pacientes', $permissoes))
            <!-- Nav Item - Pacientes -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-regular fa-hospital-user"></i>
                    <span>Pacientes</span>
                </a>
                <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('Pacientes.create') }}">Cadastar</a>
                        <a class="collapse-item" href="{{ route('Pacientes.index') }}">Pacientes</a>
                    </div>
                </div>
            </li>
        @endif

        @if (in_array('sessoes', $permissoes))
            <!-- Nav Item - Sessões -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo3"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-regular fa-address-card"></i>
                    <span>Sessões</span>
                </a>
                <div id="collapseTwo3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('Sessao.index') }}">Sessões</a>
                        <a class="collapse-item" href="{{ route('SessaoPaciente.index') }}">Valores</a>
                        <a class="collapse-item" href="{{ route('ValidacaoAgendamento.index') }}">Validar</a>
                    </div>
                </div>
            </li>
        @endif

        @if (in_array('pagamentos', $permissoes))
            <!-- Nav Item - Pagamentos -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo2"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-solid fa-file-invoice-dollar"></i>
                    <span>Pagamentos</span>
                </a>
                <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('Pagamentos.create') }}">Lançar</a>
                        <a class="collapse-item" href="{{ route('Pagamentos.index') }}">Pagamentos</a>
                    </div>
                </div>
            </li>
        @endif

        @if (in_array('gastos_pessoais', $permissoes))
            <!-- Nav Item - Gastos Pessoais -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo4"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-solid fa-dollar-sign"></i>
                    <span>Gastos Pessoais</span>
                </a>
                <div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('GastosPessoais.create') }}">Cadastar</a>
                        <a class="collapse-item" href="{{ route('GastosPessoais.index') }}">Gastos Pessoais</a>
                    </div>
                </div>
            </li>
        @endif

        @if (in_array('gastos_profissionais', $permissoes))
            <!-- Nav Item - Gastos Profissionais -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo5"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-solid fa-dollar-sign"></i>
                    <span>Gastos Profissionais</span>
                </a>
                <div id="collapseTwo5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('GastosProfissionais.create') }}">Cadastar</a>
                        <a class="collapse-item" href="{{ route('GastosProfissionais.index') }}">Gastos Profissionais</a>
                    </div>
                </div>
            </li>
        @endif

        @if (in_array('relatorios', $permissoes))
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Relatórios
            </div>

            <!-- Nav Item - Relatório Sessão -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-regular fa-address-card"></i>
                    <span>Sistema</span>
                </a>
                <div id="collapsePages1" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('Relatorios.Pacientes') }}">Pacientes</a>
                        <a class="collapse-item" href="{{ route('Relatorios.Agendamentos') }}">Agendamentos</a>
                        <a class="collapse-item" href="{{ route('Relatorios.Pagamentos') }}">Pagamentos</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Relatório Gastos -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-solid fa-dollar-sign"></i>
                    <span>Gastos</span>
                </a>
                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('Relatorios.GastosPessoais') }}">Gastos Pessoais</a>
                        <a class="collapse-item" href="{{ route('Relatorios.GastosProfissionais') }}">Gastos Profissionais</a>
                    </div>
                </div>
            </li>
        @endif

        @if (in_array('sistema', $permissoes))
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Sistema
            </div>

            <!-- Nav Item - Usuários -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo6"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-regular fa-users"></i>
                    <span>Usuários</span>
                </a>
                <div id="collapseTwo6" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('Users.create') }}">Cadastar</a>
                        <a class="collapse-item" href="{{ route('Users.index') }}">Usuários</a>
                    </div>
                </div>
            </li>
        @endif

        <!-- Adicione mais links de acordo com as permissões do usuário -->
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
