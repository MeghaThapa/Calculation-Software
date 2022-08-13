<template>
  <h3 class="text-center">Staff Dashboard</h3>

<router-link class="btn btn-primary float-end"  :to="{name:'addStaff'}">Add Staff</router-link>
<br>
<br>
<div class="row">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact 1</th>
                <th>Contact 2</th>
                <th>Monthly salary</th>
                <th>OT</th>
                <th>Activity</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="(data,i) in trValue.staff " :key="data.id">
                    <td>{{++i}}</td>
                    <td>{{data.name}}</td>
                    <td>{{data.address}}</td>
                    <td>{{data.contact1}}</td>
                    <td>{{data.contact2}}</td>
                    <td>{{data.monthlySalary}}</td>
                    <td>{{data.ot}}</td>
                    <td>
                        <div class="form-check form-switch">
                           <input class="form-check-input "   @change="toggle(data.id,$event.target.checked)" :checked="data.status"  type="checkbox" id="flexSwitchCheckChecked" >
                            <!-- <label class="form-check-label" for="flexSwitchCheckChecked"></label> -->

                        </div>
                    </td>
                    <td>
                        <router-link  class="btn btn-primary" :to="{ name: 'editStaffs',params:{id:data.id}}">Edit</router-link>
                        <button class="btn btn-danger" @click="dltStaf(data.id)">Delete</button>
                    </td>

            </tr>

        </tbody>
    </table>
</div>
</template>

<script setup>
import { reactive,ref } from '@vue/reactivity'
import tableData from '../../composable_api/staff/tableData';
import { onMounted } from '@vue/runtime-core';
import deleteStaff from '../../composable_api/staff/deleteStaff.js'
import router from '../../Router/router';
import editStaff from '../../composable_api/staff/editStaff.js';




        const{toggleEdit}=editStaff();
        const {getStaffDetails, trValue,loading}= tableData();
        const{staffDelete}=deleteStaff();
        function dltStaf(id){
            Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                        }
                        })
                 staffDelete(id);
                 getStaffDetails();
        }
        function toggle(id,flag){
                const toggleValue= reactive({
                   flag:flag
                })
              toggleEdit({formInput:toggleValue,id:id});
        }

   onMounted(()=>{
         getStaffDetails();
   })

</script>

<style>

/* switch */
.form-check-input:checked {
    background-color: green;
    border-color: green;
}

.form-switch .form-check-input {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='green'/%3e%3c/svg%3e");
}
.form-switch .form-check-input:focus {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='green'/%3e%3c/svg%3e");
}

</style>
