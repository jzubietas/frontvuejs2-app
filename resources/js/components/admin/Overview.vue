<template>
    <div class="componentwarpper">

        <div class="warpper px-5">
            <a :href="'/admin/projects/create'">
                <div class="d-inline-block text-3">
                    Ingrese unidad de operaciones <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>

        <div class="warpper px-5">

            <span v-if="chosen_country" class="text-3"> {{chosen_country}} <i class="fas fa-chevron-right mx-2"></i></span>
            <span v-if="chosen_continent" class="text-3"> {{chosen_continent}} <i class="fas fa-chevron-right mx-2"></i></span>

            <div class="d-flex w-100 border mt-3">

                <div class="w-100 overflow-auto">
                    <ul class="p-0 d-flex flex-column">
                        <li @click="setContinent(continent)" v-for="continent in getContinents" :key="continent" class="single-list list-unstyled p-3 border">
                            <div class="d-inline-block w-50">continent {{ continent }}</div><div class="d-inline-block w-50 text-right"><i class="fas fa-chevron-right"></i></div>
                        </li>
                    </ul>
                </div>

                <div class="w-100 overflow-auto">
                    <ul class="p-0 d-flex flex-column">
                        <li @click="setCountry(country)" v-for="country in getCountries" :key="country" class="single-list list-unstyled p-3 border">
                            <div class="d-inline-block w-50">pais {{ country }}</div><div class="d-inline-block w-50 text-right"><i class="fas fa-chevron-right"></i></div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>


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
export default {
    props:[
        'data'
    ],
    data() {
        return {
            chosen_country: "",
            chosen_continent: "",
            getContinents: "",
            getCountries: "",
        }
    },
    mounted(){
        console.log(this.data)
    }
}
</script>

<style scoped>

</style>
