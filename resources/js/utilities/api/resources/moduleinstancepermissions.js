import BaseResource from './../baseresource';

export default class extends BaseResource{

    get(id) {
        return this.request('get', '/module-instance-permission/' + id);
    }

    create(attributes) {
        return this.request('post', '/module-instance-permission', attributes);
    }

    update(id, attributes) {
        return this.request('put', '/module-instance-permission/' + id, attributes);
    }


    forModuleInstance(moduleInstanceId) {
        return this.request('get', '/module-instance/' + moduleInstanceId + '/module-instance-permission')
    }

}
