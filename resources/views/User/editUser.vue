<template>
<div v-if="loading">
<div class="d-flex justify-content-center">
     <div class="spinner-grow text-dark" role="status">
  <span class="visually-hidden">Loading...</span>
</div>

</div>
</div>

    <div v-else class="userForm">

        <form @submit.prevent="editedForm">
            <div class="row">
                <div class="col-md-8">

                    <div id="userInputs" class="card card-body" shadow>

                        <h3 class="text-center">Edit User</h3>

                        <div class="stl">
                            <label for="">Name</label>
                            <br>
                            <input type="text" v-model="data.name">


                            <p v-if="data.error.nameError" class="errorStyle">
            {{data.error.nameError}}
            </p>
                        </div>
                        <div class="stl">
                            <label for="">Email</label>
                            <br>
                            <input type="email" v-model="data.email">
                            <p v-if="data.error.emailError" class="errorStyle">
            {{data.error.emailError}}
            </p>
                        </div>
                        <br>
                        <div class="text-center">

                        <button type="submit" class="btn btn-primary btn-sm">Create</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>


    </div>

</template>

<script>
import { reactive ,ref} from '@vue/reactivity'
import axios from 'axios'
import { watch,onMounted } from '@vue/runtime-core'
export default {
    props: ['id'],
    setup(props) {
        const data=reactive({
            name:'',
            email:'',
            error:{
                nameError:'',
                emailError:'',
            }
        })

        const receivedUser=ref({});
        const editUserRef=ref({});
        const loading = ref(false);

        //Api Request Received after pressing edit button from table
        const userData=async()=>{
            await axios.get('api/user/edit/'+ props.id,{
                 headers:{
                    Authorization: `Bearer ${localStorage.getItem('token')}`,
                    Accept: 'application/json',
                }
            })
        .then((res)=>{
            receivedUser.value=res.data;

        })}

        // Calling APi Request
        onMounted(()=>{
             userData();
        })


        //Watching Data to Be change(ReceivedUser)
         watch(receivedUser,()=>{
          data.name =receivedUser.value.name;
          data.email =receivedUser.value.email;
        })
        function formValidation(){

            const name =data.name.trim();
            const email =data.email.trim();
            const required={
                emailRequired:'Emial required!!!',
                minNameLength:'Name must be of at leat 5 characters!!!',
                nameRequired:'Name required!!!',
            }
        if(name.length<5){
            data.error.nameError = required.minNameLength;
        }if(!name){
            data.error.nameError = required.nameRequired;
        }if(!email){
            data.error.emailError=required.emailRequired;
        }if(name.length<5 ||!name || !email){
            return false;
        }
        data.error.nameError='';
        data.error.emailError='';
        return true;


        }
        function editedForm(){
            const errorFlag=formValidation();
            if(!errorFlag){
                return null;
            }
            editUser();

        }
        // Save changes
        const editUser = async() =>{
            await axios.post('api/user/update/'+props.id,data,{
                headers:{
                    Authorization: `Bearer ${localStorage.getItem('token')}`,
                    Accept: 'application/json',
                }
            }).then ((response)=>{
                editUserRef.value=response.data;

            })
        }



    return{receivedUser,loading,data,editedForm}


    }


}
</script>

<style>
.userForm {
    /* margin-top:5px; */
    margin: 30px 10px;


}

#userInputs {
    /* margin:40px; */
    padding: 10px 20px;
    font-weight: bold;

}

input {
    width: 90%;
}

.stl {
    margin-top: 10px;

}

.btn {
    width: 100px;


}

.errorStyle {
    color: red;
    font-family: italic;
    font-size: 13px;
}
</style>
