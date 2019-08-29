import BaseResource from './../baseresource';

export default class extends BaseResource{

    get(id) {
        return this.request('get', '/module_instance_setting/' + id);
    }

    create(attributes) {
        return this.request('post', '/module_instance_setting', attributes);
    }

    update(id, attributes) {
        return this.request('put', '/module_instance_setting/' + id, attributes);
    }

}
