<template>
<div>
    <div class="row"> 
        <ul class="list-group">
            <li v-for="error,index in errors" v-bind:key="index" class="list-group-item list-group-item-danger">
                {{ error[0] }}
            </li>
        </ul>  
    </div>
    <div class="row"> 
        <div class="col-md-2">
            <select v-model="form.choice" class="form-control" id="inputGroupSelect01">
                <option selected>type user</option>
                <option value="1">user</option>
                <option value="2">admin</option>
            </select>
        </div> 
        <div class="col-md-2">
            <select class="form-control" v-model="form.id" id="inputGroupSelect01">
                <option v-for='person in persons' :key="person.id"  :value="person.id">{{person.name}}</option>
            </select>
            
        </div> 
        <div class="col-md-3">
            <input @keyup.enter="handleSubmit" v-model="form.name" class="form-control" type="text"  placeholder="Add a new todo ( hit enter to add )">
        </div>
    </div> 
</div>
</template>

<script>
import axios from 'axios'
    export default {
        data(){
            return{
                form : {
                    id : null,
                    choice : 1,
                    name : null,

                },
                choice : 1,
                errors : {},
            }
        },
        props :['users', 'admins'],
        computed : {
            persons(){
                if (this.form.choice == 1){
                    return this.users
                }
                else{
                    return this.admins
                }

            }

        },
        methods : {
            handleSubmit(){
                axios.post('/api/todos',this.form).then(response=>{
                   this.errors = {};
                   this.form.name= null;
                   this.form.id= null;

                   this.$store.commit('addTodo',response.data.data);

                    console.log(response.data);
                }).catch(errors => {
                    this.errors=errors.response.data.errors
                    // console.log(errors.response.data.errors)
                })
            }
            
        }

    }
</script>