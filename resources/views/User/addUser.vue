<template>
<div v-if="loading">
<div class="d-flex justify-content-center">
     <div class="spinner-grow text-dark" role="status">
  <span class="visually-hidden">Loading...</span>
</div>

</div>
</div>
  <div v-else class="userForm">

    <form @submit.prevent="userLogedIn">
    <div class="row">
        <div class="col-md-12">

        <div id="userInputs" class="card card-body" shadow>

        <h3>Create User</h3>

        <div class="stl">
            <label for="">Name</label>
            <br>
            <input type="text" v-model="formInput.name">
            <p v-if="formInput.error.nameError" class="errorStyle">
            {{formInput.error.nameError}}
            </p>
        </div>
        <div class="stl">
            <label for="">Email</label>
            <br>
            <input type="email" v-model="formInput.email">
            <p v-if="formInput.error.emailError" class="errorStyle">
            {{formInput.error.emailError}}
            </p>
        </div>
        <div class="stl">
            <label for="">Password</label>
            <br>
        <input type="password" v-model="formInput.password">
        <p v-if="formInput.error.passwordError" class="errorStyle">
            {{formInput.error.passwordError}}
            </p>
        </div>
        <br>

     <button type="submit" class="btn btn-primary btn-sm">Create</button>

    </div>
    </div>
    </div>

    </form>


  </div>
</template>

<script>
import { reactive,ref } from '@vue/reactivity'
import { watch } from "@vue/runtime-core";
import router from '../../Router/router';

export default {

    setup(){
        const formInput= reactive(
            {
                name:'',
                email:'',
                password:'',
                error:{
                    nameError:'',
                    emailError:'',
                    passwordError:''
                },

            })
            const apiResUser = ref({});
    const loading = ref(false);

    function fromValidation(){
        const name =formInput.name.trim();
        const email =formInput.email.trim();
        const password=formInput.password.trim();
            //    console.log(name, email, password);
        const required={
            emailRequired:'Email required !!!',
            passwordRequired:'Password required!!!',
            minNameLength:'Name must be of at leat 5 characters!!!',
            nameRequired:'Name required!!!',
            passwordRequired:'Password required!!!',
            passwordStandard:'Minimum eight characters, at least one letter, one number and one special character'
       }

    const passwordRegex =/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

        if(name.length<5){
            formInput.error.nameError = required.minNameLength;
        }if(!name){
            formInput.error.nameError = required.nameRequired;
        }if(!email){
            formInput.error.emailError=required.emailRequired;
        }if(!password){
            formInput.error.passwordError=required.passwordRequired;
        }
        if(!passwordRegex.test(password)){
            formInput.error.passwordError=required.passwordStandard;
            return false;
        }
        if(name.length<5 || !name ||  !email ||!password){
            return false;
        }

        formInput.error.nameError=" ";
        formInput.error.emailError=" ";
        formInput.error.passwordError=" ";
        return true;


    }

      // function submit(){
    //     console.log('hello eve');
    // }
    function userLogedIn(){
       const Errorflag= fromValidation();
       if(!Errorflag){
            return null;
       }
       userAddRequest();
       loading.value=true;
    watch(apiResUser,(newRes,oldRes)=>{
        loading.value=false;
        router.push({name:'userDashboard'})
    });




    }

     const userAddRequest= async()=>{
                await axios.post('api/user/add',formInput,{
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`,
                        Accept: 'application/json',
                    }
                })
                .then((res)=>{
                    // console.log(res);
                    apiResUser.value = res.data;

                })
            }


    return{formInput,userLogedIn,loading}

    }

}
</script>

<style scoped>
.userForm{
    /* margin-top:5px; */
   margin:30px 30px;


}
#userInputs{
    /* margin:40px; */
    padding:10px 30px;
    font-weight:bold;

}
input{
    width: 90%;
}
.stl{
    margin-top:10px;

}
.btn{
    width: 100px;

}
.errorStyle{
    color:red;
    font-family: italic;
    font-size:13px;
}

</style>
