import axios from 'axios';
import { ref } from 'vue';

const editStaff = () => {

    const staffData = ref({});
    const individualData = async (id) => {
        await axios.get('api/staffEdit/' + id, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
                Accept: 'application/json',
            }
        }).then((response) => {

            staffData.value = response.data;
        })
    }
    const toggleEdit = async ({ id, formInput }) => {

        await axios.post('api/editedStaff/toggleEdit/' + id, formInput, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
                Accept: 'application/json',
            }
        }).then((response) => {
            console.log(response.data);


        })

    }

    const storeEdit = async (id, formInput) => {

        await axios.post('api/editedStaff/save/' + id, formInput, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
                Accept: 'application/json',
            }
        }).then((response) => {
            console.log(response.data);
        })

    }
    return { individualData, staffData, storeEdit, toggleEdit }

}
export default editStaff;

