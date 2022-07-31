@extends ('layouts.app')

@section('content')
<div class="container card" style="border-radius: 40px 40px 40px 40px;">
        <div class="row card-header align-items-center" style="border-radius: 40px 40px 0px 0px;">
            <div class="col-lg-3">
                <span class="badge culoare1 fs-5">
                    <i class="fa-solid fa-calendar-check me-1"></i>Programări
                </span>
            </div>
            @php
                // dd(Route::currentRouteName(), Route::currentRouteAction());
            @endphp

            <div class="col-lg-6">
                @if (Route::currentRouteName() === "programari.index")
                    <form class="needs-validation" novalidate method="GET" action="{{ route(Route::currentRouteName())  }}">
                        @csrf
                        <div class="row mb-1 input-group custom-search-form justify-content-center" id="programari">
                            <div class="col-lg-6">
                                <input type="text" class="form-control rounded-3" id="search_client" name="search_client" placeholder="Client" value="{{ $search_client }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control rounded-3" id="search_telefon" name="search_telefon" placeholder="Telefon" value="{{ $search_telefon }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control rounded-3" id="search_nr_auto" name="search_nr_auto" placeholder="Nr. auto" value="{{ $search_nr_auto }}">
                            </div>
                            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                {{-- <div> --}}
                                    <label class="me-1">Data:</label>
                                    <vue-datepicker-next
                                        data-veche="{{ $search_data }}"
                                        nume-camp-db="search_data"
                                        tip="date"
                                        value-type="YYYY-MM-DD"
                                        format="DD-MM-YYYY"
                                        :latime="{ width: '125px' }"
                                        style="margin-right: 20px;"
                                    ></vue-datepicker-next>
                                {{-- </div> --}}
                            </div>
                        </div>
                        <div class="row input-group custom-search-form justify-content-center">
                            <button class="btn btn-sm btn-primary text-white col-md-4 me-3 border border-dark rounded-3" type="submit">
                                <i class="fas fa-search text-white me-1"></i>Caută
                            </button>
                            <a class="btn btn-sm bg-secondary text-white col-md-4 border border-dark rounded-3" href="/programari" role="button">
                                <i class="far fa-trash-alt text-white me-1"></i>Resetează căutarea
                            </a>
                        </div>
                    </form>
                @endif
            </div>
            <div class="col-lg-3 text-end">
                <a class="btn btn-sm bg-success text-white border border-dark rounded-3 col-md-8" href="/programari/adauga" role="button">
                    <i class="fas fa-plus-square text-white me-1"></i>Adaugă programare
                </a>
            </div>
        </div>

        <div class="card-body px-0 py-3">

            @include ('errors')

            @if (Route::currentRouteName() === "programari.index")
                <div class="table-responsive rounded">
                    <table class="table table-striped table-hover rounded">
                        <thead class="text-white rounded culoare2">
                            <tr class="" style="padding:2rem">
                                <th>#</th>
                                <th>Client</th>
                                <th>Telefon</th>
                                <th class="text-center">Dată și oră programare</th>
                                <th class="text-center">Dată și oră finalizare</th>
                                <th class="text-center">Nr. auto</th>
                                <th class="text-end">Acțiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($programari as $programare)
                                <tr>
                                    <td align="">
                                        {{ ($programari ->currentpage()-1) * $programari ->perpage() + $loop->index + 1 }}
                                    </td>
                                    <td>
                                        <b>{{ $programare->client ?? '' }}</b>
                                    </td>
                                    <td>
                                        <b>{{ $programare->telefon ?? '' }}</b>
                                    </td>
                                    <td class="text-center">
                                        <b>{{ $programare->data_ora_programare ? \Carbon\Carbon::parse($programare->data_ora_programare)->isoFormat('DD.MM.YYYY HH:mm') : '' }}</b>
                                    </td>
                                    <td class="text-center">
                                        <b>{{ $programare->data_ora_finalizare ? \Carbon\Carbon::parse($programare->data_ora_finalizare)->isoFormat('DD.MM.YYYY HH:mm') : '' }}</b>
                                    </td>
                                    <td class="text-center">
                                        <b>{{ $programare->nr_auto ?? '' }}</b>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ $programare->path() }}" class="flex me-1">
                                                <span class="badge bg-success">Vizualizează</span>
                                            </a>
                                            <a href="{{ $programare->path() }}/modifica" class="flex me-1">
                                                <span class="badge bg-primary">Modifică</span>
                                            </a>
                                            <div style="flex" class="">
                                                <a
                                                    href="#"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#stergeProgramarea{{ $programare->id }}"
                                                    title="Șterge Programarea"
                                                    >
                                                    <span class="badge bg-danger">Șterge</span>
                                                </a>
                                            </div>
                                        </div>
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
                            {{$programari->appends(Request::except('page'))->links()}}
                        </ul>
                    </nav>
            @elseif (Route::currentRouteName() === "programari.afisareCalendar")
                {{-- <div class="table-responsive rounded mb-4">
                    <table class="table table-striped table-hover table-sm rounded table-bordered">
                        <thead class="rounded culoare2">
                            <tr class="" style="padding:2rem">
                                <th class="px-0 text-center">Ora</th>
                                @for ($ziua = \Carbon\Carbon::parse($search_data_inceput); $ziua <= \Carbon\Carbon::parse($search_data_sfarsit); $ziua->addDay())
                                    @if ($ziua->dayOfWeekIso != 7)
                                        <td class="px-0 text-center">
                                    @else
                                        <td class="px-0 text-center culoare1">
                                    @endif
                                            {{ ucfirst($ziua->minDayName) }}
                                            <br>
                                            {{ $ziua->day }}
                                    </td>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @for ($ora = \Carbon\Carbon::now()->hour(8)->minute(0)->second(0); $ora <= \Carbon\Carbon::now()->hour(16)->minute(50)->second(0) ; $ora->addMinutes(10))
                                <tr>
                                    <td class="px-0 py-0 text-center text-white culoare2">
                                        <b>{{ $ora->isoFormat('HH:mm') }}</b>
                                    </td>
                                        @for ($ziua = \Carbon\Carbon::parse($search_data_inceput); $ziua <= \Carbon\Carbon::parse($search_data_sfarsit); $ziua->addDay())
                                            @php
                                                $ziua->hour = $ora->hour;
                                                $ziua->minute = $ora->minute;
                                            @endphp

                                            <td class="px-0 py-0 text-start">
                                                @if (
                                                    ($ora->hour === 12) || // Pauza de masa
                                                    (($ziua->dayOfWeekIso === 6) && ($ora->hour >= 13)) || // Sambata program pana la 13:00
                                                    ($ziua->dayOfWeekIso === 7) // Duminica liber
                                                    )
                                                @else
                                                    <div class="d-flex">
                                                        @php
                                                            $nr_masini = 0;
                                                        @endphp
                                                        @foreach ($programari->where('data_ora_programare', '<=', $ziua)->where('data_ora_finalizare', '>=', $ziua->addHour()) as $programare)
                                                            <a href="{{ $programare->path() }}/modifica">
                                                                @switch($nr_masini)
                                                                    @case(0)
                                                                        <div class="text-white" style="width:20px; height: 100%; background-color:rgb(0, 110, 37);">
                                                                        @break
                                                                    @case(1)
                                                                        <div class="text-white" style="width:20px; height: 100%; background-color:rgb(48, 151, 0);">
                                                                        @break
                                                                    @case(2)
                                                                        <div class="text-white" style="width:20px; height: 100%; background-color:rgb(229, 255, 0);">
                                                                        @break
                                                                    @case(3)
                                                                        <div class="text-white" style="width:20px; height: 100%; background-color:rgb(196, 0, 0);">
                                                                        @break
                                                                    @default
                                                                        <div class="text-white" style="width:20px; height: 100%; background-color:red;">
                                                                @endswitch
                                                                    {{ ++$nr_masini }}
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif

                                            @php
                                                $ziua->hour = 0; // altfel ultima zi din iteratie nu va mai fi egala cu search_data_sfarsit, va fi mai mai cu acele ore adaugate
                                            @endphp
                                            </td>
                                        @endfor
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div> --}}

        <div class="row mb-2">
            @for ($ziua = \Carbon\Carbon::parse($search_data_inceput); $ziua <= \Carbon\Carbon::parse($search_data_sfarsit); $ziua->addDay())
                <div class="col-md-2 p-0">
                    <div class="" style="border-radius: 20px 20px 0px 0px;">
                        <div class="border border-secondary p-2" style="border-radius: 20px 20px 0px 0px; background-color:#005a5a">
                            <h5 class="my-0 text-center" style="color:white">
                                <b>{{ $ziua->isoFormat('dddd') }}</b>
                                <br>
                                {{ $ziua->isoFormat('DD') }}
                            </h5>
                        </div>
                        <div class="d-flex">
                                    <div class="" style="width: 30px;">
                                        @for ($i = 8; $i <= 16; $i++)
                                            <div class="border border-secondary text-center" style="width: 100%; height:60px; background-color:white;">
                                                {{ $i }}
                                            </div>
                                        @endfor
                                    </div>

                                    <div class="" style="width:100%">
                                        @php
                                            $ora_initiala = \Carbon\Carbon::now();
                                            $ora_initiala->hour = 9;
                                            $ora_initiala->minute = 0;
                                            $ora_initiala->second = 0;

                                            $ora_finala = \Carbon\Carbon::now();
                                            $ora_finala->hour = 19;
                                            $ora_finala->minute = 0;
                                            $ora_finala->second = 0;

                                            $total_minute_zi = 0;
                                        @endphp

                                        {{-- @forelse ($programari->where('programare_data', \Carbon\Carbon::now()->weekday($week_day)->toDateString()) as $programare)
                                            @php
                                                //variabila pentru crearea divului gol
                                                $durata_minute_inainte = $ora_initiala->diffInMinutes($programare->programare_ora);
                                                //variabila pentru crearea divului cu programarea
                                                $durata_minute =
                                                    (
                                                        \Carbon\Carbon::parse($programare->programare_durata)->isoFormat('HH') * 60
                                                        +
                                                        \Carbon\Carbon::parse($programare->programare_durata)->isoFormat('mm')
                                                    );
                                                //setarea orei de unde incepe calcularea la programarea urmatoare
                                                $ora_initiala = \Carbon\Carbon::parse($programare->programare_ora)->addMinutes($durata_minute);
                                                //variabila de control
                                                $total_minute_zi += $durata_minute_inainte + $durata_minute;
                                            @endphp
                                            <div class="border border-secondary" style="width: 100%; background-color:white; height:{{ $durata_minute_inainte }}px;">
                                            </div>
                                            <div class="border border-secondary text-center p-0 text-white" style="width: 100%; background-color:darkgreen; height:{{ $durata_minute }}px;
                                                line-height: 1;"
                                                title="
                                                        {{
                                                            \Carbon\Carbon::parse($programare->programare_ora)->isoFormat('HH:mm') .
                                                            '-' .
                                                            \Carbon\Carbon::parse($programare->programare_ora)->addMinutes($durata_minute)->isoFormat('HH:mm')
                                                        }}. {{ $programare->pacient->nume ?? '' }} {{ $programare->pacient->prenume ?? ''}}.@foreach ($programare->servicii as $serviciu) {{ $serviciu->nume ?? '' }}.@endforeach
                                                        "
                                                >
                                                {{
                                                    $programare->pacient->nume ?? ''
                                                }}
                                                {{
                                                    $programare->pacient->prenume ?? ''
                                                }}
                                                <br>
                                                {{
                                                            \Carbon\Carbon::parse($programare->programare_ora)->isoFormat('HH:mm') .
                                                            '-' .
                                                            \Carbon\Carbon::parse($programare->programare_ora)->addMinutes($durata_minute)->isoFormat('HH:mm')
                                                }}
                                            </div>

                                            @if ($loop->last)
                                                @php
                                                    $durata_minute_final = $ora_finala->diffInMinutes($ora_initiala);
                                                    $total_minute_zi += $durata_minute_final;
                                                @endphp
                                                @if ($total_minute_zi > 600)
                                                    <script type="application/javascript">
                                                        programariSuprapuse{!! json_encode($week_day) !!}=true;
                                                    </script>
                                                @else
                                                    <div class="border border-secondary" style="width: 100%; background-color:white; height:{{ $durata_minute_final }}px;">
                                                    </div>
                                                @endif
                                            @endif
                                        @empty
                                            <div class="border border-secondary" style="width: 100%; background-color:white; height:600px;">
                                            </div>
                                        @endforelse --}}
                                    </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

            @endif
        </div>
    </div>

    {{-- Modalele pentru stergere programare --}}
    @if (Route::currentRouteName() === "programari.index")
        @foreach ($programari as $programare)
            <div class="modal fade text-dark" id="stergeProgramarea{{ $programare->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Programarea: <b>{{ $programare->client ?? '' }}</b></h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-align:left;">
                        Ești sigur ca vrei să ștergi Programarea?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Renunță</button>

                        <form method="POST" action="{{ $programare->path() }}">
                            @method('DELETE')
                            @csrf
                            <button
                                type="submit"
                                class="btn btn-danger text-white"
                                >
                                Șterge Programarea
                            </button>
                        </form>

                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


@endsection