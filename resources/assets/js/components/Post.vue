<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Post</div>
                    <div class="panel-body">
                        <form @submit.prevent="createPost">
                            <input v-model="post.title" type="text" class="form-control" placeholder="Title">
                            <br>
                            <textarea v-model="post.text" placeholder="Write Something" class="form-control" required></textarea>
                            <br>
                            <button class="btn btn-primary">Post</button>     
                        </form>
                    </div>
                </div>
                <br><br>
                <post-item v-for="post in posts" :post="post" :key="post.id"></post-item>
            </div>
        </div>
    </div>
</template>

<script>
import PostItem from './PostItem'

export default {
  data () {
    return {
      post: {},
      posts: []
    }  
  },
  components: {
    'post-item': PostItem
  },
  created () {
    this.getPosts()
  },
  methods: {
    getPosts () {
      axios.post('/posts', this.post).then(response => {
        this.posts = response.data.posts
      })
    },
    createPost () {
      axios.post('/post/create', this.post).then(response => {
        this.posts = [response.data.post, ...this.posts]
        this.post = {}
      })
    }
  }
}
</script>