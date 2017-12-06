<template>
    <div>
        <div class="panel panel-default">
                <div class="panel-heading">
                    {{ post.user.profile.first_name + ' ' + post.user.profile.last_name }}
                    <span class="pull-right">
                        <a href="javascript:void(0)" @click="editPost(post)">edit</a>
                        <a href="javascript:void(0)" @click="deletePost(post.id, index)" >delete</a>
                    </span> &nbsp;
                    <!-- <span class="pull-right">{{ post.created_at }}</span> &nbsp; -->
                </div>
                <div class="panel-body">
                    <h4>{{ post.title }}</h4>
                    <p>{{ post.text }}</p>
                </div>
                <div class="panel-footer">
                    <comment :updateComments="updateComments" :post_id="post.id" :comments="post.comments"></comment>
                </div>
        </div>
    </div>
</template>

<script>
import Comment from './Comment'

export default {
  props: ['post', 'deletePost', 'index', 'editPost', 'updateComments'],
  components: {
  'comment': Comment
  }
}
</script>