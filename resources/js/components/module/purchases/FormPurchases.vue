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
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">
                                    Form Barang Masuk
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
                                    <label for="" class="col-md-3"
                                        >Artikel</label
                                    >
                                    <div class="col-md-9">
                                        <input-article
                                            v-if="
                                                selected_product.product !==
                                                    null
                                            "
                                            :value="
                                                selected_product.product.article
                                            "
                                        ></input-article>
                                        <input-article v-else></input-article>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-3">Warna</label>
                                    <div class="col-md-9">
                                        <input-product
                                            :value="selected_product.product"
                                        ></input-product>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-3">PCS</label>
                                    <div class="col-md-9">
                                        <input
                                            v-model="
                                                selected_product.product.pcs
                                            "
                                            type="text"
                                            class="form-control"
                                            readonly
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-3"
                                        >Jumlah</label
                                    >
                                    <div class="col-md-9">
                                        <input
                                            v-model="
                                                selected_product.product.amount
                                            "
                                            type="text"
                                            class="form-control"
                                            readonly
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-3"
                                        >Satuan</label
                                    >
                                    <div class="col-md-9">
                                        <v-select
                                            v-model="
                                                selected_product.purchase_unit
                                            "
                                            :options="options"
                                            label="value"
                                            placeholder="Pilih Satuan"
                                            :disabled="
                                                !selected_product.product.hasOwnProperty(
                                                    'id'
                                                )
                                            "
                                        ></v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-3"
                                        >Harga Pokok</label
                                    >
                                    <div class="col-md-9">
                                        <input
                                            v-model="
                                                selected_product.principal_price
                                            "
                                            v-validate="
                                                'required|numeric|min_value:0'
                                            "
                                            name="prinipal_price"
                                            type="text"
                                            data-vv-as="Harga Pokok"
                                            class="form-control"
                                        />
                                        <div class="invalid-feedback">
                                            {{
                                                errors.first("prinvipal_price")
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-3"
                                        >Jumlah Beli PCS</label
                                    >
                                    <div class="col-md-9">
                                        <input
                                            v-model="
                                                selected_product.purchase_pcs
                                            "
                                            v-validate="
                                                'required|numeric|min_value:0'
                                            "
                                            data-vv-as="Jumlah Beli PCS"
                                            name="purchase_pcs"
                                            type="text"
                                            class="form-control"
                                        />
                                        <div class="invalid-feedback">
                                            {{ errors.first("purchase_pcs") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-3"
                                        >Jumlah Beli Panjang</label
                                    >
                                    <div class="col-md-9">
                                        <input
                                            v-model="
                                                selected_product.purchase_amount
                                            "
                                            v-validate="
                                                'required|numeric|min_value:0'
                                            "
                                            data-vv-as="Jumlah Beli Panjang"
                                            name="purchase_amount"
                                            type="text"
                                            class="form-control"
                                        />
                                        <div class="invalid-feedback">
                                            {{
                                                errors.first("purchase_amount")
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                >
                                    Close
                                </button>
                                <button
                                    v-if="selected_product.id === null"
                                    :disabled="!disabled"
                                    type="button"
                                    class="btn btn-primary"
                                    @click="addToCart(selected_product)"
                                >
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
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <v-client-table
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
                </v-client-table>
                <div class="form-group row">
                    <label class="col-md-3">Pelanggan</label>
                    <div class="col-md-6">
                        <input-supplier></input-supplier>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Alamat</label>
                    <div class="col-md-6">
                        <textarea
                            class="form-control"
                            readonly
                            :value="supplier.address"
                        />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button
                    type="submit"
                    class="btn btn-sm btn-primary"
                    :disabled="
                        Object.keys(carts).length === 0 ||
                            Object.keys(supplier).length === 0
                    "
                    @click="storeSales"
                >
                    <i class="fa fa-dot-circle-o"></i> Simpan
                </button>
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
import InputArticle from "../../InputArticle.vue";
import InputProduct from "../../InputProduct.vue";
import InputSupplier from "../../InputSupplier.vue";
import EventBus from "../../../eventBus";

const uuidv4 = require("uuid/v4");

export default {
    components: {
        InputArticle,
        InputProduct,
        InputSupplier
    },
    filters: {
        // ;
    },
    data: () => {
        return {
            selected_product: {
                id: null,
                product: {},
                purchase_pcs: null,
                purchase_amount: null,
                purchase_unit: null,
                principal_price: 0
            },
            supplier: [],
            options: [],
            carts: [],
            selectUnitDisable: true,
            columns: [
                "product.article.name",
                "product.color",
                "purchase_pcs",
                "purchase_amount",
                "purchase_unit.value",
                "principal_price",
                "id"
            ],
            options_table: {
                headings: {
                    "product.article.name": "Artikel",
                    "product.color": "Warna",
                    purchase_pcs: "Jumlah Beli PCS",
                    purchase_amount: "Jumlah Beli Panjang",
                    "purchase_unit.value": "Satuan",
                    principal_price: "Harga Pokok",
                    id: "Action"
                },
                filterByColumn: false,
                perPage: 2,
                pagination: { chunk: 10, dropdown: false },
                customFilters: [
                    {
                        name: "article_id",
                        callback(row, query) {
                            return row.article.name[0] === query;
                        }
                    }
                ]
            }
        };
    },
    computed: {
        disabled() {
            return !this.errors.any() && "id" in this.selected_product.product;
        }
    },
    watch: {
        // ;
    },
    mounted() {
        this.getUnit("unit");
        this.getCarts();
        EventBus.$on("CHANGE_PRODUCT", val => {
            this.selected_product.product = val;
        });
        EventBus.$on("CHANGE_SUPPLIER", val => {
            this.supplier = val;
        });
        $(this.$refs.vuemodal).on("hidden.bs.modal", this.resetForm);
    },
    methods: {
        async getUnit(name) {
            const url = `/api/sysvalues/${name}`;
            const response = await axios.get(url);
            this.options = response.data;
        },
        resetForm() {
            this.selected_product.id = null;
            this.selected_product.product = {};
            this.selected_product.purchase_amount = null;
            this.selected_product.purchase_pcs = null;
            this.selected_product.purchase_unit = null;
            this.selected_product.principal_price = 0;
            this.unit = null;
            this.$validator.reset();
        },
        addToCart(selectedProduct) {
            const { sessionStorage } = window.sessionStorage;
            const isExist = this.checkProductIsExistInCart(
                selectedProduct.product
            );
            if (!isExist) {
                this.$validator.validate().then(result => {
                    if (result) {
                        this.carts.push({
                            id: uuidv4(),
                            product: selectedProduct.product,
                            purchase_amount: selectedProduct.purchase_amount,
                            purchase_pcs: selectedProduct.purchase_pcs,
                            purchase_unit: selectedProduct.purchase_unit,
                            principal_price: selectedProduct.principal_price
                        });
                        window.sessionStorage.setItem(
                            "purchases_carts",
                            JSON.stringify(this.carts)
                        );
                        $(this.$refs.vuemodal).modal("hide");
                    }
                });
            } else {
                Swal("Barang Sudah ada");
            }
        },
        removeFromCart(idx) {
            this.carts.splice(idx - 1, 1);
            window.sessionStorage.setItem(
                "purchases_carts",
                JSON.stringify(this.carts)
            );
        },
        editItemFromCart(id) {
            const product = this.carts.find(element => {
                return element.id === id;
            });
            Object.assign(this.selected_product, product);
            $(this.$refs.vuemodal).modal("show");
        },
        updateItemFromCart(id, selectedProduct) {
            const isExist = this.checkProductIsExistInCart(
                selectedProduct.product
            );
            const index = this.carts.findIndex(element => {
                return element.id === id;
            });
            if (
                (!isExist && !this,
                this.carts[index].product.id === selectedProduct.product.id)
            ) {
                this.$validator.validate().then(result => {
                    if (result) {
                        Object.assign(this.carts[index], selectedProduct);
                        window.sessionStorage.setItem(
                            "purchases_carts",
                            JSON.stringify(this.carts)
                        );
                        $(this.$refs.vuemodal).modal("hide");
                    }
                });
            } else {
                Swal("Barang Sudah ada");
            }
        },
        checkProductIsExistInCart(product) {
            const carts = this.getCarts();
            if (Object.keys(carts).length > 0) {
                return carts.some(data => {
                    return data.product.id === product.id;
                });
            }
            return false;
        },
        getCarts() {
            const carts =
                "purchases_carts" in window.sessionStorage
                    ? window.sessionStorage.getItem("purchases_carts")
                    : "[]";
            this.carts = JSON.parse(carts);
            return JSON.parse(carts);
        },
        async storeSales() {
            try {
                const url = "/purchases";
                await axios.post(url, {
                    carts: this.getCarts(),
                    supplier: this.supplier
                });
                window.sessionStorage.clear();
                window.location.href = "/purchases";
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
