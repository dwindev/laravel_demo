<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Post</div>
                    <div class="panel-body">
                        <form @submit.prevent="createPost">
                            <input v-model="post.title" type="text" class="form-control" placeholder="Title">
                            <p class="text-danger" v-for="error in errors.title">{{ error }}</p>
                            <br>
                            <textarea v-model="post.text" placeholder="Write Something" class="form-control"></textarea>
                            <p class="text-danger" v-for="error in errors.text">{{ error }}</p>
                            <br>
                            <button class="btn btn-primary">Post</button>     
                        </form>
                    </div>
                </div>
                <br><br>
                <post-item v-for="(post, index) in posts" 
                :post="post"
                :deletePost="deletePost" 
                :index="index"
                :editPost="editPost"
                :updateComments="updateComments"
                :key="post.id"></post-item>
            </div>
        </div>

        <div class="modal fade" id="edit-post">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Post</h4>
              </div>
              <div class="modal-body">
              <form>
                  <input v-model="editPostData.title" type="text" class="form-control" placeholder="Title">
                  <p class="text-danger" v-for="error in editErrors.title">{{ error }}</p>
                  <br>
                  <textarea v-model="editPostData.text" placeholder="Write Something" class="form-control"></textarea>
                  <p class="text-danger" v-for="error in editErrors.text">{{ error }}</p>
                  <br>
              </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="updatePost">Save changes</button>
              </div>
            </div>
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
      editPostData: {},
      posts: [],
      errors: '',
      editErrors: ''
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
      axios.post('/posts?limit=5', this.post).then(response => {
        this.posts = response.data.posts
      })
    },
    createPost () {
      axios.post('/post/create', this.post).then(response => {
        this.posts = [response.data.post, ...this.posts]
        this.post = {}
        this.errors = ''
      }).catch(err => {
        this.errors = err.response.data.errors
      })
    },
    editPost (data) {
      this.editPostData = Object.assign({}, data)
      $('#edit-post').modal('show')
    },
    updatePost () {
      axios.put('/post/update', this.editPostData).then(response => {
        this.posts = this.posts.map(post => {
          return post.id !== response.data.post.id ? post : response.data.post
        })

        $('#edit-post').modal('hide')
        this.editErrors = ''
      }).catch(err => {
        this.editErrors = err.response.data.errors
      })
    },
    deletePost (id, index) {
      if (confirm('Continue Delete?')) {
        axios.delete('/post/delete/' + id).then(response => {
          this.posts.splice(index, 1)
        }).catch(err => {
          this.errors = err.response.data.errors
        })
      }
    },
    updateComments (post_id, comments) {
      let postIndex = this.posts.findIndex(post => post.id === post_id)
      this.posts[postIndex].comments = comments
    }
  }
}
</script>