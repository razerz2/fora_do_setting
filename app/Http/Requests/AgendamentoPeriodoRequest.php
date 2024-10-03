<?php

namespace App\Http\Requests;

use App\AgendamentoPeriodo;
use Illuminate\Foundation\Http\FormRequest;

class AgendamentoPeriodoRequest extends FormRequest
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
        return [
            'periodo' => 'required|string|max:255',
            'hora_inicial' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $horaInicial = $this->input('hora_inicial');
                    $horaFinal = $this->input('hora_final');
                    
                    $id_ap = $this->route('id'); // Para capturar o ID em caso de atualização
                    //dd($value, $horaInicial, $horaFinal);

                    // Verifica conflito de horários
                    $conflito = AgendamentoPeriodo::where(function ($query) use ($value, $horaFinal, $id_ap) {
                        $query->where('hora_inicial', '<', $horaFinal)
                            ->where('hora_final', '>', $value);

                        // Excluir o período atual da verificação em caso de edição
                        if ($id_ap) {
                            $query->where('id_ap', '!=', $id_ap);
                        }
                    })->exists();

                    if ($conflito) {
                        $fail('O intervalo de horário conflita com outro período já registrado.');
                    }
                },
            ],
            'hora_final' => 'required|date_format:H:i|after:hora_inicial', // Mantenha apenas essa validação
        ];
    }

    // Mensagens de erro personalizadas
    public function messages()
    {
        return [
            'hora_inicial.required' => 'A hora inicial é obrigatória.',
            'hora_inicial.date_format' => 'A hora inicial deve estar no formato correto (HH:MM).',
            'hora_final.required' => 'A hora final é obrigatória.',
            'hora_final.date_format' => 'A hora final deve estar no formato correto (HH:MM).',
            'hora_final.after' => 'A hora final deve ser posterior à hora inicial.'
        ];
    }
}
