<?php

namespace App\Http\Requests;

use App\Agendamento;
use App\AgendamentoPeriodo;
use Illuminate\Foundation\Http\FormRequest;

class AgendamentosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('Agendamento');
        
        $periodo = AgendamentoPeriodo::findOrFail($this->ap_id);

        return [
            'ap_id' => 'required',
            'n_dia' => 'required',
            'horario_inicial' => [
                'required',
                function ($attribute, $value, $fail) use ($periodo) {
                    if ($value < $periodo->hora_inicial || $value > $periodo->hora_final) {
                        $fail('O horário de início deve estar dentro do período selecionado.');
                    }
                },
                function ($attribute, $value, $fail) {
                    $agendamento = $this->route('Agendamento');
                    $conflict = Agendamento::where('ap_id', $this->ap_id)
                        ->where('n_dia', $this->n_dia)
                        ->where(function ($query) use ($value) {
                            $query->where('horario_inicial', '<=', $value)
                                ->where('horario_final', '>', $value);
                        })
                        ->exists();
    
                    if ($conflict) {
                        $fail('Já existe um horário inicial cadastrado para este dia no mesmo ou entre período e horário.');
                    }
                },
            ],
            'horario_final' => [
                'required',
                'after:horario_inicial',
                function ($attribute, $value, $fail) use ($periodo) {
                    if ($value < $periodo->hora_inicial || $value > $periodo->hora_final) {
                        $fail('O horário final deve estar dentro do período selecionado.');
                    }
                },
                function ($attribute, $value, $fail) {
                    $agendamento = $this->route('Agendamento');
                    $conflict = Agendamento::where('ap_id', $this->ap_id)
                        ->where('n_dia', $this->n_dia)
                        ->where(function ($query) use ($value) {
                            $query->where('horario_inicial', '<', $value)
                                ->where('horario_final', '>=', $value);
                        })
                        ->exists();
    
                    if ($conflict) {
                        $fail('Já existe um horário final cadastrado para este dia no mesmo ou entre período e horário.');
                    }
                },
            ],
        ];   
    }

    public function messages()
{
    return [
        'ap_id.required' => 'O Período é obrigatório',
        'n_dia.required' => 'O Dia da semana é obrigatório',
        'horario_inicial.required' => 'O horário de início é obrigatório.',
        'horario_final.required' => 'O horário final é obrigatório.',
        'horario_final.after' => 'O horário final deve ser maior que o horário inicial.',
    ];
}
}
