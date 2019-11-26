import BaseResource from './../baseresource';

export default class extends BaseResource{

    get(id) {
        return this.request('get', '/module-instance-setting/' + id);
    }

    create(attributes) {
        return this.request('post', '/module-instance-setting', attributes);
    }

    update(id, attributes) {
        return this.request('put', '/module-instance-setting/' + id, attributes);
    }

}
