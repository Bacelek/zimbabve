import Api from '/src/api/index.js';
class Customer extends Api{
    customer = (categoryId) => {
        if(categoryId) {
            return this.rest('/customer/list_filtered.json',{
                method: 'POST',
                'Content-Type': 'application/json',
                body: JSON.stringify({categoryId}),
            });
        }

        return this.rest("/customer/list.json");
    }


    add = (customer) => {
        const formData = new FormData();
        Object.keys(customer).forEach(key => {
            formData.append(key, customer[key]);
        });

        return this.rest('/customer/add-item', {
            method: 'POST',
            body: formData,
        }).then(res => res.json());
    }

    update = (customer) => {
        const formData = new FormData();
        Object.keys(customer).forEach(key => {
            formData.append(key, customer[key]);
        });

        return this.rest('/customer/update-item', {
            method: 'POST',
            body: formData,
        }).then(res => res.json());
    }

    remove = (id) => this.rest('/customer/delete-item', {
        method: 'POST',
        'Content-Type': 'application/json',
        body: JSON.stringify({id}),
    }).then(() => id);
}

export default new Customer();