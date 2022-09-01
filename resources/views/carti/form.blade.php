@csrf

<script type="application/javascript">
    carti = {!! json_encode($carti) !!}
    autor = {!! json_encode(old('autor', $carte->autor)) !!}
    editura = {!! json_encode(old('editura', $carte->editura)) !!}
    loc_publicare = {!! json_encode(old('loc_publicare', $carte->loc_publicare)) !!}
    subiecte = {!! json_encode(old('subiecte', $carte->subiecte)) !!}
    limba = {!! json_encode(old('limba', $carte->limba)) !!}
    tip_material = {!! json_encode(old('tip_material', $carte->tip_material)) !!}
    locatie = {!! json_encode(old('locatie', $carte->locatie)) !!}
</script>


<div class="row mb-0 p-3 d-flex border-radius: 0px 0px 40px 40px" id="carte">
    <div class="col-lg-12 mb-0">

        <div class="row mb-0">
            <div class="col-lg-8 mb-5 mx-auto">
                <label for="titlu" class="mb-0 ps-3">Titlu<span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('titlu') ? 'is-invalid' : '' }}"
                    name="titlu"
                    placeholder=""
                    value="{{ old('titlu', $carte->titlu) }}"
                    required>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="autor" class="mb-0 ps-3">Autor **</label>
                <input
                    type="text"
                    v-model="autor_autocomplete"
                    {{-- v-on:keyup="autocomplete('autor')" --}}
                    v-on:focus="nume_camp = 'autor'; valoare_camp = $event.target.value; autocomplete()"
                    v-on:input="nume_camp = 'autor'; valoare_camp = $event.target.value; autocomplete()"
                    {{-- v-on:focus="nume_camp = 'autor'; valoare_camp = $event.target.value;" --}}
                    {{-- v-on:blur="nume_camp = ''; valoare_camp = '';" --}}
                    class="form-control bg-white rounded-3 {{ $errors->has('autor') ? 'is-invalid' : '' }}"
                    name="autor"
                    placeholder=""
                    ref="autor"
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="nume_camp == 'autor'" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="autor in carti_lista_autocomplete"
                                v-on:click="
                                    {{-- se sterge ce este introdus dupa ultima virgula. +1 pastreaza si virgula --}}
                                    {{-- autor_autocomplete.lastIndexOf(',') == -1 -- Daca nu este primul element, se adauga un spatiu, dupa virgula --}}
                                    {{-- autor_autocomplete += autor -- se adauga in string textul pe care se da click --}}
                                    autor_autocomplete = autor_autocomplete.substr(0, autor_autocomplete.lastIndexOf(',') + 1);
                                    autor_autocomplete += (autor_autocomplete.lastIndexOf(',') == -1 ? '' : ' ');
                                    autor_autocomplete += autor;

                                    carti_lista_autocomplete = '';
                                    {{-- this.$refs.editura.focus(); --}}
                                ">
                                    @{{ autor }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="autor" class="mb-0 ps-3">Autor **</label>
                <input
                    type="text"
                    v-model="autor_autocomplete"
                    v-on:keyup="autorAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('autor') ? 'is-invalid' : '' }}"
                    name="autor"
                    placeholder=""
                    ref="autor"
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_autor_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="autor in carti_lista_autor_autocomplete"
                                v-on:click="
                                    {{-- se sterge ce este introdus dupa ultima virgula. +1 pastreaza si virgula --}}
                                    {{-- autor_autocomplete.lastIndexOf(',') == -1 -- Daca nu este primul element, se adauga un spatiu, dupa virgula --}}
                                    {{-- autor_autocomplete += autor -- se adauga in string textul pe care se da click --}}
                                    autor_autocomplete = autor_autocomplete.substr(0, autor_autocomplete.lastIndexOf(',') + 1);
                                    autor_autocomplete += (autor_autocomplete.lastIndexOf(',') == -1 ? '' : ' ');
                                    autor_autocomplete += autor;

                                    carti_lista_autor_autocomplete = '';
                                    this.$refs.editura.focus();
                                ">
                                    @{{ autor }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="editura" class="mb-0 ps-3">Editura **</label>
                <input
                    type="text"
                    v-model="editura_autocomplete"
                    v-on:keyup="edituraAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('editura') ? 'is-invalid' : '' }}"
                    name="editura"
                    placeholder=""
                    ref="editura"
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_editura_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="editura in carti_lista_editura_autocomplete"
                                v-on:click="
                                    editura_autocomplete = editura_autocomplete.substr(0, editura_autocomplete.lastIndexOf(',') + 1);
                                    editura_autocomplete += (editura_autocomplete.lastIndexOf(',') == -1 ? '' : ' ');
                                    editura_autocomplete += editura;

                                    carti_lista_editura_autocomplete = '';
                                    this.$refs.loc_publicare.focus();
                                ">
                                    @{{ editura }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="loc_publicare" class="mb-0 ps-3">Loc publicare **</label>
                <input
                    type="text"
                    v-model="loc_publicare_autocomplete"
                    v-on:keyup="loc_publicareAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('loc_publicare') ? 'is-invalid' : '' }}"
                    name="loc_publicare"
                    placeholder=""
                    ref="loc_publicare"
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_loc_publicare_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="loc_publicare in carti_lista_loc_publicare_autocomplete"
                                v-on:click="
                                    loc_publicare_autocomplete = loc_publicare_autocomplete.substr(0, loc_publicare_autocomplete.lastIndexOf(',') + 1);
                                    loc_publicare_autocomplete += (loc_publicare_autocomplete.lastIndexOf(',') == -1 ? '' : ' ');
                                    loc_publicare_autocomplete += loc_publicare;

                                    carti_lista_loc_publicare_autocomplete = '';
                                    this.$refs.an_publicare.focus();
                                ">
                                    @{{ loc_publicare }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="an_publicare" class="mb-0 ps-3">An publicare</label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('an_publicare') ? 'is-invalid' : '' }}"
                    name="an_publicare"
                    placeholder=""
                    value="{{ old('an_publicare', $carte->an_publicare) }}"
                    ref="an_publicare"
                    required>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="isbn_issn" class="mb-0 ps-3">ISBN/ ISSN</label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('isbn_issn') ? 'is-invalid' : '' }}"
                    name="isbn_issn"
                    placeholder=""
                    value="{{ old('isbn_issn', $carte->isbn_issn) }}"
                    required>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="subiecte" class="mb-0 ps-3">Subiecte **</label>
                <input
                    type="text"
                    v-model="subiecte_autocomplete"
                    v-on:keyup="subiecteAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('subiecte') ? 'is-invalid' : '' }}"
                    name="subiecte"
                    placeholder=""
                    ref="subiecte"
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_subiecte_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="subiecte in carti_lista_subiecte_autocomplete"
                                v-on:click="
                                    subiecte_autocomplete = subiecte_autocomplete.substr(0, subiecte_autocomplete.lastIndexOf(',') + 1);
                                    subiecte_autocomplete += (subiecte_autocomplete.lastIndexOf(',') == -1 ? '' : ' ');
                                    subiecte_autocomplete += subiecte;

                                    carti_lista_subiecte_autocomplete = '';
                                    this.$refs.inventar.focus();
                                ">
                                    @{{ subiecte }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="inventar" class="mb-0 ps-3">Inventar</label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('inventar') ? 'is-invalid' : '' }}"
                    name="inventar"
                    placeholder=""
                    value="{{ old('inventar', $carte->inventar) }}"
                    ref="inventar"
                    required>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="limba" class="mb-0 ps-3">Limba **</label>
                <input
                    type="text"
                    v-model="limba_autocomplete"
                    v-on:keyup="limbaAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('limba') ? 'is-invalid' : '' }}"
                    name="limba"
                    placeholder=""
                    ref="limba"
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_limba_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="limba in carti_lista_limba_autocomplete"
                                v-on:click="
                                    limba_autocomplete = limba_autocomplete.substr(0, limba_autocomplete.lastIndexOf(',') + 1);
                                    limba_autocomplete += (limba_autocomplete.lastIndexOf(',') == -1 ? '' : ' ');
                                    limba_autocomplete += limba;

                                    carti_lista_limba_autocomplete = '';
                                    this.$refs.tip_material.focus();
                                ">
                                    @{{ limba }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="tip_material" class="mb-0 ps-3">Tip material **</span></label>
                <input
                    type="text"
                    v-model="tip_material_autocomplete"
                    v-on:keyup="tip_materialAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('tip_material') ? 'is-invalid' : '' }}"
                    name="tip_material"
                    placeholder=""
                    ref="tip_material"
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_tip_material_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="tip_material in carti_lista_tip_material_autocomplete"
                                v-on:click="
                                    tip_material_autocomplete = tip_material_autocomplete.substr(0, tip_material_autocomplete.lastIndexOf(',') + 1);
                                    tip_material_autocomplete += (tip_material_autocomplete.lastIndexOf(',') == -1 ? '' : ' ');
                                    tip_material_autocomplete += tip_material;

                                    carti_lista_tip_material_autocomplete = '';
                                    this.$refs.locatie.focus();
                                ">
                                    @{{ tip_material }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="locatie" class="mb-0 ps-3">Locație **</span></label>
                <input
                    type="text"
                    v-model="locatie_autocomplete"
                    v-on:keyup="locatieAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('locatie') ? 'is-invalid' : '' }}"
                    name="locatie"
                    placeholder=""
                    ref="locatie"
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_locatie_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="locatie in carti_lista_locatie_autocomplete"
                                v-on:click="
                                    locatie_autocomplete = locatie_autocomplete.substr(0, locatie_autocomplete.lastIndexOf(',') + 1);
                                    locatie_autocomplete += (locatie_autocomplete.lastIndexOf(',') == -1 ? '' : ' ');
                                    locatie_autocomplete += locatie;

                                    carti_lista_locatie_autocomplete = '';
                                    this.$refs.submit.focus();
                                ">
                                    @{{ locatie }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-12 ms-2 mb-5 border-start border-info border-4"
                {{-- style="border:1px solid #e9ecef; border-left:0.25rem rgb(1, 119, 255) solid;" --}}
            >
                ** Introdu minim 3 caractere pentru a vedea entități similare introduse deja în baza de date.
                <br>
                ** Dacă vrei să adaugi mai multe entități, separă-le cu virgulă.
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-2 d-flex justify-content-center">
                <button type="submit" ref="submit" class="btn btn-primary text-white me-3 rounded-3">{{ $buttonText }}</button>
                <a class="btn btn-secondary rounded-3" href="{{ Session::get('carte_return_url') }}">Renunță</a>
            </div>
        </div>
    </div>
</div>
