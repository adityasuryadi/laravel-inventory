<template>
    <div>
        <div class="card">
            <div class="card-header">
                <strong>Input Kaca</strong>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="customer"
                        >Merk Kaca</label
                    >
                    <div class="col-md-3">
                        <v-select
                            v-model="form.input_wind_shield_brand"
                            :options="wind_shield_brands"
                            placeholder="Pilih Merk Kaca"
                        ></v-select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="customer"
                        >Bagian Kaca</label
                    >
                    <div class="col-md-3">
                        <div v-for="part in wind_shield_parts" :key="part.id">
                            <input
                                id=""
                                v-model="form.input_wind_shield_part"
                                :value="part.id"
                                type="radio"
                                name=""
                            />
                            {{ part.name }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="customer"
                        >Merk Mobil</label
                    >
                    <div class="col-md-3">
                        <v-select
                            v-model="form.input_car_brand"
                            :options="car_brands"
                            placeholder="Pilih Merk Mobil"
                            @input="fetchCars"
                        ></v-select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="customer"
                        >Nama Mobil</label
                    >
                    <div class="col-md-3">
                        <v-select
                            v-model="form.input_car"
                            :options="cars"
                            placeholder="Pilih Nama Mobil"
                            @input="fetchCarTypes"
                        ></v-select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="customer"
                        >Type Mobil</label
                    >
                    <div class="col-md-3">
                        <v-select
                            v-model="form.input_car_type"
                            :options="car_types"
                            placeholder="Pilih Type Mobil"
                        ></v-select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="customer"
                        >Harga</label
                    >
                    <div class="col-md-3">
                        <input
                            id=""
                            v-model="form.input_price"
                            type="number"
                            min="0"
                            name=""
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="customer"
                        >Jumlah</label
                    >
                    <div class="col-md-3">
                        <input
                            id=""
                            v-model="form.input_qty"
                            type="text"
                            name=""
                            class="form-control"
                            disabled
                        />
                    </div>
                </div>
                <div
                    v-for="(rack, index) in form.input_rack"
                    id=""
                    :key="rack.id"
                    class="form-group row"
                >
                    <label class="col-md-3 col-form-label" for="customer"
                        >Rak {{ index }}</label
                    >
                    <div class="col-md-2">
                        <input
                            v-model="rack.value"
                            type="number"
                            min="0"
                            class="form-control"
                            @change="countRack"
                        />
                        <input
                            type="hidden"
                            :value="rack.id"
                            class="form-control"
                        />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    @click="saveWindShield"
                >
                    <i class="fa fa-dot-circle-o"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import EventBus from "../../../eventBus";

export default {
    data: () => {
        return {
            form: {
                input_wind_shield_brand: null,
                input_wind_shield_part: null,
                input_car_brand: null,
                input_car: null,
                input_car_type: null,
                input_price: 0,
                input_qty: 0,
                input_rack: []
            },
            wind_shield_brands: [],
            wind_shield_parts: [],
            car_brands: [],
            cars: [],
            car_types: [],
            tmp_car_brands: [],
            tmp_cars: [],
            racks: []
        };
    },
    mounted() {
        this.fetchWindShieldBrands();
        this.fetchWindShieldParts();
        this.fetchCarBrands();
        this.fetchRacks();
    },
    methods: {
        async fetchWindShieldBrands() {
            const url = "/api/windshieldbrands";
            const response = await axios.get(url);
            this.wind_shield_brands = response.data.map(element => {
                return { label: element.name, value: element.id };
            });
        },
        async fetchWindShieldParts() {
            const url = "/api/windshieldparts";
            const response = await axios.get(url);
            this.wind_shield_parts = response.data;
        },
        async fetchCarBrands() {
            const url = "/api/carbrands";
            const response = await axios.get(url);
            this.car_brands = response.data.map(element => {
                return { label: element.name, value: element.id };
            });
            this.tmp_car_brands = response.data;
        },
        fetchCars(value) {
            const car = this.tmp_car_brands.find(brand => {
                return brand.id === value.value;
            });
            this.tmp_cars = car.car;
            this.cars = car.car.map(element => {
                return { label: element.name, value: element.id };
            });
            this.form.input_car = null;
        },
        fetchCarTypes(value) {
            this.form.input_car_type = null;
            if (value !== null) {
                const types = this.tmp_cars.find(cars => {
                    return cars.id === value.value;
                });
                this.car_types = types.car_type.map(element => {
                    return { label: element.name, value: element.id };
                });
            } else {
                this.car_types = null;
            }
        },
        async fetchRacks() {
            const url = "/api/racks";
            const response = await axios.get(url);
            this.form.input_rack = response.data;
            response.data.forEach((element, index) => {
                this.form.input_rack[index].value = 0;
            });
        },
        saveWindShield() {
            const url = "/windshield";
            axios.post(url, this.form);
        },
        countRack() {
            let total = 0;
            this.form.input_rack.forEach(value => {
                total += parseInt(value.value, 0);
            });
            this.form.input_qty = total;
        }
    }
};
</script>
