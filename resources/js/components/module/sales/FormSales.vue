<template>
    <div>
        <div class="card">
            <div class="card-header">
                <strong>List Barang</strong>
            </div>
            <div class="card-body">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#exampleModal"
                >
                    Tambah Barang
                </button>

                <!-- Modal -->
                <div
                    id="exampleModal"
                    ref="vuemodal"
                    class="modal fade"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">
                                    Input Penjualan
                                </h5>
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="Close"
                                >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="customer"
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
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="customer"
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
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="customer"
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
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="customer"
                                        >Merk Kaca</label
                                    >
                                    <div class="col-md-3">
                                        <v-select
                                            v-model="
                                                form.input_wind_shield_brand
                                            "
                                            :options="wind_shield_brands"
                                            placeholder="Pilih Merk Kaca"
                                        ></v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="customer"
                                        >Bagian Kaca</label
                                    >
                                    <div class="col-md-3">
                                        <div
                                            v-for="part in wind_shield_parts"
                                            :key="part.id"
                                        >
                                            <input
                                                id=""
                                                v-model="
                                                    form.input_wind_shield_part
                                                "
                                                :value="part.id"
                                                type="radio"
                                                name=""
                                            />
                                            {{ part.name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="customer"
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
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="customer"
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
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="customer"
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
                            <div class="modal-footer">
                                <!-- <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                >
                                    Close
                                </button>
                                <button>
                                    Save
                                </button>
                                <button
                                    v-else
                                    :disabled="!disabled"
                                    type="button"
                                    class="btn btn-info"
                                    @click="
                                        updateItemFromCart(
                                            selected_product.id,
                                            selected_product
                                        )
                                    "
                                >
                                    Update
                                </button> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Windsield -->
                <modal-windshield :stocks="tmp_windshield"></modal-windshield>
                <!-- end Modal Windshield -->

                <v-client-table
                    :data="windshield_table.tableData"
                    :columns="windshield_table.columns"
                    :options="windshield_table.options"
                >
                    <template slot="windshield_brand" scope="props">
                        <div>{{ props.row.windshield_brand.name }}</div>
                    </template>
                    <template slot="windshield_part" scope="props">
                        <div>{{ props.row.windshield_part.name }}</div>
                    </template>
                    <template slot="car_type" scope="props">
                        <div>{{ props.row.car_type.name }}</div>
                    </template>
                    <template slot="car" scope="props">
                        <div>{{ props.row.car_type.car.name }}</div>
                    </template>
                    <template slot="car_brand" scope="props">
                        <div>{{ props.row.car_type.car.brand_car.name }}</div>
                    </template>
                    <template slot="action" scope="props">
                        <button
                            class="btn btn-sm btn-info"
                            data-toggle="modal"
                            data-target="#windshieldModal"
                            @click="viewWindShield(props.row)"
                        >
                            Tambah {{ props.id }}
                        </button>
                    </template>
                </v-client-table>
                <!-- <v-client-table
                    :data="carts"
                    :columns="columns"
                    :options="options_table"
                >
                    <template slot="id" scope="props">
                        <button
                            class="btn btn-sm btn-danger"
                            target="_blank"
                            @click="removeFromCart(props.index)"
                        >
                            Hapus
                        </button>
                        <button
                            class="btn btn-sm btn-info"
                            target="_blank"
                            @click="editItemFromCart(props.row.id)"
                        >
                            Edit
                        </button>
                    </template>
                    <template slot="total" scope="props">{{
                        (props.row.sales_price * props.row.sales_amount) | price
                    }}</template>
                </v-client-table> -->
                <!-- <div class="form-group row">
                    <label class="col-md-3">Pelanggan</label>
                    <div class="col-md-6">
                        <input-customer></input-customer>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Alamat</label>
                    <div class="col-md-6">
                        <textarea
                            class="form-control"
                            readonly
                            :value="customer.address"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Pengirim</label>
                    <div class="col-md-6">
                        <input-company></input-company>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Keterangan</label>
                    <div class="col-md-6">
                        <textarea
                            v-model="description"
                            class="form-control"
                        ></textarea>
                    </div>
                </div> -->
            </div>
            <div class="card-footer">
                <!-- <button
                    type="submit"
                    class="btn btn-sm btn-primary"
                    :disabled="
                        Object.keys(carts).length === 0 ||
                            Object.keys(customer).length === 0 ||
                            Object.keys(company).length === 0
                    "
                    @click="storeSales"
                >
                    <i class="fa fa-dot-circle-o"></i> Simpan
                </button> -->
            </div>
        </div>
        <!-- Button trigger modal -->
    </div>
</template>
<script>
import VeeValidate from "vee-validate";
import axios from "axios";
import Swal from "sweetalert";
import $ from "jquery";
import ModalWindSield from "./ModalWindShield.vue";
import EventBus from "../../../eventBus";

export default {
    components: {
        "modal-windshield": ModalWindSield
    },
    data: () => {
        return {
            windshield_table: {
                columns: [
                    "kode",
                    "windshield_brand",
                    "windshield_part",
                    "car_type",
                    "car",
                    "car_brand",
                    "action"
                ],
                tableData: [],
                options: {
                    filterByColumn: true,
                    perPage: 10,
                    headings: {
                        id: "Id",
                        kode: "kode",
                        windshield_brand: "Merk Kaca",
                        windshield_part: "Bagian Kaca",
                        car_type: "Type Mobil",
                        car: "Jenis Mobil",
                        car_brand: "Merk Mobil"
                    },
                    sortable: ["id", "kode"],
                    texts: {
                        filter: "Filtrar:",
                        filterBy: "{column}",
                        count: " "
                    }
                }
            },
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
            racks: [],
            tmp_windshield: {},
            input_qty: {}
        };
    },
    mounted() {
        this.fetchWindShieldBrands();
        this.fetchWindShieldParts();
        this.fetchCarBrands();
        this.fetchRacks();
        this.fetchWindShields();
    },
    methods: {
        viewWindShield(windshield) {
            this.tmp_windshield = windshield;
        },
        async fetchWindShields() {
            const url = "/api/windshields";
            const response = await axios.get(url);
            this.windshield_table.tableData = response.data;
        },
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
