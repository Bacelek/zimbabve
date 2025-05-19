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
            state.items = state.items.filter(({ id }) => id !== idRemove);
        },

        updateItem(state, item) {
            const index = state.items.indexOf(item);
            state.items[index] = item;
        },
    },

    actions: {
        fetchItems: async ({ commit },categoryId) => {
            const response = await api.customer(categoryId);
            const items = await response.json();
            commit('setItems', items);
        },
        removeItem: async ({ commit },id) => {
            const idRemove = await api.remove(id);
            commit('removeItem', idRemove);
        },
        addItem: async ({ commit }, {name,surname,image} ) => {
            const item = await api.add({name,surname,image});
            commit('addItem', item);
        },

        updateItem: async ({ commit }, {id,name,surname,image}) => {
            const item = await api.update({id,name,surname,image});
            commit('updateItem', item);
        }
    }
}