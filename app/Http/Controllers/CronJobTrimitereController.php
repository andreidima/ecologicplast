<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Programare;
use Carbon\Carbon;

use App\Traits\TrimiteSmsTrait;

class CronJobTrimitereController extends Controller
{
    use TrimiteSmsTrait;

    public function trimitereAutomataSmsCerereConfirmareProgramare($key = null)
    {
        $config_key = \Config::get('variabile.cron_job_key');
        // dd($key, $config_key);

        if ($key === $config_key){

            $search_data = Carbon::today()->todatestring();

            $programari = Programare::whereNotNull('data_ora_programare')
                ->whereDate('created_at', '<', Carbon::today()->todatestring())
                ->whereDate('data_ora_programare', '=', Carbon::tomorrow()->todatestring())
                ->where('stare_masina', 0) // sms-ul nu a fost deja trimis
                ->doesntHave('sms_confirmare') // sms-ul nu a fost deja trimis
                ->get();

            foreach ($programari as $programare){
                $mesaj = 'Accesati ' . url('/status-programare/' . $programare->cheie_unica) . ', pentru a confirma sau anula programarea din ' . \Carbon\Carbon::parse($programare->data_ora_programare)->isoFormat('DD.MM.YYYY') .
                            ', ora ' . \Carbon\Carbon::parse($programare->data_ora_programare)->isoFormat('HH:mm') .
                            '. AutoGNS +40723114595!';
                // Referitor la diacritice, puteti face conversia unui string cu diacritice intr-unul fara diacritice, in mod automatizat cu aceasta functie PHP:
                $mesaj = \Transliterator::createFromRules(':: Any-Latin; :: Latin-ASCII; :: NFD; :: [:Nonspacing Mark:] Remove; :: NFC;', \Transliterator::FORWARD)->transliterate($mesaj);
                $this->trimiteSms('programari', 'confirmare', $programare->id, [$programare->telefon], $mesaj);
            }

            // return redirect('/clienti')->with('status', 'Cron Joburile de astăzi au fost trimise!' . $cron_jobs->count());
        } else {
            echo 'Cheia pentru Cron Joburi nu este corectă!';
            // return redirect('/clienti')->with('error', 'Cron Joburile de astăzi nu fost trimise! Cheia ' . $key . ' nu este validă');
        }

    }
}
