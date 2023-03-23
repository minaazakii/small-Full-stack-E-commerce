import { createStore } from 'vuex'
import mutations from './mutation.js';
import actions from './actions.js';
import getters from './getters.js';

import categoryModule from './modules/category/index.js'
import productModule from './modules/product/index.js'

const store = createStore({
    state(){
        return{
            isLoading:false,
            statuses:[],
            user:JSON.parse(localStorage.getItem('user')) || null,
            cart:[],
            cartCount:''
        }
    },
    modules:{
        category:categoryModule,
        product:productModule
    },
    mutations,
    actions,
    getters
});

export default store
