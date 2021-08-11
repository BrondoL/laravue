<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">TAMBAH POST</div>

                    <div class="card-body">
                        <form @submit.prevent="PostStore">
                            <div class="form-group">
                                <div v-if="validation.title">
                                    <div
                                        class="alert alert-danger mt-1"
                                        role="alert"
                                    >
                                        {{ validation.title[0] }}
                                    </div>
                                </div>
                                <label>TITLE</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="post.title"
                                    placeholder="Masukkan Title"
                                />
                            </div>

                            <div class="form-group">
                                <div v-if="validation.content">
                                    <div
                                        class="alert alert-danger mt-1"
                                        role="alert"
                                    >
                                        {{ validation.content[0] }}
                                    </div>
                                </div>
                                <label>KONTEN</label>
                                <textarea
                                    class="form-control"
                                    v-model="post.content"
                                    rows="5"
                                    placeholder="Masukkan Konten"
                                ></textarea>
                            </div>

                            <div class="form-group">
                                <button
                                    type="submit"
                                    class="btn btn-sm btn-success"
                                >
                                    SIMPAN
                                </button>
                                <button
                                    type="reset"
                                    class="btn btn-sm btn-danger"
                                >
                                    RESET
                                </button>
                            </div>
                        </form>
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
            post: {},
            validation: []
        };
    },
    methods: {
        PostStore() {
            let uri = "http://localhost:8000/api/posts";
            this.axios
                .post(uri, this.post)
                .then(response => {
                    this.$router.push({
                        name: "posts"
                    });
                })
                .catch(error => {
                    this.validation = error.response.data.data;
                });
        }
    }
};
</script>
