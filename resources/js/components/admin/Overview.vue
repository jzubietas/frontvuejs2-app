<template>
  <div class="componentwarpper">
    <div class="container mt-5" fluid>
      <div class="row">
        <div class="col">
          <div class="card" no-body>
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
              <div class="card-body d-flex align-items-center" style="gap: 10px">
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
                    >
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
                    ><i
                      :class="{
                        'fas fa-check': filtroActivo,
                        'fas fa-ban': !filtroActivo,
                      }"
                    ></i
                  ></button>
                  <button
                    title="Resetear filtro"
                    type="button"
                    class="btn btn-primary"
                    @click="resetFiltro()"
                    ><i class="fas fa-undo"></i
                  ></button>
                </div>
              </div>
            </div>

            <hr class="my-0" />
          </div>
        </div>
      </div>
      <div class="mt-5"></div>
    </div>

    <div class="container mt-4" fluid>
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
              <summary>{{ category }}
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


    <div class="warpper px-5">
      <a :href="'/admin/projects/create'">
        <div class="d-inline-block text-3">
          Ingrese unidad de operaciones <i class="fas fa-arrow-right"></i>
        </div>
      </a>
    </div>

    <!--<div class="warpper px-5">
      <span v-if="chosen_country" class="text-3">
        {{ chosen_country }} <i class="fas fa-chevron-right mx-2"></i
      ></span>
      <span v-if="chosen_continent" class="text-3">
        {{ chosen_continent }} <i class="fas fa-chevron-right mx-2"></i
      ></span>

      <div class="d-flex w-100 border mt-3">
        <div class="w-100 overflow-auto">
          <ul class="p-0 d-flex flex-column">
            <li
              @click="setContinent(continent)"
              v-for="continent in getContinents"
              :key="continent"
              class="single-list list-unstyled p-3 border"
            >
              <div class="d-inline-block w-50">continent {{ continent }}</div>
              <div class="d-inline-block w-50 text-right">
                <i class="fas fa-chevron-right"></i>
              </div>
            </li>
          </ul>
        </div>

        <div class="w-100 overflow-auto">
          <ul class="p-0 d-flex flex-column">
            <li
              @click="setCountry(country)"
              v-for="country in getCountries"
              :key="country"
              class="single-list list-unstyled p-3 border"
            >
              <div class="d-inline-block w-50">pais {{ country }}</div>
              <div class="d-inline-block w-50 text-right">
                <i class="fas fa-chevron-right"></i>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div> -->

    <!-- <div class="warpper px-5">
            <h4 class="font-weight-600"><i class="fas fa-users"></i> Users Data</h4>
            <div class="row mt-4 pt-5 pb-4">
                <div class="col-4 text-center">
                    <h4 v-if="data.total_admin[0].total_admin">{{ data.total_admin[0].total_admin}}</h4>
                    <h4 v-else>0</h4>
                    <p class="text-7">Total Admin(s)</p>
                </div>
                <div class="col-4 text-center">
                    <h4 v-if="data.total_project[0].total_seller">{{ data.total_seller[0].total_project }}</h4>
                    <h4 v-else>0</h4>
                    <p class="text-7">Total Project(s)</p>
                </div>
                <div class="col-4 text-center d-none">
                    <h4 v-if="data.total_buyer[0].total_buyer">{{ data.total_buyer[0].total_buyer }}</h4>
                    <h4 v-else>0</h4>
                    <p class="text-7">Total Buyer(s)</p>
                </div>
            </div>
        </div> -->
    <!-- <div class="warpper px-5 d-none">
            <h4 class="font-weight-600"><i class="fas fa-boxes"></i> Miscellaneous</h4>
            <div class="row mt-4 pt-5 pb-4">
                <div class="col-4 text-center">
                    <h4 v-if="data.total_order[0].total_order">{{ data.total_order[0].total_order }}</h4>
                    <h4 v-else>0</h4>
                    <p class="text-7">Completed Orders</p>
                </div>
                <div class="col-4 text-center">
                    <h4 v-if="data.total_feedback[0].total_feedback">{{ data.total_feedback[0].total_feedback }}</h4>
                    <h4 v-else>0</h4>
                    <p class="text-7">Pending Feedbacks</p>
                </div>
                <div class="col-4 text-center">
                    <h4 v-if="data.avg_rating[0].avg_rating">{{ data.avg_rating[0].avg_rating}}/5</h4>
                    <h4 v-else>Not Rated Yet</h4>
                    <p class="text-7">Average Rating</p>
                </div>
            </div>
        </div> -->
  </div>
</template>

<script>
import Modal from './../Modal.vue';
export default {
    components: {
        Modal
    },
  props: ["data"],
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
      console.log("division: ", division);
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
    console.log(this.data);
  },
};
</script>

<style scoped>
</style>
