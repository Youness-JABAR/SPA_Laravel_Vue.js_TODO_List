<template>
  <div class="row">
      <div class="col-1">
        <input class="form-check-input" v-model="form.is_finished" @click="updateTodo"  type="checkbox" value="" id="flexCheckDefault">
    </div> 
    <div class="col-md-3">
        <input class="form-control" :disabled="form.is_finished == 1"  :style="form.is_finished ?'text-decoration : line-through':''" v-model="form.name" type="text"  placeholder="ToDo description">
    </div> 
    <div class="col-md-2">
        <select :disabled="form.is_finished == 1" class="form-control" id="inputGroupSelect01">
            <option value="1" :selected="form.choice == 1">user</option>
            <option value="2" :selected="form.choice == 2">admin</option>
        </select>
    </div> 
    <div class="col-md-2">
        <select  :disabled="form.is_finished == 1" class="form-control" v-model="form.id" id="inputGroupSelect01">
                <option v-for='person in persons' :key="person.id"  :value="person.id">{{person.name}}</option>
        </select>
        
    </div> 

    <div class="col-md-2">
          <button @click="deleteTodo()" type="button" class="btn btn-danger">delete</button>
    </div> 
    <div class="col-md-2">
          <button @click="updateTodo()" type="button" class="btn btn-warning">update</button>
    </div> 
    </div>
      
</template>

<script>
export default {
    data(){
        return {
            todoId : null,
            form : {
                choice : null,
                id : null,
                name : null,
                is_finished : null,
            }
        }

    },
    props :['users', 'admins','todo'],
    created (){
        if (this.todo.users.length != 0){
            this.form.choice = 1;
            this.form.id=this.todo.users[0].id

        }
            
        else {
            this.form.choice = 2;
            this.form.id=this.todo.admins[0].id
        }
        this.todoId = this.todo.id;
        this.form.name = this.todo.name;
        this.form.is_finished = this.todo.is_finished;
        
        // console.log(this.todo)
    },
    methods : {
        deleteTodo(){
            axios.delete("api/todos/"+this.todoId).then( response =>
            {
                this.$store.commit('deleteTodo',this.todoId);
            })
        },
        updateTodo(){
            console.log(this.form)
            axios.put("/api/todos/"+this.todoId, this.form).then( response =>
            {
                this.$store.commit('updateTodo',response.data.data);
                console.log(response.data.data)
            }).catch(errors => {
                     console.log(errors.response.data.errors)
                })
        }
    },
    computed : {
        persons(){
            if (this.form.choice == 1){
                return this.users
            }
            else{
                return this.admins
            }

        }

    }
}
</script>

<style>

</style>