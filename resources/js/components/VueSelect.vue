<template>
    <div>
        <v-select v-model="selected" :options="options" placeholder="select" />
        <input type="hidden" :name="name" :value="selected.value" />
    </div>
</template>
<script>
export default {
    name: "VueSelect",
    props: {
        name: {
            type: String,
            default: null
        },
        value: {
            default: () => {
                return [];
            },
            type: Array
        },
        valueId: {
            default: null,
            type: String
        }
    },
    data() {
        return {
            selected: "",
            options: []
        };
    },
    mounted() {
        this.initData();
    },
    methods: {
        initData() {
            if (this.value.length > 0) {
                this.options = this.value.map(element => {
                    return { label: element.name, value: element.id };
                });
            }

            if (this.valueId != null) {
                this.selected = this.options.find(element => {
                    return element.value === this.valueId;
                });
            }
        }
    }
};
</script>
