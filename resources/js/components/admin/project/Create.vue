<template>
  <div class="componentwarpper">
    <div class="warpper min-vh-100">
      <div class="content-warpper d-flex justify-content-between">
        <h4 class="d-inline-block font-weight-600">
          Add New Project
          <span class="text-7 font-weight-200">(Step {{ step }}/2)</span>
        </h4>

        <a :href="'/admin/projects'">
          <div class="d-inline-block text-3">
            My Projects <i class="fas fa-arrow-right"></i>
          </div>
        </a>
      </div>

      <div class="step2 mt-5">
        <h6>Ingrese los detalles del proyecto:</h6>

        <div class="row">
          <div
            class="d-inline-flex flex-column col-6 justify-content-center align-items-center"
          >
            <img
              id="project-image"
              :src="preview_project_img"
              alt="project image"
              class="cursor-pointer"
              @click="selectImage"
            />
            <p class="mt-2 cursor-pointer" @click="selectImage">
              Carga de adjunto
            </p>
            <input
              ref="fileInput"
              type="file"
              class="d-none"
              @change="onFileChange"
            />
          </div>
          <form class="col-6">
            <div v-if="isSuccess" class="successmsg p-3 my-4">
              <i class="fas fa-check text-9 mr-2"></i> Successfully listed the
              project.
            </div>
            <div v-if="isError" class="errormsg p-3 my-4">
              <i class="fas fa-times text-8 mr-2"></i> {{ errortext }}
            </div>
            <div v-if="isEmpty" class="errormsg p-3 my-4">
              <i class="fas fa-exclamation text-8 mr-2"></i> Please enter all
              the required fields and upload your project's image.
            </div>

            <label for="name" class="d-block mt-4 text-7"
              >Nombre de proyecto<span class="text-8">*</span></label
            >
            <input
              v-model="project.name"
              type="text"
              name="name"
              id="name"
              class="form-input"
              placeholder="Ingrese el nombre del proyecto*"
              required
              autofocus
            />

            <label for="description" class="d-block mt-4 text-7"
              >Descripcion<span class="text-8">*</span></label
            >
            <input
              v-model="project.description"
              type="text"
              name="description"
              id="description"
              class="form-input"
              placeholder="Ingrese descripcion del proyecto*"
              required
            />

            <label for="continents" class="d-block mt-4 text-7"
              >Seleccione un Continente</label
            >
            <select
              name="continent-name"
              id="continents"
              class="form-control form-control-sm"
              v-model="project.selectedContinent"
            >
              <option
                v-for="continent in project.continents"
                :value="continent"
                :key="continent"
              >
                {{ continent }}
              </option>
            </select>

            <label for="countries" class="d-block mt-4 text-7"
              >Seleccione un país</label
            >
            <select
              name="country-name"
              id="countries"
              class="form-control form-control-sm"
              v-model="project.selectedCountry"
            >
              <option
                v-for="country in filteredCountries"
                :value="country"
                :key="country"
              >
                {{ country }}
              </option>
            </select>

            <div
              @click="submitRequest"
              class="submit-button d-inline-block w-50"
            >
              Registrar
            </div>
            <div @click="clearFields" class="clear-button d-inline-block w-50">
              Limpiar
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["categories"],
  data() {
    return {
      step: 1,
      chosen_category: "",
      chosen_subcategory: "",
      chosen_subcategory2: "",
      preview_project_img: "../../img/illustrator/uploadimage.png",
      project: {
        name: "",
        description: "",
        image: "",
        selectedContinent: "",
        selectedCountry: "",
        continents: ["America", "Europa", "Asia", "Africa"],
        countries: {
          'America': [
            'Canada',
            'Mexico',
            'United States',
            'Argentina',
            'Brazil',
            'Chile',
          ],
          'Europa': ['France', 'Germany', 'Italy'],
          'Asia': ['China', 'India', 'Thailand'],
          'Africa': ['Egypt', 'Nigeria'],
        },
      },
      isSuccess: false,
      isError: false,
      isEmpty: false,
      errortext: "",
    };
  },
  methods: {
    selectImage() {
      this.$refs.fileInput.click();
    },
    onFileChange(e) {
      this.project.image = e.target.files[0];
      this.preview_project_img = URL.createObjectURL(this.project.image);
    },

    submitRequest() {
      if (
        this.project.name == "" ||
        this.project.description == "" ||
        this.project.image == ""
      ) {
        this.isSuccess = false;
        this.isError = false;
        this.isEmpty = true;
      } else {
        let formData = new FormData();
        formData.append("name", this.project.name);
        formData.append("description", this.project.description);
        formData.append("image", this.project.image);
        axios
          .post("/admin/projects/create", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((response) => {
            this.project.name = "";
            this.project.description = "";
            this.project.image = "";
            this.preview_project_img = "../../img/illustrator/uploadimage.png";
            this.isSuccess = true;
            this.isError = false;
            this.isEmpty = false;
          })
          .catch((error) => {
            console.log(error.response.data);
            this.isSuccess = false;
            this.isError = true;
            this.isEmpty = false;
            this.errortext = Object.values(error.response.data.errors)
              .flat()
              .join();
          });
      }
    },

    clearFields() {
      this.project.name = "";
      this.project.description = "";
    },
  },
  computed: {
    filteredCountries() {
      return this.project.countries[this.project.selectedContinent] || [];
    },
  },
  mounted() {},
};
</script>

<style scoped>
.content-warpper {
  width: 90%;
  margin: 0 auto;
}
/* PAGE ! */
.step1 {
  width: 90%;
  margin: 0 auto;
}
#category-box {
  height: 50vh;
}

.single-list {
  cursor: pointer;
}
.single-list:hover,
.single-list.active,
.single-list.focus {
  color: #fcfaf1;
  background-color: #134153;
}

.next-disable-button {
  float: right;
  cursor: not-allowed;
  text-align: center;
  line-height: 45px;
  margin-top: 25px;
  max-width: 160px;
  width: 100%;
  color: #fcfaf1;
  background-color: #999999;
}
.next-button,
.submit-button {
  cursor: pointer;
  text-align: center;
  line-height: 45px;
  width: 100%;
  color: #fcfaf1;
  background-color: rgba(19, 65, 83, 1);

  box-shadow: inset 0 0 20px rgba(190, 218, 250, 0);
  outline-color: rgba(19, 65, 83, 0.5);
  outline-offset: 0px;
  text-shadow: none;
  transition: all 1250ms cubic-bezier(0.19, 1, 0.22, 1);
}
.next-button {
  float: right;
  max-width: 160px;
  margin-top: 25px;
}
.next-button:hover,
.submit-button:hover {
  box-shadow: inset 0 0 20px rgba(190, 218, 250, 0.5),
    0 0 20px rgba(190, 218, 250, 0.2);
  outline: 1px solid;
  outline-color: rgba(190, 218, 250, 0);
  outline-offset: 15px;
  text-shadow: 1px 1px 2px #2e828b;
}

/* PAGE 2 */
.step2 {
  width: 90%;
  margin: 0 auto;
}
#project-image {
  width: 350px;
  height: 250px;
  object-fit: contain;
}

.form-input {
  background-color: transparent;
  color: #333333;
  border: 2px solid #999999;
  padding: 5px;
  border-radius: 0;
  width: 100%;
}
.form-input:focus {
  color: #333333;
  border: 2px solid #333333;
}
.form-input:focus {
  color: #333333;
  border: 2px solid #333333;
}

.form-input::placeholder {
  color: #999999;
}

.submit-button {
  float: left;
  margin-top: 35px;
}

.clear-button {
  float: right;
  cursor: pointer;
  text-align: center;
  line-height: 45px;
  margin-top: 35px;
  width: 100%;
  color: #e40041;
  background-color: transparent;

  box-shadow: inset 0 0 20px rgba(190, 218, 250, 0);
  outline-color: rgba(19, 65, 83, 0.5);
  outline-offset: 0px;
  text-shadow: none;
  transition: all 1250ms cubic-bezier(0.19, 1, 0.22, 1);
}
.clear-button:hover {
  box-shadow: inset 0 0 20px rgba(190, 218, 250, 0.5),
    0 0 20px rgba(190, 218, 250, 0.2);
  outline: 1px solid;
  outline-color: rgba(190, 218, 250, 0);
  outline-offset: 15px;
  text-shadow: 1px 1px 2px #2e828b;
}

.back-button {
  margin-top: -30px;
  cursor: pointer;
}
</style>
