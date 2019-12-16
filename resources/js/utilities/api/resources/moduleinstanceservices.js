import BaseResource from './../baseresource';

export default class extends BaseResource{

    get(id) {
        return this.request('get', '/module-instance-service/' + id);
    }

    create(attributes) {
        return this.request('post', '/module-instance-service', attributes);
    }

    update(id, attributes) {
        return this.request('put', '/module-instance-service/' + id, attributes);
    }

}
