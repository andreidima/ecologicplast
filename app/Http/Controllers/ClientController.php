<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

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

        $clienti = Client::with('user')
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
            })
            ->simplePaginate(25);

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
        $client->update($this->validateRequest($request));

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
                'oferta_pret' => '',
                'avans' => '',
                'observatii' => '',
                'user_id' => '',
                // 'cheie_unica' => ''
            ],
            [

            ]
        );
    }
}
