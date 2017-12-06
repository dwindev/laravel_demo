<template>
    <div>
        <b>Comments</b>
        <div class="row">
            <div class="col-md-12">
                <div class="row" v-for="comment in comments">
                    <div class="col-md-3">{{ comment.user.profile.first_name + ' ' + comment.user.profile.last_name }}</div>
                    <div class="col-md-7">{{ comment.text }}</div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" @click="editComment(comment)">edit</a>
                        <a href="javascript:void(0)" @click="deleteComment(comment.id)" >delete</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <div class="row">
            <form @submit.prevent="createComment">
                <div class="col-md-10">
                    <input v-model="comment.text" type="text" class="form-control">
                    <p class="text-danger" v-for="error in errors.text">{{ error }}</p>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary">Comment</button>
                </div>
            </form>
        </div>

        
        <div class="modal fade" id="edit-comment">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Comment</h4>
                    </div>
                    <div class="modal-body">
                        <input v-model="editCommentData.text" type="text" class="form-control">
                        <p class="text-danger" v-for="error in editErrors.text">{{ error }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="updateComment">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
</template>

<script>
export default {
  data () {
    return {
      comment: { text: '' },
      editCommentData: { text: '' },
      errors: '',
      editErrors: ''
    }
  },
  props: ['post_id', 'comments', 'updateComments'],
  methods: {
    createComment () {
      this.comment.post_id = this.post_id
      axios.post('/comment/create', this.comment).then(response => {
        this.comments = [response.data.comment, ...this.comments]
        this.comment = { text: '' }
        this.errors = ''
      }).catch(err => {
        this.errors = err.response.data.errors
      })
    },
    editComment (data) {
      this.editCommentData = Object.assign({}, data)
      $('#edit-comment').modal('show')
    },
    updateComment () {
      axios.put('/comment/update', this.editCommentData).then(response => {
        let updatedComments = this.comments.map(comment => {
          return comment.id !== response.data.comment.id ? comment : response.data.comment
        })
        this.updateComments(this.post_id, updatedComments)
        $('#edit-comment').modal('hide')
        this.editErrors = ''
      }).catch(err => {
        this.editErrors = err.response.data.errors
      })
    },
    deleteComment (id) {
      if (confirm('Continue Delete?')) {
        axios.delete('/comment/delete/' + id).then(response => {
            let updatedComments = this.comments.filter(comment => comment.id !== id)
            this.updateComments(this.post_id, updatedComments)
        }).catch(err => {
          this.errors = err.response.data.errors
        })
      }
    }
  }
}
</script>