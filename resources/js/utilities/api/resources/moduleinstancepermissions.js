import BaseResource from './../baseresource';

export default class extends BaseResource{

    get(id) {
        return this.request('get', '/module_instance_permission/' + id);
    }

    create(attributes) {
        return this.request('post', '/module_instance_permission', attributes);
    }

    update(id, attributes) {
        return this.request('put', '/module_instance_permission/' + id, attributes);
    }

}
