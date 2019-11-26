import BaseResource from './../baseresource';

export default class extends BaseResource{

    create(parameters) {
        return this.request('post', '/action-instance', parameters);
    }

    update(id, parameters) {
        return this.request('patch', '/action-instance/' + id, parameters);
    }

}
