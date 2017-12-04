<template>
    <div class="panel panel-default">
            <div class="panel-heading">
                {{ post.user.profile.first_name + ' ' + post.user.profile.last_name }}
                <span class="pull-right">{{ post.created_at }}</span>
            </div>
            <div class="panel-body">
                <h4>{{ post.title }}</h4>
                <p>{{ post.text }}</p>
            </div>
            <div class="panel-footer">
                <comment :post_id="post.id" :comments="post.comments"></comment>
            </div>
    </div>
</template>

<script>
import Comment from './Comment'

export default {
  props: ['post'],
  components: {
  'comment': Comment
  }
}
</script>