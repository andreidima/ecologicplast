<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MesajTrimisSms;

class MesajTrimisSmsController extends Controller
{
    public function index()
    {
        $search_nr_auto = \Request::get('search_nr_auto');
        $search_telefon = \Request::get('search_telefon');

        $mesaje_sms = MesajTrimisSms::with('programare:id,nr_auto')
            ->when($search_nr_auto, function ($query, $search_nr_auto) {
                return $query->whereHas('programare', function ($query) use ($search_nr_auto){
                    return $query->where('nr_auto', 'like', '%'.$search_nr_auto.'%');
                });
            })
            ->when($search_telefon, function ($query, $search_telefon) {
                return $query->where('telefon', 'like', '%' . $search_telefon . '%');
            })
            ->latest()
            ->simplePaginate(25);

        return view('mesajeTrimiseSms.index', compact('mesaje_sms', 'search_nr_auto', 'search_telefon'));
    }
}
