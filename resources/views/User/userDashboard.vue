<template>

    <div class="row">
        <div class="col-md-3">

<h2 class="mt-4">User Dashborad</h2>
</div>
<div class="col-md-6"></div>
<div class="col-md-3">
<router-link  class="btn btn-primary btn-sm float-end mt-5" :to="{name:'addUser'} ">Add User</router-link>
</div>
<div id="app">
<table class="table table-striped table-bordered" style="width:100% " >

    <thead>
       <tr>
         <th>S.N</th>
        <th>Name</th>
        <th>Email</th>
        <th>Create at</th>
        <th>Action</th>
       </tr>

    </thead>

    <tbody>
        <tr v-for="(dataReceived,i) in dataReceive" :key="dataReceived.index">

            <td>{{++i}}</td>
            <td>{{dataReceived.name}}</td>
            <td>{{dataReceived.email}}</td>
            <td>{{dataReceived.created_at}}</td>
            <td>
                <router-link :to="{ name: 'userEdit',params:{id:dataReceived.id}}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </router-link>
                &nbsp;


                <a  @click="deleteUser(dataReceived.id)">
                <i class="fa-solid fa-trash-can-list" style="color:red;"></i>
                </a>
            </td>
        </tr>
    </tbody>
</table>
</div>
</div>

</template>

<script>
import { reactive,ref } from '@vue/reactivity'
import axios from 'axios'


export default {
   setup(){
    const tableReq=reactive({
        email:'',
        name:'',
        created_at: '',
    })
    const dataReceive= ref({});
    //Get data in table
    const getDataReq=async()=>{
        await axios.get('api/users/userList',{
                 headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
                Accept: 'application/json',
            }
        })
        .then((res)=>{
            // console.log(res);
            dataReceive.value=res.data;
        })


    }
        const dltUser=async(id)=>{
            // console.log(id);
            await axios.delete('api/user/delete/'+id,{
                headers:{
                    Authorization: `Bearer ${localStorage.getItem('token')}`,
                    Accept: 'application/json',
                }
            }).then((res)=>{
                // console.log(res);
            })
        }
    function deleteUser(id){


        const flag=confirm("Are you sure you want to delete this user?");
        if(flag){
            dltUser(id);
            getDataReq();

        }
    }
    return{getDataReq,dataReceive,deleteUser}


   },
   mounted() {

        this.getDataReq();

  }

}
</script>

<style>
thead{
    background: blue;
    color:white;
}
table{
    margin-top:15px ;
    border:3px solid black ;
}
</style>
