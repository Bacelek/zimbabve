import Api from '/src/api/index.js';
class Order extends Api{
    order = (categoryId) => {
        if(categoryId) {
            return this.rest('/order/list_filtered.json',{
                method: 'POST',
                'Content-Type': 'application/json',
                body: JSON.stringify({categoryId}),
            });
        }
        return this.rest("/order/list.json");
    }

    remove = (id) => this.rest('/order/delete', {
        method: 'POST',
        'Content-Type': 'application/json',
        body: JSON.stringify({id}),
    }).then(() => id);
    add = (order) => this.rest('/order/add', {
        method: 'POST',
        'Content-Type': 'application/json',
        body: JSON.stringify({order}),
    }).then(() => order);

    update = (order) => this.rest('/order/update', {
        method: 'POST',
        'Content-Type': 'application/json',
        body: JSON.stringify({order}),
    }).then(() => order);
}

export default new Order();