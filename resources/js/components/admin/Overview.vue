<template>
  <div style="margin-top: 8rem">
    <div class="mx-5 mt-5" fluid>
      <div class="row">
        <div class="col">
          <div class="card" no-body style="background-color: #ecf0f5">
            <div class="card-header border-0 bg-transparent">
              <h1 class="mb-0">Bienvenido: Empresa Minera Buenaventura</h1>
              <div class="d-flex align-items-center mt-2">
                <h3 class="mb-0 d-flex align-items-center">
                  Ingrese unidad de operaciones
                </h3>
                <base-button
                  class="rounded-circle ml-2"
                  style="height: 27px; padding: 0px 4px; background: #28a745"
                  size="md"
                  body-class="text-left"
                  v-b-popover.hover.top="'Nueva unidad de operaciones'"
                  type="success"
                  v-b-modal.modal-unidad-operaciones
                >
                  <i class="fas fa-plus text-white"></i>
                </base-button>
              </div>
            </div>
            <hr class="my-1" />
            <div class="row">
              <div
                class="card-body d-flex align-items-center"
                style="gap: 10px"
              >
                <div class="col-lg-3 d-flex flex-wrap">
                  <select
                    name="tipo"
                    id="tipoPais"
                    class="form-control form-control-sm"
                  >
                    <option value="-1">Selecione el País</option>
                    <option value="0">Perú</option>
                    <option value="1">Alemania</option>
                    <option value="2">Noruega</option>
                  </select>
                </div>
                <div class="col-lg-3 d-flex">
                  <select
                    name="tipo"
                    id="tipoContinente"
                    class="form-control form-control-sm"
                  >
                    <option value="-1">Selecione el Continente</option>
                    <option value="0">America</option>
                    <option value="1">Europa</option>
                    <option value="2">Asia</option>
                    <option value="3">Africa</option>
                    <option value="4">Oceania</option>
                  </select>
                </div>
                <div class="col-lg-3">
                  <b-input-group size="sm" prepend="Proyecto:">
                    <input
                      id="nick"
                      type="text"
                      v-on:change="onFiltroChange()"
                      value=""
                      class="form-control form-control-sm"
                      placeholder="Nombre del proyecto"
                    />
                  </b-input-group>
                </div>
                <div class="col-lg-3 text-center">
                  <button
                    title="Aplicar filtro"
                    type="button"
                    :class="{
                      'btn btn-success': filtroActivo,
                      'btn btn-light': !filtroActivo,
                    }"
                    @click="aplicarFiltro()"
                  >
                    <i
                      :class="{
                        'fas fa-check': filtroActivo,
                        'fas fa-ban': !filtroActivo,
                      }"
                    ></i>
                  </button>
                  <button
                    title="Resetear filtro"
                    type="button"
                    class="btn btn-primary"
                    @click="resetFiltro()"
                  >
                    <i class="fas fa-undo"></i>
                  </button>
                </div>
              </div>
            </div>

            <hr class="my-0" />
          </div>
        </div>
      </div>
    </div>

    <div class="mx-5 mt-4" fluid>
      <div class="row">
        <div
          class="col-lg-4 col-md-4 col-sm-12"
          v-for="division in submittedNames"
          :key="division.name"
        >
          <div class="position-relative">
            <details class="card p-3 d-flex" open>
              <summary>
                {{ division.name }}
                <button
                  class="btn base-button rounded-circle ml-2 btn-success btn-md text-left"
                  style="
                    height: 20px;
                    padding: 0px 4px;
                    width: 20px;
                    font-size: 11px;
                  "
                  type="button"
                  v-b-modal.modal-categoria
                  @click="openModalCategory(division)"
                >
                  <i class="fas fa-plus"></i>
                </button>
                <button
                  class="btn base-button rounded-circle ml-2 btn-danger btn-md text-left"
                  style="
                    height: 20px;
                    padding: 0px 4px;
                    width: 20px;
                    font-size: 11px;
                  "
                  type="button"
                  @click="deleteCategory(division)"
                >
                  <i class="fas fa-minus"></i>
                </button>
              </summary>
              <details
                class="ml-4"
                open
                v-for="category in division.categories"
                :key="category"
              >
                <summary>
                  {{ category }}
                  <button
                    class="btn base-button rounded-circle ml-2 btn-success btn-md text-left"
                    style="
                      height: 20px;
                      padding: 0px 4px;
                      width: 20px;
                      font-size: 11px;
                    "
                    type="button"
                    v-b-modal.modal-categoria
                    @click="openModalSubCategory(division)"
                  >
                    <i class="fas fa-plus"></i>
                  </button>
                  <button
                    class="btn base-button rounded-circle ml-2 btn-danger btn-md text-left"
                    style="
                      height: 20px;
                      padding: 0px 4px;
                      width: 20px;
                      font-size: 11px;
                    "
                    type="button"
                    @click="deleteCategory()"
                  >
                    <i class="fas fa-minus"></i>
                  </button>
                </summary>
                <details
                  class="ml-4"
                  v-for="subcategory in subdivion"
                  :key="subcategory"
                >
                  <summary>{{ subcategory }}</summary>
                  <button
                    class="btn base-button rounded-circle ml-2 btn-success btn-md text-left"
                    style="
                      height: 20px;
                      padding: 0px 4px;
                      width: 20px;
                      font-size: 11px;
                    "
                    type="button"
                    v-b-modal.modal-subcategoria
                    @click="openModalCategory(subdivision)"
                  >
                    <i class="fas fa-plus"></i>
                  </button>
                  <p class="ml-4 mb-0">
                    <a
                      href="#"
                      style="
                        text-decoration: none !important;
                        color: black;
                        font-size: 0.9rem;
                      "
                      >Nombre de proyecto</a
                    >
                    <button
                      class="btn base-button rounded-circle ml-2 btn-primary btn-md text-left"
                      style="
                        height: 20px;
                        padding: 0px 4px;
                        width: 20px;
                        font-size: 11px;
                      "
                      type="button"
                      @click="hideCategory()"
                    >
                      <i class="fas fa-eye text-white"></i>
                    </button>
                  </p>
                </details>
                <details class="ml-4">
                  <summary>
                    Particular
                    <button
                      class="btn base-button rounded-circle ml-2 btn-success btn-md text-left"
                      style="
                        height: 20px;
                        padding: 0px 4px;
                        width: 20px;
                        font-size: 11px;
                      "
                      type="button"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </summary>
                  <p class="ml-4 mb-0">
                    <a
                      href="#"
                      style="
                        text-decoration: none !important;
                        color: black;
                        font-size: 0.9rem;
                      "
                      >Nombre de proyecto</a
                    >
                    <button
                      class="btn base-button rounded-circle ml-2 btn-primary btn-md text-left"
                      style="
                        height: 20px;
                        padding: 0px 4px;
                        width: 20px;
                        font-size: 11px;
                      "
                      type="button"
                      @click="hideCategory()"
                    >
                      <i class="fas fa-eye text-white"></i>
                    </button>
                  </p>
                </details>
              </details>
            </details>
          </div>
          <div
            class="position-absolute text-center"
            style="
              top: 1px;
              right: 16px;
              border: 1px solid rgb(236, 240, 245);
              border-radius: 3px;
              padding: 5px;
            "
          >
            <p class="m-0">58</p>
            <p class="m-0">Proyectos</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Unidad de operaciones -->
    <b-modal
      id="modal-unidad-operaciones"
      ref="modal"
      title="Unidad de operaciones"
      @show="resetModal"
      @hidden="resetModal"
      @ok="handleOk"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group
          label="Nombre"
          label-for="name-input"
          invalid-feedback="Name is required"
          :state="nameState"
        >
          <b-form-input
            id="name-input"
            v-model="name"
            :state="nameState"
            required
          ></b-form-input>
        </b-form-group>
      </form>
    </b-modal>
    <!-- Categoria -->
    <b-modal
      id="modal-categoria"
      ref="modal"
      title="Agregar categoria"
      @show="resetModal"
      @hidden="resetModal"
      @ok="handleOkCategory"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group
          label="Nombre de la categoria"
          label-for="name-input"
          invalid-feedback="Name is required"
          :state="nameState"
        >
          <b-form-input
            id="name-input"
            v-model="category"
            :state="nameState"
            required
          ></b-form-input>
        </b-form-group>
      </form>
    </b-modal>
    <!-- Sub-Categoria -->
    <b-modal
      id="modal-subcategoria"
      ref="modal"
      title="Agregar Subcategoria"
      @show="resetModal"
      @hidden="resetModal"
      @ok="handleOkSubCategory"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <div class="d-flex align-items-center">
          <b-form-checkbox v-model="checked" name="check-button" switch>
          </b-form-checkbox>
          <p v-if="checked" class="m-0">Proyecto</p>
          <p v-else class="m-0">Subcategoria</p>
        </div>

        <b-form-group
          label="Nombre de la subcategoria"
          label-for="name-input"
          invalid-feedback="Name is required"
          :state="nameState"
        >
          <b-form-input
            id="name-input"
            v-model="subcategory"
            :state="nameState"
            required
          ></b-form-input>
        </b-form-group>
      </form>
    </b-modal>
  </div>
</template>

<script>
import Modal from "./../Modal.vue";
import { Form } from "vform";
import { Input, Tooltip, Popover } from "element-ui";
import {
  BModal,
  VBModal,
  BButton,
  BFormInput,
  BFormGroup,
  BFormRadio,
  BFormRadioGroup,
  BFormFile,
  BInputGroup,
  BFormCheckboxGroup,
  BFormCheckbox,
} from "bootstrap-vue";
export default {
  components: {
    Modal,
    BModal,
    VBModal,
    Popover,
    BButton,
    BFormInput,
    BFormGroup,
    BFormRadio,
    BFormRadioGroup,
    BFormFile,
    BInputGroup,
    BFormCheckboxGroup,
    BFormCheckbox,
    Input,
    Tooltip,
  },
  directives: {
    "b-modal": VBModal,
    "b-popover": Popover,
    "b-button": BButton,
    "b-form-input": BFormInput,
    "b-form-group": BFormGroup,
    "b-form-radio": BFormRadio,
    "b-form-radio-group": BFormRadioGroup,
    "b-form-file": BFormFile,
    "b-input-group": BInputGroup,
    "b-form-checkbox-group": BFormCheckboxGroup,
    "b-form-checkbox": BFormCheckbox,
  },
  props: ["data"],
  data() {
    return {
      step: 1,
      checked: false,
      filtroActivo: false,
      form: new Form({
        proyecto: "",
        tipoP: "",
        tipoC: "",
        nick: "",
      }),
      filtro: new Form({
        nomProyecto: "",
        tipoPais: "-1",
        tipoContinente: "-1",
        dni: "",
      }),
      name: "",
      division: {
        name: "",
        categories: [],
      },
      subdivision: {
        name: "",
        subcategories: [],
      },
      submittedNames: [],
      nameState: null,
      category: "",
      subcategory: "",
      categories: [],
      subcategories: [],
      divisionEdited: null,
      subDivisionEdited: null,

      chosen_country: "",
      chosen_continent: "",
      getContinents: "",
      getCountries: "",
      filtroActivo: false,
    };
  },
  methods: {
    //----------------------------------------------------

    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.nameState = valid;
      return valid;
    },
    resetModal() {
      this.name = "";
      this.nameState = null;
    },
    handleOk(bvModalEvent) {
      bvModalEvent.preventDefault();
      this.handleSubmit();
    },
    handleOkCategory(bvModalEvent) {
      bvModalEvent.preventDefault();
      this.handleSubmitCategory();
    },
    handleOkSubCategory(bvModalEvent) {
      bvModalEvent.preventDefault();
      this.handleSubmitSubCategory();
    },
    handleSubmit() {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return;
      }
      // Push the name to submitted names
      this.submittedNames.push(
        JSON.parse(JSON.stringify({ ...this.division, name: this.name }))
      );
      // Hide the modal manually
      this.$nextTick(() => {
        this.$bvModal.hide("modal-unidad-operaciones");
      });
    },
    handleSubmitCategory() {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return;
      }
      this.divisionEdited.categories.push(this.category);
      // this.submittedNames.push(
      //   JSON.parse(JSON.stringify({ ...this.division, name: this.name }))
      // );
      this.$nextTick(() => {
        this.$bvModal.hide("modal-categoria");
      });
    },
    handleSubmitSubCategory() {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return;
      }
      this.subDivisionEdited.subcategories.push(this.subcategory);
      // this.submittedNames.push(
      //   JSON.parse(JSON.stringify({ ...this.division, name: this.name }))
      // );
      this.$nextTick(() => {
        this.$bvModal.hide("modal-subcategoria");
      });
    },
    openModalCategory(division) {
      this.divisionEdited = division;
      //   console.log("division: ", division);
    },
    openModalSubCategory(subdivision) {
      this.subDivisionEdited = subdivision;
      //   console.log("division: ", division);
    },
    //----------------------------------------------------
    aplicarFiltro() {
      let loader = this.$loading.show({
        container: this.fullPage ? null : this.$refs.formContainer,
        canCancel: true,
        loader: "dots",
      });
      this.getResults();
      loader.hide();
    },
    resetFiltro() {
      this.filtro.reset();
      this.filtroActivo = false;
      this.getResults();
    },
    onFiltroChange() {
      this.filtroActivo = true;
    },
    //----------------------------------------------------
  },
  mounted() {
    // console.log(this.data);
  },
};
</script>

<style scoped>
</style>
