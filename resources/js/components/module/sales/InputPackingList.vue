<template>
    <div>
        <table
            v-if="packing_lists.length > 0"
            class="table table-striped table-bordered"
        >
            <thead>
                <th>LOT</th>
                <th>PCS</th>
                <th>QTY</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr
                    v-for="packing_list in packing_lists"
                    :key="packing_list.id"
                >
                    <td>{{ packing_list.lot_name }}</td>
                    <td>{{ subTotalPcs(packing_list.id) }}</td>
                    <td>{{ subTotalQty(packing_list.id) }}</td>
                    <td>
                        <button
                            class="btn btn-info"
                            @click="editPackingList(packing_list.id)"
                        >
                            Edit
                        </button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <td>Total</td>
                <td>{{ total_pcs }}</td>
                <td>{{ total_qty }}</td>
            </tfoot>
        </table>
        <div class="form-group row">
            <label class="col-md-4"><strong>Nama Lot</strong></label>
            <div class="col-md-6">
                <input
                    v-model="form.lot_name"
                    type="text"
                    class="form-control"
                />
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>LOT</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(lot, index) in form.lots" :key="lot.id">
                    <td>{{ index + 1 }}</td>
                    <td>
                        <input
                            v-model="lot.lot_qty"
                            type="number"
                            name=""
                            class="form-control"
                        />
                    </td>
                    <td>
                        <button
                            class="btn btn-danger"
                            @click="removePackingNumber(index)"
                        >
                            Hapus
                        </button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <td colspan="2">
                    <button class="btn btn-info" @click="addPackingNumber">
                        Add
                    </button>
                </td>
            </tfoot>
        </table>
        <button
            v-if="form.id === null"
            class="btn btn-primary"
            @click="addToPackingList(form)"
        >
            Save
        </button>
        <button
            v-else
            class="btn btn-primary"
            @click="updatePackingList(form.id, form)"
        >
            Update
        </button>
    </div>
</template>
<script>
import EventBus from "../../../eventBus";

const uuidv4 = require("uuid/v4");

export default {
    name: "InputPackingList",
    props: {
        packingLists: {
            type: Array,
            default() {
                return [];
            }
        }
    },
    data: () => {
        return {
            form: { id: null, lot_name: null, lots: [] },
            lots: [],
            lot_name: "",
            tes: null,
            packing_lists: []
        };
    },
    computed: {
        // total_qty() {
        //     return this.paacking_lists.reduce(lotQty => {
        //         let a = 0;
        //         lotQty.lots.forEach(lot => {
        //             a += lot.lots;
        //         });
        //         return a;
        //     }, 0);
        // }
        total_qty() {
            let total = 0;
            this.packing_lists.forEach(a => {
                a.lots.forEach(b => {
                    total += Number(b.lot_qty);
                });
            });
            return total;
        },
        total_pcs() {
            let total = 0;
            this.packing_lists.forEach(a => {
                total += a.lots.length;
            });
            return total;
        }
    },
    beforeMount() {
        this.packing_lists = this.packingLists;
    },
    watch: {
        packingLists(value) {
            this.packing_lists = value;
        }
    },
    methods: {
        editPackingList(id) {
            const found = this.packing_lists.find(element => {
                return element.id === id;
            });
            // Object.assign(this.form, found);
            this.form = JSON.parse(JSON.stringify(found));
        },
        updatePackingList(id, form) {
            const index = this.packing_lists.findIndex(element => {
                return element.id === id;
            });
            // this.packing_lists[index] = this.form;
            Object.assign(this.packing_lists[index], form);
            // this.$set({}, this.packing_lists[index], this.form);
            EventBus.$emit(
                "UPDATE_PACKING_LIST",
                JSON.parse(JSON.stringify(this.packing_lists))
            );
            this.resetForm();
        },
        subTotalPcs(id) {
            const found = this.packing_lists.find(element => {
                return element.id === id;
            });

            return found.lots.length;
        },
        subTotalQty(id) {
            const found = this.packing_lists.find(element => {
                return element.id === id;
            });

            return found.lots.reduce((total, element) => {
                return total + Number(element.lot_qty);
            }, 0);
        },
        resetForm() {
            this.form.id = null;
            this.form.lot_name = "";
            this.form.lots = [];
        },
        addPackingNumber() {
            this.form.lots.push({
                id: uuidv4(),
                lot_name: this.form.lot_name,
                lot_qty: null
            });
        },
        removePackingNumber(index) {
            this.form.lots.splice(index, 1);
        },
        addToPackingList(forms) {
            const form = JSON.parse(JSON.stringify(forms));
            this.packing_lists.push({
                id: uuidv4(),
                lot_name: form.lot_name,
                lots: form.lots
            });
            EventBus.$emit(
                "ADD_PACKING_LIST",
                JSON.parse(JSON.stringify(this.packing_lists))
            );
            this.resetForm();
        }
    }
};
</script>
