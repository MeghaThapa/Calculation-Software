import axios from "axios"
import { ref } from "vue"

const tableData = () => {
    const trValue=  ref({});
    const loading = ref(true);

    const getStaffDetails = async () => {
        await axios.get('api/staff/index', {
                headers:{
                    Authorization:  `Bearer ${localStorage.getItem('token')}`,
                    Accept:'application/json',
                }
        }).then((response)=>{
            trValue.value=response.data;
            // console.log(trValue.value);
            loading.value=false;

        })

    }
    return {getStaffDetails, trValue,loading}
}
export default tableData;

