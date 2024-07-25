@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Pagamentos \ <span class="h6 mb-0 text-gray-800"> Visualizar Recibo </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">
        <div class="col-md-12">
            <div id="card_recibo" class="card">
                <div class="card-header">
                    <h3 class="text-center">Recibo Nº {{ $data['pagamento']->id_pagamento }}</h3>
                </div>
                <div class="card-body">
                    <div class="invoice">
                        <div class="invoice-header">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-4">
                                    <div class="invoice-from">
                                        <small>De</small>
                                        <address class="m-t-5 m-b-5">
                                            <strong class="text-inverse">Psicologa Ínara Piva.</strong><br>
                                            Street Address<br>
                                            City, Zip Code<br>
                                            Telefone: (123) 456-7890
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="invoice-to">
                                        <small>Paciente</small>
                                        <address class="m-t-5 m-b-5">
                                            <strong class="text-inverse">{{ $data['paciente']->nome_paciente }}</strong><br>
                                            {{ isset($data['paciente']->enderecoP->endereco) ? $data['paciente']->enderecoP->endereco : 'Endereço não informado' }},
                                            {{ isset($data['paciente']->enderecoP->n_endereco) ? $data['paciente']->enderecoP->n_endereco : 'Número não informado' }}<br>
                                            {{ isset($data['paciente']->enderecoP->cidade->nome_cidade) ? $data['paciente']->enderecoP->cidade->nome_cidade : 'Cidade não informado' }}
                                            -
                                            {{ isset($data['paciente']->enderecoP->estado->uf) ? $data['paciente']->enderecoP->estado->uf : '' }},
                                            {{ isset($data['paciente']->enderecoP->cep) ? $data['paciente']->enderecoP->cep : 'CEP não informado' }},<br>
                                            Telefone: {{ $data['paciente']->telefone_1 }}

                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row align-items-center justify-content-end">
                                        <div class="col-md-5">
                                            <div class="invoice-date">
                                                <small>Fatura/período</small><br>
                                                <small>{{ $data['pagamento']->mes_referente }} de
                                                    {{ $data['pagamento']->ano_referente }}</small><br>
                                                <div class="invoice-detail">
                                                    {{ \Carbon\Carbon::parse($data['pagamento']->data_pagamento)->translatedFormat('d \d\e F \d\e Y') }}
                                                </div>
                                                <div class="invoice-detail">
                                                    #0{{ $data['pagamento']->id_pagamento }}PGSR<br>
                                                    <small> Serviço(s) Prestado(s) </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="invoice-content">
                            <div class="table-responsive">
                                <table class="table table-invoice">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5%">#</th>
                                            <th>Descrição</th>
                                            <th class="text-center" width="10%">Data</th>
                                            <th class="text-right" width="20%">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['sessoes'] as $sessao)
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>
                                                    <span class="text-inverse">Atendimento Nº {{ $sessao->id_sessao }}
                                                        ({{ $sessao->presencial ? 'Presencial' : 'Online' }})
                                                    </span><br>
                                                    <small>Período: {{ $sessao->periodo }}, ocorreu entre
                                                        {{ substr($sessao->horario_inicial, 0, 5) }}hrs às
                                                        {{ substr($sessao->horario_final, 0, 5) }}hrs </small>
                                                </td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($sessao->data_sessao)->format('d/m/Y') }}</td>
                                                <td class="text-right">R$
                                                    {{ number_format($sessao->valor_sessao, 2, ',', '.') }}</small></td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="invoice-price">
                                <div class="invoice-price-left">
                                    <div class="invoice-price-row">
                                        <div class="row align-items-center justify-content-end">
                                            <div class="col-md-2">
                                                <div class="invoice-price-right">
                                                    <small>TOTAL</small> <span class="f-w-600">R$
                                                        {{ number_format($data['vt_pagamento'], 2, ',', '.') }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="invoice-note">
                            * Realize todos os pagamentos em nome de [Nome da Sua Empresa].<br>
                            * O pagamento deve ser realizado até a data do vencimento.<br>
                            * Se você tiver qualquer dúvida sobre esta fatura, entre em contato com [Nome, Telefone, Email]
                        </div>
                        <br>
                        <div class="invoice-footer">
                            <p class="text-center m-b-5 f-w-600">
                                AGRADECEMOS A CONFIANÇA EM NOSSO TRABALHO
                            </p>
                            <p class="text-center">
                                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> matiasgallipoli.com</span>
                                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:016-18192302</span>
                                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> <a
                                        href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                        data-cfemail="5220263b373f222112353f333b3e7c313d3f">[email&#160;protected]</a></span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <div class="row align-items-center justify-content-center text-center">
                        <div class="form-group">
                            <a href="{{ route('Pagamentos.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-ban"></i> Voltar </a>
                            <button id="generate-pdf" class="btn btn-secondary btn-sm"><i class="fa fa-file-pdf"></i> Gerar PDF </button>
                            <button id="print-page" class="btn btn-secondary btn-sm"><i class="fa fa-print"></i> Imprimir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('generate-pdf').addEventListener('click', () => {
            const element = document.getElementById('card_recibo');
            const options = {
                margin: 0,
                filename: 'recibo.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(element).set(options).save();
        });

        document.getElementById('print-page').addEventListener('click', () => {
            const originalContent = document.body.innerHTML;
            const printContent = document.getElementById('card_recibo').outerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;  // Restaurar o conteúdo original
            location.reload();  // Recarregar a página para restaurar os eventos
        });
    </script>
@endsection
