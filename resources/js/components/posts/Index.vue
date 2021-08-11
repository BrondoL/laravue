<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">POSTS</div>

                    <div class="card-body">
                        <router-link
                            :to="{ name: 'create' }"
                            class="btn btn-md btn-success"
                            >TAMBAH POST</router-link
                        >

                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr class="d-flex">
                                        <th class="col-2">TITLE</th>
                                        <th class="col-8">KONTEN</th>
                                        <th class="col-2 text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="d-flex"
                                        v-for="(post, index) in posts"
                                        :key="post.id"
                                    >
                                        <td class="col-2">{{ post.title }}</td>
                                        <td class="col-8">
                                            {{ post.content }}
                                        </td>
                                        <td class="text-center col-2">
                                            <router-link
                                                :to="{
                                                    name: 'edit',
                                                    params: { id: post.id }
                                                }"
                                                class="btn btn-sm btn-primary"
                                                >EDIT</router-link
                                            >
                                            <button
                                                @click.prevent="
                                                    PostDelete(post.id, index)
                                                "
                                                class="btn btn-sm btn-danger"
                                            >
                                                HAPUS
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: []
        };
    },
    created() {
        let uri = `http://localhost:8000/api/posts`;
        this.axios.get(uri).then(response => {
            this.posts = response.data.data;
        });
    },
    methods: {
        PostDelete(id, index) {
            let answ = confirm("Apakah ingin menghapus data ?");
            if (answ == true) {
                this.axios
                    .delete(`http://localhost:8000/api/posts/${id}`)
                    .then(response => {
                        this.posts.splice(index, 1);
                    })
                    .catch(error => {
                        alert("system error!");
                    });
            }
        }
    }
};
</script>
