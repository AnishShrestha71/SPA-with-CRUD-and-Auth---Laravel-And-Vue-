<template>
    <div>
        <h1>dashboard page</h1>
        <button @click.prevent="logout">logout</button>

        name: {{ user.name !== null ? user.name : "" }}

        <input type="text" name="name" placeholder="name" v-model="form.name" />
        <input
            type="text"
            name="telephone"
            placeholder="telephone"
            v-model="form.telephone"
        />
        <button @click.prevent="create">
            {{ isEditable ? "edit" : "save" }}
        </button>

        <div v-if="lists.length > 0">
            <table>
                <tr>
                    <th>name</th>
                    <th>telephone</th>
                    <th>action</th>
                </tr>
                <tr v-for="item in lists" :key="item.id">
                    <td>{{ item.name }}</td>
                    <td>{{ item.phone }}</td>
                    <td>
                        <button @click="editTel(item)">edit</button>
                        <button @click="deleteTel(item.id)">delete</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: null,
            form: {
                name: "",
                telephone: ""
            },
            errors: [],
            lists: [],
            temp_id: null,
            isEditable: false
        };
    },
    methods: {
        fetchAll() {
            axios.get("/api/index").then(res => {
                this.lists = res.data;
                console.log(this.lists);
            });
        },
        logout() {
            axios.post("/api/logout").then(() => {
                this.$router.push({ name: "home" });
            });
        },
        create() {
            if (this.isEditable) {
                try {
                    axios
                        .put(`api/update/${this.temp_id}`, this.form)
                        .then(res => {
                            this.form = {
                                name: "",
                                telephone: ""
                            },
                            this.temp_id = null,
                            this.isEditable = false,
                           
                            this.fetchAll();
                        });
                } catch (e) {
                    console.log(e);
                }
            } else {
                try {
                    axios.post("api/store", this.form).then(res => {
                        this.form = {
                            name: "",
                            telephone: ""
                        };
                        console.log(res.data);
                        this.lists = [res.data,
                        ...this.lists]

                    });
                } catch (e) {
                    console.log(e);
                }
            }
            // this.fetchAll();
        },
        deleteTel(id) {
            try {
                axios.delete(`api/delete/${id}`).then(res => {
                    this.fetchAll();
                    // this.lists = [res.data , this.lists]
                });
            } catch (e) {
                console.log(e);
            }
        },
        editTel(tel) {
            this.form = {
                name: tel.name,
                telephone: tel.phone
            };
            this.temp_id = tel.id;
            this.isEditable = true;
        }
    },
    mounted() {
        axios.get("/api/user").then(res => {
            this.user = res.data;
        });
        this.fetchAll();
    }
};
</script>
