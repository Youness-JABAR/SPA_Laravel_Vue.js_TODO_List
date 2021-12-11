<template>
  <div>
      <Header/>
        <div class="container">
            <div v-for=' todo in todos' :key="todo.id" >
                <Onetodo :users="users" :todo="todo" :admins="admins" />
                <hr>
            </div>
            <CreateTodo :users="users" :admins="admins"  />
        </div>
  </div>
</template>

<script>
import Header from './components/Header'
import Onetodo from './components/Onetodo'
import CreateTodo from './components/CreateTodo'
import axios from 'axios'
import {mapGetters} from 'vuex'


export default {
    data(){

        return {
            users : [],
            admins : [],
        }
    },
    created(){
        
        this.getUsers();
        this.getAdmins();
        this.getTodos();

    },
    methods : {
        getUsers (){
            axios.get('/api/users').then(response=>{
                this.users=response.data;
                
                })
        },
        getAdmins (){
            axios.get('/api/admins').then(response=>{
                this.admins = response.data;
                
                })
        },
        getTodos (){
            
            axios.get('/api/todos').then(response=>{
            this.$store.commit('setTodos', response.data.data)
                 //console.log(response.data.data);
                })
        }   

    },
    components : {
        Header,
        Onetodo,
        CreateTodo,

    },
    computed : {
        ...mapGetters({
            todos : 'getTodos'
        })
    }

   
}
</script>