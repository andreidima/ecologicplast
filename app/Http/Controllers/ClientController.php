<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\ClientIstoric;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->forget('client_return_url');

        $search_nume = $request->search_nume;
        $search_telefon = $request->search_telefon;
        $search_status = $request->search_status;
        $sortare_lansare = $request->sortare_lansare;

        $query = Client::with('user', 'istoricuri')
            ->when($search_nume, function ($query, $search_nume) {
                return $query->where('nume', 'like', '%' . $search_nume . '%');
            })
            ->when($search_telefon, function ($query, $search_telefon) {
                return $query->where('telefon', 'like', '%' . $search_telefon . '%');
            })
            ->when($search_status, function ($query, $search_status) {
                return $query->where('status', 'like', '%' . $search_status . '%');
            })
            ->when($sortare_lansare, function ($query, $sortare_lansare) {
                if ($sortare_lansare === "cea_mai_noua"){
                    return $query->orderby('lansare', 'desc');
                } else {
                    return $query->orderby('lansare', 'asc');
                }
            }, function ($query) {
                $query->latest();
            });
        if (auth()->user()->role !== "Administrator"){
            $query = $query->where('user_id', auth()->user()->id);
        }
        $clienti = $query->simplePaginate(25);

        return view('clienti.index', compact('clienti', 'search_nume', 'search_telefon', 'search_status', 'sortare_lansare'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->session()->get('client_return_url') ?? $request->session()->put('client_return_url', url()->previous());

        return view('clienti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::create($this->validateRequest($request));

        // Salvare in istoric
        $client_istoric = new ClientIstoric;
        $client_istoric->fill($client->makeHidden(['created_at', 'updated_at'])->attributesToArray());
        $client_istoric->operatie = 'Adaugare';
        $client_istoric->operatie_user_id = auth()->user()->id ?? null;
        $client_istoric->save();

        return redirect($request->session()->get('client_return_url') ?? ('/clienti'))->with('status', 'Clientul „' . ($client->nume ?? '') . '” a fost adăugat cu succes!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        $request->session()->get('client_return_url') ?? $request->session()->put('client_return_url', url()->previous());

        return view('clienti.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        $request->session()->get('client_return_url') ?? $request->session()->put('client_return_url', url()->previous());

        return view('clienti.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        $client->update($this->validateRequest($request));

        // Salvare in istoric
        if ($client->wasChanged()){
            $client_istoric = new ClientIstoric;
            $client_istoric->fill($client->makeHidden(['created_at', 'updated_at'])->attributesToArray());
            $client_istoric->operatie = 'Modificare';
            $client_istoric->operatie_user_id = auth()->user()->id ?? null;
            $client_istoric->save();
        }

        return redirect($request->session()->get('client_return_url') ?? ('/clienti'))->with('status', 'Clientul „' . ($client->nume ?? '') . '” a fost modificat cu succes!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        // Salvare in istoric
        $client_istoric = new ClientIstoric;
        $client_istoric->fill($client->makeHidden(['created_at', 'updated_at'])->attributesToArray());
        $client_istoric->operatie = 'Stergere';
        $client_istoric->operatie_user_id = auth()->user()->id ?? null;
        $client_istoric->save();

        $client->delete();

        return back()->with('status', 'Clientul „' . ($client->nume ?? '') . '” a fost șters cu succes!');
    }

    /**
     * Validate the request attributes.
     *
     * @return array
     */
    protected function validateRequest(Request $request)
    {
        // Se adauga userul doar la adaugare, iar la modificare nu se schimba
        if ($request->isMethod('post')) {
            $request->request->add(['user_id' => $request->user()->id]);
        }

        // if ($request->isMethod('post')) {
        //     $request->request->add(['cheie_unica' => uniqid()]);
        // }

        return $request->validate(
            [
                'nume' => 'required|max:500',
                'telefon' => 'nullable|max:500',
                'adresa' => 'nullable|max:500',
                'status' => 'nullable|max:500',
                'intrare' => '',
                'lansare' => '',
                'oferta_pret' => 'nullable|integer',
                'avans' => 'nullable|integer',
                'observatii' => '',
                'user_id' => '',
                // 'cheie_unica' => ''
            ],
            [

            ]
        );
    }

    public function restaurareIstoric(Request $request, Client $client = null, ClientIstoric $client_istoric = null){
        $client->nume = $client_istoric->nume;
        $client->telefon = $client_istoric->telefon;
        $client->adresa = $client_istoric->adresa;
        $client->status = $client_istoric->status;
        $client->intrare = $client_istoric->intrare;
        $client->lansare = $client_istoric->lansare;
        $client->oferta_pret = $client_istoric->oferta_pret;
        $client->avans = $client_istoric->avans;
        $client->observatii = $client_istoric->observatii;
        $client->user_id = $client_istoric->user_id;

        $client->save();

        // Salvare in istoric
        if ($client->wasChanged()){
            $client_istoric = new ClientIstoric;
            $client_istoric->fill($client->makeHidden(['created_at', 'updated_at'])->attributesToArray());
            $client_istoric->operatie = 'Modificare';
            $client_istoric->operatie_user_id = auth()->user()->id ?? null;
            $client_istoric->save();
            return redirect($request->session()->get('client_return_url') ?? ('/clienti'))->with('status', 'Clientul „' . ($client->nume ?? '') . '” a fost restaurat cu succes!');
        } else {
            return redirect($request->session()->get('client_return_url') ?? ('/clienti'))->with('warning', 'Clientul „' . ($client->nume ?? '') . '” nu a avut nimic de restaurat!');
        }

    }
}
