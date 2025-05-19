export const fetchItems = (store,categoryId) => {
    const {dispatch} = store;
    dispatch('order/fetchItems',categoryId);
}

export const selectItems = (store) => {
    const {getters} = store;
    return getters['order/items'];
}

export const removeItem = (store,id) => {
    const {dispatch} = store;
    dispatch('order/removeItem', id);
}

export const selectItemsById = (store,id) => {
    const {getters} = store;
    return getters['order/itemsByKey'][id] || {};
}

export const updateItem = (store, {id,date,cost,customer_id}) => {
    const {dispatch} = store;
    dispatch('order/updateItem', {id,date,cost,customer_id});
}

export const addItem = (store, {date,cost,customer_id}) => {
    const {dispatch} = store;
    dispatch('order/addItem', {date,cost,customer_id});
}