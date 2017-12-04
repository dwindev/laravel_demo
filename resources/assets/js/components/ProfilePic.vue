<template>
    <div>
        <img v-model="profilePic" class="profile" :src="'/avatars/' + profilePic" alt="">
        <form action="" class="text-center">
            <br>
            <div class="form-group">
                <center><input id="profile" @change="updateProfile" style="border: 1px solid #d4d1d1;" type="file"></center>
            </div>
        </form>
    </div>
</template>

<script>

export default {
  data () {
    return {
      profilePic: ''
    }
  },
  props: ['profile_pic'],
  watch: {
    profile_pic () {
      this.profilePic = this.profile_pic !== 'default_profile.jpg' ? this.profile_pic : 'default_profile.jpg'
    }
  },
  methods: {
    updateProfile (e) {
      let form  = new FormData()
      form.set('profile_pic', e.target.files[0])
      axios.post('/profile/picture', form).then(response => {
        this.profilePic = response.data.file
        $('#profile').val('')
      })
    }
  }
}
</script>


<style>
img.profile {
    max-width: 134px;
    border-radius: 300px;
}
</style>