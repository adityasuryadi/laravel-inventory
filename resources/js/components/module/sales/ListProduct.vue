<template>
    <div>
        <v-client-table :data="tableData" :columns="columns" :options="options">
            <template slot="id" scope="props">
                <button
                    class="btn btn-sm btn-info"
                    target="_blank"
                    @click="addProductToCart(props.row.id)"
                >
                    Tambah
                </button>
            </template>
        </v-client-table>
    </div>
</template>
<script>
import Axios from "axios";

export default {
    name: "FormSales",
    data() {
        return {
            columns: ["article.name", "color", "pcs", "amount", "id"],
            tableData: [],
            options: {
                headings: {
                    "article.name": "Artikel",
                    color: "Warna",
                    pcs: "PCS",
                    amount: "Stok",
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
    mounted() {
        this.fetchProducts();
    },
    methods: {
        async fetchProducts() {
            const url = "/api/products";
            const response = await Axios.get(url);
            this.tableData = response.data;
        },
        addProductToCart(id) {
            //
        }
    }
};
</script>
