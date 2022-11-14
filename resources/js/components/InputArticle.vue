<template>
    <div>
        <v-select
            v-model="selected"
            :options="options"
            placeholder="Pilih Artikel"
        ></v-select>
    </div>
</template>
<script>
import axios from "axios";
import EventBus from "../eventBus";

export default {
    name: "InputArticle",
    props: {
        value: {
            default: null,
            type: Object
        }
    },
    data: () => {
        return {
            selected: null,
            options: []
        };
    },
    watch: {
        value(val) {
            if (val !== null) {
                this.selected = { label: val.name, val: val.id };
            } else {
                this.selected = val;
            }
        },
        selected(val) {
            EventBus.$emit("CHANGE_ARTICLE", val);
        }
    },
    mounted() {
        this.fetchArticles();
    },
    methods: {
        async fetchArticles() {
            const url = "/api/articles";
            const response = await axios.get(url);
            this.options = response.data.map(element => {
                return { label: element.name, value: element.id };
            });
        },
        getProduct(val) {
            EventBus.$emit("CHANGE_ARTICLE", val);
        }
    }
};
</script>
