<template>
  <form @submit.prevent="submit">
    <div class="row">
      <div class="col-md-8">
        <div class="card card-body shadow" >
           <h3 class="text-center">Create Staff</h3>
              <div class="oneDiv">
                <label>Name </label>
                <br>
                <input type="text" v-model="form.name">
               <div  class="errorRef" v-for="error in v$.name.$errors" :key="error">
                    {{error.$message}}
               </div>
              </div>
              <div class="oneDiv">
                <label>Address</label>
                <br>
                <input type="text" v-model="form.address">
                 <div class="errorRef" v-for="error in v$.address.$errors" :key="error">
                    {{error.$message}}
               </div>
              </div>
              <div class="oneDiv">
                <label> Contact 1</label>
                <br>
                <input type="number" min="0" v-model="form.contact1">
                <div class="errorRef" v-for="error in v$.contact1.$errors" :key="error">
                    {{error.$message}}
               </div>
              </div>
              <div class="oneDiv">
                <label> Contact 2</label>
                <br>
                <input type="number" min="0" v-model="form.contact2">
                 <div class="errorRef" v-for="error in v$.contact2.$errors" :key="error">
                    {{error.$message}}
               </div>
              </div >
              <div class="oneDiv">
                <label>Monthly Salary</label>
                <input type="number"  min="0" v-model="form.monthlySalary">
                 <div class="errorRef" v-for="error in v$.monthlySalary.$errors" :key="error">
                    {{error.$message}}
               </div>
              </div>
               <div class="oneDiv">
                <label>OT</label>
                <br>
                <input type="number" min="0" v-model="form.ot">
                 <div class="errorRef" v-for="error in v$.ot.$errors" :key="error">
                    {{error.$message}}
               </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import { reactive } from '@vue/reactivity'
import useVuelidate from "@vuelidate/core"
import createStaff from "../../composable_api/staff/createStaff.js";
import { watch } from "@vue/runtime-core";

import {
  required,
  minValue,
  minLength,
  maxLength,
} from "@vuelidate/validators";
import router from '../../Router/router.js';
export default {
    // components:[createStaff.js],
    setup(){

      const {staff,staffCreate} =createStaff();

        const form=reactive({
            name:'',
            address:'',
            contact1:'',
            contact2:'',
            monthlySalary:'',
            ot:''
        })
         const rules={
            name:{ required, minLength: minLength(5) },
            address:{required},
            contact1:{required, minLength: minLength(10),maxLength: maxLength(10)},
            contact2:{required, minLength: minLength(10),maxLength: maxLength(10)},
            monthlySalary:{required, minValue: minValue(0)},
            ot:{required, minValue:minValue(0)}
        };
        const v$ = useVuelidate(rules, form);
    const submit= async()=>{
        const result = await v$.value.$validate();
        if(!result){
            console.log("false");
            return null;
        }
            staffCreate(form);
    }
    watch(staff,()=>{
        router.push({name:'staffDashboard'})
    })



        return{form, v$, submit};
    }

}
</script>

<style scoped>
.oneDiv{
    margin-bottom: 15px;
}
button{
    margin-left:30%;
    margin-right:25%;
}
.errorRef{
    color:red;
}

</style>
