@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="shadow-lg" style="border-radius: 40px 40px 40px 40px;">
                <div class="border border-secondary p-2" style="border-radius: 40px 40px 0px 0px; background-color:#e66800">
                    <span class="badge text-light fs-5">
                        <i class="fa-solid fa-calendar-check me-1"></i>Programări / {{ $programare->client ?? '' }}
                    </span>
                </div>

                <div class="card-body py-2 border border-secondary"
                    style="border-radius: 0px 0px 40px 40px;"
                >

            @include ('errors')

                    <div class="table-responsive col-md-12 mx-auto">
                        <table class="table table-striped table-hover"
                        >
                            <tr>
                                <td class="pe-4">
                                    Client
                                </td>
                                <td>
                                    {{ $programare->client }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Telefon
                                </td>
                                <td>
                                    {{ $programare->telefon }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Email
                                </td>
                                <td>
                                    {{ $programare->email }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Mașina
                                </td>
                                <td>
                                    {{ $programare->masina }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Nr auto
                                </td>
                                <td>
                                    {{ $programare->nr_auto }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Dată și oră programare
                                </td>
                                <td>
                                    {{ $programare->data_ora_programare ? \Carbon\Carbon::parse($programare->data_ora_programare)->isoFormat('DD.MM.YYYY HH:mm') : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Dată și oră finalizare
                                </td>
                                <td>
                                    {{ $programare->data_ora_finalizare ? \Carbon\Carbon::parse($programare->data_ora_finalizare)->isoFormat('DD.MM.YYYY HH:mm') : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Lucrare
                                </td>
                                <td>
                                    {{ $programare->lucrare }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Canal
                                </td>
                                <td>
                                    {{ ($programare->lucrare_canal == '1') ? 'DA' : 'NU' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Geometrie
                                </td>
                                <td>
                                    {{ ($programare->lucrare_geometrie == '1') ? 'DA' : 'NU' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Freon
                                </td>
                                <td>
                                    {{ ($programare->lucrare_freon == '1') ? 'DA' : 'NU' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Piese client
                                </td>
                                <td>
                                    {{ ($programare->piese_client == '1') ? 'DA' : 'NU' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Observații
                                </td>
                                <td>
                                    {{ $programare->observatii }}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="form-row mb-2 px-2">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <a class="btn btn-primary text-white rounded-3" href="{{ Session::get('programare_return_url') }}">Înapoi</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
