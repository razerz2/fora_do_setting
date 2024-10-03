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

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row justify-content-between">
        <div class="col md-4">
            <form action="{{ route('homeMonth') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="list_meses" class="text-xs font-weight-bold text-dark text-uppercase mb-1">Mês:</label>
                            <select id="list_meses" name="mes" class="form-control form-control-user border-left-secondary" required>
                                <option value="1" {{ date('n') == 1 ? 'selected' : '' }}>Janeiro</option>
                                <option value="2" {{ date('n') == 2 ? 'selected' : '' }}>Fevereiro</option>
                                <option value="3" {{ date('n') == 3 ? 'selected' : '' }}>Março</option>
                                <option value="4" {{ date('n') == 4 ? 'selected' : '' }}>Abril</option>
                                <option value="5" {{ date('n') == 5 ? 'selected' : '' }}>Maio</option>
                                <option value="6" {{ date('n') == 6 ? 'selected' : '' }}>Junho</option>
                                <option value="7" {{ date('n') == 7 ? 'selected' : '' }}>Julho</option>
                                <option value="8" {{ date('n') == 8 ? 'selected' : '' }}>Agosto</option>
                                <option value="9" {{ date('n') == 9 ? 'selected' : '' }}>Setembro</option>
                                <option value="10" {{ date('n') == 10 ? 'selected' : '' }}>Outubro</option>
                                <option value="11" {{ date('n') == 11 ? 'selected' : '' }}>Novembro</option>
                                <option value="12" {{ date('n') == 12 ? 'selected' : '' }}>Dezembro</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="list_anos" class="text-xs font-weight-bold text-dark text-uppercase mb-1">Ano:</label>
                            <select id="list_anos" name="ano" class="form-control form-control-user border-left-secondary" required>
                                @foreach ($anos as $ano)
                                    <option value="{{ $ano }}" {{ $ano == date('Y') ? 'selected' : '' }}>
                                        {{ $ano }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group">
                            <button id="bt-submit" type="submit" class="btn btn-secondary"> <i class="fas fa-check"></i> Aplicar </button>
                        </div>   
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">

        <!-- Pacientes (Ativos) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Pacientes (Ativos)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['total_pacientes'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Validações Pendentes Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Validações Pendentes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{  $data['total_validacoes'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nº Sessões do Mês (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Nº Sessões (Mês Atual)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['total_sessoes'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-address-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nº de Pagamentos do Mês (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Valores Lançados (Mês Atual)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ number_format($data['total_valors'], 2, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Ganhos no ultimos (6) meses</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Sessões Ocorridas</h6>
                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Sessões
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Sessões Canceladas
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        const chartData = @json($data['chartP_sessoes']);
    </script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
@endsection
