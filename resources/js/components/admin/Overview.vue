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
                <button
                  type="button"
                  class="btn base-button rounded-circle ml-2 btn-success btn-md text-left"
                  style="height: 27px; padding: 0px 4px"
                  v-b-modal.modal-unidad-operaciones
                >
                  <i class="fas fa-plus"></i>
                </button>
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
      <div class="mt-5"></div>
    </div>

    <div class="mx-5 mt-4" fluid>
      <div class="row">
        <div
          class="col-lg-4 col-md-4 col-sm-12"
          v-for="division in submittedNames"
          :key="division.name"
        >
          <details class="card p-3 d-flex" open>
            <summary>
              {{ division.name }}
              <button
                class="btn base-button rounded-circle ml-2 btn-success btn-md text-left"
                style="height: 27px; padding: 0px 4px"
                type="button"
                v-b-modal.modal-categoria
                @click="openModalCategory(division)"
              >
                <i class="fas fa-plus"></i>
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
                  style="height: 27px; padding: 0px 4px"
                  type="button"
                  v-b-modal.modal-categoria
                  @click="openModalCategory(division)"
                >
                  <i class="fas fa-plus"></i>
                </button>
              </summary>
              <details class="ml-4">
                <summary>Nacional</summary>
                <p class="ml-4 mb-0">
                  <a href="#">Nombre de proyecto</a>
                </p>
                <p class="ml-4 mb-0">
                  <a href="#">Nombre de proyecto</a>
                </p>
              </details>
              <details class="ml-4">
                <summary>Particular</summary>
                <p class="ml-4 mb-0">
                  <a href="#">Nombre de proyecto</a>
                </p>
                <p class="ml-4 mb-0">
                  <a href="#">Nombre de proyecto</a>
                </p>
              </details>
            </details>
          </details>
        </div>
      </div>
    </div>

    <!-- Version anterior -->
    <div class="warpper px-5">
      <a :href="'/admin/projects/create'">
        <div class="d-inline-block text-3">
          Ingrese unidad de operaciones <i class="fas fa-arrow-right"></i>
        </div>
      </a>
    </div>
    
  </div>
</template>

<script>
import Modal from "./../Modal.vue";
import {
  BModal,
  VBModal,
  BFormInput,
  BFormGroup,
  BFormRadio,
  BFormRadioGroup,
  BFormFile,
} from "bootstrap-vue";
export default {
  components: {
    Modal,
    BModal,
    VBModal,
    BFormInput,
    BFormGroup,
    BFormRadioGroup,
    BFormRadioGroup,
    BFormFile,
  },
  directives: {
    "b-modal": Modal,
  },
  props: ["data"],
  directives: {
    "b-modal": VBModal,
    "b-form-input": BFormInput,
    "b-form-group": BFormGroup,
    "b-form-radio": BFormRadio,
    "b-form-radio-group": BFormRadioGroup,
    "b-form-file": BFormFile,
  },
  data() {
    return {
      chosen_country: "",
      chosen_continent: "",
      getContinents: "",
      getCountries: "",

      filtroActivo: false,
      submittedNames: [],
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
    openModalCategory(division) {
      this.divisionEdited = division;
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
  },
  mounted() {
    // console.log(this.data);
  },
};
</script>

<style scoped>
</style>
