<template>

    <div class="container" >
        <form action="" @submit.prevent="submitHandel">
        <div class="row justify-content-center">
            <h1>Calculation Software </h1>
            <h2>{{formInput.email}}</h2>
            <h2>{{formInput.password}}</h2>
            <div class="col-lg-5">
            <div class="card card-body shadow mt-3" >
                <label id="mail" >Email</label>
                <input type="text" v-model="formInput.email" :style="(formInput.emailError)? ' border-bottom: 3px solid red;':null">
                <p v-if="formInput.emailError" class="formErr">
                        {{formInput.emailError}}
                </p>

                <label for="">Password </label>
                <input type="text" v-model="formInput.password" :style="(formInput.pwError)? ' border-bottom: 3px solid red;':null">
                <p v-if="formInput.pwError" class="formErr">
                        {{formInput.pwError}}
                </p>
                <span>
                    <input type="checkbox">&nbsp;&nbsp;
                    <label>  Remember Password</label>
                </span>
               <button type="submit" class="btn btn-primary" >
                    Login
               </button>
               <a href="" class="fpw">Forget Password?</a>
               <!-- <a class="fpw"> Forget Password?</label> -->
            </div>
        </div>
        </div>
        </form>
    </div>
</template>

<script>
import { reactive } from '@vue/reactivity'
import axios from 'axios';
import router from '../../Router/router';
export default {
    setup(){
        const formInput=reactive( {
                email:'',
                password:'',
               emailError:'',
               pwError:''
            })
            function formValidation(){
            const required ={
                    emailRequired:'Email required!!!!',
                    passwordRequired:'Password required!!',
             }
             if(!formInput.email ){
                    formInput.emailError= required.emailRequired;
                }
            if(!formInput.password){
                    formInput.pwError= required.passwordRequired;
                }
            if(!formInput.email || !formInput.password){
                return false;
            }
            return true;


            }

            function submitHandel(){
                const flag= formValidation();
                if(!flag){
                    return null;
                }

                loginRequest();
            }

            const loginRequest= async()=>{
                await axios.post('api/user/login',formInput)
                .then((res)=>{
                    localStorage.setItem('token',res.data.authentication.token)
                    router.push({name:'home'})
                })
            }

            return{ formInput, submitHandel}
    }


}
</script>

<style scoped>

h1{
    text-align: center;
     padding-top: 75px;

}
input{
  border-bottom: 3px solid black;
  margin-bottom: 15px;
}
label{
    font-size: 18px;
}
.card{
    padding:40px;
}
.fpw{
    font-size:14px;
     text-align: center;
}
.formErr{
    color:red;

}
</style>
