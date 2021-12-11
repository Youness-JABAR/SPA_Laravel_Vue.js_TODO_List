import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex)




const store = new Vuex.Store({
    state : {
        todos : []

    },
    getters : {
        getTodos(state){
            return state.todos;

        },
        getTodosNumber(state){
            return state.todos.length;

        }

    },
    mutations : {
        deleteTodo(state,todoId){
            state.todos = state.todos.filter(todo => todo.id != todoId)
        },
        setTodos(state,todos){
            state.todos=todos;
            
        },
        addTodo(state, todo){
            state.todos.push(todo);
        },
        updateTodo(state, newTodo){
            state.todos = state.todos.map(todo => {
                return todo.id == newTodo.id ? newTodo : todo
            })
        }

    },
    actions : {

    },
    
    plugins: [createPersistedState()]
})

export default store