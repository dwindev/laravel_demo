<template>
    <div>
        <b>Comments</b>
        <div class="row">
            <div class="col-md-12">
                <div class="row" v-for="comment in comments">
                    <div class="col-md-3">{{ comment.user.profile.first_name + ' ' + comment.user.profile.last_name }}</div>
                    <div class="col-md-9">{{ comment.text }}</div>
                </div>
                <br>
            </div>
        </div>
        <div class="row">
            <form @submit.prevent="createComment">
                <div class="col-md-10">
                    <input v-model="comment.text" type="text" class="form-control">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary">Comment</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
  data () {
    return {
      comment: { text: '' }
    }
  },
  props: ['post_id', 'comments'],
  methods: {
    createComment () {
      this.comment.post_id = this.post_id
      axios.post('/comment/create', this.comment).then(response => {
        this.comments = [response.data.comment, ...this.comments]
        this.comment = { text: '' }
      })
    }
  }
}
</script>