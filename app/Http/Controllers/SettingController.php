<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    public function index()
    {
        return view('configuracao.index');
    }

    public function indexConfig()
    {
        return view('configuracao.geral.edit');
    }
    
    public function update(SettingRequest $request)
    {
        $data = $request->all();

        // Lida com upload de arquivos
        if ($request->hasFile('system_logo')) {
            $data['system_logo'] = $request->file('system_logo')->store('logos', 'public');
        } else {
            $data['system_logo'] = config('settings.system_logo');
        }

        if ($request->hasFile('login_logo')) {
            $data['login_logo'] = $request->file('login_logo')->store('logos', 'public');
        } else {
            $data['login_logo'] = config('settings.login_logo');
        }

        // Atualiza o arquivo de configuração
        $configData = "<?php\n\nreturn " . var_export($data, true) . ";\n";
        File::put(config_path('settings.php'), $configData);

        // Limpa o cache de configuração
        Artisan::call('config:clear');

        return redirect()->route('Configuracoes.index');
    }
}
