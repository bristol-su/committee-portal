import BaseResource from './../baseresource';

export default class extends BaseResource{

    create(parameters) {
        return this.request('post', '/action-instance-field', parameters);
    }

    update(id, parameters) {
        return this.request('patch', '/action-instance-field/' + id, parameters);
    }

}
