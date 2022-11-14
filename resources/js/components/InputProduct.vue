<template>
    <div>
        <v-select
            v-model="selected"
            :options="options"
            :disabled="disabled"
            label="color"
            placeholder="Pilih Warna"
        >
        </v-select>
    </div>
</template>
<script>
import axios from "axios";
import EventBus from "../eventBus";

export default {
    name: "InputProduct",
    props: {
        value: {
            default: null,
            type: Object
        }
    },
    data: () => {
        return {
            options: [],
            selected: null,
            disabled: true
        };
    },
    watch: {
        value(val) {
            this.selected = val;
        },
        selected(val) {
            this.getProduct(val);
        }
    },
    mounted() {
        EventBus.$on("CHANGE_ARTICLE", val => {
            if (val !== null) {
                this.fetchProducts(val.value);
                this.selected = {};
            }
        });
    },
    methods: {
        async fetchProducts(articleId) {
            try {
                const url = `/api/products/${articleId}`;
                const response = await axios.get(url);
                this.options = response.data;
                this.disabled = false;
            } catch (error) {
                console.log(error);
            }
        },
        getProduct(val) {
            EventBus.$emit("CHANGE_PRODUCT", val);
        }
    }
};
</script>
