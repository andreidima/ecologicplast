@extends ('layouts.app')

@section('content')
<div class="mx-3 px-3 card" style="border-radius: 40px 40px 40px 40px;">
        <div class="row card-header align-items-center" style="border-radius: 40px 40px 0px 0px;">
            <div class="col-lg-3">
                <span class="badge culoare1 fs-5">
                    <i class="fa-solid fa-users me-1"></i>Clienți
                </span>
            </div>

            <div class="col-lg-6">
                <form class="needs-validation" novalidate method="GET" action="{{ route(Route::currentRouteName())  }}">
                    @csrf
                    <div class="row mb-1 custom-search-form justify-content-center">
                        <div class="col-lg-4">
                            <input type="text" class="form-control rounded-3" id="search_nume" name="search_nume" placeholder="Nume" value="{{ $search_nume }}">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control rounded-3" id="search_telefon" name="search_telefon" placeholder="Telefon" value="{{ $search_telefon }}">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control rounded-3" id="search_status" name="search_status" placeholder="Status" value="{{ $search_status }}">
                        </div>
                    </div>
                    <div class="row custom-search-form justify-content-center">
                        <button class="btn btn-sm btn-primary text-white col-md-4 me-3 border border-dark rounded-3" type="submit">
                            <i class="fas fa-search text-white me-1"></i>Caută
                        </button>
                        <a class="btn btn-sm btn-secondary text-white col-md-4 border border-dark rounded-3" href="{{ route(Route::currentRouteName())  }}" role="button">
                            <i class="far fa-trash-alt text-white me-1"></i>Resetează căutarea
                        </a>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 text-end">
                <a class="btn btn-sm btn-success text-white border border-dark rounded-3 col-md-8" href="{{ route(Route::currentRouteName())  }}/adauga" role="button">
                    <i class="fas fa-plus-square text-white me-1"></i>Adaugă client
                </a>
            </div>
        </div>

        <div class="card-body px-0 py-3">

            @include ('errors')

            <div class="table-responsive rounded">
                <table class="table table-striped table-hover rounded">
                    <thead class="text-white rounded culoare2">
                    {{-- <thead class="text-white rounded" style="background-color: #69A1B1"> --}}
                        <tr class="" style="padding:2rem">
                            <th class="">#</th>
                            <th class="">Creat de</th>
                            <th class="">Nume client</th>
                            <th class="">Adresa</th>
                            <th class="">Telefon</th>
                            <th class="text-center">Status</th>
                            <th class="">Obervații</th>
                            <th class="text-center">Intrare</th>
                            <th class="text-center">
                                <form class="needs-validation mb-0" novalidate method="GET" action="{{ route(Route::currentRouteName())  }}">
                                    @csrf
                                    Lansare
                                    <input type="hidden" id="sortare_lansare" name="sortare_lansare" placeholder="Status"
                                        value="{{ ($sortare_lansare === "cea_mai_noua") ? "cea_mai_veche" : "cea_mai_noua" }}">
                                    <button class="btn btn-sm btn-primary text-white mx-1 border border-dark rounded-3" type="submit">
                                        <i class="fa-solid fa-sort"></i>
                                    </button>
                                    {{-- <a class="btn btn-sm btn-secondary text-white col-md-4 border border-dark rounded-3" href="{{ route(Route::currentRouteName())  }}" role="button">
                                        <i class="far fa-trash-alt text-white me-1"></i>Resetează căutarea
                                    </a> --}}
                                </form>
                            </th>
                            <th class="text-center">Oferță<br>preț</th>
                            <th class="text-center">Avans</th>
                            <th class="text-end">Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clienti as $client)
                            <tr>
                                <td align="">
                                    {{ ($clienti ->currentpage()-1) * $clienti ->perpage() + $loop->index + 1 }}
                                </td>
                                <td class="">
                                    {{ $client->user->name ?? ''}}
                                </td>
                                <td class="">
                                    {{ $client->nume }}
                                </td>
                                <td class="">
                                    {{ $client->adresa }}
                                </td>
                                <td class="">
                                    {{ $client->telefon }}
                                </td>
                                <td class="text-center">
                                    @switch($client->status)
                                        @case("In derulare")
                                                <span class="badge" style="background-color:orange">
                                                    {{ $client->status }}
                                                </span>
                                            @break
                                        @case("Contractat")
                                                <span class="badge" style="background-color:green">
                                                    {{ $client->status }}
                                                </span>
                                            @break
                                        @case("Pierdut")
                                                <span class="badge" style="background-color:red">
                                                    {{ $client->status }}
                                                </span>
                                            @break

                                        @default
                                            {{ $client->status }}
                                    @endswitch
                                </td>
                                <td class="">
                                    {{ $client->observatii }}
                                </td>
                                <td class="text-center">
                                    {{ $client->intrare ? \Carbon\Carbon::parse($client->intrare)->isoFormat('DD.MM.YYYY') : '' }}
                                </td>
                                <td class="text-center">
                                    {{ $client->lansare ? \Carbon\Carbon::parse($client->lansare)->isoFormat('DD.MM.YYYY') : '' }}
                                </td>
                                <td class="text-end">
                                    {{ $client->oferta_pret }}
                                </td>
                                <td class="text-end">
                                    {{ $client->avans }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ $client->path() }}/modifica" class="flex me-1">
                                            <span class="badge bg-primary">Modifică</span>
                                        </a>
                                        <div style="flex" class="">
                                            <a
                                                href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#stergeClientul{{ $client->id }}"
                                                title="Șterge Clientul"
                                                >
                                                <span class="badge bg-danger">Șterge</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ $client->path() }}" class="flex me-1">
                                            <span class="badge bg-success">Vizualizează</span>
                                        </a>
                                        <a class="" data-bs-toggle="collapse" href="#client{{ $loop->iteration }}" role="button" aria-expanded="false" aria-controls="client{{ $loop->iteration }}">
                                            <span class="badge bg-info">Istoric</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>

                            </tr>
                            <tr class="collapse multi-collapse" id="client{{ $loop->iteration }}">
                                <td colspan="12" class="">
                                    @if ($client->istoricuri->count() < 2)
                                        <div class="text-center">
                                            <span class="px-2 bg-info text-white">
                                                Acest client nu are nici o modificare
                                            </span>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-center">
                                            <div class="table-responsive rounded w-100 p-5">
                                                <table class="table table-hover rounded">
                                                    <thead class="text-white rounded bg-info">
                                                    {{-- <thead class="text-white rounded" style="background-color: #69A1B1"> --}}
                                                        <tr class="" style="padding:2rem">
                                                            <th class="">#</th>
                                                            <th class="">Modificat de</th>
                                                            <th class="">Nume client</th>
                                                            <th class="">Adresa</th>
                                                            <th class="">Telefon</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="">Obervații</th>
                                                            <th class="text-center">Intrare</th>
                                                            <th class="text-center">Lansare</th>
                                                            <th class="text-center">Oferță preț</th>
                                                            <th class="text-center">Avans</th>
                                                            <th class="text-center">Data operației</th>
                                                            <th class="text-end">Acțiuni</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($client->istoricuri as $client_istoric)
                                                            <tr>
                                                                <td>
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td>
                                                                    {{ $client_istoric->user->name ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $client_istoric->nume }}
                                                                </td>
                                                                <td>
                                                                    {{ $client_istoric->adresa }}
                                                                </td>
                                                                <td>
                                                                    {{ $client_istoric->telefon }}
                                                                </td>
                                                                <td class="text-center">
                                                                    @switch($client_istoric->status)
                                                                        @case("In derulare")
                                                                                <span class="badge" style="background-color:orange">
                                                                                    {{ $client_istoric->status }}
                                                                                </span>
                                                                            @break
                                                                        @case("Contractat")
                                                                                <span class="badge" style="background-color:green">
                                                                                    {{ $client_istoric->status }}
                                                                                </span>
                                                                            @break
                                                                        @case("Pierdut")
                                                                                <span class="badge" style="background-color:red">
                                                                                    {{ $client_istoric->status }}
                                                                                </span>
                                                                            @break

                                                                        @default
                                                                            {{ $client_istoric->status }}
                                                                    @endswitch
                                                                </td>
                                                                <td>
                                                                    {{ $client_istoric->observatii }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $client_istoric->intrare ? \Carbon\Carbon::parse($client_istoric->intrare)->isoFormat('DD.MM.YYYY') : '' }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $client_istoric->lansare ? \Carbon\Carbon::parse($client_istoric->lansare)->isoFormat('DD.MM.YYYY') : '' }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $client_istoric->oferta_pret }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $client_istoric->avans }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $client_istoric->data_operatie ? \Carbon\Carbon::parse($client_istoric->data_operatie)->isoFormat('DD.MM.YYYY HH:mm') : '' }}
                                                                </td>
                                                                <td class="text-end">
                                                                    @if ($loop->last)
                                                                        Versiunea curentă
                                                                    @else
                                                                        <a
                                                                            href="#"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#restaureazaClientul{{ $loop->parent->iteration }}Istoricul{{ $loop->iteration }}"
                                                                            title="Restaurează Istoricul"
                                                                            >
                                                                            <span class="badge bg-warning">Restaurează</span>
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            {{-- <div>Nu s-au gasit rezervări în baza de date. Încearcă alte date de căutare</div> --}}
                        @endforelse
                        </tbody>
                </table>
            </div>

                <nav>
                    <ul class="pagination justify-content-center">
                        {{$clienti->appends(Request::except('page'))->links()}}
                    </ul>
                </nav>
        </div>
    </div>

    {{-- Modalele pentru stergere client --}}
    @foreach ($clienti as $client)
        <div class="modal fade text-dark" id="stergeClientul{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Clientul: <b>{{ $client->titlu }}</b></h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align:left;">
                    Ești sigur ca vrei să ștergi Clientul?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Renunță</button>

                    <form method="POST" action="{{ $client->path() }}">
                        @method('DELETE')
                        @csrf
                        <button
                            type="submit"
                            class="btn btn-danger text-white"
                            >
                            Șterge Clientul
                        </button>
                    </form>

                </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modalele pentru restaurare istoric client --}}
    @foreach ($clienti as $client)
        @foreach ($client->istoricuri as $client_istoric)
            <div class="modal fade text-dark" id="restaureazaClientul{{ $loop->parent->iteration }}Istoricul{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="restaureazaClientIstoric" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="restaureazaClientIstoric">Clientul: <b>{{ $client->nume }}</b></h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-align:left;">
                        Ești sigur ca vrei să restaurezi versiunea anterioară?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Renunță</button>

                        <form method="POST" action="/clienti/{{ $client->id }}/restaurare-istoric/{{ $client_istoric->id_pk }}">
                            @method('POST')
                            @csrf
                            <button
                                type="submit"
                                class="btn btn-danger text-white"
                                >
                                Restaurează
                            </button>
                        </form>

                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach

@endsection
