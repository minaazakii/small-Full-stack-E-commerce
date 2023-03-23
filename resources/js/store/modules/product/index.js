import prodActions from './actions.js'
import prodGetters from './getters.js'
import prodMutations from './mutations.js'

export default {
    state(){
        return{
            products:[]
        }
    },
    actions:prodActions,
    mutations:prodMutations,
    getters:prodGetters
}