import axios from 'axios';
import { ref } from '@vue/reactivity';

const createStaff = () => {
    //Store
    const staff = ref('');
    const staffError = ref('');


    //Api request
    const staffCreate = async (form) => {
        await axios.post('api/staff/create', form, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
                Accept: 'application/json',
            }
        }).then((response) => { //200 response

            console.log(response);
            staff.value = response.data;

        }).catch((err) => { //400 500 response
            staffError.value = err.message;
        });

    }

    return { staff, staffError, staffCreate }

}

export default createStaff;
