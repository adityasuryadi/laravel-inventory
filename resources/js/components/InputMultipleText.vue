<template>
    <div class="form-group">
        <button
            type="button"
            class="btn btn-primary"
            href="#"
            @click="addField"
        >
            Tambah
        </button>
        <br />
        <br />
        <table class="table table-bordered">
            <thead>
                <th>No</th>
                <th>Type Mobil</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr v-for="(field, index) in fields" :key="index.name">
                    <td>{{ index + 1 }}</td>
                    <td>
                        <input
                            v-model="field.name"
                            type="text"
                            class="form-control"
                        />
                    </td>
                    <td>
                        <button class="btn btn-danger">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" :name="name" :value="JSON.stringify(fields)" />
    </div>
</template>
<script>
export default {
    props: {
        name: {
            type: String,
            default: "car_type"
        },
        value: {
            type: Array,
            default: () => {
                return [];
            }
        }
    },
    data() {
        return {
            fields: [
                {
                    name: null
                }
            ]
        };
    },
    methods: {
        addField() {
            this.fields.push({ name: null });
        }
    }
};
</script>
