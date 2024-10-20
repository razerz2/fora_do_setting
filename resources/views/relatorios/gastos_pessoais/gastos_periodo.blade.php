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
    <h1 class="h3 mb-2 text-gray-800">Relatórios</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Relatório de Gastos Pessoais por Período</h6>
        </div>
        <div class="card-body">
            <div class="row ">
                <div class="col-md-12">
                    <h5 class="text-center m-0 font-weight-bold text-secondary"><small>Entre {{ $data_a }} à {{ $data_b }}</small></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex">
                        <!-- Botão à esquerda -->
                        <button id="downloadExcel" class="btn btn-secondary btn-sm">
                            <i class="fa fa-file-excel"></i> Exportar
                        </button>
                    </div>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th style="width: 8%">ID</th>
                            <th>Despesa</th>
                            <th>Data Vencimento</th>
                            <th>Data Pagamento</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $gasto)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $gasto->id_gpe }}</small></td>
                                <td class="text-center"><small>{{ $gasto->despesa }}</small></td>
                                <td class="text-center"><small>{{ $gasto->data_vencimento }}</small></td>
                                <td class="text-center"><small>{{ $gasto->data_pagamento }}</small></td>
                                <td class="text-center"><small>R$ {{ number_format($gasto->valor_despesa, 2, ',', '.') }}</small></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- jQuery (necessário para o DataTables) -->
    <script src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('vendor/excel/xlsx.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pageLength": 25,  // Exibe 25 registros por página
                "searching": false, // Desativa o campo de busca
                "language": {
                    "lengthMenu": "Exibindo _MENU_ registros por página",
                    "zeroRecords": "Nenhum registro encontrado",
                    "info": "Exibindo página _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registros disponíveis",
                    "infoFiltered": "(filtrado de _MAX_ registros totais)",
                    "paginate": {
                        "first": "Primeiro",
                        "last": "Último",
                        "next": "Próximo",
                        "previous": "Anterior"
                    }
                }
            });
        });

        // Converter os dados de $pacientes em JSON
        const dados = @json($dados);
    
        document.getElementById('downloadExcel').addEventListener('click', function () {
            // Converter os dados para o formato Excel
            const worksheet = XLSX.utils.json_to_sheet(dados);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Gastos Pessoais Periodo');
    
            // Gerar e baixar o arquivo Excel
            XLSX.writeFile(workbook, 'gastos_pessoais_periodo.xlsx');
        });
    </script>
@endsection