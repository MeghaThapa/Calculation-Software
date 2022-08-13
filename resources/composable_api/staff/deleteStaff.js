import axios from "axios"

const deleteStaff=()=>{
        const staffDelete=async(id)=>{
            console.log(id);
            await axios.delete('api/Staff/delete/'+id,{
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`,
                    Accept: 'application/json',
                }
            }).then((response)=>{
              
            }
            )
        }
        return {staffDelete}

}
export default deleteStaff;
