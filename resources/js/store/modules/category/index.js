import catActions from './actions.js'
import catGetters from './getters.js'
import catMutations from './mutations.js'
export default {
    state(){
        categories:[]
    },
    actions:catActions,
    getters:catGetters,
    mutations:catMutations,
}