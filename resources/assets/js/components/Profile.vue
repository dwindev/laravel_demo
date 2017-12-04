<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <profile-pic :profile_pic="userProfile.profile_pic"></profile-pic>
                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form @submit.prevent="updateProfile">
                            <div class="form-group">
                                <label for="">First name</label>
                                <input v-model="userProfile.first_name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Last name</label>
                                <input v-model="userProfile.last_name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input v-model="userProfile.phone_no" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Mobile Number</label>
                                <input v-model="userProfile.mobile_no" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input v-model="userProfile.address" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">City</label>
                                <input v-model="userProfile.city" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">State</label>
                                <input v-model="userProfile.state" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Zip</label>
                                <input v-model="userProfile.zip" type="text" class="form-control">
                            </div>
                            <button class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProfilePic from './ProfilePic'

export default {
  data () {
    return {
      userProfile: ''
    }  
  },
  created () {
    this.getProfileDetails()
  },
  components: {
    'profile-pic': ProfilePic
  },
  methods: {
    getProfileDetails () {
      axios.get('/profile/details').then(response => {
          this.userProfile = response.data.user.profile
          this.userProfile.id = response.data.user.id
      })
    },
    updateProfile () {
      axios.put('/profile/update', this.userProfile).then(response => {
        alert('Successfully Updated')
      }).catch(err => {
        alert('Something went wrong')
      })
    }
  }
}
</script>
