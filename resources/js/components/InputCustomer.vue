<template>
    <div>
        <v-select
            v-model="selected"
            :options="options"
            placeholder="Pilih Pelanggan"
            label="name"
        ></v-select>
    </div>
</template>
<script>
import axios from "axios";
import EventBus from "../eventBus";

export default {
    name: "InputCustomer",
    data: () => {
        return {
            options: [],
            selected: null
        };
    },
    watch: {
        selected(value) {
            EventBus.$emit("CHANGE_CUSTOMER", value);
        }
    },
    mounted() {
        this.getCustomers();
    },
    methods: {
        async getCustomers() {
            try {
                const url = "/api/customers";
                const response = await axios.get(url);
                this.options = response.data;
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
