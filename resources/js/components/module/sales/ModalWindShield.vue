<template>
    <div>
        <div
            id="testModal"
            ref="vuemodal"
            class="modal fade"
            tabindex="-1"
            role="dialog"
            aria-labelledby="windshieldLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="windshieldLabel" class="modal-title">
                            Stok Barang
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
                        TEst
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div
            id="windshieldModal"
            ref="vuemodal"
            class="modal fade"
            tabindex="-1"
            role="dialog"
            aria-labelledby="windshieldLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="windshieldLabel" class="modal-title">
                            Stok Barang
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
                        <button
                            class="btn btn-sm btn-info"
                            data-toggle="modal"
                            data-target="#testModal"
                        >
                            Tambah
                        </button>
                        <div class="form-group row">
                            <label for="" class="col-md-3">
                                Rak
                            </label>
                            <div class="col-md-3">
                                <select
                                    id=""
                                    v-model="form.rack_id"
                                    name=""
                                    class="form-control"
                                >
                                    <option
                                        v-for="rack in stocks.rack"
                                        :key="rack.id"
                                        :value="rack.pivot"
                                        >{{ rack.name }}</option
                                    >
                                </select>
                            </div>
                            <div class="col-md-3">
                                <p v-if="form.rack_id != null">
                                    Sisa Stok {{ form.rack_id.qty }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3">Harga</label>
                            <div class="col-md-3">
                                <input
                                    id=""
                                    v-model="form.price"
                                    type="text"
                                    name=""
                                    class="form-control"
                                />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3">Jumlah</label>
                            <div class="col-md-3">
                                <input
                                    id=""
                                    v-model="form.qty"
                                    type="text"
                                    name=""
                                    class="form-control"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
#testModal {
    z-index: 1080 !important;
    background-color: rgba(0, 0, 0, 0.5);
}
</style>

<script>
export default {
    props: {
        stocks: {
            type: Object,
            default: () => {
                return {};
            }
        }
    },
    data: () => {
        return {
            form: {
                rack_id: null,
                price: 0,
                qty: 0
            }
        };
    }
};
</script>
