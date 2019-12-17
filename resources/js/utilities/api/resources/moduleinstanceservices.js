import BaseResource from './../baseresource';

export default class extends BaseResource{

    get(id) {
        return this.request('get', '/module-instance-service/' + id);
    }

    create(service, connectionId, moduleInstanceId) {
        return this.request('post', '/module-instance-service', {
            service: service, connection_id: connectionId, module_instance_id: moduleInstanceId
        });
    }

    update(id, connectionId) {
        return this.request('put', '/module-instance-service/' + id, {connection_id: connectionId});
    }

    forModuleInstance(moduleInstanceId) {
        return this.request('get', '/module-instance/' + moduleInstanceId + '/module-instance-service')
    }

    all() {
        return this.request('get', '/module-instance-service');
    }

}
