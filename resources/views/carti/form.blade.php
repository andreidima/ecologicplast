@csrf

<script type="application/javascript">
    carti = {!! json_encode($carti) !!}
    autor = {!! json_encode(old('autor', $carte->autor)) !!}
    editura = {!! json_encode(old('editura', $carte->editura)) !!}
    loc_publicare = {!! json_encode(old('loc_publicare', $carte->loc_publicare)) !!}
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
                <label for="autor" class="mb-0 ps-3">Autor</span></label>
                <input
                    type="text"
                    v-model="autor_autocomplete"
                    v-on:keyup="autorAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('autor') ? 'is-invalid' : '' }}"
                    name="autor"
                    placeholder=""
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_autor_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="carte in carti_lista_autor_autocomplete"
                                v-on:click="
                                    autor_autocomplete = carte.autor;

                                    carti_lista_autor_autocomplete = ''
                                ">
                                    @{{ carte.autor }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="editura" class="mb-0 ps-3">Editura</span></label>
                <input
                    type="text"
                    v-model="editura_autocomplete"
                    v-on:keyup="edituraAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('editura') ? 'is-invalid' : '' }}"
                    name="editura"
                    placeholder=""
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_editura_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="carte in carti_lista_editura_autocomplete"
                                v-on:click="
                                    editura_autocomplete = carte.editura;

                                    carti_lista_editura_autocomplete = ''
                                ">
                                    @{{ carte.editura }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="loc_publicare" class="mb-0 ps-3">Loc publicare</span></label>
                <input
                    type="text"
                    v-model="loc_publicare_autocomplete"
                    v-on:keyup="loc_publicareAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('loc_publicare') ? 'is-invalid' : '' }}"
                    name="loc_publicare"
                    placeholder=""
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_loc_publicare_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="carte in carti_lista_loc_publicare_autocomplete"
                                v-on:click="
                                    loc_publicare_autocomplete = carte.loc_publicare;

                                    carti_lista_loc_publicare_autocomplete = ''
                                ">
                                    @{{ carte.loc_publicare }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="an_publicare" class="mb-0 ps-3">An publicare</span></label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('an_publicare') ? 'is-invalid' : '' }}"
                    name="an_publicare"
                    placeholder=""
                    value="{{ old('an_publicare', $carte->an_publicare) }}"
                    required>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="isbn_issn" class="mb-0 ps-3">ISBN/ ISSN</span></label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('isbn_issn') ? 'is-invalid' : '' }}"
                    name="isbn_issn"
                    placeholder=""
                    value="{{ old('isbn_issn', $carte->isbn_issn) }}"
                    required>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="subiecte" class="mb-0 ps-3">Subiecte</span></label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('subiecte') ? 'is-invalid' : '' }}"
                    name="subiecte"
                    placeholder=""
                    value="{{ old('subiecte', $carte->subiecte) }}"
                    required>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="inventar" class="mb-0 ps-3">Inventar</span></label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('inventar') ? 'is-invalid' : '' }}"
                    name="inventar"
                    placeholder=""
                    value="{{ old('inventar', $carte->inventar) }}"
                    required>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="limba" class="mb-0 ps-3">Limba</span></label>
                <input
                    type="text"
                    v-model="limba_autocomplete"
                    v-on:keyup="limbaAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('limba') ? 'is-invalid' : '' }}"
                    name="limba"
                    placeholder=""
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_limba_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="carte in carti_lista_limba_autocomplete"
                                v-on:click="
                                    limba_autocomplete = carte.limba;

                                    carti_lista_limba_autocomplete = ''
                                ">
                                    @{{ carte.limba }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="tip_material" class="mb-0 ps-3">Tip material</span></label>
                <input
                    type="text"
                    v-model="tip_material_autocomplete"
                    v-on:keyup="tip_materialAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('tip_material') ? 'is-invalid' : '' }}"
                    name="tip_material"
                    placeholder=""
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_tip_material_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="carte in carti_lista_tip_material_autocomplete"
                                v-on:click="
                                    tip_material_autocomplete = carte.tip_material;

                                    carti_lista_tip_material_autocomplete = ''
                                ">
                                    @{{ carte.tip_material }}
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 mb-5 mx-auto">
                <label for="locatie" class="mb-0 ps-3">Locație</span></label>
                <input
                    type="text"
                    v-model="locatie_autocomplete"
                    v-on:keyup="locatieAutoComplete()"
                    class="form-control bg-white rounded-3 {{ $errors->has('locatie') ? 'is-invalid' : '' }}"
                    name="locatie"
                    placeholder=""
                    autocomplete="off"
                    required>
                    <div v-cloak v-if="carti_lista_locatie_autocomplete.length" class="panel-footer">
                        <div class="list-group">
                            <button class="list-group-item list-group-item list-group-item-action py-0"
                                v-for="carte in carti_lista_locatie_autocomplete"
                                v-on:click="
                                    locatie_autocomplete = carte.locatie;

                                    carti_lista_locatie_autocomplete = ''
                                ">
                                    @{{ carte.locatie }}
                            </button>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-2 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary text-white me-3 rounded-3">{{ $buttonText }}</button>
                <a class="btn btn-secondary rounded-3" href="{{ Session::get('carte_return_url') }}">Renunță</a>
            </div>
        </div>
    </div>
</div>
