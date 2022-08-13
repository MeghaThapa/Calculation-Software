<template>
  <form @submit.prevent="store">
    <div class="row">
      <div class="col-md-8">
        <div class="card card-body shadow" >
           <h3 class="text-center">Edit Staff</h3>
              <div class="oneDiv">
                <label>Name </label>
                <br>
                <input type="text" v-model="formInput.name" >


              <div class="oneDiv">
                <label>Address</label>
                <br>
                <input type="text" v-model="formInput.address">

              </div>
              <div class="oneDiv">
                <label> Contact 1</label>
                <br>
                <input type="number" min="0" v-model="formInput.contact1" >

              </div>
              <div class="oneDiv">
                <label> Contact 2</label>
                <br>
                <input type="number" min="0" v-model="formInput.contact2" >

              </div >
              <div class="oneDiv">
                <label>Monthly Salary</label>
                <input type="number"  min="0" v-model="formInput.monthlySalary">

              </div>
               <div class="oneDiv">
                <label>OT</label>
                <br>
                <input type="number" min="0" v-model="formInput.ot">

              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
       </div>
    </div>
  </form>
</template>

<script>
import useVuelidate from "@vuelidate/core"
import { reactive } from '@vue/reactivity'
import editStaff from '../../composable_api/staff/editStaff';
import { onMounted, watch } from '@vue/runtime-core';
import {
  required,
  minValue,
  minLength,
  maxLength,
} from "@vuelidate/validators";
import { routeLocationKey } from 'vue-router';
import router from '../../Router/router';

export default {
    props:['id'],
setup(props){
    // console.log(props.id);
    const {individualData,storeEdit,staffData}=editStaff();
    const formInput=reactive({
        name:'',
        address:'',
        contact1:'',
        contact2:'',
        monthlySalary:'',
        ot:''

    })
    const rules={
        name:{required, minLength:minLength(5)},
        address:{required},
        contact1:{required, minLength:minLength(10), maxLength:minLength(10)},
        contact2:{minLength:minLength(10), maxLength:minLength(10)},
        monthlySalary:{required,minVale:minValue(0)},
        ot:{required,minVale:minValue(0)}

    };
    const v$ =useVuelidate(rules,formInput);
    const id= props.id;

    const store= async()=>{
        const flag= await v$.value.$validate();
                if(!flag){
                    // console.log('false');
                    return null;

                }


         storeEdit(id,formInput);
         router.push(
            {name:"staffDashboard"}
         );
    }

    onMounted(()=>{
                individualData(id);

            })




   watch(staffData,()=>{
        formInput.name=staffData.value.staff.name;
        formInput.address=staffData.value.staff.address;
        formInput.contact1=staffData.value.staff.contact1;
        formInput.contact2=staffData.value.staff.contact2;
        formInput.monthlySalary=staffData.value.staff.monthlySalary;
        formInput.ot=staffData.value.staff.ot;

   })
    return {formInput, id, staffData,storeEdit,store};


}
}
</script>

<style>
.oneDiv{
    margin-bottom: 15px;
}

</style>
