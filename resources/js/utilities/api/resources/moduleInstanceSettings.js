import BaseResource from './../baseresource';

export default class extends BaseResource{

    get(id) {
        return this.request('get', '/module-instance-setting/' + id);
    }

    forModuleInstance(moduleInstanceId) {
        return this.request('get', '/module-instance/' + moduleInstanceId + '/module-instance-setting')
    }

    create(key, value, moduleInstanceId) {
        return this.request('post', '/module-instance-setting', {key: key, value: value, module_instance_id: moduleInstanceId});
    }

    update(id, value) {
        return this.request('put', '/module-instance-setting/' + id, {value: value});
    }


}
