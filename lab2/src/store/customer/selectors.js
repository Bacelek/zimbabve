export const fetchItems = (store,categoryId) => {
    const {dispatch} = store;
    dispatch('customer/fetchItems',categoryId);
}

export const selectItems = (store) => {
    const {getters} = store;
    return getters['customer/items'];
}

export const removeItem = (store,id) => {
    const {dispatch} = store;
    dispatch('customer/removeItem', id);
}

export const selectItemsById = (store,id) => {
    const {getters} = store;
    return getters['customer/itemsByKey'][id] || {};
}

export const updateItem = (store, {id,name,surname,image}) => {
    const {dispatch} = store;
    dispatch('customer/updateItem', {id,name,surname,image});
}

export const addItem = (store, {name,surname,image}) => {
    const {dispatch} = store;
    dispatch('customer/addItem', {name,surname,image});
}