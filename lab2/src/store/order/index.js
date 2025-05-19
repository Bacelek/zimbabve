import api from './api'

export default{
    namespaced: true,
    state: {
        items: [],
    },

    getters: {
        items: state => state.items,
        itemsByKey: state => state.items.reduce((acc, cur) => {
            acc[cur.id] = cur;
            return acc;
        },{}),
    },
    mutations:{
        setItems(state, items) {
            state.items = items;
        },
        addItem(state, item) {
            state.items.push(item);
        },
        removeItem(state, idRemove) {
            state.items = state.items.filter(({id}) => id !== idRemove);
        },

        updateItem(state, item) {
            const index = state.items.indexOf(item);
            state.items[index] = item;
        },
    },

    actions: {
        fetchItems: async ({ commit },categoryId) => {
            const response = await api.order(categoryId);
            const items = await response.json();
            commit('setItems', items);
        },
        removeItem: async ({ commit },id) => {
            const idRemovedItem = await api.remove(id);
            commit('removeItem', idRemovedItem);
        },

        addItem: async ({ commit }, {customer_name,customer_surname,customer_id} ) => {
            const item = await api.add({customer_name,customer_surname,customer_id});
            commit('addItem', item);
        },

        updateItem: async ({ commit }, {id,customer_name,customer_surname,customer_id}) => {
            const item = await api.update({id,customer_name,customer_surname,customer_id});
            commit('updateItem', item);
        }

    }

}