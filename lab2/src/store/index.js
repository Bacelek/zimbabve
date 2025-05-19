import {createStore} from 'vuex';
import customer from './customer';
import order from './order';
export default createStore(
    {
        modules: {
            customer,
            order,
        },
        state:{},
        mutations:{},
        actions:{},
    }
)