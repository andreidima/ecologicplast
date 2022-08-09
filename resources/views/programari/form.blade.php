@csrf

<div class="row mb-0 p-3 d-flex border-radius: 0px 0px 40px 40px" id="app">
    <div class="col-lg-12 mb-0">

        <div class="row mb-0" id="programari">
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="client" class="mb-0 ps-3">Client<span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('client') ? 'is-invalid' : '' }}"
                    name="client"
                    placeholder=""
                    value="{{ old('client', $programare->client) }}"
                    required>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="telefon" class="mb-0 ps-3">Telefon</label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('telefon') ? 'is-invalid' : '' }}"
                    name="telefon"
                    placeholder=""
                    value="{{ old('telefon', $programare->telefon) }}"
                    required>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="email" class="mb-0 ps-3">Email</label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    name="email"
                    placeholder=""
                    value="{{ old('email', $programare->email) }}"
                    required>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="masina" class="mb-0 ps-3">Mașina</label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('masina') ? 'is-invalid' : '' }}"
                    name="masina"
                    placeholder=""
                    value="{{ old('masina', $programare->masina) }}"
                    required>
            </div>
            <div class="col-lg-2 mb-5 mx-auto">
                <label for="nr_auto" class="mb-0 ps-3">Nr. auto</label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('nr_auto') ? 'is-invalid' : '' }}"
                    name="nr_auto"
                    placeholder=""
                    value="{{ old('nr_auto', $programare->nr_auto) }}"
                    required>
            </div>
            <div class="col-lg-3 mb-5 mx-auto d-flex justify-content-start">
                <div>
                    <label for="data_ora_programare" class="mb-0 ps-xxl-2"><small>Dată și oră programare</small></label>
                    <vue-datepicker-next
                        data-veche="{{ old('data_ora_programare', ($programare->data_ora_programare ?? '')) }}"
                        nume-camp-db="data_ora_programare"
                        tip="datetime"
                        :hours="[8,9,10,11,12,13,14,15,16]"
                        :minute-step="10"
                        {{-- disabled-date="disabledDuminica" --}}
                        value-type="YYYY-MM-DD HH:mm"
                        format="DD-MM-YYYY HH:mm"
                        :latime="{ width: '170px' }"
                        style="margin-right: 20px;"
                    ></vue-datepicker-next>
                </div>
            </div>
            <div class="col-lg-3 mb-5 mx-auto d-flex justify-content-start">
                <div>
                    <label for="data_ora_finalizare" class="mb-0 ps-xxl-2"><small>Dată și oră finalizare</small></label>
                    <vue-datepicker-next
                        data-veche="{{ old('data_ora_finalizare', ($programare->data_ora_finalizare ?? '')) }}"
                        nume-camp-db="data_ora_finalizare"
                        tip="datetime"
                        :hours="[8,9,10,11,12,13,14,15,16]"
                        :minute-step="10"
                        value-type="YYYY-MM-DD HH:mm"
                        format="DD-MM-YYYY HH:mm"
                        :latime="{ width: '170px' }"
                        style="margin-right: 20px;"
                    ></vue-datepicker-next>
                </div>
            </div>
            <div class="col-lg-8 mb-5 mx-auto">
                <label for="lucrare" class="form-label mb-0 ps-3">Lucrare</label>
                <textarea class="form-control bg-white {{ $errors->has('lucrare') ? 'is-invalid' : '' }}"
                    name="lucrare" rows="5">{{ old('lucrare', $programare->lucrare) }}</textarea>
            </div>
            <div class="col-lg-4 mb-5 ps-s mx-auto d-flex align-items-center">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="hidden" name="geometrie_turism" value="0" />
                        <input class="form-check-input" type="checkbox" value="1" name="geometrie_turism" id="geometrie_turism"
                            {{ old('geometrie_turism', $programare->geometrie_turism) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="geometrie_turism">Geometrie Turism</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="hidden" name="geometrie_camion" value="0" />
                        <input class="form-check-input" type="checkbox" value="1" name="geometrie_camion" id="geometrie_camion"
                            {{ old('geometrie_camion', $programare->geometrie_camion) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="geometrie_camion">Geometrie Camion</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="hidden" name="freon" value="0" />
                        <input class="form-check-input" type="checkbox" value="1" name="freon" id="freon"
                            {{ old('freon', $programare->freon) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="freon">Freon</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-5 ps-s mx-auto d-flex align-items-center" style="">
                <div>
                    Piese:
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" name="piese" id="piese_fara"
                            {{ old('piese', $programare->piese) == '0' ? 'checked' : '' }}>
                        <label class="form-check-label" for="piese_fara">Fără</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" name="piese" id="piese_comandate"
                            {{ old('piese', $programare->piese) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="piese_comandate">Comandate</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="2" name="piese" id="piese_venite"
                            {{ old('piese', $programare->piese) == '2' ? 'checked' : '' }}>
                        <label class="form-check-label" for="piese_venite">Venite</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="3" name="piese" id="piese_client"
                            {{ old('piese', $programare->piese) == '3' ? 'checked' : '' }}>
                        <label class="form-check-label" for="piese_client">Client</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-5 ps-s mx-auto d-flex align-items-end">
                <div>
                    Stare mașină:
                    <br>
                    <div class="form-check px-4">
                        <input class="form-check-input" type="radio" value="0" name="stare_masina" id="stare_masina_nu_este_la_service"
                            {{ old('stare_masina', $programare->stare_masina) == '0' ? 'checked' : '' }}>
                        <label class="form-check-label" for="stare_masina_nu_este_la_service">Nu este la service</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" name="stare_masina" id="stare_masina_in_asteptare"
                            {{ old('stare_masina', $programare->stare_masina) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="stare_masina_in_asteptare">În așteptare</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="2" name="stare_masina" id="stare_masina_in_lucru"
                            {{ old('stare_masina', $programare->stare_masina) == '2' ? 'checked' : '' }}>
                        <label class="form-check-label" for="stare_masina_in_lucru">În lucru</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="3" name="stare_masina" id="stare_masina_finalizata"
                            {{ old('stare_masina', $programare->stare_masina) == '3' ? 'checked' : '' }}>
                        <label class="form-check-label" for="stare_masina_finalizata">Finalizată</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-5 mx-auto">
                <label for="observatii" class="form-label mb-0 ps-3">Observații</label>
                <textarea class="form-control bg-white {{ $errors->has('observatii') ? 'is-invalid' : '' }}"
                    name="observatii" rows="4">{{ old('observatii', $programare->observatii) }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-2 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary text-white me-3 rounded-3">{{ $buttonText }}</button>
                <a class="btn btn-secondary rounded-3" href="{{ Session::get('programare_return_url') }}">Renunță</a>
            </div>
        </div>
    </div>
</div>
